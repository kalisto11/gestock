<?php
	class BonEntree
	{
		public $id;
		public $reference;
		public $date;
		public $dotations;
		public $fournisseur;
		public $totalGeneral;

		public function __construct($id = null) {//constructeur du bon d'entrée
			if ($id != null){
				$this->id = $id;
				$pdo = Database::getPDO();
				$req = "SELECT id, reference, DATE_FORMAT(date, '%d/%m/%Y') AS date, fournisseur FROM bon_entree WHERE id = ?";
				$reponse = $pdo->prepare($req);
				$reponse->execute(array($id));
				$bonentree         = $reponse->fetch();
				$this->id          = $bonentree['id'];
				$this->reference   = $bonentree['reference'];
				$this->date        = $bonentree['date'];
				$this->fournisseur = new Fournisseur($bonentree['fournisseur']);
				$req = 'SELECT * FROM article RIGHT JOIN entree_article ON article.id = entree_article.id_article WHERE entree_article.id_bon_entree = ?';
				$reponse = $pdo->prepare($req);
				$reponse->execute(array($id));
				$dotations = [];
				while ($row = $reponse->fetch()){
					$article = new Article($row['id']);
					$dotation = new Dotation($article, $row['quantite'], $row['prix'], $row['total']);
					$dotations[] = $dotation;
				}
				$this->dotations = $dotations;	
			}
			else{
				$this->id          = null;
				$this->reference   = null;
				$this->date        = null;
				$this->dotations   = null;
				$this->fournisseur = null;
			}
		}

		public function save() {// Méthode permettant d'insérer un bon d'entrée
			$pdo = Database::getPDO();
            $req = 'INSERT INTO bon_entree (reference, date, fournisseur) VALUES (:reference, CURDATE(), :fournisseur)';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
			'reference'   => $this->reference,
			'fournisseur' => $this->fournisseur
			));
			$req = 'SELECT id FROM bon_entree Order By ID Desc LIMIT 1';
        	$reponse = $pdo->query($req);
			$bonentree = $reponse->fetch();
			$this->id = $bonentree['id'];
			$this->saveArticles();
		 }

		public function delete() { //Méthode qui permet de supprimer un bon d'entrée
			$pdo = Database::getPDO();
			$req = 'DELETE FROM bon_entree WHERE id = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));
			$req = 'DELETE FROM entree_article WHERE id_bon_entree = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array( $this->id));
		}

		public function modify() {//Méthode permettant de modifier le bon d'entrée
			$pdo = Database::getPDO();
            $req = 'UPDATE bon_entree SET reference = :reference, fournisseur = :fournisseur WHERE id = :id';
            $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
			$resultat = $reponse->execute(array( 
			'reference'   => $this->reference,
			'fournisseur' =>$this->fournisseur,
			'id'           =>$this->id
			));	
			$this->saveArticles($this->id);
		}
		/**
		  * permet de récupérer la liste des bons d'entrée
		  */
		public static function getList($perpage, $offset) {
			$pdo = Database::getPDO();
			$req = "SELECT id from bon_entree ORDER BY date DESC LIMIT $perpage OFFSET $offset";
			$reponse = $pdo->query($req);
			$bonsentrees = array();
			while ($row = $reponse->fetch()){
				$bonentree = new BonEntree($row['id']);
				$bonsentrees[] = $bonentree;
			}
			return $bonsentrees;
		}
		public static function getNbrBon(){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM bon_entree";
			$reponse = $pdo->query($req);
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			 return  $count;
		}

		public function saveArticles(){
			$pdo = Database::getPDO();
			$req = 'DELETE FROM entree_article WHERE id_bon_entree = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));
			foreach ($this->dotations as $dotation){
				$req = 'INSERT INTO entree_article (id_bon_entree, id_article, quantite, prix, total) VALUES (:id_bon_entree, :id_article, :quantite, :prix, :total)';
				$reponse = $pdo->prepare($req);
				$reponse->execute(array(
					'id_bon_entree' => $this->id,
					'id_article'    => $dotation->article,
					'quantite'    => $dotation->quantite,
					'prix'		=> $dotation->prix,
					'total'		=> $dotation->total
           		));
        	}
		}

	}// fin class
<?php
	class BonSortie
	{
		public $id;
		public $reference;
		public $date;
		public $article;
		public $quantite;
		public $beneficiaire;

		public function __construct($id = null) {//constructeur du bon de sortie
			if ($id != null){
				$this->id = $id;
				$pdo = Database::getPDO();
				$req = "SELECT id, reference, DATE_FORMAT(date, '%d/%m/%Y') AS date, beneficiaire FROM bon_sortie WHERE id = ?";
				$reponse = $pdo->prepare($req);
				$reponse->execute(array($id));
				$bonsortie        = $reponse->fetch();
				$this->id          = $bonsortie['id'];
				$this->reference   = $bonsortie['reference'];
				$this->date        = $bonsortie['date'];
				$this->beneficiaire = new Personnel($bonsortie['beneficiaire']);
				$req = 'SELECT id, nom FROM article RIGHT JOIN sortie_article ON article.id = sortie_article.id_article WHERE sortie_article.id_bon_sortie = ?';
				$reponse = $pdo->prepare($req);
				$reponse->execute(array($id));
				$articles = array();
				while ($row = $reponse->fetch()){
					$article = new Article( $row['id']);
					$articles[] = $article;
				}
				$this->article = $articles;	
			}	
			else{
				$this->id          = null;
				$this->reference   = null;
				$this->date        = null;
				$this->article     = null;
				$this->quantite    = null;
				$this->beneficiaire = null;
			}
		}

		public function save() {// Méthode permettant d'insérer un bon de sortie
			$pdo = Database::getPDO();
            $req = 'INSERT INTO bon_sortie (reference, date, beneficiaire) VALUES (:reference, CURDATE(),:beneficiaire)';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
			'reference'   => $this->reference,
			'beneficiaire' => $this->beneficiaire
			));
			$req = 'SELECT id FROM bon_sortie Order By ID Desc LIMIT 1';
        	$reponse = $pdo->query($req);
			$bonsortie = $reponse->fetch();
			$this->id = $bonsortie['id'];
			foreach ($this->article as $article){
				$req = 'INSERT INTO sortie_article (id_bon_sortie, id_article) VALUES (:id_bon_sortie, :id_article)';
				$reponse = $pdo->prepare($req);
				$reponse->execute(array(
					'id_bon_sortie' => $this->id,
					'id_article'    => $article
           		 ));
        	}
		}

		public function delete() { //Méthode qui permet de supprimer un bon de sortie
			$pdo = Database::getPDO();
			$req = 'DELETE FROM bon_sortie WHERE id = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));

			$req = 'DELETE FROM sortie_article WHERE id_bon_sortie = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));
		}

		public function modify() {//Méthode permettant de modifier le bon de sortie
			$pdo = Database::getPDO();
            $req = 'UPDATE bon_sortie SET reference = :reference, beneficiaire = :beneficiaire WHERE id = :id';
            $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
            $resultat = $reponse->execute(array(
			'reference'   => $this->reference,
			'beneficiaire' =>$this->beneficiaire,
            'id'          => $this->id
            ));
			
			$req = 'DELETE FROM sortie_article WHERE id_bon_sortie = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));
			foreach ($this->article as $article){
			$req = 'INSERT INTO sortie_article (id_bon_sortie, id_article) VALUES (:id_bon_sortie, :id_article)';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array(
				'id_bon_sortie' => $this->id,
				'id_article'    => $article
			));
		}
		}
		/**
		  * permet de récupérer la liste des bons de sortie
		  */ 
		public static function getList() {
			$pdo = Database::getPDO();
			$req = 'SELECT id from bon_sortie';
			$reponse = $pdo->query($req);
			$bonssorties = array();
			while ($row = $reponse->fetch()){
				$bonsortie = new BonSortie($row['id']);
				$bonssorties[] = $bonsortie;
			}
			return $bonssorties;
		}

	}// fin class
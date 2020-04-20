<?php
	class BonEntree
	{
		public $id;
		public $reference;
		public $date;
		public $article;
		public $quantite;
		public $fournisseur;

		public function __construct($id = null) {//constructeur du bon d'entrée
			if ($id != null){
				$this->id = $id;
				$pdo = Database::getPDO();
				$req = 'SELECT * from bon_entree WHERE id = ?';
				$reponse = $pdo->prepare($req);
				$reponse->execute(array($id));
				$bonentree         = $reponse->fetch();
				$this->id          = $bonentree['id'];
				$this->reference   = $bonentree['reference'];
				$this->date        = $bonentree['date'];
				$this->article     = $bonentree['article'];
				$this->quantite    =$bonentree['quantite'];
				$this->fournisseur =$bonentree['fournisseur'];
				
			}
			else{
				$this->id          = null;
				$this->reference   = null;
				$this->date        = null;
				$this->article     = null;
				$this->quantite    = null;
				$this->fournisseur = null;
			}
		}
		public function save() {// Méthode permettant d'insérer un bon d'entrée
			$pdo = Database::getPDO();
            $req = 'INSERT INTO bon_entree (reference, date, article, quantite, fournisseur ) 
			VALUES (:reference, :date, :article, :quantite, :fournisseur)';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
			'reference'   => $this->reference,
			'date'        => $this->date,
			'article'     =>$this->article,
			'quantite'    =>$this->quantite,
			'fournisseur' =>$this->fournisseur
            ));
		}
		public function delete() { //Méthode qui permet de supprimer un bon d'entrée
			$pdo = Database::getPDO();
			$req = 'DELETE FROM bon_entree WHERE id = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));
		}
		public function modify() {//Méthode permettant de modifier le bon d'entrée
			$pdo = Database::getPDO();
            $req = 'UPDATE bon_entree SET (reference = :reference, date = :date, article =:article, quantite =:quantite, fournisseur =:fournisseur) WHERE id = :id';
            $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
            $resultat = $reponse->execute(array(
			'reference'   => $this->reference,
			'date'        =>$this->date,
			'article'     =>$this->article,
			'quantite'    =>$this->quantite,
			'fournisseur' =>$this->fournisseur,
            'id'          => $this->id
            ));
		}

		/**
		  * permet de récupérer la liste des bons d'entrée
		  */
		public static function getList() {
			$pdo = Database::getPDO();
			$req = 'SELECT * from bon_entree';
			$reponse = $pdo->query($req);
			$bonentrees = array();
			while ($row = $reponse->fetch()){
				$bonentree = new BonEntree();
				$bonentree->id          = $row['id'];
				$bonentree->reference   = $row['reference'];
				$bonentree->date        = $row['date'];
				$bonentree->article     = $row['article'];
				$bonentree->quantite    = $row['quantite'];
				$bonentree->fournisseur = $row['fournisseur'];
				$bonentrees[]           = $bonentree;
			}
			return $bonentrees;
		}

	}
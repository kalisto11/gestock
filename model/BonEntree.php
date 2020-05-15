<?php
	class BonEntree
	{
		public $id;
		public $reference;
		public $date;
		public $numeroFacture;
		public $dateFacture;
		public $idFournisseur;
		public $nomFournisseur;
		public $totalGeneral;
		public $idModificateur;
		public $nomModificateur;
		public $dateModification;
		public $dotations;

		public function __construct($id = null) {//constructeur du bon d'entrée
			if ($id != null){
				$this->id = $id;
				$pdo = Database::getPDO();
				$req = "SELECT id, reference, numero_facture, DATE_FORMAT(date_facture, '%d/%m/%Y') AS date_facture, DATE_FORMAT(date, '%d/%m/%Y') AS date, fournisseur_id, fournisseur_nom, modificateur_id, modificateur_nom, DATE_FORMAT(date_modification, '%d/%m/%Y') AS date_modification FROM bon_entree WHERE id = ?";
				$reponse = $pdo->prepare($req);
				$reponse->execute(array($id));
				$bonentree         = $reponse->fetch();
				$this->id          = $bonentree['id'];
				$this->reference   = $bonentree['reference'];
				$this->numeroFacture   = $bonentree['numero_facture'];
				$this->dateFacture   = $bonentree['date_facture'];
				$this->date        = $bonentree['date'];
				$this->idFournisseur = $bonentree['fournisseur_id'];
				$this->nomFournisseur = $bonentree['fournisseur_nom'];
				$this->idModificateur = $bonentree['modificateur_id'];
				$this->nomModificateur = $bonentree['modificateur_nom'];
				$this->dateModification = $bonentree['date_modification'];
				$req = 'SELECT * FROM article RIGHT JOIN entree_article ON article.id = entree_article.id_article WHERE entree_article.id_bon_entree = ?';
				$reponse = $pdo->prepare($req);
				$reponse->execute(array($id));
				$dotations = [];
				while ($row = $reponse->fetch()){
					$dotation = new Dotation($row['id'], $row['nom_article'], $row['quantite'], $row['prix']);
					$dotations[] = $dotation;
					$this->totalGeneral += $dotation->total;
				}
				$this->dotations = $dotations;	
			}
			else{
				$this->id  = null;
				$this->reference   = null;
				$this->numeroFacture   = null;
				$this->dateFacture   = null;
				$this->date        = null;
				$this->idFournisseur = null;
				$this->nomFournisseur = null;
				$this->totalGeneral = null;
				$this->idModificateur = null;
				$this->nomModificateur = null;
				$this->dateModification = null;
				$this->dotations   = null;
			}
		}

		public function save() {// Méthode permettant d'insérer un bon d'entrée
			$pdo = Database::getPDO();
            $req = 'INSERT INTO bon_entree (reference, numero_facture, date_facture, date, fournisseur_id, fournisseur_nom, modificateur_id, modificateur_nom, date_modification) VALUES (:reference, :numeroFacture, :dateFacture, CURDATE(), :idFournisseur, :nomFournisseur, :idModificateur, :nomModificateur, CURDATE())';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
			'reference'   => $this->reference,
			'numeroFacture'   => $this->numeroFacture,
			'dateFacture'   => $this->dateFacture,
			'idFournisseur' => $this->idFournisseur,
			'nomFournisseur' => $this->nomFournisseur,
			'idModificateur' => $this->idModificateur,
			'nomModificateur' => $this->nomModificateur
			));
			$req = 'SELECT id FROM bon_entree Order By ID Desc LIMIT 1';
        	$reponse = $pdo->query($req);
			$bonentree = $reponse->fetch();
			$this->id = $bonentree['id'];
			$statutBon = 'new';
			$this->saveArticles($statutBon);
			

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
            $req = 'UPDATE bon_entree SET reference = :reference, numero_facture = :numeroFacture, date_facture = :dateFacture, fournisseur_id = :idFournisseur, fournisseur_nom = :nomFournisseur, modificateur_id = :idModificateur, modificateur_nom = :nomModificateur, date_modification = CURDATE() WHERE id = :id';
            $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
			$resultat = $reponse->execute(array( 
			'reference'   => $this->reference,
			'numeroFacture'   => $this->numeroFacture,
			'dateFacture'   => $this->dateFacture,
			'idFournisseur' =>$this->idFournisseur,
			'nomFournisseur' =>$this->nomFournisseur,
			'idModificateur' => $this->idModificateur,
			'nomModificateur' => $this->nomModificateur,
			'id'           =>$this->id
			));	
			$statutBon = 'old';
			$this->saveArticles($statutBon);
		}
		/**
		  * permet de récupérer la liste des bons d'entrée
		  */
		public static function getList($perpage, $offset) {
			$pdo = Database::getPDO();
			$req = "SELECT id from bon_entree ORDER BY id DESC LIMIT $perpage OFFSET $offset";
			$reponse = $pdo->query($req);
			$bonsentrees = array();
			while ($row = $reponse->fetch()){
				$bonentree = new BonEntree($row['id']);
				$bonsentrees[] = $bonentree;
			}
			return $bonsentrees;
		}
		
		public static function getListJournal() {
			$pdo = Database::getPDO();
			$req = "SELECT id from bon_entree  WHERE date = CURDATE()";
			$reponse = $pdo->query($req);
			$bonsentrees = array();
			while ($row = $reponse->fetch()){
				$bonentree = new BonEntree($row['id']);
				$bonsentrees[] = $bonentree;
			}
			return $bonsentrees;
		}
		/**
		 * 
		 */
		public static function getListFournisseur($idFournisseur, $perpage, $offset) {
			$pdo = Database::getPDO();
			$req = "SELECT id from bon_entree WHERE fournisseur_id = $idFournisseur ORDER BY date DESC LIMIT $perpage OFFSET $offset";
			$reponse = $pdo->query($req);
			$bonsentrees = array();
			while ($row = $reponse->fetch()){
				$bonentree = new BonEntree($row['id']);
				$bonsentrees[] = $bonentree;
			}
			return $bonsentrees;	
		}
		/**
		 * 
		 */
		public static function getNbrBon(){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM bon_entree";
			$reponse = $pdo->query($req);
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			 return  $count;
		}
		/**
		 * 
		 */
		public static function getNbrBonFournisseur($idFournisseur){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM bon_entree WHERE fournisseur_id = $idFournisseur";
			$reponse = $pdo->query($req);
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			 return  $count;
		}
		/**
		 * 
		 */
		public function saveArticles($statutBon){
			$pdo = Database::getPDO();
			$req = 'DELETE FROM entree_article WHERE id_bon_entree = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));
			foreach ($this->dotations as $dotation){
				$req = 'INSERT INTO entree_article (id_bon_entree, id_article, nom_article, quantite, prix) VALUES (:id_bon_entree, :id_article, :nom_article, :quantite, :prix)';
				$reponse = $pdo->prepare($req);
				$reponse->execute(array(
					'id_bon_entree' => $this->id,
					'id_article'    => $dotation->idArticle,
					'nom_article'    => $dotation->nomArticle,
					'quantite'    => $dotation->quantite,
					'prix'		=> $dotation->prix
				   ));
				if($statutBon == 'old'){
					Article::difQuantity($dotation->idArticle, $this->reference);
				}
				Article::updateQuantity($dotation->idArticle,$dotation->quantite, "entree");
				Article::transaction($dotation->idArticle,$this->id, $this->reference, $dotation->quantite, "entree");			
        	}
		}
		/**
		 * 
		 */
		public function formatDateEng($dateFR){
			$tab = trim($dateFR, "/");
			$parts = explode("/", $tab);
			$revTab = array_reverse($parts);
			$dateEN = implode("-", $revTab);
			return $dateEN;
		}

	}// fin class
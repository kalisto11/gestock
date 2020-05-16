<?php
	class BonSortie{
		public $id;
		public $reference;
		public $date;
		public $dotations;
		public $idBeneficiaire;
		public $nomBeneficiaire;
		public $totalGeneral;
		public $idModificateur;
		public $nomModificateur;
		public $dateModification;
		/**
		 * 
		 */
		public function __construct($id = null) {//constructeur du bon de sortie
			if ($id != null){
				$this->id = $id;
				$pdo = Database::getPDO();
				$req = "SELECT id, reference, DATE_FORMAT(date, '%d/%m/%Y') AS date, beneficiaire_id, beneficiaire_nom, modificateur_id, modificateur_nom, DATE_FORMAT(date_modification, '%d/%m/%Y') AS date_modification FROM bon_sortie WHERE id = ?";
				$reponse = $pdo->prepare($req);
				$reponse->execute(array($id));
				$bonsortie        = $reponse->fetch();
				$this->id          = $bonsortie['id'];
				$this->reference   = $bonsortie['reference'];
				$this->date        = $bonsortie['date'];
				$this->idBeneficiaire = $bonsortie['beneficiaire_id'];
				$this->nomBeneficiaire = $bonsortie['beneficiaire_nom'];
				$this->idModificateur = $bonsortie['modificateur_id'];
				$this->nomModificateur = $bonsortie['modificateur_nom'];
				$this->dateModification = $bonsortie['date_modification'];
				$req = 'SELECT * FROM article RIGHT JOIN sortie_article ON article.id = sortie_article.id_article WHERE sortie_article.id_bon_sortie = ?';
				$reponse = $pdo->prepare($req);
				$reponse->execute(array($id));
				$dotations = [];
				while ($row = $reponse->fetch()){
					$dotation = new Dotation($row['id_article'], $row['nom_article'], $row['quantite'], $row['prix']);
					$dotations[] = $dotation;
					$this->totalGeneral += $dotation->total;
				}
				$this->dotations = $dotations;	
			}	
			else{
				$this->id          = null;
				$this->reference   = null;
				$this->date        = null;
				$this->dotations     = null;
				$this->idBeneficiaire = null;
				$this->nomBeneficiaire = null;
				$this->totalGeneral = null;
				$this->idModificateur = null;
				$this->nomModificateur = null;
				$this->dateModification = null;
				
			}
		}
		/**
		 * 
		 */
		public function save() {// Méthode permettant d'insérer un bon de sortie
			$pdo = Database::getPDO();
            $req = 'INSERT INTO bon_sortie (reference, date, beneficiaire_id, beneficiaire_nom, modificateur_id, modificateur_nom, date_modification) VALUES (:reference, CURDATE(), :idBeneficiaire, :nomBeneficiaire, :idModificateur, :nomModificateur, CURDATE())';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
				'reference'   => $this->reference,
				'idBeneficiaire' => $this->idBeneficiaire,
				'nomBeneficiaire' => $this->nomBeneficiaire,
				'idModificateur' => $this->idModificateur,
				'nomModificateur' => $this->nomModificateur
			));
			$req = 'SELECT id FROM bon_sortie Order By ID Desc LIMIT 1';
        	$reponse = $pdo->query($req);
			$bonsortie = $reponse->fetch();
			$this->id = $bonsortie['id'];
			$statutBon = 'new';
			$this->saveArticles($statutBon);
		}
		/**
		 * 
		 */
		public function delete() { //Méthode qui permet de supprimer un bon de sortie
			$pdo = Database::getPDO();
			$req = 'DELETE FROM bon_sortie WHERE id = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));

			$req = 'DELETE FROM sortie_article WHERE id_bon_sortie = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));
		}
		/**
		 * 
		 */
		public function modify() {//Méthode permettant de modifier le bon de sortie
			$pdo = Database::getPDO();
            $req = 'UPDATE bon_sortie SET reference = :reference, beneficiaire_id = :idBeneficiaire, beneficiaire_nom = :nomBeneficiaire, modificateur_id = :idModificateur, modificateur_nom = :nomModificateur, date_modification = CURDATE() WHERE id = :id';
            $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
			$resultat = $reponse->execute(array( 
			'reference'   => $this->reference,
			'idBeneficiaire' =>$this->idBeneficiaire,
			'nomBeneficiaire' =>$this->nomBeneficiaire,
			'idModificateur' => $this->idModificateur,
			'nomModificateur' => $this->nomModificateur,
			'id' => $this->id
			));	
			
			$req = 'DELETE FROM sortie_article WHERE id_bon_sortie = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));
			$statutBon = 'old';
			$this->saveArticles($statutBon);
			
		}
		/**
		 * 
		 */
		public function saveArticles($statutBon){
			$pdo = Database::getPDO();
			$req = 'DELETE FROM sortie_article WHERE id_bon_sortie = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));
			foreach ($this->dotations as $dotation){
				$req = 'INSERT INTO sortie_article (id_bon_sortie, id_article, nom_article, quantite, prix) VALUES (:id_bon_sortie, :id_article, :nom_article, :quantite, :prix)';
				$reponse = $pdo->prepare($req);
				$reponse->execute(array(
					'id_bon_sortie' => $this->id,
					'id_article'    => $dotation->idArticle,
					'nom_article'    => $dotation->nomArticle,
					'quantite'    => $dotation->quantite,
					'prix'    => $dotation->prix
				));
				if($statutBon == 'old'){
					Article::removeQuantity($dotation->idArticle, $this->reference, "sortie");
				}
				Article::updateQuantity($dotation->idArticle,$dotation->quantite, "sortie");
				Article::insertTransaction($dotation->idArticle, $this->id, $this->reference, $dotation->quantite, "sortie");
			}
		}
		/**
		  * permet de récupérer la liste des bons de sortie
		  */ 
		public static function getList($perpage, $offset) {
			$pdo = Database::getPDO();
			$req = "SELECT id from bon_sortie ORDER BY id DESC LIMIT $perpage OFFSET $offset";
			$reponse = $pdo->query($req);
			$bonssorties = array();
			while ($row = $reponse->fetch()){
				$bonsortie = new BonSortie($row['id']);
				$bonssorties[] = $bonsortie;
			}
			return $bonssorties;
			
		}
		/**
		 * 
		 */
		public static function getListJournal() {
			$pdo = Database::getPDO();
			$req = "SELECT id from bon_sortie WHERE date = CURDATE()";
			$reponse = $pdo->query($req);
			$bonssorties = array();
			while ($row = $reponse->fetch()){
				$bonsortie = new BonSortie($row['id']);
				$bonssorties[] = $bonsortie;
			}
			return $bonssorties;
		}
		/**
		 * 
		 */
		public static function getListBeneficiaire($idBeneficiaire, $perpage, $offset) {
			$pdo = Database::getPDO();
			$req = "SELECT id from bon_sortie WHERE beneficiaire_id = $idBeneficiaire ORDER BY date DESC LIMIT $perpage OFFSET $offset";
			$reponse = $pdo->query($req);
			$bonssorties = array();
			while ($row = $reponse->fetch()){
				$bonsortie = new BonSortie($row['id']);
				$bonssorties[] = $bonsortie;
			}
			return $bonssorties;
			
		}
		/**
		 * 
		 */
		public static function getNbrBon(){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM bon_sortie";
			$reponse = $pdo->query($req);
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			 return  $count;
		}
		/**
		 * 
		 */
		public static function getNbrBonBeneficiaire($idBeneficiaire){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM bon_sortie WHERE beneficiaire_id = $idBeneficiaire";
			$reponse = $pdo->query($req);
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			 return  $count;
		}
		
	}// fin class

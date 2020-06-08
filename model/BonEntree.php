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
				$req = 'SELECT * FROM article RIGHT JOIN entree_article ON article.id = entree_article.id_article WHERE entree_article.id_bon_entree = ? ORDER BY id';
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

		/**
		 * Permet de sauvegarder le bon d'entrée qui l'appelle
		 */
		public function save() {
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

		
		/**
		 * Modifie les informations dans la base de données du bon d'netrée qui l'appelle
		 */
		public function update() {
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
		 * Supprime le bon d'netrée qui l'appelle de la base de données
		 */
		public function delete() {
			$pdo = Database::getPDO();
			$req = 'DELETE FROM bon_entree WHERE id = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));
			$req = 'DELETE FROM entree_article WHERE id_bon_entree = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));
		}

		/**
		  * permet de récupérer la liste des bons d'entrée par lot dont le nombre est défini par $perPage
		  * @param Int $perPage : nombre de bons par page
		  * @param Int $offset : valeur de départ pour chaque lot
		  * @return BonEntree[] : liste des bons d'entrée dont le nombre est égal à $perPage
		  */
		public static function getList($perPage, $offset) {
			$pdo = Database::getPDO();
			$req = "SELECT id from bon_entree ORDER BY id DESC LIMIT $perPage OFFSET $offset";
			$reponse = $pdo->query($req);
			$bonsentrees = array();
			while ($row = $reponse->fetch()){
				$bonentree = new BonEntree($row['id']);
				$bonsentrees[] = $bonentree;
			}
			return $bonsentrees;
		}
		
		/**
		 * Retourne la liste de tous les bons d'entrée par ordre décroissant selon la date
		 * @return BonEntree[] $bonsentrees : liste de tous les bons d'entrées
		 */
		public static function getListAll() {
			$pdo = Database::getPDO();
			$req = "SELECT id from bon_entree ORDER BY date DESC";
			$reponse = $pdo->query($req);
			$bonsentrees = array();
			while ($row = $reponse->fetch()){
				$bonentree = new BonEntree($row['id']);
				$bonsentrees[] = $bonentree;
			}
			return $bonsentrees;
		}
		
		/**
		 * Retourne la liste des bons d'entrée qui ont été créés aujourd'hui
		 * @return BonEntree[] $bonsentrees : liste des bons d'entrée créés aujourd'hui
		 */
		public static function getListJournal() {
			$pdo = Database::getPDO();
			$req = "SELECT id from bon_entree WHERE date = CURDATE()";
			$reponse = $pdo->query($req);
			$bonsentrees = array();
			while ($row = $reponse->fetch()){
				$bonentree = new BonEntree($row['id']);
				$bonsentrees[] = $bonentree;
			}
			return $bonsentrees;
		}

		/**
		 * Retourne le nombre de bons d'entrée présent dans la base
		 * @return Int $count : nombre de bons d'entrée
		 */
		public static function getNbrBon(){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM bon_entree";
			$reponse = $pdo->query($req);
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			 return  $count;
		}
		
		/**
		 * sauvegarde dans la base la liste des articles choisis dans le bon d'entrée
		 * @param String $statutBon : type du bon (old/new)
		 */
		public function saveArticles($statutBon){
			$pdo = Database::getPDO();

			if ($statutBon == 'old'){
				$req = 'DELETE FROM entree_article WHERE id_bon_entree = ?';
				$reponse = $pdo->prepare($req);
				$reponse->execute(array($this->id));
			}
		
			foreach ($this->dotations as $dotation){
				try{
					$req = 'INSERT INTO entree_article (id_bon_entree, id_article, nom_article, quantite, prix) VALUES (:id_bon_entree, :id_article, :nom_article, :quantite, :prix)';
				$reponse = $pdo->prepare($req);
				$reponse->execute(array(
					'id_bon_entree' => $this->id,
					'id_article'    => $dotation->idArticle,
					'nom_article'    => $dotation->nomArticle,
					'quantite'    => $dotation->quantite,
					'prix'		=> $dotation->prix
				   ));
				}
				catch (PDOException $e) {
					echo $e;
				}
				
				
				$article = new Article($dotation->idArticle);
				if($statutBon == 'old'){
					Article::removeArticleQuantity($dotation->idArticle, $this->reference, "entrée");
					Transaction::updateTransaction($dotation->idArticle, $dotation->nomArticle, $article->quantite, $this->id, $this->reference, $dotation->quantite, "entrée");
				}
				else{
					Transaction::insertTransaction($dotation->idArticle, $dotation->nomArticle, $article->quantite, $this->id, $this->reference, $dotation->quantite, "entrée");
				}
        	}
		}

		/**
		 * Retourne le nombre de bon du fournisseur dont l'ID est fourni en paramètre
		 * @param Int $idFournisseur : l'id du fournisseur dont on veut récupérer les bons
		 * @return Int $count : nombre de bons d'entrée du fournisseur
		 */
		public static function getNbrBonFournisseur($idFournisseur){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM bon_entree WHERE fournisseur_id = $idFournisseur";
			$reponse = $pdo->query($req);
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			 return  $count;
		}

		/**
		 * retourne les bons du fournisseur dont l'id est fourni en paramètre
		 * @param Int $idFournisseur : l'id du fournisseur dont on veut récupérer ses bons
		 * @param Int $perPage : nombre de bons affichés par page
		 * @param Int $offset : valeur de départ pour récupere les bons
		 * @return BonEntree[] : tableau des bons d'entrées du fournisseur dont l'id est fourni
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
		 * formatte la date au format français en format anglais pour etre compatible avec le champ date du formulaire
		 * de modification du bon d'entrée
		 * @param Date $dateFR : la date du bon au format français
		 * @return Date $dateEN : la date du bon au format anglais
		 */
		public function formatDateEng($dateFR){
			$tab = trim($dateFR, "/");
			$parts = explode("/", $tab);
			$revTab = array_reverse($parts);
			$dateEN = implode("-", $revTab);
			return $dateEN;
		}

	}// fin class
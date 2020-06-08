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
				$req = 'SELECT * FROM article RIGHT JOIN sortie_article ON article.id = sortie_article.id_article WHERE sortie_article.id_bon_sortie = ? ORDER BY id';
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
		 * sauvegarde l'objet qui l'appelle dans la base de données
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
		 * Met à jour les informations de l'obejt qui l'appelle dans la base de données
		 */
		public function update() {
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
		 * Supprime l'objet qui l'appelle de la base données
		 */
		public function delete() {
			$pdo = Database::getPDO();
			$req = 'DELETE FROM bon_sortie WHERE id = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));

			$req = 'DELETE FROM sortie_article WHERE id_bon_sortie = ?';
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($this->id));
		}

		/**
		 * sauveagarde les articles du bon qui l'appelle dans la base de données
		 * @param String $statutBon : détermine si c'est un nouveau bon ajouté ou un ancien bon modifié
		 */
		public function saveArticles($statutBon){
			$pdo = Database::getPDO();
			if ($statutBon == 'old'){
				$req = 'DELETE FROM sortie_article WHERE id_bon_sortie = ?';
				$reponse = $pdo->prepare($req);
				$reponse->execute(array($this->id));
			}
			
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
				
				$article = new Article($dotation->idArticle);
				
				if($statutBon == 'old'){
					Article::removeArticleQuantity($dotation->idArticle, $this->reference, "sortie");
					Transaction::updateTransaction($dotation->idArticle, $dotation->nomArticle, $article->quantite, $this->id, $this->reference, $dotation->quantite, "sortie");
				}
				else{
					Transaction::insertTransaction($dotation->idArticle, $dotation->nomArticle, $article->quantite, $this->id, $this->reference, $dotation->quantite, "sortie");
				}
			}
		}

		/**
		  * permet de récupérer la liste des bons de sortie par lot dont le nombre est détéerminé par $perPage
		  * @param Int $perPage : nombre de bons affichés par page
		  * @param Int $offset : valeur de départ pour récupérer les bons par lot
		  * @return BonSortie[] $bonsorties : liste des bons de sorties par lot dont le nombre est défini par la valeur de $perPage  
		  */ 
		public static function getList($perPage, $offset) {
			$pdo = Database::getPDO();
			$req = "SELECT id from bon_sortie ORDER BY id DESC LIMIT $perPage OFFSET $offset";
			$reponse = $pdo->query($req);
			$bonssorties = array();
			while ($row = $reponse->fetch()){
				$bonsortie = new BonSortie($row['id']);
				$bonssorties[] = $bonsortie;
			}
			return $bonssorties;
			
		}

		/**
		 * Retourne la liste de tous les bons de sorties
		 * @return BonSortie[] $bonssorties : liste de tous les bons de sorties présents dans la base
		 */
		public static function getListAll() {
			$pdo = Database::getPDO();
			$req = "SELECT id from bon_sortie ORDER BY date DESC";
			$reponse = $pdo->query($req);
			$bonssorties = array();
			while ($row = $reponse->fetch()){
				$bonsortie = new BonSortie($row['id']);
				$bonssorties[] = $bonsortie;
			}
			return $bonssorties;
		}

		/**
		 * Retourne la liste des bons de sorties créés aujourd'hui
		 * @return BonSortie[] $bonssorties : liste des bons de sortie d'aujourd'hui
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
		 * Retourne la liste de bons attribués à l'utiliateur dont l'id est fourni en paramètre
		 * @param Int $idBeneficiaire : l'id du bénéficaire des bons
		 * @param Int $perPage : nombre de bons affichés par page
		 * @param Int $offset : valeur de départ pour récupérer les bons par lot
		 * @return BonSortie[] $bonsorties : liste des bons de sorties du bénéficiaire par lot dont le nombre est défini par la valeur de $perPage  
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
		 * Retourne le nombre de bons présents dans la base
		 * @return Int $count : nombre de bons d sortie présent dans la base
		 */
		public static function getNbrBon(){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM bon_sortie";
			$reponse = $pdo->query($req);
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			return  $count;
		}
		
		/**
		 * Retourne le nombre de bons du bénéficiaire dont l'id est fourni en paramètre
		 * @param Int $idBeneficiaire : l'id du bénéficiaire dont on veut récupérer le nombre de bons attribués
		 * @return Int $couunt : le nombre de bons attribués au bénéficiaire
		 */
		public static function getNbrBonBeneficiaire($idBeneficiaire){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM bon_sortie WHERE beneficiaire_id = ?";
			$reponse = $pdo->prepare($req);
			$reponse->execute(array($idBeneficiaire));
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			return  $count;
		}
		
	}// fin class

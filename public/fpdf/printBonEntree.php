<?php
session_start();

if (isset($_SESSION['user'])){
    if ($_SESSION['user']['niveau'] == 2){

        require '../../core/database.php';
        require '../../model/fpdf/fpdf.php' ;
        require '../../model/dotation.php';
        require '../../model/bonEntree.php';

        class PDF extends FPDF{
            public $bonentree;
        
        // En-tête
            function Header(){
                $this->bonentree = new BonEntree($_GET["id"]); 
        
                // Logo
                $this->Image('../images/photos/enteteiakaf.png', 15, 15, 180);
                // Police Arial gras 15
                $this->SetFont('Arial','BU',14);
                $this->Ln(60);
                // Décalage à droite
                $this->Cell(80);
                // Titre
                $this->Cell(30, 5, "BON D'ENTREE", 0, 1,'C');
            }
        
            // Tableau coloré
        function FancyTable()
        {
            // Couleurs, épaisseur du trait et police grasse
            $this->SetFillColor(0, 109, 241);
            $this->SetTextColor(255);
            $this->SetDrawColor(0, 0, 0);
            $this->SetLineWidth(.3);
            $this->SetFont('','B');
            // En-tête
            $this->Cell(15, 7);
            $this->Cell(40, 7, "Article", 0, 0,'C', true);
            $this->Cell(40, 7, "Quantité", 0, 0,'C', true);
            $this->Cell(40, 7, "Prix Unitaire", 0, 0,'C', true);
            $this->Cell(40, 7, "Prix total", 0, 0,'C', true);
            $this->Ln();
            // Restauration des couleurs et de la police
            $this->SetFillColor(255, 0, 0);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Données
            $fill = false;
            foreach($this->bonentree->dotations as $dotation)
            {
                $this->Cell(15, 7);
                $this->Cell(40, 7, $dotation->nomArticle, 1, 0,'C', 0,'C',$fill);
                $this->Cell(40, 7, $dotation->quantite, 1, 0,'C', 0,'C',$fill);
                $this->Cell(40, 7, $dotation->prix, 1, 0,'C', 0,'C',$fill);
                $this->Cell(40, 7, $dotation->total, 1, 0,'C', 0,'C',$fill);
                $this->Ln();
                $fill = !$fill;
            }
            $this->Cell(15, 7);
            $this->SetFont('','B');
            $this->Cell(120, 7, "Total général", 1, 0, "C", 0, "C, true");
            $this->Cell(40, 7, $this->bonentree->totalGeneral, 1, 0, "C", 0, "C, true");
        }
        
            // Pied de page
            function Footer(){
                // Positionnement à 1,5 cm du bas
                $this->SetY(-25);
                // Police Arial italique 8
                $this->SetFont('Arial','I',10);
                // Numéro de page
                $this->Cell(0, 10,"Inspection d'academie de Kaffrine");
                $this->Cell(-10, 10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
                $this->Ln(5);
                $this->Cell(0, 10,"Diamaguene TP, derrière l'agence Senelec");
                $this->Ln(5);
                $this->Cell(0, 10,"Tél: (+221)339461734 - Email: iakaffrine@education.sn");
            }
        }
        
        // Instanciation de la classe dérivée
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
        $pdf->Cell(60, 20, "Numéro du bon: " . $pdf->bonentree->reference, 0, 0, 'C');
        $pdf->Cell(200, 20, "Numéro de la facture: " . $pdf->bonentree->numeroFacture, 0, 0, 'C');
        $pdf->Ln(8);
        $pdf->Cell(60, 20, "Date du bon: " . $pdf->bonentree->date, 0, 0, 'C');
        $pdf->Cell(200, 20, "Date de la facture: " . $pdf->bonentree->dateFacture, 0, 0, 'C');
        $pdf->Ln(8);
        $pdf->Cell(180, 20, "Fournisseur: " . $pdf->bonentree->nomFournisseur, 0, 0, 'C');
        $pdf->Ln(15);
        $pdf->FancyTable();
        $pdf->Ln(20);
        $pdf->SetFont('Times','BU',12);
        $pdf->Cell(20, 10);
        $pdf->Cell(100, 10, "Le fournisseur");
        $pdf->Cell(40, 10, "Le comptable des matières", 0, "R");
        $pdf->Output();
    }
    else{
        echo "Vous n'avez pas les autorisations nécessaires pour accéder à cette ressource.";
    }
}
else{
    echo "Vous n'avez pas les autorisations nécessaires pour accéder à cette ressource.";
}

?>

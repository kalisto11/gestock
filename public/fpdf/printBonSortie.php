<?php
require('fpdf.php');
require '../../core/database.php';
require '../../model/dotation.php';
require ('../../model/bonSortie.php');

class PDF extends FPDF{
    public $bonsortie;

// En-tête
    function Header(){
        $this->bonsortie = new BonSortie($_GET["id"]); 

        // Logo
        $this->Image('enteteiakaf.png', 15, 15, 180);
        // Police Arial gras 15
        $this->SetFont('Arial','BU',14);
        $this->Ln(60);
        // Décalage à droite
        $this->Cell(80);
        // Titre
        $this->Cell(30, 5, "BON DE SORTIE", 0, 1,'C');
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
    foreach($this->bonsortie->dotations as $dotation)
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
    $this->Cell(40, 7, $this->bonsortie->totalGeneral, 1, 0, "C", 0, "C, true");
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
$pdf->Cell(100, 20, "Numéro du bon: " . $pdf->bonsortie->reference, 0, 0, 'L');
$pdf->Cell(80, 20, "Bénéficiaire: " . $pdf->bonsortie->nomBeneficiaire, 0, 0, 'R');
$pdf->Ln(8);
$pdf->Cell(90, 20, "Date du bon: " . $pdf->bonsortie->date, 0, 0, 'L');
$pdf->Ln(15);
$pdf->FancyTable();
$pdf->Ln(20);
$pdf->SetFont('Times','BU',12);
$pdf->Cell(20, 10);
$pdf->Cell(60, 10, "Le comptable des matières", 0, "L");
$pdf->Cell(60, 10, "L'inspecteur d'académie", 0, "C");
$pdf->Cell(60, 10, "Le bénéficiaire", 0, "R");
$pdf->Output();
?>

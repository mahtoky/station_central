<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gen_PDF extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->library('Fpdf_gen');
    $this->load->model('Mouvement_DB');
  }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
   public function beneficePDF(){
     $beneficeTotal = $this->Mouvement_DB->beneficeTotal();
     $beneficeProduit = $this->Mouvement_DB->beneficeProduit();
     $totalvente = $this->Mouvement_DB->statParStation();

     $pdf = new FPDF("P", "mm", "A4");
     $this->fpdf->SetFont('Arial','B', 12);
     $this->fpdf->Cell(190,10,'Benefices station Galana',0,1,'C');
     $this->fpdf->Cell(35, 10, '', 0);
     $this->fpdf->Cell(60, 10, 'Benefice total :', 1, 0, 'C');
     $this->fpdf->Cell(60, 10, $beneficeTotal->beneficetotal.' Ariary', 1, 1, 'C');
     $this->fpdf->Cell(35, 10, '', 0, 1);
     $this->fpdf->Cell(35, 10, 'Benefices par produits', 0, 1);
     $this->fpdf->Cell(60, 10, 'Produit', 1, 0);
     $this->fpdf->Cell(60, 10, 'Benefice', 1, 1);
     foreach ($beneficeProduit as $value) {
       // code...
       $this->fpdf->Cell(60, 10, $value->productname, 1, 0);
       $this->fpdf->Cell(60, 10, $value->benefice.' Ariary', 1, 1);
     }
     $this->fpdf->Ln(5);
     $this->fpdf->Cell(80, 10, 'Recapitulation des ventes par station', 0, 1);
     $this->fpdf->Cell(60, 10, 'Station', 1, 0);
     $this->fpdf->Cell(60, 10, 'Total vente', 1, 1);
     foreach ($totalvente as $value) {
       // code...
       $this->fpdf->Cell(60, 10, $value->ville, 1, 0);
       $this->fpdf->Cell(60, 10, $value->totalvente.' litres', 1, 1);
     }
     echo $this->fpdf->Output('benefice.pdf', 'I');
   }
}

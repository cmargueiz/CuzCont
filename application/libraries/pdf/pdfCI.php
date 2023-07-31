<?php 
require_once APPPATH.'third_party/fpdf/code128.php';
class PdfCI {
   	//funciones que queremos implementar en Miclase.
	public $FPDF;
	

    public function __construct()
    {
    	$this->FPDF = new FPDF();
	}	

	// Los siguientes metodos son para tener mas estructurado la creacion de pdf

	public function generarCabecera()
	{
		$this->FPDF->AddPage('P','letter',0);
		$this->FPDF->SetFont('Arial','B',16);
	}

	public function generarPieDePagina()
	{

	}

}

?>
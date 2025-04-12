<?php 
  require_once '../../../res/fpdf/fpdf.php';

	class PDF extends FPDF{
		function Header(){
			$this->Image('../../../img/'.LOGO,10,10,20);
		  $this->SetFont('Arial','B',12);
		  $this->Cell(195,5,NAME_EMPRESA,0,1,'C');
		  $this->SetFont('Arial','',10);
		  $this->Cell(195,4,'Nit: '.NIT_EMPRESA,0,1,'C');
		  $this->Cell(195,4,ADRESS_EMPRESA,0,1,'C');
		  $this->Cell(195,4,(CIUDAD_EMPRESA.', '.PAIS_EMPRESA),0,1,'C');
		  $this->Cell(195,4,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
		}

		function Footer(){
			$this->SetY(-15);
		  $this->SetFont('Arial','',8);	
		  $this->Cell(100,5,WEB_EMPRESA,0,0,'L');
		  $this->Cell(95,5,CORREO_EMPRESA,0,1,'R');
		}
		
	}

?>
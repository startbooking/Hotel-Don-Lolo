<?php 
  require_once '../../res/fpdf/fpdf.php';
 
	class PDF extends FPDF{
		function Header(){
		  $this->Image('../../img/'.LOGO,xPOS,yPOS,tPOS); 
		  $this->SetFont('Arial','B',13);
		  $this->Cell(190,7,NAME_EMPRESA,0,1,'C');
		  $this->SetFont('Arial','',10);
		  $this->Cell(190,5,'Nit: '.NIT_EMPRESA,0,1,'C');
		  $this->Cell(190,5,ADRESS_EMPRESA,0,1,'C');
		  $this->Cell(190,5,utf8_decode(CIUDAD_EMPRESA.', '.PAIS_EMPRESA),0,1,'C');
		  $this->Cell(190,5,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
		  $this->SetFont('Arial','B',11);
		  $this->Cell(190,6,NAME_HOTEL,0,1,'C');
		  $this->Ln(1);
		}

		function Footer(){
			$this->SetY(-15);
		  $this->SetFont('Arial','',8);	
		  $this->Cell(95,5,WEB_EMPRESA,0,0,'L');
		  $this->Cell(95,5,CORREO_EMPRESA,0,1,'R');
		}
		
	}

?>
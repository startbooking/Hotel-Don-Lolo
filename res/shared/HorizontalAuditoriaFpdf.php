<?php 

  require '../../../../res/fpdf/fpdf.php';

	class PDF extends FPDF{
		function Header(){
			$this->Image('../../../../img/'.LOGO,10,10,20);
		  $this->SetFont('Arial','B',13);
		  $this->Cell(260,7,NAME_EMPRESA,0,1,'C');
		  $this->SetFont('Arial','',10);
		  $this->Cell(260,5,'Nit: '.NIT_EMPRESA,0,1,'C');
		  $this->Cell(260,5,ADRESS_EMPRESA,0,1,'C');
		  $this->Cell(260,5,utf8_decode(CIUDAD_EMPRESA.', '.PAIS_EMPRESA),0,1,'C');
		  $this->Cell(260,5,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
		}

		function Footer(){
			$this->SetY(-15);
		  $this->SetFont('Arial','',8);	
		  $this->Cell(130,5,WEB_EMPRESA,0,0,'L');
		  $this->Cell(130,5,CORREO_EMPRESA,0,1,'R');
		}
		
	}

?>
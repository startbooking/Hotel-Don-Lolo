<?php 

  require_once '../../../res/fpdf/fpdf.php';
	define('FILENAME', $filename);
	// echo FILENAME;

	// echo $filename;

	class PlantillaPDF extends FPDF{
		function Header(){
			// $this->Image('../../img/'.LOGO,10,10,20);
		  $this->SetFont('Arial','B',13);
		 /*  $this->Cell(190,7,NAME_EMPRESA,0,1,'C');
		  $this->SetFont('Arial','',10);
		  $this->Cell(190,5,'Nit: '.NIT_EMPRESA,0,1,'C');
		  $this->Cell(190,5,ADRESS_EMPRESA,0,1,'C');
		  $this->Cell(190,5,utf8_decode(CIUDAD_EMPRESA.', '.PAIS_EMPRESA),0,1,'C');
		  $this->Cell(190,5,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C'); */
			$this->Image('../../../img/'.LOGO, 10, 5, 40);
			// $this->Image($filename, 163, 5, 33);

			$this->SetFont('Arial', 'B', 11);
			$this->Cell(190, 4, (NAME_EMPRESA), 0, 1, 'C');
			$this->SetFont('Arial', '', 8);
			$this->Cell(190, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
			$this->Cell(190, 4, (ADRESS_EMPRESA), 0, 1, 'C');
			$this->Cell(40, 4, '', 0, 0, 'C');
			$this->Cell(110, 4, (CIUDAD_EMPRESA).' '.PAIS_EMPRESA, 0, 1, 'C');
			// $this->Cell(40, 4, '', 0, 1, 'C');
			$this->SetFont('Arial', '', 8);
			$this->Cell(40, 4, '', 0, 0, 'C');
			$this->Cell(110, 4, (REGIMEN), 0, 1, 'C');
			$this->SetFont('Arial', '', 7);
			$this->Cell(40, 4, '', 0, 0, 'C');
			$this->Cell(110, 4, (MAIL_HOTEL), 0, 1, 'C');
			$this->Cell(40, 4, '', 0, 0, 'C');
			$this->Cell(110, 4, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 1, 'C');
			$this->Cell(40, 4, '', 0, 0, 'C');
			$this->Cell(110, 4, (ACTIVIDAD), 0, 0, 'C');
			$this->SetFont('Arial', 'B', 7);
			$this->MultiCell(40, 4, 'FACTURA ELECTRONICA DE VENTA', 1, 'C');
			$this->SetFont('Arial', '', 7);
			$this->setY(42);
			$this->Cell(40, 4, '', 0, 0, 'C');
			// $this->MultiCell(110, 4, ($textoResol), 0, 'C');
			$this->Cell(150, 4, '', 0, 0, 'C');
			$this->setY(46);
			$this->setX(160);
			$this->SetFont('Arial', 'B', 8);
			// $this->MultiCell(40, 4, 'Nro '.$prefijo.' '.str_pad($factura, 4, '0', STR_PAD_LEFT), 1, 'C');
			$this->SetFont('Arial', '', 8);
			$this->Ln(1);
		}

		function Footer(){
			$this->SetY(-15);
		  $this->SetFont('Arial','',8);
			// $this->PageNo()
		  /* $this->Cell(95,5,WEB_EMPRESA,0,0,'L');
		  $this->Cell(95,5,CORREO_EMPRESA,0,1,'R'); */
		}
		
	}


?>
<?php 

	require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
  require '../../../../res/fpdf/fpdf.php';

	clearstatcache();
	$nComa  = $_SESSION['NUMERO_COMANDA'];
	$amb    = $_SESSION['AMBIENTE_ID'];
	$nomamb = $_SESSION['NOMBRE_AMBIENTE'];
	$prods  = $_POST['produc']; 

	$numerocomanda     = $nComa;

	$pref      = $pos->getPrefijoAmbiente($amb);
	$datosmesa = $pos->getDatosComanda($numerocomanda,$amb);

	$pax  = $datosmesa[0]['pax'];
	$mesa = $datosmesa[0]['mesa'];
	$fec  = $datosmesa[0]['fecha'];

	$pdf = new FPDF('P', 'mm', array(100,250));
	$pdf->SetMargins(5, 10 , 5);
  $pdf->AddPage();
  $pdf->Ln(2);
  
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(90,6,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(90,6,'NIT: '.NIT_EMPRESA,0,1,'C');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(30,5,'Fecha ',0,0,'L');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(30,5,$fec,0,1,'L');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(30,5,'Mesa ',0,0,'L');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(20,5,$mesa,0,1,'L');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(30,5,'Comanda Nro: ',0,0,'L');
  $pdf->SetFont('Times','',12);
  $pdf->Cell(20,5,$pref.'-'.str_pad($numerocomanda,5,'0',STR_PAD_LEFT),0,1,'L');
  $pdf->SetFont('Times','',12);
  $pdf->Ln(2);
	  $pdf->Cell(80,5,'PRODUCTO',0,0,'C');
	  $pdf->Cell(10,5,'CANT.',0,1,'C');
	  $pdf->Ln(1);
	  $pdf->SetFont('Times','',12);

		foreach ($prods as $producto) {
		  $pdf->Cell(80,5,utf8_decode(substr($producto['producto'],0,23)),0,0,'L');
		  $pdf->Cell(10,5,$producto['cant'],0,1,'R');
		}
 
  	$pdf->Ln(3);
	  $pdf->SetFont('Times','',10);
	  $pdf->Cell(50,45,'Usuario: '.$_SESSION['usuario'],0,1,'L');
  	$pdf->Ln(3);
	  $pdf->SetFont('Times','',8);
	  $pdf->Cell(45,3,WEB_EMPRESA,0,0,'L');
	  $pdf->Cell(45,3,CORREO_EMPRESA,0,1,'R');

	$file = '../../../impresiones/comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
  $pdf->Output($file,'F');
  echo 'comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
?>
 
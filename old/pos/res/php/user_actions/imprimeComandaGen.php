<?php 

	require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
  require '../../../../res/fpdf/fpdf.php';

	clearstatcache();
	$amb    = $_POST['idamb'];
	$nomamb = $_POST['nomamb'];
	$nComa  = $_POST['numComa'];
	$prods  = $_POST['produc'];
	$user   = $_POST['user'];

	$numerocomanda     = $nComa;

	$pref      = $pos->getPrefijoAmbiente($amb);
	$datosmesa = $pos->getDatosComanda($numerocomanda,$amb);

	$pax  = $datosmesa[0]['pax'];
	$mesa = $datosmesa[0]['mesa'];
	$fec  = $datosmesa[0]['fecha'];

	$pdf = new FPDF('P', 'mm', array(100,250));
  $pdf->AddPage();
	$pdf->SetMargins(5, 10 , 5);
  $pdf->SetFont('Arial','',1);
  $pdf->Cell(90,5,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(90,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  $pdf->Cell(90,5,'Fecha '.$fec.' Mesa '.$mesa,0,1,'L');
  $pdf->SetFont('Times','',10);
  $pdf->Cell(90,5,'Comanda Nro: '.$pref.'-'.str_pad($numerocomanda,5,'0',STR_PAD_LEFT),0,1,'L');
  $pdf->SetFont('Times','',9);
  $pdf->Ln(2);

  $pdf->Cell(80,5,'PRODUCTO',0,0,'C');
  $pdf->Cell(10,5,'CANT.',0,1,'C');
  $pdf->Ln(2);
  $pdf->SetFont('Times','',10);

	foreach ($prods as $producto) {
	  $pdf->Cell(80,5,utf8_decode(substr($producto['producto'],0,28)),0,0,'L');
	  $pdf->Cell(10,4,substr($producto['cant'],0,23),0,1,'R');
	}
 
	$pdf->Ln(3);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(90,5,'Usuario: '.$user,0,1,'L');
	$pdf->Ln(3);
  $pdf->SetFont('Times','',8);
  $pdf->Cell(45,4,WEB_EMPRESA,0,0,'L');
  $pdf->Cell(45,4,CORREO_EMPRESA,0,1,'R');

	$file = '../../../impresiones/comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
  $pdf->Output($file,'F');
  echo 'comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
?>
 
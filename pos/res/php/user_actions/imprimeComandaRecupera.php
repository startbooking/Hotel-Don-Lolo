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
	$cliente = $datosmesa[0]['cliente'];

	$pdf = new FPDF('P', 'mm', array(50,250));
  $pdf->AddPage();
	$pdf->SetMargins(0, 3 , 0);
  $pdf->SetFont('Times','B',8);

  $pdf->Ln(2);

  // $pdf->Cell(50,4,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->Cell(50,4,utf8_decode($nomamb),0,1,'C');
  $pdf->SetFont('Times','B',7);
  $pdf->Cell(23,4,'Fecha '.$fec,0,0,'L');
  $pdf->SetFont('Times','',7);
  $pdf->Cell(23,4,'Mesa '.$mesa,0,1,'L');
  $pdf->Cell(50,4,'Comanda Nro: '.$pref.'-'.str_pad($numerocomanda,5,'0',STR_PAD_LEFT),0,1,'L');
	$pdf->Cell(10,4,'Cliente: ',0,0,'L');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(20,4,substr(utf8_decode($cliente),0,24),0,1,'L');
  $pdf->SetFont('Arial','B',7);
  $pdf->Ln(2);

	  $pdf->Cell(35,5,'PRODUCTO',0,0,'C');
	  $pdf->Cell(10,5,'CANT.',0,1,'C');
	  $pdf->Ln(2);
	  $pdf->SetFont('Arial','',7);

		foreach ($prods as $producto) {
			if($producto['activo']==0){		
			  $pdf->Cell(35,4,utf8_decode(substr($producto['producto'],0,23)),0,0,'L');
			  $pdf->Cell(10,4,$producto['cant'],0,1,'R');
			}
		}
 
  	$pdf->Ln(3);
	  $pdf->SetFont('Arial','',7);
	  $pdf->Cell(50,4,'Usuario: '.$_SESSION['usuario'],0,1,'L');
  	$pdf->Ln(3);

/* 	  $pdf->Cell(25,4,WEB_EMPRESA,0,0,'L');
	  $pdf->Cell(25,4,CORREO_EMPRESA,0,1,'R');
 */
	$file = '../../../impresiones/comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
  $pdf->Output($file,'F');
  echo 'comandaCocina_'.$pref.'_'.$numerocomanda.'.pdf';
?>
 
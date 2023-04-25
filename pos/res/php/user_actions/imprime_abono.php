<?php 
	require_once '../../../../res/php/titles.php';
  require_once '../../../../res/php/app_topPos.php';
  require_once '../../../../res/fpdf/fpdf.php';


	$pref      = $pos->getPrefijoAmbiente($idamb);
	$datosmesa = $pos->getDatosComanda($comanda,$idamb);

	$pax  = $datosmesa[0]['pax'];
	$mesa = $datosmesa[0]['mesa'];
	$fec  = $datosmesa[0]['fecha'];
	$cliente = $datosmesa[0]['cliente'];

	$pdf = new FPDF('P', 'mm', array(50,250));
	$pdf->SetMargins(0, 3 , 0);
  $pdf->AddPage();
  $pdf->Image('../../../../img/'.$logo,2,5,10);
  $pdf->SetFont('Arial','B',8);
  $pdf->Cell(50,6,$nomamb,0,1,'C');
	// $pdf->Cell(50,4,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',8);
  $pdf->Cell(50,4,'NIT: '.NIT_EMPRESA,0,1,'C');
  $pdf->Cell(50,4,'Iva Regimen Simplificado',0,1,'C');
  $pdf->Cell(50,4,utf8_decode(ADRESS_EMPRESA),0,1,'C');
  $pdf->Cell(50,4,utf8_decode(CIUDAD_EMPRESA.' '.PAIS_EMPRESA),0,1,'C');
  $pdf->Cell(50,4,'Telefono '.TELEFONO_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',8);
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(10,4,'Fecha ',0,0,'L');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(20,4,$fec,0,1,'L');
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(10,4,'Mesa ',0,0,'L');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(20,4,$mesa,0,1,'L');
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(20,4,'Comanda Nro: ',0,0,'L');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(20,4,$pref.'-'.str_pad($comanda,5,'0',STR_PAD_LEFT),0,1,'L');
  $pdf->SetFont('Arial','B',7);
	$pdf->Cell(10,4,'Cliente: ',0,0,'L');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(20,4,substr(utf8_decode($cliente),0,24),0,1,'L');
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(25,4,"Abono a Cuenta: ",0,0,'L');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(20,4,$pref."_".str_pad($numAbo,5,'0',STR_PAD_LEFT),0,1,'L');
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(25,4,'Forma de Pago: ',0,0,'L');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(20,4,$textopago,0,1,'L');
  $pdf->MultiCell(45,4,'Descripcion : '.$comenta,0,'L');
  /* 
	$pdf->Ln(2);
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(35,4,'PRODUCTO',0,0,'C');
  $pdf->Cell(10,4,'CANT.',0,1,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','',7);
  foreach ($productos as $producto) {
    $pdf->Cell(35,4,utf8_decode(substr($producto['producto'],0,23)),0,0,'L');
    $pdf->Cell(10,4,$producto['cant'],0,1,'R');
  }
 */
  $pdf->Ln(3);
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(20,4,'Valor Abono ',0,0,'R');
  $pdf->Cell(25,4,number_format($totabo,2,",","."),0,1,'R');
  $pdf->SetFont('Arial','',7);
	$pdf->MultiCell(45,4,'Son : '.numtoletras($totabo),0,'L');
  $pdf->SetFont('Arial','',7);

  $pdf->Ln(3);
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(45,4,'Usuario: '.$user,0,1,'L');
  $pdf->Ln(3);
  $pdf->MultiCell(45,4,'Apreciado Cliente : Favor incluir este recibo de abono al momento de cancelar la presente cuenta.' ,0,'C');
  $pdf->Cell(45,4,' Muchas Gracias',0,1,'C');

  $pdf->Ln(3);
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(25,3,WEB_EMPRESA,0,0,'L');
  // $pdf->Cell(25,3,CORREO_EMPRESA,0,1,'R');
	$file = '../../../impresiones/abono_'.$pref.'-'.$numAbo.'.pdf';
  $pdf->Output($file,'F');
  echo 'abono_'.$pref.'-'.$numAbo.'.pdf';
?>

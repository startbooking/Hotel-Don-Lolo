<?php 

  require '../../../../res/fpdf/fpdf.php';

	clearstatcache();

	$pref      = $pos->getPrefijoAmbiente($ambi);
	
	$pdf = new FPDF('P', 'mm', array(50,250));
	$pdf->SetMargins(0, 3 , 0);
  $pdf->AddPage(); 
  $pdf->Image('../../../../img/'.$logo,2,5,10);
  $pdf->SetFont('Arial','B',8);
	$pdf->Cell(50,4,utf8_decode($nomambi),0,1,'C');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(50,4,'NIT: '.NIT_EMPRESA,0,1,'C');
/*   $pdf->Cell(50,4,'Iva Regimen Comun',0,1,'C');
  $pdf->Cell(50,4,utf8_decode(ADRESS_EMPRESA),0,1,'C');
  $pdf->Cell(50,4,utf8_decode(CIUDAD_EMPRESA.' '.PAIS_EMPRESA),0,1,'C');
  $pdf->Cell(50,4,'Telefono '.TELEFONO_EMPRESA,0,1,'C');
 */  
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(50,4,'RECIBO DE CAJA',0,1,'C');
  $pdf->Ln(2);  
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(22,4,'Fecha '.$fecha,0,0,'L');
  $pdf->Cell(22,4,'Usuario: '.$user,0,1,'L');
 
  $pdf->Cell(50,4,"Recibo Nro: ".$pref."-".str_pad($numerocaja,5,'0',STR_PAD_LEFT),0,1,'L');

  $pdf->MultiCell(50,4,'Cliente : '.utf8_decode($cliente),0,'L');
  $pdf->MultiCell(50,4,'Concepto: '.utf8_decode($concepto),0,'L');
  $pdf->Ln(2);  
  $pdf->SetFont('Arial','B',8);
  $pdf->Cell(50,4,'DETALLE FACTURAS',0,1,'C');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(15,4,'Fecha ',0,0,'L');
  $pdf->Cell(15,4,'Numero ',0,0,'C');
  $pdf->Cell(15,4,'Valor ',0,1,'C');

  foreach ($facturas as $key => $value) {
    $pdf->Cell(15,4,$value['fecha'],0,0,'L');
    $pdf->Cell(15,4,$value['numero'],0,0,'R');
    $pdf->Cell(15,4,number_format($value['valor'],2),0,1,'R');
  };
  $pdf->Ln(2);  
  $pdf->Cell(50,4,'Valor Pagado : '.number_format($base,2),0,1,'L');
	$pdf->MultiCell(45,4,'Valor en letras : '.numtoletras($base),0,'L');
  
	$pdf->Ln(20);
  $pdf->Cell(50,4,str_repeat('_', 55),0,1,'L');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(50,4,'Firma',0,1,'C');

  $pdf->Ln(3);
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(50,4,'Usuario: '.$user,0,1,'L');
  $pdf->Ln(3);
  $pdf->SetFont('Arial','',6);

	$file = '../../../impresiones/reciboCaja'.$pref.'-'.$numerocaja.'.pdf';
  $pdf->Output($file,'F');
  echo 'reciboCaja'.$pref.'-'.$numerocaja.'.pdf';
?>
 
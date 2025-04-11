<?php 
  // require 'plantillaAuditoria.php';

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,4,'BALANCE DIARIO ',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(195,4,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(4);

  $saldo  = $hotel->getBalanceSaldoAnterior(FECHA_PMS);
  // $diario = $hotel->getBalanceSaldodelDia(FECHA_PMS);

  $cartera = 0;
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(65,5,'SALDO ANTERIOR ',1,1,'C');
  $pdf->Rect(10, 43, 65, 18);
  $pdf->Cell(35,5,'CARGOS',0,0,'L');
  $pdf->SetFont('Arial','',10);
  if(count($saldo)==0){
    $pdf->Cell(30,5,number_format(0,2),0,1,'R');
  }else{
    $pdf->Cell(30,5,number_format($saldo[0]['saldo_viene'],2),0,1,'R');
  }
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(35,5,'IMPUESTOS ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  if(count($saldo)==0){
    $pdf->Cell(30,5,number_format(0,2),0,1,'R');
  }else{  
    $pdf->Cell(30,5,number_format($saldo[0]['impto_viene'],2),0,1,'R');
  }
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(35,5,'ABONOS ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  if(count($saldo)==0){
    $pdf->Cell(30,5,number_format(0,2),0,1,'R');
  }else{
    $pdf->Cell(30,5,number_format($saldo[0]['pagos_viene'],2),0,1,'R');
  }
  $ventasdia = $hotel->getCargosDia(FECHA_PMS,1);
  $pdf->Ln(4);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(80,5,'Descripcion ',1,0,'C');
  $pdf->Cell(10,5,'Cant. ',1,0,'C');
  $pdf->Cell(30,5,'Monto',1,0,'C');
  $pdf->Cell(30,5,'Impuesto',1,0,'C');
  $pdf->Cell(30,5,'Total',1,1,'C');
  $pdf->SetFont('Arial','',9);
  $totalCargos = 0 ;
  $totalPagos = 0;
  foreach ($ventasdia as $ventadia) { 
    $pdf->Cell(80,4,$ventadia['descripcion_cargo'],0,0,'L');
    $pdf->Cell(10,4,$ventadia['canti'],0,0,'L');
    $pdf->Cell(30,4,number_format($ventadia['cargos'],2),0,0,'R');
    $pdf->Cell(30,4,number_format($ventadia['imptos'],2),0,0,'R');
    $pdf->Cell(30,4,number_format($ventadia['total_cargo'],2),0,1,'R');
    $totalCargos = $totalCargos + $ventadia['total_cargo'] ;
  }
  $pagosdia = $hotel->getCargosDia(FECHA_PMS,3);

  $pdf->Ln(4);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(80,5,'Descripcion ',1,0,'C');
  $pdf->Cell(10,5,'Cant. ',1,0,'C');
  $pdf->Cell(30,5,'Valor Pago',1,1,'C');
  $pdf->SetFont('Arial','',9);

  foreach ($pagosdia as $pagodia) { 
    $pdf->Cell(80,4,$pagodia['descripcion_cargo'],0,0,'L');
    $pdf->Cell(10,4,$pagodia['canti'],0,0,'L');
    $pdf->Cell(30,4,number_format($pagodia['pagos'],2),0,1,'R');
    $totalPagos = $totalPagos + $pagodia['pagos'] ;
  }

  $file = '../../imprimir/auditorias/Balance_Diario_'.FECHA_PMS.'.pdf';
  $pdf->Output($file,'F');

?>

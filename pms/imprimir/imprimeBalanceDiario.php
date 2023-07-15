<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once 'plantillaFpdf.php';

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(195,4,'BALANCE DIARIO ',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(195,4,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(4);

  $saldo  = $hotel->getBalanceSaldoAnterior(FECHA_PMS);
  $diario = $hotel->getBalanceSaldodelDia(FECHA_PMS);
  
  $cartera = 0;
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(65,5,'SALDO ANTERIOR ',1,1,'C');
  $pdf->Rect(10, 51, 65, 16);
  $pdf->Cell(35,5,'CARGOS',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(30,5,number_format($saldo[0]['saldo_viene'],2),0,1,'R');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(35,5,'IMPUESTOS ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(30,5,number_format($saldo[0]['impto_viene'],2),0,1,'R');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(35,5,'ABONOS ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(30,5,number_format($saldo[0]['pagos_viene'],2),0,1,'R');
  $pdf->SetFont('Arial','B',10);
  // $pdf->Cell(35,5,'RECAUDO CARTERA ',0,0,'L');
  // $pdf->SetFont('Arial','',10);
  // $pdf->Cell(30,6,number_format($cartera,2),0,1,'R');
  $ventasdia = $hotel->getCargosDia(FECHA_PMS,1);
  $pdf->Ln(4);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(90,6,'Descripcion ',1,0,'C');
  $pdf->Cell(10,6,'Cant. ',1,0,'C');
  $pdf->Cell(30,6,'Monto',1,0,'C');
  $pdf->Cell(30,6,'Impuesto',1,0,'C');
  $pdf->Cell(30,6,'Total',1,1,'C');
  $pdf->SetFont('Arial','',10);
  $totalCargos = 0 ;
  $totalPagos = 0;
  foreach ($ventasdia as $ventadia) { 
    $pdf->Cell(90,5,$ventadia['descripcion_cargo'],0,0,'L');
    $pdf->Cell(10,5,$ventadia['canti'],0,0,'R');
    $pdf->Cell(30,5,number_format($ventadia['cargos'],2),0,0,'R');
    $pdf->Cell(30,5,number_format($ventadia['imptos'],2),0,0,'R');
    $pdf->Cell(30,5,number_format($ventadia['total_cargo'],2),0,1,'R');
    $totalCargos = $totalCargos + $ventadia['total_cargo'] ;
  }
  $pagosdia = $hotel->getCargosDia(FECHA_PMS,3);

  $pdf->Ln(4);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(80,6,'Descripcion ',1,0,'C');
  $pdf->Cell(10,6,'Cant. ',1,0,'C');
  $pdf->Cell(30,6,'Valor Pago',1,1,'C');
  $pdf->SetFont('Arial','',10);

  foreach ($pagosdia as $pagodia) { 
    $pdf->Cell(80,5,$pagodia['descripcion_cargo'],0,0,'L');
    $pdf->Cell(10,5,$pagodia['canti'],0,0,'R');
    $pdf->Cell(30,5,number_format($pagodia['pagos'],2),0,1,'R');
    $totalPagos = $totalPagos + $pagodia['pagos'] ;
  }

  $fileOut = '../imprimir/informes/'.$file.'.pdf'; 
  $pdf->Output($fileOut,'F');
  echo $file.'.pdf';
?>

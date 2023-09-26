<?php 

  require '../../../res/shared/plantillaInvVer.php'; 

  $numeroSal   = $numeroMov; 
  $bodega      = $almacen; 

  $movimientos = $inven->getMovimientos(2,$numeroSal, $bodega);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,5,'SALIDA DE INVENTARIOS',0,1,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(40,5,'CENTRO DE COSTO',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(80,5,$inven->buscaCentroCosto($movimientos[0]['id_proveedor']),0,1,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(50,5,'TIPO DE MOVIMIENTO',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(70,5,$inven->getBuscaMovimiento($movimientos[0]['tipo_movi']),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(30,5,'SALIDA NRO',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(30,5,$numeroSal,0,1,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(40,5,'BODEGA',0,0,'l');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(50,5,$inven->buscaAlmacen($movimientos[0]['id_bodega']),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(30,5,'Fecha :',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,5,$movimientos[0]['fecha_movimiento'],0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(20,5,'Usuario :',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,5,$movimientos[0]['usuario'],0,1,'L');

  $pdf->Ln(4);
  $pdf->Cell(70,4,'PRODUCTO',1,0,'C');
  $pdf->Cell(20,4,'CANT',1,0,'C');
  $pdf->Cell(45,4,'UNIDAD',1,0,'C');
  $pdf->Cell(30,4,'VALOR UNI.',1,0,'C');
  $pdf->Cell(30,4,'TOTAL',1,1,'C');
  $pdf->SetFont('Arial','',10);
  $totalsum  = 0; 
  foreach ($movimientos as $movimiento) {
    $totalsum = $totalsum + $movimiento['valor_total']; 
    $pdf->Cell(70,4,utf8_decode($movimiento['nombre_producto']),1,0,'L');
    $pdf->Cell(20,4,number_format($movimiento['cantidad'],2),1,0,'R');
    $pdf->Cell(45,4,$inven->getUnidadAlmacena($movimiento['unidad_alm']),1,0,'L');
    $pdf->Cell(30,4,number_format($movimiento['valor_unitario'],2),1,0,'R');
    $pdf->Cell(30,4,number_format($movimiento['valor_total'],2),1,1,'R');
  }
  $pdf->Cell(90,4,'',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(75,4,'VALOR TOTAL SALIDA ',1,0,'R');
  $pdf->Cell(30,4,number_format($totalsum,2),1,1,'R');
  $pdf->Ln(25);

  $valY = $pdf->GetY();
  $pdf->Line(20,$valY,95,$valY);
  $pdf->Line(110,$valY,195,$valY);
  $pdf->Cell(95,4,'RECIBE',0,0,'C');
  $pdf->Cell(5,4,'',0,0,'L');
  $pdf->Cell(95,4,'ENTREGA',0,0,'C');

  $pdf->Ln(5);
  $file = '../../imprimir/Salida_'.$numeroMov.'.pdf';

  $pdf->Output($file,'F');

  echo $numeroSal;


?>

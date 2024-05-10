<?php 

  require '../../../res/shared/plantillaInvVer.php'; 

  $numeroTra   = $numeroMov; 
  $bodega      = $almacen; 
  $movimientos = $inven->getMovimientos(4,$numeroTra, $bodega);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,7,'AJUSTES DE INVENTARIO',0,1,'C');
  $pdf->Ln(1);
  $pdf->Cell(30,6,'AJUSTE NRO ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,6,$numeroTra,0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(30,6,'FECHA ',0,0,'L'); 
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,6,$movimientos[0]['fecha_movimiento'],0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(20,6,'Usuario ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,6,$movimientos[0]['usuario'],0,1,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(30,6,'BODEGA',0,0,'l');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(60,6,$inven->buscaAlmacen($movimientos[0]['id_bodega']),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(40,6,'TIPO MOVIMIENTO',0,0,'l');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(60,6,$inven->getBuscaMovimiento($tipomovi),0,1,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(50,6,'PRODUCTO',1,0,'C');
  $pdf->Cell(30,6,'UNIDAD',1,0,'C');
  $pdf->Cell(15,6,'CANT',1,0,'C');
  $pdf->Cell(20,6,'VALOR UNI.',1,0,'C');
  $pdf->Cell(25,6,'SUBTOTAL',1,0,'C'); 
  $pdf->Cell(10,6,'% IMP',1,0,'C');
  $pdf->Cell(25,6,'IMPTO',1,0,'C');
  $pdf->Cell(25,6,'TOTAL',1,1,'C');
  $pdf->SetFont('Arial','',9);
  $impto    = 0;
  $subto    = 0;
  $total    = $subto + $impto;
  $totalsum  = 0; 

  foreach ($movimientos as $movimiento) {
    $subto = $subto + $movimiento['valor_subtotal'];
    $impto = $impto + $movimiento['impuesto'];
    $total = $subto + $impto;
    $totalsum = $totalsum + $movimiento['valor_total']; 
    $pdf->Cell(50,6,substr(utf8_decode($movimiento['nombre_producto']),0,25),1,0,'L');
    $pdf->Cell(30,6,substr($inven->getUnidadAlmacena($movimiento['unidad_alm']),0,12),1,0,'L');
    $pdf->Cell(15,6,number_format($movimiento['cantidad'],0),1,0,'R');
    $pdf->Cell(20,6,number_format($movimiento['valor_unitario'],2),1,0,'R');
    $pdf->Cell(25,6,number_format($movimiento['valor_subtotal'],2),1,0,'R');
    $pdf->Cell(10,6,number_format($movimiento['porce_impto'],2),1,0,'R');
    $pdf->Cell(25,6,number_format($movimiento['impuesto'],2),1,0,'R');
    $pdf->Cell(25,6,number_format($movimiento['valor_total'],2),1,1,'R');
  }
  $pdf->Cell(95,5,'',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(55,6,'VALOR TOTAL AJUSTE ',1,0,'R');
  $pdf->Cell(25,6,number_format($impto,2),1,0,'R');
  $pdf->Cell(25,6,number_format($totalsum,2),1,1,'R');
  $pdf->Ln(25);

  $valY = $pdf->GetY();
  $pdf->Line(20,$valY,95,$valY);
  $pdf->Line(110,$valY,195,$valY);
  $pdf->Cell(95,6,'RECIBE',0,0,'C');
  $pdf->Cell(5,6,'',0,0,'L');
  $pdf->Cell(95,6,'ENTREGA',0,0,'C');

  $pdf->Ln(5);

  $file = '../../imprimir/Ajuste_'.$numeroTra.'.pdf';

  $pdf->Output($file,'F');

  echo $numeroTra;

?>

<?php 

  require '../../../res/shared/plantillaInvVer.php'; 

  // $bodega      = $almacen; 
  $movimientos = $inven->getMovimientos(3,$numero, $almacen);
  $entradas    = $inven->getMovimientos(3,$numero, $destino);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,5,'TRASLADO DE INVENTARIO',0,1,'C');
  $pdf->Cell(30,5,'TRASLADO NRO ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,5,$numero,0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(30,5,'FECHA ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,5,$movimientos[0]['fecha_movimiento'],0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(20,5,'Usuario ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,5,$movimientos[0]['usuario'],0,1,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(30,5,'BODEGA',0,0,'l');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(60,5,$inven->buscaAlmacen($movimientos[0]['id_bodega']),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(40,5,'TIPO MOVIMIENTO',0,0,'l');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(60,5,$inven->getBuscaMovimiento($movSale),0,1,'L');
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(50,5,'PRODUCTO',1,0,'C');
  $pdf->Cell(30,5,'UNIDAD',1,0,'C');
  $pdf->Cell(15,5,'CANT',1,0,'C');
  $pdf->Cell(20,5,'VALOR UNI.',1,0,'C');
  $pdf->Cell(25,5,'SUBTOTAL',1,0,'C'); 
  $pdf->Cell(10,5,'% IMP',1,0,'C');
  $pdf->Cell(25,5,'IMPTO',1,0,'C');
  $pdf->Cell(25,5,'TOTAL',1,1,'C');
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
    $pdf->Cell(50,4,substr(($movimiento['nombre_producto']),0,25),0,0,'L');
    $pdf->Cell(30,4,substr($inven->getUnidadAlmacena($movimiento['unidad_alm']),0,12),1,0,'L');
    $pdf->Cell(15,4,number_format($movimiento['cantidad'],0),0,0,'R');
    $pdf->Cell(20,4,number_format($movimiento['valor_unitario'],2),0,0,'R');
    $pdf->Cell(25,4,number_format($movimiento['valor_subtotal'],2),0,0,'R');
    if($movimiento['porce_impto']== ''){
      $pdf->Cell(10,4,number_format(0,2),1,0,'R');
    }else{
      $pdf->Cell(10,4,number_format($movimiento['porce_impto'],2),0,0,'R');
    }
    if($movimiento['impuesto']== ''){
      $pdf->Cell(25,4,number_format(0,2),1,0,'R');
    }else{
      $pdf->Cell(25,4,number_format($movimiento['impuesto'],2),0,0,'R');
    }
    $pdf->Cell(25,4,number_format($movimiento['valor_total'],2),0,1,'R');
  }
  $pdf->Cell(95,5,'',0,0,'L');
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(55,5,'VALOR TOTAL SALIDA ',1,0,'R');
  $pdf->Cell(25,5,number_format($impto,2),1,0,'R');
  $pdf->Cell(25,5,number_format($totalsum,2),1,1,'R');


  $pdf->Ln(10); 
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(30,5,'BODEGA',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(60,5,$inven->buscaAlmacen($destino),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(40,5,'TIPO MOVIMIENTO',0,0,'l');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(60,5,$inven->getBuscaMovimiento($movEntra),0,1,'L');

  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(50,5,'PRODUCTO',1,0,'C');
  $pdf->Cell(30,5,'UNIDAD',1,0,'C');
  $pdf->Cell(15,5,'CANT',1,0,'C');
  $pdf->Cell(20,5,'VALOR UNI.',1,0,'C');
  $pdf->Cell(25,5,'SUBTOTAL',1,0,'C'); 
  $pdf->Cell(10,5,'% IMP',1,0,'C');
  $pdf->Cell(25,5,'IMPTO',1,0,'C');
  $pdf->Cell(25,5,'TOTAL',1,1,'C');
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
    $pdf->Cell(50,4,substr(($movimiento['nombre_producto']),0,25),0,0,'L');
    $pdf->Cell(30,4,substr($inven->getUnidadAlmacena($movimiento['unidad_alm']),0,12),0,0,'L');
    $pdf->Cell(15,4,number_format($movimiento['cantidad'],0),0,0,'R');
    $pdf->Cell(20,4,number_format($movimiento['valor_unitario'],2),0,0,'R');
    $pdf->Cell(25,4,number_format($movimiento['valor_subtotal'],2),0,0,'R');
    if($movimiento['porce_impto']== ''){
      $pdf->Cell(10,4,number_format(0,2),0,0,'R');
    }else{
      $pdf->Cell(10,4,number_format($movimiento['porce_impto'],2),0,0,'R');
    }
    if($movimiento['impuesto']== ''){
      $pdf->Cell(25,4,number_format(0,2),0,0,'R');
    }else{
      $pdf->Cell(25,4,number_format($movimiento['impuesto'],2),0,0,'R');
    }
    $pdf->Cell(25,4,number_format($movimiento['valor_total'],2),0,1,'R');
  }
  $pdf->Cell(95,5,'',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(55,5,'VALOR TOTAL ENTRADA ',1,0,'R');
  $pdf->Cell(25,5,number_format($impto,2),1,0,'R');
  $pdf->Cell(25,5,number_format($totalsum,2),1,1,'R');

  $pdf->Ln(25);

  $valY = $pdf->GetY();
  $pdf->Line(20,$valY,95,$valY);
  $pdf->Line(110,$valY,195,$valY);
  $pdf->Cell(95,5,'RECIBE',0,0,'C');
  $pdf->Cell(5,5,'',0,0,'L');
  $pdf->Cell(95,5,'ENTREGA',0,0,'C');

  $pdf->Ln(5);

  $file = '../../imprimir/Traslado_'.$numero.'.pdf';

  $pdf->Output($file,'F');

  echo $numero;

?>

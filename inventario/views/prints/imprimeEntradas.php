<?php 

  require_once '../../../res/shared/plantillaInvVer.php'; 

  $numeroEnt   = $numeroMov; 
  $bodega      = $almacen; 
  $movimientos = $inven->getMovimientos(1,$numeroEnt, $bodega);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,7,'ENTRADA DE INVENTARIOS',0,1,'C');
  $pdf->Ln(1);
  $pdf->Cell(30,4,'PROVEEDOR',0,0,'l');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(90,4,$inven->buscaProveedor($movimientos[0]['id_proveedor']),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(30,4,'Nro Documento',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(30,4,$movimientos[0]['documento'],0,1,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(50,4,'TIPO DE MOVIMIENTO',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(70,4,$inven->getBuscaMovimiento($movimientos[0]['tipo_movi']),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(30,4,'ENTRADA NRO',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(30,4,$numeroEnt,0,1,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(30,4,'BODEGA',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(60,4,$inven->buscaAlmacen($movimientos[0]['id_bodega']),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(30,4,'Fecha :',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,4,$movimientos[0]['fecha_movimiento'],0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(20,4,'Usuario :',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,4,$movimientos[0]['usuario'],0,1,'L');
  $pdf->SetFont('Arial','B',10);

  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(50,5,'PRODUCTO',1,0,'C');
  $pdf->Cell(30,5,'UNIDAD',1,0,'C');
  $pdf->Cell(15,5,'CANT',1,0,'C');
  $pdf->Cell(20,5,'VALOR U1I0',1,0,'C');
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
    $pdf->Cell(10,4,number_format($movimiento['porce_impto'],2),0,0,'R');
    $pdf->Cell(25,4,number_format($movimiento['impuesto'],2),0,0,'R');
    $pdf->Cell(25,4,number_format($movimiento['valor_total'],2),0,1,'R');
  }
  $pdf->Ln(2);

  $pdf->Cell(95,4,'',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(55,4,'VALOR TOTAL ENTRADA ',1,0,'R');
  $pdf->Cell(25,4,number_format($impto,2),1,0,'R');
  $pdf->Cell(25,4,number_format($totalsum,2),1,1,'R');
  $pdf->Ln(25);

  $valY = $pdf->GetY();
  $pdf->Line(20,$valY,95,$valY);
  $pdf->Line(110,$valY,195,$valY);
  $pdf->Cell(95,5,'RECIBE',0,0,'C');
  $pdf->Cell(5,5,'',0,0,'L');
  $pdf->Cell(95,5,'ENTREGA',0,0,'C');

  $pdf->Ln(5);

  $file = '../../imprimir/Entrada_'.$numeroEnt.'.pdf';

  $pdf->Output($file,'F');

  echo $numeroMov;

?>

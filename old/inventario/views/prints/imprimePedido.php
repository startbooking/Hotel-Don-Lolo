<?php 
  require '../../../res/shared/plantillaInvVer.php'; 

  $numeroPed = $numero; 
  $pedidos   = $inven->getPedidoDetallado($numeroPed);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',11);
  $pdf->Ln(1);
  $pdf->Cell(195,7,'ORDEN DE PEDIDO',0,1,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,6,'FECHA',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(40,6,$pedidos[0]['fecha_ped'],0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,6,'PEDIDO NRO',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(40,6,str_pad($pedidos[0]['numero_ped'],5,'0',STR_PAD_LEFT),0,1,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,6,'ALMACEN ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(60,6,utf8_decode($inven->buscaAlmacen($pedidos[0]['id_centrocosto'])),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,6,'PROVEEDOR ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(60,6,utf8_decode($pedidos[0]['empresa']),0,1,'L');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(65,6,'PRODUCTO',1,0,'C');
  $pdf->Cell(35,6,'UNIDAD',1,0,'C');
  $pdf->Cell(30,6,'CANT',1,0,'C');
  $pdf->Cell(30,6,'VAL UNITARIO',1,0,'C');
  $pdf->Cell(35,6,'VALOR TOTAL',1,1,'C');
  $pdf->SetFont('Arial','',10);
  $totalsum  = 0; 
  foreach ($pedidos as $pedido) {
    $totalsum = $totalsum + $pedido['valor_total']; 
    $pdf->Cell(65,6,utf8_decode($pedido['nombre_producto']),1,0,'L');
    $pdf->Cell(35,6,substr(utf8_decode($pedido['descripcion_unidad']),0,14),1,0,'L');
    $pdf->Cell(30,6,number_format($pedido['cantidad'],2),1,0,'R');
    $pdf->Cell(30,6,number_format($pedido['valor_unitario'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($pedido['valor_total'],2),1,1,'R');
  }
  $pdf->Cell(65,6,'',0,0,'L');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(95,6,'TOTAL ',1,0,'C');
  $pdf->Cell(35,6,number_format($totalsum,2),1,1,'R');
  $pdf->Ln(1);

  $pdf->Ln(2);
  $file = '../../imprimir/Pedido_'.$numero.'.pdf';

  $pdf->Output($file,'F');

  echo $numero;

?>

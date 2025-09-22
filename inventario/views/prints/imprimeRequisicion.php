<?php 
  
  require '../../../res/shared/plantillaInvVer.php'; 

  $numeroReq = $numero; 
  $pedidos   = $inven->getRequisicionDetallado($numeroReq);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,7,'REQUISICIONES  INVENTARIOS',0,1,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Ln(2);
  $pdf->Cell(25,6,'FECHA',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(30,6,$pedidos[0]['fecha_req'],0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(35,6,'REQUISICION NRO',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(40,6,str_pad($pedidos[0]['numero_req'],5,'0',STR_PAD_LEFT),0,1,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(40,6,'CENTRO DE COSTO ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(50,6,($pedidos[0]['descripcion_centro']),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(40,6,'ALMACEN ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(50,6,($pedidos[0]['descripcion_bodega']),0,1,'L');
  $pdf->Ln(3);

  $pdf->Cell(65,6,'PRODUCTO',1,0,'C');
  $pdf->Cell(35,6,'UNIDAD',1,0,'C');
  $pdf->Cell(30,6,'CANT',1,0,'C');
  $pdf->Cell(30,6,'VAL UNITARIO',1,0,'C');
  $pdf->Cell(35,6,'VALOR TOTAL',1,1,'C');
  $pdf->SetFont('Arial','',9);
  $totalsum  = 0; 
  foreach ($pedidos as $pedido) {
    $totalsum = $totalsum + $pedido['valor_total']; 
    $pdf->Cell(65,6,utf8_decode($pedido['nombre_producto']),1,0,'L');
    $pdf->Cell(35,6,substr(utf8_decode($pedido['descripcion_unidad']),0,12),1,0,'L');
    $pdf->Cell(30,6,number_format($pedido['cantidad'],2),1,0,'R');
    $pdf->Cell(30,6,number_format($pedido['valor_unitario'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($pedido['valor_total'],2),1,1,'R');
  }
  $pdf->Cell(100,6,'',0,0,'L');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(60,6,'TOTAL ',1,0,'C');
  $pdf->Cell(35,6,number_format($totalsum,2),1,1,'R');
  $pdf->Ln(1);

  $pdf->Ln(2);

  $file = '../../imprimir/Requisicion_'.$numeroReq.'.pdf';

  $pdf->Output($file,'F');

  echo $numero;
?>

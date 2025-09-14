<?php 
  include_once('encabezado_impresiones.php');

  $movimientos = $pos->getProductosMovimiento($numeroMov);

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Image('../../../../img/'.$logo,10,10,20);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(195,7,NAME_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(195,5,'Nit: '.NIT_EMPRESA,0,1,'C');
   $pdf->Cell(25,5,'Fecha',0,0,'L');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(30,5,$movimientos[0]['fecha_movimiento'],0,0,'L');
  $pdf->Cell(35,5,'Salida Nro',0,0,'L');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(40,5,str_pad($movimientos[0]['numero'],5,'0',STR_PAD_LEFT),0,1,'L');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(25,5,'Almacen ',0,0,'L');
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(70,5,$movimientos[0]['descripcion_bodega'],0,0,'L');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(40,5,'Factura Nro ',0,0,'L');
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(50,6,($movimientos[0]['documento']),0,1,'L');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(195,5,'SALIDA DE INVENTARIOS',0,1,'C');
  $pdf->Cell(65,5,'PRODUCTO',1,0,'C');
  $pdf->Cell(20,5,'CANT',1,0,'C');
  $pdf->Cell(45,5,'UNIDAD',1,0,'C');
  $pdf->Cell(30,5,'VALOR UNI.',1,0,'C');
  $pdf->Cell(30,5,'TOTAL',1,1,'C');
  $pdf->SetFont('Arial','',10);
  $totalsum  = 0; 
  foreach ($movimientos as $movimiento) {
    $totalsum = $totalsum + $movimiento['valor_total']; 
    $pdf->Cell(65,4,($movimiento['nombre_producto']),0,0,'L');
    $pdf->Cell(20,4,number_format($movimiento['cantidad'],2),0,0,'R');
    $pdf->Cell(45,4,$pos->getUnidadAlmacena($movimiento['unidad_alm']),0,0,'L');
    $pdf->Cell(30,4,number_format($movimiento['valor_unitario'],2),0,0,'R');
    $pdf->Cell(30,4,number_format($movimiento['valor_total'],2),0,1,'R');
  }
  $pdf->Cell(65,5,'',0,0,'L');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(95,5,'TOTAL ',1,0,'C');
  $pdf->Cell(30,5,number_format($totalsum,2),1,1,'R');
  $pdf->Ln(1);

  $pdf->Ln(2);
  $file = '../../../../inventario/imprimir/Salida_'.$numeroMov.'.pdf';

  $pdf->Output($file,'F');

?>

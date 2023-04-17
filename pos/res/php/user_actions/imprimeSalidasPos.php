<?php 
  include_once('encabezado_impresiones.php');

  $movimientos = $pos->getProductosMovimiento($numeroMov);

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Image('../../../../img/'.$logo,10,10,20);
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(195,7,NAME_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(195,6,'Nit: '.NIT_EMPRESA,0,1,'C');
  /*  
  $pdf->Cell(195,6,ADRESS_EMPRESA,0,1,'C');
  $pdf->Cell(195,6,utf8_decode(CIUDAD_EMPRESA.', '.PAIS_EMPRESA),0,1,'C');
  $pdf->Cell(195,6,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
   */
  $pdf->SetFont('Arial','B',12);
  $pdf->Ln(2);
  $pdf->Cell(25,6,'Fecha',0,0,'L');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(30,6,$movimientos[0]['fecha_movimiento'],0,0,'L');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(35,6,'Salida Nro',0,0,'L');
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(40,6,str_pad($movimientos[0]['numero'],5,'0',STR_PAD_LEFT),0,1,'L');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(40,6,'Almacen ',0,0,'L');
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(70,6,$pos->buscaAlmacen(utf8_decode($movimientos[0]['id_bodega'])),0,0,'L');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(40,6,'Factura Nro ',0,0,'L');
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(50,6,utf8_decode($movimientos[0]['documento']),0,1,'L');
  $pdf->Ln(3);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(195,5,'SALIDA DE INVENTARIOS',0,1,'C');
  $pdf->Ln(4);
  $pdf->Cell(65,6,'PRODUCTO',1,0,'C');
  $pdf->Cell(20,6,'CANT',1,0,'C');
  $pdf->Cell(45,6,'UNIDAD',1,0,'C');
  $pdf->Cell(30,6,'VALOR UNI.',1,0,'C');
  $pdf->Cell(30,6,'TOTAL',1,1,'C');
  $pdf->SetFont('Arial','',10);
  $totalsum  = 0; 
  foreach ($movimientos as $movimiento) {
    $totalsum = $totalsum + $movimiento['valor_total']; 
    $pdf->Cell(65,6,utf8_decode($movimiento['nombre_producto']),1,0,'L');
    $pdf->Cell(20,6,number_format($movimiento['cantidad'],2),1,0,'R');
    $pdf->Cell(45,6,$pos->getUnidadAlmacena($movimiento['unidad_alm']),1,0,'L');
    $pdf->Cell(30,6,number_format($movimiento['valor_unitario'],2),1,0,'R');
    $pdf->Cell(30,6,number_format($movimiento['valor_total'],2),1,1,'R');
  }
  $pdf->Cell(65,6,'',0,0,'L');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(95,6,'TOTAL ',1,0,'C');
  $pdf->Cell(30,6,number_format($totalsum,2),1,1,'R');
  $pdf->Ln(1);

  $pdf->Ln(2);
  $file = '../../../../inventario/imprimir/Salida_'.$numeroMov.'.pdf';

  $pdf->Output($file,'F');

?>

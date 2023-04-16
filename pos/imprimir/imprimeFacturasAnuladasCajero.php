<?php 

  $detalles = $pos->getDetalleFacturaAnuladaCajeroDia('X',$user, $idamb);
  /// $detalles        = $pos->getDetalleFacturaCajerosDia('A',$user, $idamb);


  require_once '../../res/fpdf/fpdf.php';

  $pdf = new FPDF();
  $pdf->AddPage('L','letter');
  $pdf->Image('../../img/'.$logo,10,10,15);
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(260,7,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(260,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  /*
    $pdf->Cell(126090,5,TIPOEMPRESA,0,1,'C');
    $pdf->Cell(260,5,utf8_decode(ADRESS_EMPRESA),0,1,'C');
    $pdf->Cell(260,5,utf8_decode(CIUDAD_EMPRESA).' '.PAIS_EMPRESA,0,1,'C');
    $pdf->Cell(260,5,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
  */
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(260,6,$nomamb,0,1,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(260,6,'Usuario '.$user.' Fecha '.$fecha,0,1,'C');
  $pdf->SetFont('Arial','B',11);
  $pdf->Ln(2);
    $pdf->SetFont('Arial','B',11);  
  $pdf->Cell(260,6,'DETALLE FACTURAS ANULADAS ',1,1,'C');
  $pdf->SetFont('Arial','',10);  
  $pdf->Cell(20,6,'Fact.',1,0,'C');
  $pdf->Cell(20,6,'Com. ',1,0,'C');
  $pdf->Cell(20,6,'Mesa ',1,0,'C');
  $pdf->Cell(20,6,'Pax ',1,0,'C');
  $pdf->Cell(35,6,'Total Fact ',1,0,'C');
  $pdf->Cell(30,6,'Usuario ',1,0,'C');
  $pdf->Cell(80,6,'Motivo Anulacion ',1,0,'C');
  $pdf->Cell(35,6,'Hora ',1,1,'C');

  $fact = 0;
  $neto = 0;
  $impt = 0;
  $prop = 0;
  $tota = 0;
  $desc = 0;

  foreach ($detalles as $detalle) {
    $fact = $fact + 1; 
    $neto = $neto + $detalle['valor_neto'];
    $impt = $impt + $detalle['impuesto'];
    $prop = $prop + $detalle['propina'];
    $desc = $desc + $detalle['descuento'];
    $tota = $tota + $detalle['valor_total'];

    $pdf->Cell(20,6,$detalle['factura'],1,0,'R');
    $pdf->Cell(20,6,$detalle['comanda'],1,0,'R');
    $pdf->Cell(20,6,$detalle['mesa'],1,0,'R');
    $pdf->Cell(20,6,$detalle['pax'],1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['valor_total'],2),1,0,'R');
    $pdf->Cell(30,6,$detalle['usuario_anulada'],1,0,'L');
    $pdf->Cell(80,6,$detalle['motivo_anulada'],1,0,'L');
    $pdf->Cell(35,6,$detalle['fecha_factura_anulada'],1,1,'L');
  }
  $pdf->Cell(80,6,'Total',1,0,'C');
  $pdf->Cell(35,6,number_format($tota,2),1,1,'R');

  $pdf->Ln(5);

  $file = '../imprimir/informes/facturasAnuladas_Cajero_'.$file.'.pdf';

  $pdf->Output($file,'F');

?>

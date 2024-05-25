<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdfFinanc.php';

  $pdf = new PDF();
  $pdf->AddPage('L','letter');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(260,5,'FACTURAS DEL DIA ',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(260,5,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(10,6,'FAC.',0,0,'C');
  $pdf->Cell(60,6,'Huesped',0,0,'C');
  $pdf->Cell(22,6,'Consumos',0,0,'C');
  $pdf->Cell(22,6,'Impuesto',0,0,'C');
  $pdf->Cell(22,6,'Total',0,0,'C');
  $pdf->Cell(30,6,'Usuario',0,0,'C');
  $pdf->Cell(10,6,'Hora',0,0,'C');
  $pdf->Cell(20,6,'Estado',0,0,'C');
  $pdf->Cell(60,6,'Forma de Pago',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $cargos = $hotel->getFacturasdelDia(); 

  $consu  = 0 ;
  $impto  = 0 ;
  $pagos  = 0 ;

  foreach ($cargos as $cargo) {
    $pdf->Cell(10,4,$cargo['factura_numero'],0,0,'L');
    $pdf->Cell(60,4,substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,28),0,0,'L');
    $pdf->Cell(22,4,number_format($cargo['total_consumos'],2),0,0,'R');
    $pdf->Cell(22,4,number_format($cargo['total_impuesto'],2),0,0,'R');
    $pdf->Cell(22,4,number_format($cargo['total_pagos'],2),0,0,'R');
    $pdf->Cell(30,4,$hotel->nombreUsuario($cargo['id_usuario_factura']),0,0,'R'); 
    $pdf->Cell(10,4,substr($cargo['fecha_sistema_cargo'],11,5),0,0,'R'); 
    $pdf->Cell(20,4,estadoFacturaImp($cargo['factura_anulada']),0,0,'L'); 
    $pdf->Cell(60,4,$hotel->getDescripcionIva($cargo['id_codigo_cargo']),0,1,'L'); 
    if($cargo['factura_anulada']==0){
      $consu  = $consu + $cargo['total_consumos'];
      $impto  = $impto + $cargo['total_impuesto'];
      $pagos  = $pagos + $cargo['total_pagos'];
    }

  }
  $pdf->Ln(2);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(70,6,'Total Facturas del Dia ',0,0,'L');
  $pdf->Cell(22,6,number_format($consu,2),0,0,'R');
  $pdf->Cell(22,6,number_format($impto,2),0,0,'R');
  $pdf->Cell(22,6,number_format($pagos,2),0,0,'R');
  $pdf->Ln(3);

/*   $fileOut = '../imprimir/informes/'.$file.'.pdf'; 
  $pdf->Output($fileOut,'F');
  echo $file.'.pdf'; */
  
  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;
?>

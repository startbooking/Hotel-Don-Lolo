<?php 
  
  require 'plantillaFpdfFacturas.php';

  $pdf = new PDF();
  $pdf->AddPage('L','letter');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(260,5,'FACTURAS POR RANGO DE FECHAS ',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(260,5,'Desde Fecha : '.$_SESSION['desde'].' Hasta Fecha '.$_SESSION['hasta'],0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(10,6,'FAC.',0,0,'C');
  $pdf->Cell(20,6,'Fecha',0,0,'C');
  $pdf->Cell(60,6,'Huesped',0,0,'C');
  $pdf->Cell(22,6,'Consumos',0,0,'C');
  $pdf->Cell(22,6,'Impuesto',0,0,'C');
  $pdf->Cell(22,6,'Total',0,0,'C');
  $pdf->Cell(30,6,'Usuario',0,0,'C');
  $pdf->Cell(10,6,'Hora',0,0,'C');
  $pdf->Cell(20,6,'Estado',0,0,'C');
  $pdf->Cell(60,6,'Forma de Pago',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $cargos = $hotel->getFacturasPorRango($desde,$hasta);

  $consu  = 0 ;
  $impto  = 0 ;
  $pagos  = 0 ;

  foreach ($cargos as $cargo) {
    $pdf->Cell(10,6,$cargo['factura_numero'],0,0,'L');
    $pdf->Cell(20,6,$cargo['fecha_factura'],0,0,'L');
    $pdf->Cell(60,6,substr(($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,28),0,0,'L');
    $pdf->Cell(22,6,number_format($cargo['total_consumos'],2),0,0,'R');
    $pdf->Cell(22,6,number_format($cargo['total_impuesto'],2),0,0,'R');
    $pdf->Cell(22,6,number_format($cargo['total_pagos'],2),0,0,'R');
    $pdf->Cell(30,6,($hotel->nombreUsuario($cargo['id_usuario_factura'])),0,0,'L'); 
    $pdf->Cell(10,6,substr($cargo['fecha_sistema_cargo'],11,5),0,0,'R'); 
    $pdf->Cell(20,6,estadoFacturaImp($cargo['factura_anulada']),0,0,'R'); 
    $pdf->Cell(60,6,$hotel->getDescripcionIva($cargo['id_codigo_cargo']),0,1,'L'); 

    $consu  = $consu + $cargo['total_consumos'];
    $impto  = $impto + $cargo['total_impuesto'];
    $pagos  = $pagos + $cargo['total_pagos'];

  }
  $pdf->Ln(2);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(70,6,'Total Facturas del Dia ',0,0,'L');
  $pdf->Cell(22,6,number_format($consu,2),0,0,'R');
  $pdf->Cell(22,6,number_format($impto,2),0,0,'R');
  $pdf->Cell(22,6,number_format($pagos,2),0,0,'R');
  $pdf->Ln(3);

  $file = '../../imprimir/informes/Informes_Facturas_'.$_SESSION['usuario'].'.pdf';

  $pdf->Output($file,'F');
?>

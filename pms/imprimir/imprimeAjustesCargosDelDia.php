<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdfFinanc.php';

  $pdf = new PDF();
  $pdf->AddPage('L','letter');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(260,5,'AJUSTES CARGOS DEL DIA ',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(260,5,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(10,5,'Hab.',1,0,'C');
  $pdf->Cell(60,5,'Huesped',1,0,'C');
  $pdf->Cell(10,5,'Fact.',1,0,'C');
  $pdf->Cell(30,5,'Consumos',1,0,'C');
  $pdf->Cell(30,5,'Impuesto',1,0,'C');
  $pdf->Cell(30,5,'Total',1,0,'C');
  $pdf->Cell(30,5,'Usuario',1,0,'C');
  $pdf->Cell(15,5,'Hora',1,1,'C');
  $pdf->SetFont('Arial','',9);
  $cargos = $hotel->getAjustesCargosDelDia(); 

  $consu  = 0 ;
  $impto  = 0 ;
  $pagos  = 0 ;

  foreach ($cargos as $cargo) {
    $pdf->Cell(10,4,$cargo['num_habitacion'],0,0,'L');
    $pdf->Cell(60,4,substr(($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,28),0,0,'L');
    $pdf->Cell(10,4,$cargo['factura_numero'],0,0,'L');
    $pdf->Cell(30,4,number_format($cargo['monto'],2),0,0,'R');
    $pdf->Cell(30,4,number_format($cargo['imptos'],2),0,0,'R');
    $pdf->Cell(30,4,number_format($cargo['cargos'],2),0,0,'R');
    $pdf->Cell(30,4,$cargo['usuario_factura'],0,0,'R'); 
    $pdf->Cell(15,4,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
    $consu  = $consu + $cargo['monto'];
    $impto  = $impto + $cargo['imptos'];
    $pagos  = $pagos + $cargo['cargos'];
  }
  $pdf->Ln(2);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(70,5,'Total Ajustes Cargos del Dia ',0,0,'L');
  $pdf->Cell(22,5,number_format($consu,2),0,0,'R');
  $pdf->Cell(22,5,number_format($impto,2),0,0,'R');
  $pdf->Cell(22,5,number_format($pagos,2),0,0,'R');
  $pdf->Ln(3);

  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;
?>

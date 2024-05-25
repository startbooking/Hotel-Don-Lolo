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
  $pdf->Cell(260,5,'CARGOS DEL DIA POR HABITACION',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(260,5,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(10,5,'Hab.',0,0,'C');
  $pdf->Cell(70,5,'Huesped',0,0,'C');
  $pdf->Cell(50,5,'Descripcion ',0,0,'C');
  $pdf->Cell(10,5,'Cant. ',0,0,'C');
  $pdf->Cell(25,5,'Monto',0,0,'C');
  $pdf->Cell(25,5,'Impuesto',0,0,'C');
  $pdf->Cell(25,5,'Total',0,0,'C');
  $pdf->Cell(30,5,'Usuario',0,0,'C');
  $pdf->Cell(10,5,'Hora',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $cargos = $hotel->getCargosporFecha(FECHA_PMS,1,0); 
  array_sort_by($cargos, 'habitacion_cargo', $order = SORT_ASC);  

  $monto  = 0 ;
  $impto  = 0 ;
  $total  = 0 ;
  foreach ($cargos as $cargo) {
    $pdf->Cell(10,4,$cargo['habitacion_cargo'],0,0,'L');
    $pdf->Cell(70,4,substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,24),0,0,'L');
    $pdf->Cell(50,4,substr(utf8_decode($cargo['descripcion_cargo']),0,19),0,0,'L');
    $pdf->Cell(10,4,$cargo['cantidad_cargo'],0,0,'C');
    $pdf->Cell(25,4,number_format($cargo['monto_cargo'],2),0,0,'R');
    $pdf->Cell(25,4,number_format($cargo['impuesto'],2),0,0,'R');
    $pdf->Cell(25,4,number_format($cargo['monto_cargo']+$cargo['impuesto'],2),0,0,'R');
    $pdf->Cell(30,4,$cargo['usuario'],0,0,'R'); 
    $pdf->Cell(10,4,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
    $monto  = $monto + $cargo['monto_cargo'];
    $impto  = $impto + $cargo['impuesto'];
    $total  = $total + $cargo['monto_cargo'] + $cargo['impuesto'];        
  }
  $pdf->Ln(2);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(140,5,'Total cargos del Dia ',0,0,'L');
  $pdf->Cell(25,5,number_format($monto,2),0,0,'R');
  $pdf->Cell(25,5,number_format($impto,2),0,0,'R');
  $pdf->Cell(25,5,number_format($total,2),0,1,'R');
  $pdf->Ln(3);
  
  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;
?>

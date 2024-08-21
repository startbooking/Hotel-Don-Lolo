<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];
  
  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdf.php';

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,5,'BALANCE CAJERO '.FECHA_PMS,0,1,'C');
  $pdf->Cell(195,5,'PAGOS ANULADOS DEL DIA ',0,1,'C');
  $pdf->Cell(30,5,'Usuario ',0,0,'L');
  $pdf->Cell(50,5,$apellidos.' '.$nombres,0,1,'C');
  $pdf->Cell(10,5,'Hab.',0,0,'C');
  $pdf->Cell(50,5,'Huesped',0,0,'C');
  $pdf->Cell(20,5,'FAC ',0,0,'C');
  $pdf->Cell(40,5,'Descripcion ',0,0,'C');
  $pdf->Cell(25,5,'Valor',0,0,'C');
  $pdf->Cell(50,5,'Motivo Anulacion',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $cargos = $hotel->getCargosAnuladosdelDiaporcajero(FECHA_PMS,$usuario,3,1); 
  $pagosanu = 0 ;
  $impto    = 0 ;
  $total    = 0 ;
  foreach ($cargos as $cargo) {
    $pdf->Cell(10,4,($cargo['habitacion_cargo']),0,0,'L');
    $pdf->Cell(50,4,substr(($cargo['nombre_completo']),0,24),0,0,'L');
    $pdf->Cell(20,4,substr($cargo['factura_numero'],0,19),0,0,'C');
    $pdf->Cell(40,4,substr($cargo['descripcion_cargo'],0,19),0,0,'L');
    $pdf->Cell(25,4,number_format($cargo['pagos_cargos'],2),0,0,'R');
    $pdf->Cell(50,4,substr($cargo['motivo_anulacion'],0,30),0,1,'L');
    $pagosanu  = $pagosanu + $cargo['pagos_cargos'];
  }
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(100,5,'Total Pagos Anulados Cajero ',0,0,'L');
  $pdf->Cell(25,5,number_format($pagosanu,2),0,1,'R');
  
  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;

?>

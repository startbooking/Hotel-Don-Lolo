<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdf.php';

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(195,5,'BALANCE CAJERO '.FECHA_PMS,0,1,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,5,'PAGOS ANULADOS DEL DIA ',0,1,'C');
  $pdf->Ln(1);  
  $pdf->Cell(30,6,'Usuario ',0,0,'L');
  $pdf->Cell(50,6,$apellidos.' '.$nombres,0,1,'C');
  $pdf->Ln(2);
  $pdf->Cell(10,6,'Hab.',0,0,'C');
  $pdf->Cell(50,6,'Huesped',0,0,'C');
  $pdf->Cell(20,6,'FAC ',0,0,'C');
  $pdf->Cell(40,6,'Descripcion ',0,0,'C');
  $pdf->Cell(25,6,'Valor',0,0,'C');
  $pdf->Cell(50,6,'Motivo Anulacion',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $cargos = $hotel->getCargosAnuladosdelDiaporcajero(FECHA_PMS,$usuario,3,1); 
  $pagosanu = 0 ;
  $impto    = 0 ;
  $total    = 0 ;
  foreach ($cargos as $cargo) {
    $pdf->Cell(10,6,utf8_decode($cargo['habitacion_cargo']),0,0,'L');
    $pdf->Cell(50,6,substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,24),0,0,'L');
    $pdf->Cell(20,6,substr($cargo['factura_numero'],0,19),0,0,'C');
    $pdf->Cell(40,6,substr($cargo['descripcion_cargo'],0,19),0,0,'L');
    $pdf->Cell(25,6,number_format($cargo['pagos_cargos'],2),0,0,'R');
    $pdf->Cell(50,6,$cargo['motivo_anulacion'],0,1,'L');
    $pagosanu  = $pagosanu + $cargo['pagos_cargos'];
  }
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(100,6,'Total Pagos Anulados Cajero ',0,0,'L');
  $pdf->Cell(25,6,number_format($pagosanu,2),0,1,'R');

  $fileOut = '../imprimir/informes/'.$file.'.pdf';
  $pdf->Output($fileOut,'F');
  echo $file.'.pdf';
?>

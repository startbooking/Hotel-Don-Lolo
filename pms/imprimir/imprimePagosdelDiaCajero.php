<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdf.php';

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(195,5,'PAGOS DEL DIA POR USUARIO',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(195,5,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $usuarios = $hotel->getUsuariosCargos(FECHA_PMS,3,0); 

  $pag   = 0;
  $pago = 0 ;

  foreach ($usuarios as $usuario) {
    $pdf->Cell(20,6,'Usuario ',0,0,'L');
    $pdf->Cell(50,6,utf8_decode($usuario['usuario']),0,1,'L');
      
    $cargos = $hotel->getCargosdelDiaporcajero(FECHA_PMS,$usuario['usuario'],3,0);
    $pdf->Cell(20,6,'',0,0,'R');
    $pdf->Cell(50,6,'Descripcion.',0,0,'C');
    $pdf->Cell(10,6,'Hab.',0,0,'R');
    $pdf->Cell(70,6,'Huesped',0,0,'C');
    $pdf->Cell(10,6,'Cant. ',0,0,'C');
    $pdf->Cell(25,6,'Pagos',0,0,'C');
    $pdf->Cell(10,6,'Hora',0,1,'C');
    $pdf->SetFont('Arial','',9);
    $pago  = 0 ;

    foreach ($cargos as $cargo) {
      $pdf->Cell(20,6,'',0,0,'L');
      $pdf->Cell(50,6,utf8_decode($cargo['descripcion_cargo']),0,0,'');
      $pdf->Cell(10,6,$cargo['habitacion_cargo'],0,0,'R');
      $pdf->Cell(70,6,substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,22),0,0,'L');
      $pdf->Cell(10,6,$cargo['cantidad_cargo'],0,0,'C');
      $pdf->Cell(25,6,number_format($cargo['pagos_cargos'],2),0,0,'R');
      $pdf->Cell(10,6,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
      $pago  = $pago + $cargo['pagos_cargos'];
    }
    $pag  = $pag + $pago;

    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(40,6,'Total Pagos Cajero',0,0,'L');
    $pdf->Cell(110,6,utf8_decode($usuario['usuario']),0,0,'L');
    $pdf->Cell(25,6,number_format($pago,2),0,1,'R');
    $pdf->Ln(3);
  }
  $pdf->Ln(2);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(150,6,'Total Pagos Del Dia',0,0,'L');
  $pdf->Cell(25,6,number_format($pag,2),0,1,'R');
  $pdf->Ln(3);

  $fileOut = '../imprimir/informes/'.$file.'.pdf';
  $pdf->Output($fileOut,'F');
  echo $file.'.pdf';
?>

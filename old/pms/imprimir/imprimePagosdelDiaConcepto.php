<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdfFinanc.php';

  // require 'plantillaFpdfFinanc.php';

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(195,5,'PAGOS DEL DIA POR CONCEPTO',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(195,5,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial','B',10);
  $codigos = $hotel->cargosDelDia(FECHA_PMS,3,0); 

  $pag = 0;
  $monto  = 0 ;

  foreach ($codigos as $codigo) {
    $pdf->Cell(30,6,'Descripcion ',0,0,'L');
    $pdf->Cell(50,6,utf8_decode($codigo['descripcion_cargo']),0,1,'L');
    $cargos = $hotel->getCargosdelDiaporCodigo(FECHA_PMS,$codigo['id_codigo_cargo'],0);
    $pdf->Cell(30,6,'Hab.',0,0,'R');
    $pdf->Cell(70,6,'Huesped',0,0,'C');
    $pdf->Cell(10,6,'Cant. ',0,0,'C');
    $pdf->Cell(25,6,'Pago',0,0,'C');
    $pdf->Cell(30,6,'Usuario',0,0,'C');
    $pdf->Cell(10,6,'Hora',0,1,'C');
    $pdf->SetFont('Arial','',9);
    $pagos  = 0 ;

    foreach ($cargos as $cargo) {
      $pdf->Cell(30,6,$cargo['habitacion_cargo'],0,0,'R');
      $pdf->Cell(70,6,substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,24),0,0,'L');
      $pdf->Cell(10,6,$cargo['cantidad_cargo'],0,0,'C');
      $pdf->Cell(25,6,number_format($cargo['pagos_cargos'],2),0,0,'R');
      $pdf->Cell(30,6,$cargo['usuario'],0,0,'R'); 
      $pdf->Cell(10,6,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
      $pagos  = $pagos + $cargo['pagos_cargos'];
    }
    $pag  = $pag + $pagos;

    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(40,6,'Total Cargos Descripcion',0,0,'L');
    $pdf->Cell(70,6,utf8_decode($cargo['descripcion_cargo']),0,0,'L');
    $pdf->Cell(25,6,number_format($pagos,2),0,1,'R');
    $pdf->Ln(3);
  }
  $pdf->Ln(2);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(110,6,'Total Pagos Del Dia',0,0,'L');
  $pdf->Cell(25,6,number_format($pag,2),0,0,'R');
  $pdf->Ln(3);

  $fileOut = '../imprimir/informes/'.$file.'.pdf'; 
  $pdf->Output($fileOut,'F');
  echo $file.'.pdf';
?>

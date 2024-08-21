<?php 

$file = $_POST['file'];
$usuario = $_POST['usuario'];
$apellidos = $_POST['apellidos'];
$nombres = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdfRooms.php';

  $reservas = $hotel->getExtranjerosenCasa(ID_PAIS_EMPRESA, FECHA_PMS,"CA"); 
  $regis    = count($reservas);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(190,4,'EXTRANJEROS EN CASA',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,4,'Fecha '.FECHA_PMS,0,1,'C');
  $pdf->Ln(2); 
  
  if($regis==0){
    $pdf->Cell(190,5,'SIN EXTRANJEROS EN CASA',1,1,'C');    
  }else{
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(25,5,'Llegada',1,0,'L');
    $pdf->Cell(25,5,'Salida',1,0,'L');
    $pdf->Cell(70,5,'Huesped',1,0,'L');
    $pdf->Cell(35,5,'Nacionalidad',0,0,'L');
    $pdf->Cell(5,5,'H',1,0,'L');
    $pdf->Cell(5,5,'M',1,0,'L');
    $pdf->Cell(5,5,'N',1,0,'L');
    $pdf->Cell(25,5,'Tarifa',1,1,'C');
    $pdf->SetFont('Arial','',9);
    foreach ($reservas as $reserva) {
      $nombrepais = $hotel->buscaNacionalidad($reserva['pais']);
      $pdf->Cell(25,5,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(25,5,$reserva['fecha_salida'],0,0,'L');
      $pdf->Cell(70,5,($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']),0,0,'L');
      $pdf->Cell(35,5,$nombrepais,0,0,'L');
      $pdf->Cell(5,5,$reserva['can_hombres'],0,0,'C');
      $pdf->Cell(5,5,$reserva['can_mujeres'],0,0,'C');
      $pdf->Cell(5,5,$reserva['can_ninos'],0,0,'C');
      $pdf->Cell(25,5,number_format($reserva['valor_diario'],2),0,1,'R'); 
    }    
  }

  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;
  ?>

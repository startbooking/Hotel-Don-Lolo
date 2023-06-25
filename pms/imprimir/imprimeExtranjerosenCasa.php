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
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(25,6,'Llegada',0,0,'L');
    $pdf->Cell(25,6,'Salida',0,0,'L');
    $pdf->Cell(70,6,'Huesped',0,0,'L');
    $pdf->Cell(35,6,'Nacionalidad',0,0,'L');
    $pdf->Cell(5,6,'H',0,0,'L');
    $pdf->Cell(5,6,'M',0,0,'L');
    $pdf->Cell(5,6,'N',0,0,'L');
    $pdf->Cell(25,6,'Tarifa',0,1,'C');
    $pdf->SetFont('Arial','',9);
    foreach ($reservas as $reserva) {
      $nombrepais = $hotel->buscaNacionalidad($reserva['pais']);
      $pdf->Cell(25,6,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(25,6,$reserva['fecha_salida'],0,0,'L');
      $pdf->Cell(70,6,utf8_decode($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']),0,0,'L');
      $pdf->Cell(35,6,$nombrepais,0,0,'L');
      $pdf->Cell(5,6,$reserva['can_hombres'],0,0,'C');
      $pdf->Cell(5,6,$reserva['can_mujeres'],0,0,'C');
      $pdf->Cell(5,6,$reserva['can_ninos'],0,0,'C');
      $pdf->Cell(25,6,number_format($reserva['valor_diario'],2),0,1,'R'); 
    }    
  }
  // $file = '../../imprimir/auditorias/Extranjeros_llegando_'.FECHA_PMS.'.pdf';


  $fileOut = '../imprimir/informes/'.$file.'.pdf';
  $pdf->Output($fileOut, 'F');
  echo $file.'.pdf';
  

  $pdf->Output($file,'F');
?>

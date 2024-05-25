<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdfFinanc.php'; 

  $depositos = $hotel->depositosReservas(CTA_DEPOSITO); 
  
  $regis    = count($depositos);

  $pdf = new PDF();
  $pdf->AddPage('L','letter');
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(265,5,'DEPOSITOS A RESERVAS ',0,1,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(265,5,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(10,5,'Res. ',0,0,'C');
  $pdf->Cell(10,5,'Hab.',0,0,'C'); 
  $pdf->Cell(70,5,'Huesped',0,0,'C');
  $pdf->Cell(30,5,'Deposito',0,0,'L');
  $pdf->Cell(50,5,'Forma de Pago ',0,0,'C');
  $pdf->Cell(20,5,'Cons. ',0,0,'C');
  $pdf->Cell(20,5,'Fecha',0,0,'C');
  $pdf->Cell(20,5,'Usuario',0,1,'C');
  $pdf->SetFont('Arial','',9);
  // $pdf->Ln(2);
  if($regis==0){
      $pdf->Cell(260,5,'SIN DEPOSITOS A RESERVAS ',0,0,'C');    
  }else{
    $sal = 0;
    foreach ($depositos as $deposito) {
      $pdf->Cell(10,4,$deposito['num_reserva'],0,0,'C');
      $pdf->Cell(10,4,$deposito['num_habitacion'],0,0,'L');
      $pdf->Cell(70,4,utf8_decode($deposito['apellido1'].' '.$deposito['apellido2'].' '.$deposito['nombre1'].' '.$deposito['nombre2']),0,0,'L');
      $pdf->Cell(30,4,number_format($deposito['pagos_cargos'],2),0,0,'R');
      $pdf->Cell(50,4,$deposito['descripcion_cargo'],0,0,'L');
      $pdf->Cell(20,4,$deposito['concecutivo_deposito'],0,0,'R');
      $pdf->Cell(20,4,$deposito['fecha_cargo'],0,0,'R');
      $pdf->Cell(20,4,utf8_decode($hotel->nombreUsuario($deposito['id_usuario'])),0,1,'L');
      $sal = $sal+ $deposito['pagos_cargos'];
    }
    $pdf->SetY(180);
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(160,6,'Total Depositos',0,0,'C');
    $pdf->Cell(30,6,number_format($sal,2),0,1,'R');
  }
  
  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));
  echo $base64String;

?>

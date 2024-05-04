<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdfFinanc.php';
  
  $pdf = new PDF();  
  $pdf->AddPage('L','letter');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(260,5,'CUENTAS CONGELADAS ',0,1,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(260,5,'Fecha '.FECHA_PMS,0,1,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(10,5,'Hab.',1,0,'C');
  $pdf->Cell(80,5,'Huesped',1,0,'C');
  $pdf->Cell(25,5,'Llegada ',1,0,'C');
  $pdf->Cell(25,5,'Salida ',1,0,'C');
  $pdf->Cell(30,5,'Consumos. ',1,0,'C');
  $pdf->Cell(30,5,'Impuestos',1,0,'C');
  $pdf->Cell(30,5,'Pagos',1,0,'C');
  $pdf->Cell(30,5,'Saldo',1,1,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','',11);

  $reservas = $hotel->getHuespedesenCasa(2,'CO'); 
  
  $regis   = count($reservas);
  $pdf->SetFont('Arial','',10);

  if($regis==0){
    $pdf->Cell(260,6,'SIN CUENTAS CONGELADAS',0,1,'C');    
  }else{
    $car = 0;
    $imp = 0;
    $pag = 0;
    $tot = 0;
    foreach ($reservas as $reserva) {
      $consumos = $hotel->getConsumosReserva($reserva['num_reserva']);
      if(count($consumos)==0){
        $consumos[0]['cargos'] = 0;
        $consumos[0]['imptos'] = 0;
        $consumos[0]['pagos']  = 0;
      } 
      $pdf->Cell(10,4,$reserva['num_habitacion'],0,0,'R');
      $pdf->Cell(80,4,utf8_decode($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']),0,0,'L');
      $pdf->Cell(25,4,$reserva['fecha_llegada'],0,0,'C');
      $pdf->Cell(25,4,$reserva['fecha_salida'],0,0,'C');
      $pdf->Cell(30,4,number_format($consumos[0]['cargos'],2),0,0,'R');
      $pdf->Cell(30,4,number_format($consumos[0]['imptos'],2),0,0,'R');
      $pdf->Cell(30,4,number_format($consumos[0]['pagos'],2),0,0,'R');
      $pdf->Cell(30,4,number_format($consumos[0]['cargos']+$consumos[0]['imptos']-$consumos[0]['pagos'],2),0,1,'R');
      $car = $car + $consumos[0]['cargos'];
      $imp = $imp + $consumos[0]['imptos'];
      $pag = $pag + $consumos[0]['pagos'];

    }
    $tot = $car+$imp-$pag;

    // $pdf->SetY(180);
    $pdf->ln(1);
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(30,6,'Consumos',1,0,'C');
    $pdf->Cell(30,6,number_format($car,2),1,0,'R');
    $pdf->Cell(30,6,'Impuesto',1,0,'C');
    $pdf->Cell(30,6,number_format($imp,2),1,0,'R');
    $pdf->Cell(30,6,'Abonos',1,0,'C');
    $pdf->Cell(40,6,number_format($pag,2),1,0,'R');
    $pdf->Cell(30,6,'Saldo',1,0,'C');
    $pdf->Cell(40,6,number_format($tot,2),1,1,'R');
 
  }

  $fileOut = '../imprimir/informes/'.$file.'.pdf'; 
  $pdf->Output($fileOut,'F');
  echo $file.'.pdf';
?>

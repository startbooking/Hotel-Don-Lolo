<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topHotel.php'; 
  require 'plantillaFpdf.php';

  $usuarios = $hotel->getUsuariosCargos(FECHA_PMS,'1'); 
  $regis    = count($usuarios);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(195,5,'PAGOS DEL DIA POR CAJERO '.FECHA_PMS,0,1,'C');
  $pdf->Ln(2);

  if($regis==0){
      $pdf->Cell(195,6,'SIN PAGOS PARA ESTE DIA',0,1,'C');    
  }else{
    foreach ($usuarios as $usuario) {
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(30,6,'Usuario . ',0,0,'L');
      $pdf->Cell(50,6,$usuario['apellidos'].' '.$usuario['nombres'],0,1,'C');
      // $pdf->Ln(1);
      $pdf->Cell(10,6,'Hab.',0,0,'C');
      $pdf->Cell(50,6,'Huesped',0,0,'C');
      $pdf->Cell(40,6,'Descripcion ',0,0,'C');
      $pdf->Cell(10,6,'Cant. ',0,0,'C');
      $pdf->Cell(25,6,'Monto',0,0,'C');
      $pdf->Cell(25,6,'Impuesto',0,0,'C');
      $pdf->Cell(25,6,'Total',0,0,'C');
      $pdf->Cell(10,6,'Hora',0,1,'C');
      $pdf->SetFont('Arial','',9);
      $cargos = $hotel->getCargosdelDiaporcajero(FECHA_PMS,$usuario['usuario'],1); 
      $monto  = 0 ;
      $impto  = 0 ;
      $total  = 0 ;
      foreach ($cargos as $cargo) {
        $pdf->Cell(10,6,$cargo['habitacion_cargo'],0,0,'L');
        $pdf->Cell(50,6,substr($cargo['apellidos'].' '.$cargo['nombres'],0,24),0,0,'L');
        $pdf->Cell(40,6,substr($cargo['descripcion_cargo'],0,19),0,0,'L');
        $pdf->Cell(10,6,$cargo['cantidad_cargo'],0,0,'C');
        $pdf->Cell(25,6,number_format($cargo['monto_cargo'],2),0,0,'R');
        $pdf->Cell(25,6,number_format($cargo['impuesto'],2),0,0,'R');
        $pdf->Cell(25,6,number_format($cargo['monto_cargo']+$cargo['impuesto'],2),0,0,'R');
        $pdf->Cell(10,6,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
        $monto  = $monto + $cargo['monto_cargo'];
        $impto  = $impto + $cargo['impuesto'];
        $total  = $total + $cargo['monto_cargo'] + $cargo['impuesto'];        
      }
      $pdf->SetFont('Arial','B',9);
      $pdf->Cell(110,6,'Total cargos Por Cajero ',0,0,'L');
      $pdf->Cell(25,6,number_format($monto,2),0,0,'R');
      $pdf->Cell(20,6,number_format($impto,2),0,0,'R');
      $pdf->Cell(25,6,number_format($total,2),0,1,'R');
      $pdf->Ln(3);

    }
  }

  $file = BASE_PMS.'auditorias/Pagos_Cajeros_'.FECHA_PMS.'.pdf';
  $pdf->Output($file,'F');
?>

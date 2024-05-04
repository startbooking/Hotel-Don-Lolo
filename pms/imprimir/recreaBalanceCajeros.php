<?php  
  $fechaBus = $_SESSION['fechaPro'];
  
  $usuarios = $hotel->getHistoricoCargosUsuarios($fechaBus,1); 
  $regis    = count($usuarios);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(195,5,'BALANCE CAJERO '.$fechaBus,0,1,'C');
  $pdf->Ln(2);

  if($regis==0){
    $pdf->Cell(195,6,'SIN CARGOS PARA ESTE DIA',0,1,'C');    
  }else{
    foreach ($usuarios as $usuario) {
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(30,6,'Usuario ',0,0,'L');
      $pdf->Cell(50,6,utf8_decode($usuario['apellidos'].' '.$usuario['nombres']),0,1,'C');
      $pdf->Cell(195,5,'CARGOS DEL DIA '.$fechaBus,0,1,'C');
      $pdf->Cell(10,6,'Hab.',0,0,'C');
      $pdf->Cell(50,6,'Huesped',0,0,'C');
      $pdf->Cell(40,6,'Descripcion ',0,0,'C');
      $pdf->Cell(10,6,'Cant. ',0,0,'C');
      $pdf->Cell(25,6,'Monto',0,0,'C');
      $pdf->Cell(25,6,'Impuesto',0,0,'C');
      $pdf->Cell(25,6,'Total',0,0,'C');
      $pdf->Cell(10,6,'Hora',0,1,'C');
      $pdf->SetFont('Arial','',9);
      $cargos = $hotel->getHistoricoCargosdelDiaporcajero($fechaBus,$usuario['id_usuario'],1,0); 

      $monto  = 0 ;
      $impto  = 0 ;
      $total  = 0 ;
      foreach ($cargos as $cargo) {
        $pdf->Cell(10,6,$cargo['habitacion_cargo'],0,0,'L');
        $pdf->Cell(50,6,substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,24),0,0,'L');
        $pdf->Cell(40,6,substr(utf8_decode($cargo['descripcion_cargo']),0,19),0,0,'L');
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
      $pdf->Cell(25,6,number_format($impto,2),0,0,'R');
      $pdf->Cell(25,6,number_format($total,2),0,1,'R');
      $pdf->Ln(3);
      $pdf->Cell(195,5,'CARGOS ANULADOS DEL DIA '.$fechaBus,0,1,'C');
      $pdf->Ln(2);
      $pdf->Cell(10,6,'Hab.',0,0,'C');
      $pdf->Cell(40,6,'Descripcion ',0,0,'C');
      $pdf->Cell(10,6,'Cant. ',0,0,'C');
      $pdf->Cell(25,6,'Monto',0,0,'C');
      $pdf->Cell(25,6,'Impuesto',0,0,'C');
      $pdf->Cell(25,6,'Total',0,0,'C');
      $pdf->Cell(50,6,'Motivo An',0,0,'C');
      $pdf->Cell(10,6,'Hora',0,1,'C');
      $pdf->SetFont('Arial','',9);
      $cargos = $hotel->getHistoricoCargosAnuladosdelDiaporcajero($fechaBus,$usuario['id_usuario'],1,1); 
      $monto  = 0 ;
      $impto  = 0 ;
      $total  = 0 ;
      foreach ($cargos as $cargo) {
        $pdf->Cell(10,6,$cargo['habitacion_cargo'],0,0,'L');
        $pdf->Cell(40,6,substr($cargo['descripcion_cargo'],0,19),0,0,'L');
        $pdf->Cell(10,6,$cargo['cantidad_cargo'],0,0,'C');
        $pdf->Cell(25,6,number_format($cargo['monto_cargo'],2),0,0,'R');
        $pdf->Cell(25,6,number_format($cargo['impuesto'],2),0,0,'R');
        $pdf->Cell(25,6,number_format($cargo['monto_cargo']+$cargo['impuesto'],2),0,0,'R');
        $pdf->Cell(50,6,$cargo['motivo_anulacion'],0,0,'L');
        $pdf->Cell(10,6,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
        $monto  = $monto + $cargo['monto_cargo'];
        $impto  = $impto + $cargo['impuesto'];
        $total  = $total + $cargo['monto_cargo'] + $cargo['impuesto'];        
      }
      $pdf->SetFont('Arial','B',9);
      $pdf->Cell(110,6,'Total Cargos Anulados Cajero ',0,0,'L');
      $pdf->Cell(25,6,number_format($monto,2),0,0,'R');
      $pdf->Cell(25,6,number_format($impto,2),0,0,'R');
      $pdf->Cell(25,6,number_format($total,2),0,1,'R');
      $pdf->Ln(3);

      $pdf->Cell(195,5,'PAGOS DEL DIA '.$fechaBus,0,1,'C');
      $pdf->Cell(10,6,'Hab.',0,0,'C');
      $pdf->Cell(50,6,'Huesped',0,0,'C');
      $pdf->Cell(40,6,'Descripcion ',0,0,'C');
      $pdf->Cell(25,6,'Valor',0,0,'C');
      $pdf->Cell(10,6,'Hora',0,1,'C');
      $pdf->SetFont('Arial','',9);
      $cargos = $hotel->getHistoricoCargosdelDiaporcajero($fechaBus,$usuario['id_usuario'],3,0); 

      $pagos  = 0 ;
      foreach ($cargos as $cargo) {
        $pdf->Cell(10,6,$cargo['habitacion_cargo'],0,0,'L');
        $pdf->Cell(50,6,substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,24),0,0,'L');
        $pdf->Cell(40,6,substr($cargo['descripcion_cargo'],0,19),0,0,'L');
        $pdf->Cell(25,6,number_format($cargo['pagos_cargos'],2),0,0,'R');
        $pdf->Cell(10,6,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
        $pagos  = $pagos + $cargo['pagos_cargos'];
      }
      $pdf->SetFont('Arial','B',9);
      $pdf->Cell(100,6,'Total Pagos Por Cajero ',0,0,'L');
      $pdf->Cell(25,6,number_format($pagos,2),0,1,'R');
      $pdf->Ln(5);

      $pdf->Cell(195,5,'PAGOS ANULADOS DEL DIA '.$fechaBus,0,1,'C');
      $pdf->Cell(10,6,'Hab.',0,0,'C');
      $pdf->Cell(50,6,'Huesped',0,0,'C');
      $pdf->Cell(40,6,'Descripcion ',0,0,'C');
      $pdf->Cell(25,6,'Valor',0,0,'C');
      $pdf->Cell(50,6,'Motivo Anulacion',0,1,'C');
      $pdf->SetFont('Arial','',9);
      $cargos = $hotel->getHistoricoCargosAnuladosdelDiaporcajero($fechaBus,$usuario['id_usuario'],3,1); 
      $pagosanu  = 0 ;
      $impto  = 0 ;
      $total  = 0 ;
      foreach ($cargos as $cargo) {
        $pdf->Cell(10,6,$cargo['habitacion_cargo'],0,0,'L');
        $pdf->Cell(50,6,substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,24),0,0,'L');
        $pdf->Cell(40,6,substr($cargo['descripcion_cargo'],0,19),0,0,'L');
        $pdf->Cell(25,6,number_format($cargo['pagos_cargos'],2),0,0,'R');
        $pdf->Cell(50,6,$cargo['motivo_anulacion'],0,1,'L');
        $pagosanu  = $pagosanu + $cargo['pagos_cargos'];
      }
      $pdf->SetFont('Arial','B',9);
      $pdf->Cell(100,6,'Total Pagos Anulados Cajero ',0,0,'L');
      $pdf->Cell(25,6,number_format($pagosanu,2),0,1,'R');
      $pdf->Ln(3);
    }
  }
  $file = '../../imprimir/cajeros/Balance_Cajeros_'.$fechaBus.'.pdf';
  $pdf->Output($file,'F'); 

  echo $file;
?>

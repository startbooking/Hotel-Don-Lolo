<?php 
  // require 'plantillaAuditoria.php';

  $pdf = new PDF();
  $pdf->AddPage('P', 'letter');
  $pdf->SetFont('Arial', 'B', 11);
  $pdf->Cell(195, 5, 'FLUJO DE CAJA', 0, 1, 'C');
  $pdf->SetFont('Arial', '', 9);
  $pdf->Cell(195, 5, 'Fecha : '.FECHA_PMS, 0, 1, 'C');
  $pdf->Ln(2);
  
  

  $codigos = $hotel->cargosDelDia(FECHA_PMS,3,0); 

  $mon   = 0;
  $monto = 0 ;

  /* if(count($codigos)==0){
      $pdf->Cell(195,6,'SIN PAGOS RECIBIDOS EN EL DIA ',0,1,'C');
  }else{
    foreach ($codigos as $codigo) {
      $pdf->SetFont('Arial','B',9);
      $pdf->Cell(30,6,'Descripcion ',0,0,'L');
      $pdf->Cell(50,6,utf8_decode($codigo['descripcion_cargo']),0,1,'L');
      $cargos = $hotel->getCargosdelDiaporCodigo(FECHA_PMS,$codigo['id_codigo_cargo'],0);
      $pdf->Cell(15,6,'Hab.',0,0,'R');
      $pdf->Cell(70,6,'Huesped',0,0,'C');
      $pdf->Cell(25,6,'Monto Pago. ',0,0,'C');
      $pdf->Cell(15,6,'Fac.',0,0,'R');
      $pdf->Cell(15,6,'Abo.',0,0,'R');
      $pdf->Cell(30,6,'Usuario.',0,0,'R');
      $pdf->Cell(10,6,'Hora',0,1,'R');
      $pdf->SetFont('Arial','',9);
      $monto  = 0 ;
      $impto  = 0 ;
      $total  = 0 ;

      foreach ($cargos as $cargo) {
        $pdf->Cell(15,6,$cargo['habitacion_cargo'],0,0,'R');
        $pdf->Cell(70,6,substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']),0,24),0,0,'L');
        $pdf->Cell(25,6,number_format($cargo['pagos_cargos'],2),0,0,'R');
        $pdf->Cell(15,6,$cargo['factura_numero'],0,0,'R');
        if($cargo['concecutivo_abono']==0){
          $pdf->Cell(15,6,$cargo['concecutivo_deposito'],0,0,'R');
        }else{
          $pdf->Cell(15,6,$cargo['concecutivo_abono'],0,0,'R');
        }
        $pdf->Cell(30,6,$cargo['usuario'],0,0,'R'); 
        $pdf->Cell(10,6,substr($cargo['fecha_sistema_cargo'],11,5),0,1,'R'); 
        $monto  = $monto + $cargo['pagos_cargos'];
      }
      $mon  = $mon + $monto;

      $pdf->Ln(2);
      $pdf->SetFont('Arial','B',9);
      $pdf->Cell(40,6,'Total Pagos Descripcion',0,0,'L');
      $pdf->Cell(60,6,utf8_decode($cargo['descripcion_cargo']),0,0,'L');
      $pdf->Cell(25,6,number_format($monto,2),0,1,'R');
      $pdf->Ln(3);
    }
    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(100,6,'Total Pagos Del Dia',0,0,'L');
    $pdf->Cell(25,6,number_format($mon,2),0,1,'R');
    $pdf->Ln(3);
  } */

  $pdf->SetFont('Arial', '', 8);
  $codigos = $hotel->cargosDelDia(FECHA_PMS, 3, 0);
  
  $pag = 0;
  $monto = 0;
  
  $pdf->Cell(20, 5, 'Numero', 0, 0, 'R');
  $pdf->Cell(20, 5, 'Hab.', 0, 0, 'R');
  $pdf->Cell(70, 5, 'Huesped', 0, 0, 'C');
  $pdf->Cell(10, 5, 'Cant. ', 0, 0, 'C');
  $pdf->Cell(25, 5, 'Pago', 0, 0, 'C');
  $pdf->Cell(30, 5, 'Usuario', 0, 0, 'C');
  $pdf->Cell(10, 5, 'Hora', 0, 1, 'C');
  
  foreach ($codigos as $codigo) {
      $pdf->Cell(40, 5, 'Forma de Pago ', 0, 0, 'L');
      $pdf->SetFont('Arial', 'B', 8);
      $pdf->Cell(50, 5, utf8_decode($codigo['descripcion_cargo']), 0, 1, 'L');
      $pdf->SetFont('Arial', '', 8);
      $cargos = $hotel->getCargosdelDiaporCodigo(FECHA_PMS, $codigo['id_codigo_cargo'], 0);
      $pdf->SetFont('Arial', '', 8);
      $pagos = 0;
  
      foreach ($cargos as $cargo) {
          if ($cargo['factura_numero'] == 0) {
              $numDoc = $cargo['concecutivo_abono'];
          } else {
              $numDoc = $cargo['factura_numero'];
          }
          $pdf->Cell(20, 4, $numDoc, 0, 0, 'R');
          $pdf->Cell(20, 4, $cargo['habitacion_cargo'], 0, 0, 'R');
          $pdf->Cell(70, 4, substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']), 0, 24), 0, 0, 'L');
          $pdf->Cell(10, 4, $cargo['cantidad_cargo'], 0, 0, 'C');
          $pdf->Cell(25, 4, number_format($cargo['pagos_cargos'], 2), 0, 0, 'R');
          $pdf->Cell(30, 4, $cargo['usuario'], 0, 0, 'R');
          $pdf->Cell(10, 4, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
          $pagos = $pagos + $cargo['pagos_cargos'];
      }
      $pag = $pag + $pagos;
  
      // $pdf->Ln(2);
      $pdf->SetFont('Arial', '', 8);
      // $pdf->Cell(40, 4, 'Total Forma de Pago', 0, 0, 'L');
      $pdf->Cell(120, 4, utf8_decode($cargo['descripcion_cargo']), 0, 0, 'L');
      $pdf->Cell(25, 4, number_format($pagos, 2), 0, 1, 'R');
      // $pdf->Ln(3);
  }
  $pdf->Ln(2);
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(120, 4, 'Total Pagos Del Dia', 0, 0, 'L');
  $pdf->Cell(25, 4, number_format($pag, 2), 0, 0, 'R');
  $pdf->Ln(3);



  $file = '../../imprimir/auditorias/flujodeCaja_'.FECHA_PMS.'.pdf';
  $pdf->Output($file,'F');
?>

<?php 
  // require 'plantillaAuditoria.php';

  $pdf = new PDF();
  $pdf->AddPage('P', 'letter');
  $pdf->SetFont('Arial', 'B', 11);
  $pdf->Cell(195, 5, 'FLUJO DE CAJA', 0, 1, 'C');
  $pdf->SetFont('Arial', '', 9);
  $pdf->Cell(195, 5, 'Fecha : '.FECHA_PMS, 0, 1, 'C');
  $pdf->Ln(2);
  
  $mon   = 0;
  $monto = 0 ;

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
      $pdf->Cell(50, 5, ($codigo['descripcion_cargo']), 0, 1, 'L');
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
          $pdf->Cell(70, 4, substr(($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']), 0, 24), 0, 0, 'L');
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
      $pdf->Cell(120, 4, ($cargo['descripcion_cargo']), 0, 0, 'L');
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

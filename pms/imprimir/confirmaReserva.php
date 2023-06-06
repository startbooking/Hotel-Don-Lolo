<?php

  setlocale(LC_ALL, 'es_CO.utf8', 'es_CO', 'esp');
  date_default_timezone_set('America/Bogota');

  require_once '../../res/php/titles.php';
  require_once '../../res/php/app_topHotel.php';
  require_once '../../../res/fpdf/fpdf.php';

  $reserva = $_POST['reserva'];
  $usuario = $_POST['usuario'];

  $datosReserva = $hotel->getReservasDatos($reserva);
  $datosHuesped = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);
  $datosCompania = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);

  /* $nombres = $datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2'];
  $llega = fechaReserva($datosReserva[0]['fecha_llegada']);
  $sale = fechaReserva($datosReserva[0]['fecha_salida']);
  $huesped = $datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2'];
  $iden = $datosHuesped[0]['identificacion']; */

  // $regisCia = count($datosCompania);
  // $fecha = $hotel->getDatePms();

  $pdf = new FPDF();
  $pdf->AddPage('P', 'letter');
  $pdf->Rect(10, 52, 190, 80);
  $pdf->Image('../../../img/'.LOGO, xPOS, yPOS, tPOS);
  $pdf->SetFont('Arial', 'B', 13);
  $pdf->Cell(190, 7, utf8_decode(NAME_EMPRESA), 0, 1, 'C');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(190, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
  $pdf->Cell(190, 5, REGIMEN, 0, 1, 'C');
  $pdf->Cell(190, 5, utf8_decode(ADRESS_EMPRESA), 0, 1, 'C');
  $pdf->Cell(190, 5, utf8_decode(CIUDAD_EMPRESA).' '.PAIS_EMPRESA, 0, 1, 'C');
  $pdf->Cell(40, 5, '', 0, 0, 'C');
  $pdf->Cell(110, 5, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 1, 'C');
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(190, 5, NAME_HOTEL, 0, 1, 'C');
  $pdf->Ln(1);

  /* $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(20, 6, 'Reserva ', 0, 0, 'C');
  $pdf->Cell(30, 6, 'Fecha Llegada', 0, 0, 'L');
  $pdf->Cell(30, 6, 'Fecha Salida', 0, 0, 'L');
  $pdf->Cell(70, 6, 'Huesped', 0, 0, 'L');
  $pdf->Cell(5, 6, 'H', 0, 0, 'L');
  $pdf->Cell(5, 6, 'M', 0, 0, 'L');
  $pdf->Cell(5, 6, 'N', 0, 0, 'L');
  $pdf->Cell(25, 6, 'Tarifa', 0, 1, 'C');
  $pdf->SetFont('Arial', '', 9);
  if ($regis == 0) {
      $pdf->Cell(190, 6, 'SIN NO SHOWS PARA ESTE DIA', 0, 0, 'C');
  } else {
      foreach ($reservas as $reserva) {
          $pdf->Cell(20, 6, $reserva['num_reserva'], 0, 0, 'C');
          $pdf->Cell(30, 6, $reserva['fecha_llegada'], 0, 0, 'L');
          $pdf->Cell(30, 6, $reserva['fecha_salida'], 0, 0, 'L');
          $pdf->Cell(70, 6, $reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2'], 0, 0, 'L');
          $pdf->Cell(5, 6, $reserva['can_hombres'], 0, 0, 'C');
          $pdf->Cell(5, 6, $reserva['can_mujeres'], 0, 0, 'C');
          $pdf->Cell(5, 6, $reserva['can_ninos'], 0, 0, 'C');
          $pdf->Cell(25, 6, number_format($reserva['valor_diario'], 2), 0, 1, 'R');
      }
  }

  $file = '../../imprimir/auditorias/NoShows_'.FECHA_PMS.'.pdf';
  $pdf->Output($file, 'F');
  */

  $pdfFile = $pdf->Output('', 'S');
  $base64Factura = chunk_split(base64_encode($pdfFile));

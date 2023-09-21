<?php

  setlocale(LC_ALL, 'es_CO.utf8', 'es_CO', 'esp');
  date_default_timezone_set('America/Bogota');

  require_once '../../res/php/app_topHotel.php';  
  require_once '../../res/fpdf/fpdf.php';

  $reserva = $_POST['reserva'];
  $usuario = $_POST['usuario'];

  $datosReserva = $hotel->getReservasDatos($reserva);
 
  $datosHuesped = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);
  $datosCompania = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);
  
if($datosReserva[0]['id_compania']== 0){
  $nomEmpresa = '';
}else{
  $nomEmpresa = $datosCompania[0]['empresa'];
}

  $pdf = new FPDF();
  $pdf->AddPage('P', 'letter');
  $pdf->Rect(10, 35, 190, 230);
  $pdf->Image('../../img/'.LOGO, 10, 5, 30);

  $pdf->SetFont('Arial', 'B', 13);
  $pdf->Cell(190, 5, utf8_decode(NAME_EMPRESA), 0, 1, 'C');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(190, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
  $pdf->Cell(190, 4, utf8_decode(ADRESS_EMPRESA), 0, 1, 'C');
  $pdf->Cell(190, 4, utf8_decode(CIUDAD_EMPRESA).' '.PAIS_EMPRESA, 0, 1, 'C');
  $pdf->Cell(40, 4, '', 0, 0, 'C');
  $pdf->Cell(110, 4, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 1, 'C');
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(190, 4, 'RESERVA DE HABITACIONES', 0, 1, 'C');
  $pdf->Ln(2);

  $pdf->SetFont('Arial', 'B', 9);
  $pdf->Cell(40, 4, NAME_HOTEL, 0, 1, 'l');
  $pdf->SetFont('Arial', '', 9);
  $pdf->Cell(45, 4, 'Registro Nacional de Turismo', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 9);
  $pdf->Cell(20, 4, RNT, 0, 1, 'L');
  $pdf->SetFont('Arial', '', 9);
  $pdf->Cell(30, 4, 'Reserva Nro: ', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 9);
  $pdf->Cell(15, 4, str_pad($datosReserva[0]['num_reserva'], 5, '0', STR_PAD_LEFT), 0, 1, 'L');
  $pdf->SetFont('Arial', '', 9);
  $pdf->Cell(30, 4, 'Fecha de Creacion ', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 9);
  $pdf->Cell(35, 4, $datosReserva[0]['reservaCreada'], 0, 1, 'L');
  $pdf->SetFont('Arial', '', 9);
  $pdf->Cell(30, 4, 'Fecha Llegada ', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 9);
  $pdf->Cell(25, 4, $datosReserva[0]['fecha_llegada'], 0, 0, 'L');
  $pdf->SetFont('Arial', '', 9);
  $pdf->Cell(30, 4, 'Fecha Salida ', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 9);
  $pdf->Cell(25, 4, $datosReserva[0]['fecha_salida'], 0, 1, 'L');
  $pdf->Ln(2);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(30, 4, 'Informacion de la Reserva ', 0, 1, 'L');  
  $pdf->Ln(1);
  $pdf->SetFont('Arial', '', 10);
  $pdf->MultiCell(190, 5, 'Habitacion '. $datosReserva[0]['num_habitacion'].' Tarifa '.number_format($datosReserva[0]['valor_diario'],2).' Huesped '.$datosReserva[0]['nombre_completo'].' Empresa '.$nomEmpresa.' Identificacion '. $datosReserva[0]['identificacion'].' Telefono '. $datosReserva[0]['telefono'].' Fecha de Nacimiento '. $datosReserva[0]['fecha_nacimiento'].' Celular '. $datosReserva[0]['celular'].' Correo '. $datosReserva[0]['email'] , 0, 'J');

  $pdf->Ln(5);

  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(30, 4, 'Informacion Empresa ', 0, 1, 'L');  
  $pdf->Ln(2);
  if($datosReserva[0]['id_compania']!=0){
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 5, 'Empresa ', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(160, 5, $datosCompania[0]['empresa'], 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 5, 'Direccion ', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(160, 5, $datosCompania[0]['direccion'], 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 5, 'Telefono ', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 5, $datosCompania[0]['telefono'], 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 5, 'Celular ', 0, 0, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 5, $datosCompania[0]['celular'], 0, 1, 'L');
  }
  
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Ln(2);
  $pdf->Cell(30, 4, 'Observaciones de la Reserva ', 0, 1, 'L');  
  $pdf->Ln(2);
  $pdf->SetFont('Arial', '', 10);
  $pdf->MultiCell(190, 5, $datosReserva[0]['observaciones'] , 0, 'J');
  
  $pdf->SetY(180);
  $pdf->Cell(40, 5, 'Reserva Creada Por ', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(60, 5, $hotel->traeNombreUsuario($datosReserva[0]['id_usuario_ingreso']), 0, 0, 'L');
  $pdf->SetFont('Arial', '', 9);
  $pdf->Cell(90, 5, 'Firma ', 0, 1, 'C');
  $pdf->Ln(10);
  $pdf->Cell(190, 4, 'Tasas 19% Alojamiento, 8% AyB, 19% Otros Serivicios ', 0, 1, 'L');
  $pdf->Cell(190, 4, 'Seguro Hotelero, 4.000.oo por Persona ', 0, 1, 'L');
  $pdf->Cell(190, 4, 'Politica de garantia, todas las reservas deben de estar garantizadas con pago pot los diferentes medios : ', 0, 1, 'L');
  $pdf->Cell(190, 4, '- Pago con Tarjeta de Credito, Visa, Master Card, American Express y Diners Club ', 0, 1, 'L');
  $pdf->Cell(190, 4, '- Con Tarjeta Debito por medio de PSE por la pagina web', 0, 1, 'L');
  $pdf->MultiCell(190, 4, '- Via BALOTOy EFECTY - SERVIENTREGA o Consignacion Bancaria a la Cuenta Corriente Nro 700-04603-0 Banco de Occidente a nombre de Hotel Don Lolo Ltda, o enviar scanner de Tarjeta de Credito con coopua de documento y carta de autorizacion donde especifique el valor a debita. Favor enviar al correo electronico reservas@donlolohotel.com la informacion del pago. ' , 0, 'J');
  $pdf->MultiCell(190, 4, utf8_decode('Condiciones, no se genera recargo por alojamiento de infantes de  0 - 1 año, se efectuara un recargo para infantes en edades de 1 - 7 años y deberan compartir la estancia en la habitacion de los adultos responsables, aplica a partir de acomodacion doble con una restriccion de maximo 2 infantes, de 7 años en adelante se considera como adulto') , 0, 'J');
  $pdf->MultiCell(190, 4, utf8_decode('Todos los Huespedes (Adultos o menores de edad) deberan presentar su documento de identificacion en el Check-In sin excepcion') , 0, 'J');
  $pdf->MultiCell(190, 4, 'Peticiones especiales sujetas a disponibilidad en el momento de Check-In' , 0, 'J');

  $file = 'reservas/ConfirmacionReserva_'.$reserva.'.pdf';
  echo $file;

  $pdf->Output($file, 'F');

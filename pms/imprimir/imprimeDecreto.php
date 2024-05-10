<?php

$conce = $hotel->traeConsecutivoDecreto();
$incr = $conce + 1;
$incremento = $hotel->actualizaDecreto($incr);

// / $reserva    = $_SESSION['reserva'];

$pdf->AddPage('P', 'letter');
$pdf->Rect(10, 10, 60, 17);
$pdf->Rect(10, 10, 195, 25);
$pdf->Rect(10, 27, 195, 8);
$pdf->Image('../../../img/'.LOGO, 20, 10, 20);
$pdf->SetFont('Arial', 'B', 14);

$pdf->Cell(60, 5, '', 0, 0, 'C');
$pdf->MultiCell(130, 8, utf8_decode('Solicitud de exención de IVA a Turistas Extranjeros o
  visitantes extranjeros no residentes en Colombia'), 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(3);
$pdf->Cell(190, 5, 'Request for exemption from IVA for Foreign Tourists or foreign visitors not residing in Colombia ', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(3);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(50, 5, 'Turista Extranjero', 0, 0, 'C');
$pdf->Cell(50, 5, 'Visitante Extranjero', 0, 0, 'C');
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(20, 5, 'Reserva Nro '.$reserva, 0, 1, 'L');
$pdf->Ln(2);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(50, 5, 'Foreign Tourist', 0, 0, 'C');
$pdf->Cell(50, 5, 'Foreign visitor', 0, 1, 'C');
$pdf->Ln(2);
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(50, 5, '', 1, 0, 'C');
$pdf->Cell(50, 5, '', 1, 0, 'C');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(20, 5, 'Factura Nro ', 0, 1, 'L');
$pdf->Cell(30, 5, '', 0, 1, 'C');
$pdf->Ln(2);
$pdf->Rect(45, 63, 35, 27);
$pdf->Rect(80, 63, 60, 27);
$pdf->Rect(10, 63, 195, 27);
$pdf->Cell(35, 8, 'Tipo Documento', 0, 0, 'C');
$pdf->Cell(35, 8, 'Numero Documento', 0, 0, 'C');
$pdf->Cell(60, 8, 'Apellidos', 0, 0, 'C');
$pdf->Cell(65, 8, 'Nombres', 0, 1, 'C');
$pdf->Cell(35, 8, 'Document Type', 0, 0, 'C');
$pdf->Cell(35, 8, 'Identification Number', 0, 0, 'C');
$pdf->Cell(60, 8, 'Last Name', 0, 0, 'C');
$pdf->Cell(65, 8, 'Name', 0, 1, 'C');
$pdf->Ln(1);
$pdf->Cell(35, 10, '', 1, 0, 'C');
$pdf->Cell(35, 10, '', 1, 0, 'C');
$pdf->Cell(60, 10, '', 1, 0, 'C');
$pdf->Cell(65, 10, '', 1, 1, 'C');
$pdf->Ln(2);

$pdf->MultiCell(195, 5, utf8_decode('En mi calidad de extranjero o residente en el exterior solicito se me exonere del pago de IVA, como beneficiario principal de los servicios prestados por HOTEL DON LOLO LTDA, según lo establecido en el decreto 297 de febrero de 2016, condición que acredito presentando mi pasaporte original __; la tarjeta Andina o la tarjeta de Mercosur__ por medio del cual se comprueba mi estatus migratorio con el sello vigente de Permiso de Ingreso y Permanencia PIP-3__, o PIP-5__, o PIP-6__, o PIP-10__; o la Visa Temporal vigente TP-7__, o TP-11__, o TP-12__; con el animo de desarrollar ____________ y NO tengo el ánimo de establecerme en Colombia; Acepto que se tome el registro digital de mi documento de identificación para archivo, únicamente como soporte de acreditación de mi estatus migratorio. 
  
      Autorizo a la DIAN a consultar mis registros migratorios; en cumplimiento de lo establecido en el literal a) del artículo 7 del decreto 1903 de 2014.'), 1, 'L');

$pdf->MultiCell(195, 5, utf8_decode('In my capacity as a foreigner or resident abroad I request to be exempted from the payment of IVA, as the main beneficiary of the services provided by HOTEL DON LOLO LTDA, as established in Decree 297 of February 2016, condition that I accredit presenting my original passport __; the Andean card or the Mercosur__ card by means of which my migratory status is verified with the current PIP-3__, or PIP-5__, or PIP-6__, or PIP-10__, or the current Temporary Visa TP-7__, or TP-11__, or TP-12__; with the intention of developing ____________ and I do not have the intention of establishing myself in Colombia.

    I agree to have my identification document digitally recorded for archiving purposes only asupport for the accreditation of my immigration status. I authorize DIAN to consult my migratory records; in compliance with the provisions of literal a) of Article 7 of Decree 1903 of 2014.'), 1, 'L');

$pdf->ln(30);

$pdf->line(20, 219, 60, 219);
$pdf->line(75, 219, 135, 219);
$pdf->line(145, 219, 195, 219);
$pdf->Cell(60, 5, 'Recepcionista', 0, 0, 'C');
$pdf->Cell(70, 5, 'Huesped / Guest ', 0, 0, 'C');
$pdf->Cell(60, 5, 'VoBo Hotel', 0, 1, 'C');
$pdf->setXY(10, 230);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(60, 5, utf8_decode('Certifico que valide la información aquí suscrita / I certifico that I validate the information I have subscribed to here.'), 0, 'C');
$pdf->setXY(70, 230);
$pdf->MultiCell(70, 5, utf8_decode('Certifico que entiendo, acepto y cumplo con los requisitos contenidos en el decreto 297 de 2016 / I certify that I understand, accept and comply with the requirements contained in Decree 297 of 2016. '), 0, 'C');
$pdf->setXY(140, 230);
$pdf->MultiCell(60, 5, utf8_decode('Certifico que valide el proceso interno establecido por HOTEL DON LOLO LTDA / I certify that it validates the internal process established by HOTEL DON LOLO LTDA.'), 0, 'C');

// $file = '../../imprimir/registros/decreto_Reserva_'.$reserva.'.pdf';
// $pdf->Output($file);

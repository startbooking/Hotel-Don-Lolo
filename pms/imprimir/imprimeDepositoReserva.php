<?php 
  require '../../../res/fpdf/fpdf.php';
  
  $deposito     = $hotel->getInformacionDeposito($numero);
  $datosReserva = $hotel->getReservasDatos($deposito[0]['id_reserva']);
  $datosHuesped = $hotel->getbuscaDatosHuesped($deposito[0]['id_huesped']);

  $fecha      = $hotel->getDatePms();

  $pdf = new FPDF();
  $pdf->AddPage('P','letter'); 
  $pdf->Rect(10, 52, 190, 80);
  $pdf->Image('../../../img/'.LOGO,xPOS,yPOS,tPOS);
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(190,7,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  $pdf->Cell(190,5,REGIMEN,0,1,'C');
  $pdf->Cell(190,5,utf8_decode(ADRESS_EMPRESA),0,1,'C');
  $pdf->Cell(190,5,utf8_decode(CIUDAD_EMPRESA).' '.PAIS_EMPRESA,0,1,'C');
  $pdf->Cell(40,5,'',0,0,'C');
  $pdf->Cell(110,5,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,5,NAME_HOTEL,0,1,'C');
  $pdf->Cell(190,6,'DEPOSITO A RESERVA ',0,1,'C');  
  $pdf->Ln(1);
  $pdf->Cell(30,5,'Deposito Nro ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(15,5,str_pad($numero,5,'0',STR_PAD_LEFT),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(20,5,'Fecha ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(30,5,FECHA_PMS,0,1,'L');
  $pdf->Ln(1);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,5,'HUESPED',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(80,5,substr(utf8_decode($datosHuesped[0]["apellido1"].' '.$datosHuesped[0]["apellido2"].' '.$datosHuesped[0]["nombre1"].' '.$datosHuesped[0]["nombre2"]),0,35),0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(35,5,'IDENTIFICACION',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,5,$datosHuesped[0]['identificacion'],0,1,'L');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,5,'HABITACION',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(8,5,$datosReserva[0]["num_habitacion"],0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(32,5,'FECHA LLEGADA',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(20,5,$datosReserva[0]["fecha_llegada"],0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(32,5,'FECHA SALIDA',0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(20,5,$datosReserva[0]["fecha_salida"],0,1,'L');
  $pdf->Ln(1);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(100,5,'DETALLE',1,0,'C');
  $pdf->Cell(90,5,'VALOR',1,1,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(100,5,utf8_decode($deposito[0]['descripcion_cargo']),0,0,'L');
  $pdf->Cell(90,5,number_format($deposito[0]['pagos_cargos'],2),0,1,'R');

  $pdf->Sety(100);  
  $pdf->Cell(190,5,'SON :'. numtoletras($deposito[0]['pagos_cargos']),1,1,'L');
  $pdf->MultiCell(100,5,utf8_decode($deposito[0]['informacion_cargo']),0,'C');
  $pdf->Cell(100,5,'Observaciones',0,0,'C');
  $pdf->setXY(100, 105);
  $pdf->Cell(92,5,'Firma',0,1,'C');
  $pdf->Ln(12);
  $pdf->Rect(10, 105, 100, 22);

  $pdf->Cell(50,5,'',0,0,'C');
  $pdf->Cell(50,5,'',0,0,'C');
  $pdf->Cell(45,5,'Nombre',0,0,'C');
  $pdf->Cell(45,5,'Identificacion',0,1,'C');
  $pdf->Cell(100,5,'',1,0,'C');
  $pdf->Cell(90,5,'CAJERO '.$usuario,1,1,'C');

  $file = '../../imprimir/notas/Deposito_'.$numero.'.pdf';

  $pdf->Output($file,'F');

  echo 'Deposito_'.$numero.'.pdf' ;
<?php 


require_once '../../../res/fpdf/fpdf.php';

  $datosReserva      = $hotel->getReservasDatos($reserva);
  $datosHuesped      = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);
  $datosAcompanantes = $hotel->getBuscarAcompanantesReserva($reserva);   
  $datosCompania     = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);
  $textoContrato     = $hotel->getContratoHotelero();
  
  $regisCia          = count($datosCompania) ;
  $fecha             = $hotel->getDatePms();

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Rect(10, 36, 190, 230);
  $pdf->Image('../../../img/'.LOGO,xPOS,10,tPOS);
  $pdf->SetFont('Arial','B',8);
  $pdf->Cell(190,5,NAME_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(190,3,'Nit: '.NIT_EMPRESA,0,1,'C');
  $pdf->Cell(190,3,utf8_decode(ADRESS_EMPRESA.' '.CIUDAD_EMPRESA.' '.PAIS_EMPRESA),0,1,'C');
  $pdf->Cell(190,3,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(190,4,NAME_HOTEL,0,0,'C'); 
  $pdf->Ln(4);

  $pdf->SetFont('Arial','B',6);
  $pdf->Cell(190,4,'REGISTRO HOTELERO ',0,1,'R');
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(180,3,'Numero ',0,0,'R');
  $pdf->SetFont('Arial','B',6);
  $pdf->Cell(10,3,str_pad($datosReserva[0]["num_registro"],5,'0',STR_PAD_LEFT),0,1,'C');

  $pdf->Ln(1);
  $pdf->Cell(100,6,'NOMBRE / NAME',1,0,'C');
  $pdf->Cell(30,6,'NACIONALIDAD',1,0,'C');
  $pdf->Cell(20,6,'IDENTIFICACION',1,0,'C');
  $pdf->Cell(40,6,'EXPEDICION',1,1,'C');
  $pdf->SetFont('Arial','',8);
  $pdf->Cell(100,5,utf8_decode($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']),1,0,'L');
  $pdf->Cell(30,5,utf8_decode($hotel->getLandGUest($datosHuesped[0]['pais_expedicion'])),1,0,'L');
  $pdf->Cell(20,5,$datosHuesped[0]['identificacion'],1,0,'R');
  $pdf->Cell(40,5,utf8_decode(substr($hotel->getCityExp($datosHuesped[0]['ciudad_expedicion']),0,21)),1,1,'L');

  foreach ($datosAcompanantes as $acompanante) {
    $pdf->Cell(100,5,utf8_decode($acompanante['apellido1'].' '.$acompanante['apellido2'].' '.$acompanante['nombre1'].' '.$acompanante['nombre2']),1,0,'L');

    $pdf->Cell(30,5,utf8_decode($hotel->getLandGUest($acompanante['pais_expedicion'])),1,0,'L');
    $pdf->Cell(20,5,$acompanante['identificacion'],1,0,'R');

    $pdf->Cell(40,5,utf8_decode(substr($hotel->getCityExp($acompanante['ciudad_expedicion']),0,21)),1,1,'L');    
  }

  $pdf->setY(79);
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(15,6,'Direccion',1,0,'L');
  $pdf->Cell(55,6,substr($datosHuesped[0]['direccion'],0,45),1,0,'L');
  $pdf->Cell(10,6,'Telefono',1,0,'L');
  $pdf->Cell(20,6,$datosHuesped[0]['telefono'],1,0,'L');
  $pdf->Cell(12,6,'Fecha Nac',1,0,'l');
  $pdf->Cell(18,6,$datosHuesped[0]['fecha_nacimiento'],1,0,'L');
  $pdf->Cell(10,6,'Ciudad',1,0,'L');
  $pdf->Cell(20,6,substr(utf8_decode($hotel->getCityExp($datosHuesped[0]['ciudad'])),0,13),1,0,'L');
  $pdf->Cell(10,6,'Pais',1,0,'L');
  $pdf->Cell(20,6,$hotel->getLandGUest($datosHuesped[0]['pais']),1,1,'L');
  $pdf->SetFont('Arial','',6);
  $pdf->Ln(1);

  $pdf->Cell(15,6,'Empresa',1,0,'L');
  if($regisCia==0){
    $pdf->Cell(85,6,'',1,0,'L');
  }else{    
    $pdf->Cell(85,6,$datosCompania[0]['empresa'],1,0,'L');
  }
  $pdf->Cell(10,6,'Nit',1,0,'L');
  if($regisCia==0){
    $pdf->Cell(20,6,'',1,0,'L');
  }else{
    $pdf->Cell(20,6,$datosCompania[0]['nit'].'-'.$datosCompania[0]['dv'],1,0,'L');
  }
  $pdf->Cell(10,6,'Celular',1,0,'l');
  if($regisCia==0){
    $pdf->Cell(20,6,'',1,0,'L');
  }else{
    $pdf->Cell(20,6,$datosCompania[0]['celular'],1,0,'L');    
  }
  $pdf->Cell(10,6,'Telefono',1,0,'L');
  if($regisCia==0){
    $pdf->Cell(20,6,'',1,1,'L');
  }else{
    $pdf->Cell(20,6,$datosCompania[0]['telefono'],1,1,'L');    
  }

  $pdf->Ln(1);

  $pdf->Cell(20,6,'Motivo Viaje',1,0,'L');
  $pdf->Cell(30,6,$hotel->motivoViaje($datosReserva[0]['motivo_viaje']),1,0,'L');
  $pdf->Cell(20,6,'Procedencia',1,0,'L');
  $pdf->Cell(30,6,substr(utf8_decode($hotel->getCityExp($datosReserva[0]['origen_reserva'])),0,20),1,0,'L');
  $pdf->Cell(20,6,'Destino',1,0,'l');
  $pdf->Cell(30,6,substr(utf8_decode($hotel->getCityExp($datosReserva[0]['destino_reserva'])),0,20),1,0,'L');
  $pdf->Cell(10,6,'Email',1,0,'L');
  $pdf->Cell(30,6,$datosHuesped[0]['email'],1,1,'L');

  $pdf->Ln(1);

  $pdf->Cell(40,6,'Ocupacion',1,0,'L');
  $pdf->Cell(40,6,'Estadia',1,0,'L');
  $pdf->Cell(15,6,'Habitacion',1,0,'L');
  $pdf->Cell(10,6,$datosReserva[0]['num_habitacion'],1,0,'C');
  $pdf->Cell(45,6,'Equipaje',1,0,'L');
  $pdf->Cell(20,6,'Recepcionista',1,0,'L');
  $pdf->Cell(20,6,$usuario,1,1,'L');
  $pdf->Ln(1);
  $pdf->Cell(20,6,'Forma de Pago',1,0,'L');
  $pdf->Cell(50,6,$hotel->formaPago($datosReserva[0]['forma_pago']),1,0,'L');
  $pdf->Cell(15,6,'Reserva Nro ',1,0,'L');
  $pdf->SetFont('Arial','',8);
  $pdf->Cell(25,6,$reserva,1,0,'L');
  $pdf->SetFont('Arial','',6);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(80,6,'FIRMA',0,1,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(110,16,'Comentarios',1,0,'L');
  $pdf->MultiCell(80,16,'Acepto el Contrato de Hospedaje',0,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,10,'PARA USO DEL HOTEL',1,1,'C');
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(20,6,'TARIFA $',1,0,'L');
  $pdf->Cell(30,6,number_format($datosReserva[0]['valor_diario'],2),1,0,'C');
  $pdf->Cell(20,6,'LLEGADA',1,0,'L');
  $pdf->Cell(30,6,$datosReserva[0]['fecha_llegada'],1,0,'C');
  $pdf->Cell(20,6,'SALIDA',1,0,'L');
  $pdf->Cell(30,6,$datosReserva[0]['fecha_salida'],1,0,'C');
  $pdf->Cell(20,6,utf8_decode('Adultos / Niños'),1,0,'L');
  $pdf->Cell(20,6,$datosReserva[0]['can_hombres']+$datosReserva[0]['can_mujeres'].' / '.$datosReserva[0]['can_ninos'],1,1,'C');
  $pdf->SetFont('Arial','',5);
  $pdf->Ln(1);
  $pdf->MultiCell(190,3,utf8_decode($textoContrato),1,'L');


  $pdf->AddPage('P','letter');
  $pdf->Rect(10, 36, 190, 230);
  $pdf->Image('../../../img/'.LOGO,xPOS,10,tPOS);
  $pdf->SetFont('Arial','B',8);
  $pdf->Cell(190,5,NAME_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(190,3,'Nit: '.NIT_EMPRESA,0,1,'C');
  $pdf->Cell(190,3,utf8_decode(ADRESS_EMPRESA.' '.CIUDAD_EMPRESA.' '.PAIS_EMPRESA),0,1,'C');
  $pdf->Cell(190,3,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(190,4,NAME_HOTEL,0,0,'C'); 
  $pdf->Ln(5);

  $pdf->SetFont('Arial','B',6);
  $pdf->Cell(190,4,'REGISTRO HOTELERO ',0,1,'R');
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(180,3,'Numero ',0,0,'R');
  $pdf->SetFont('Arial','B',6);
  $pdf->Cell(10,3,str_pad($datosReserva[0]["num_registro"],5,'0',STR_PAD_LEFT),0,1,'C');


  $pdf->Cell(100,6,'NOMBRE / NAME',1,0,'C');
  $pdf->Cell(30,6,'NACIONALIDAD',1,0,'C');
  $pdf->Cell(20,6,'IDENTIFICACION',1,0,'C');
  $pdf->Cell(40,6,'EXPEDICION',1,1,'C');
  $pdf->SetFont('Arial','',8);
  $pdf->Cell(100,5,utf8_decode($datosHuesped[0]['nombre_completo']),1,0,'L');
  $pdf->Cell(30,5,utf8_decode($hotel->getLandGUest($datosHuesped[0]['pais_expedicion'])),1,0,'L');
  $pdf->Cell(20,5,$datosHuesped[0]['identificacion'],1,0,'R');
  $pdf->Cell(40,5,utf8_decode(substr($hotel->getCityExp($datosHuesped[0]['ciudad_expedicion']),0,21)),1,1,'L');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',8);
  $pdf->Cell(190,4,'CONTACTO EN CASO DE EMERGENCIA',0,1,'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(30,6,'Nombre',1,0,'C');
  $pdf->Cell(65,6,'',1,0,'L');
  $pdf->Cell(30,6,'Parentesco',1,0,'C');
  $pdf->Cell(65,6,'',1,1,'L');
  $pdf->Cell(30,6,'Telefono',1,0,'C');
  $pdf->Cell(65,6,'',1,0,'L');
  $pdf->Cell(30,6,'EPS',1,0,'C');
  $pdf->Cell(65,6,'',1,1,'L');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',8);
  $pdf->Cell(190,4,'Condiciones de morbilidad preexistentes',0,1,'C');
  $pdf->Ln(5);

  $pdf->Rect(10, 85, 190, 40);
  $pdf->setY(130);
  $pdf->SetFont('Arial','',8);
  $pdf->MultiCell(190,5,utf8_decode('Declaro que todas la información suministrada es verídica, adicional autorizo a '.NAME_HOTEL.' el manejo de datos de acuerdo a su política de datos personales. En caso de presentar Síntomas relacionados con el COVID-19 autorizo a ('.NAME_HOTEL.'), a realizar el reporte respectivo de acuerdo a los protocolos implementados.'));

  $pdf->Ln(2);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,22,'Comentarios',1,1,'L');
  $pdf->Ln(4);
  $pdf->Cell(190,6,'FIRMA',0,1,'C');
  $pdf->SetFont('Arial','',14);
  $pdf->Ln(4);
  $pdf->MultiCell(190,22,'Acepto el Tratamiento de mi Informacion',0,'C');
  $pdf->Ln(1);

  if($causar==2){
    include_once 'imprimeDecreto.php';
  }
  
  $file = '../../imprimir/registros/Registro_Hotelero_'.str_pad($datosReserva[0]["num_registro"],5,'0',STR_PAD_LEFT).'.pdf';
  $pdf->Output($file,'F');
?>

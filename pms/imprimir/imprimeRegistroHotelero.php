<?php 


require_once '../../../res/fpdf/fpdf.php';

  $datosReserva      = $hotel->getReservasDatos($reserva);
  $datosHuesped      = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);
  $datosAcompanantes = $hotel->getBuscarAcompanantesReserva($reserva);   
  $datosCompania     = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);
  $textoContrato     = $hotel->getContratoHotelero();
  
  $profesion         = $hotel->descripcionGrupo($datosHuesped[0]['profesion']);
  $regisCia          = count($datosCompania) ; 
  $fecha             = $hotel->getDatePms();

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Rect(10, 34, 190, 230);
  $pdf->Image('../../../img/'.LOGO,xPOS,10,tPOS);
  $pdf->SetFont('Arial','B',8);
  $pdf->Cell(190,5,NAME_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(190,3,'Nit: '.NIT_EMPRESA,0,1,'C');
  $pdf->Cell(190,3,(ADRESS_EMPRESA.' '.CIUDAD_EMPRESA.' '.PAIS_EMPRESA),0,1,'C');
  $pdf->Cell(190,3,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(190,4,NAME_HOTEL,0,0,'C'); 
  $pdf->Ln(2);

  $pdf->SetFont('Arial','B',6);
  $pdf->Cell(190,4,'REGISTRO HOTELERO ',0,1,'R');
  $pdf->SetFont('Arial','',5);
  $pdf->Cell(180,3,'Numero ',0,0,'R');
  $pdf->SetFont('Arial','B',5);
  $pdf->Cell(10,3,str_pad($datosReserva[0]["num_registro"],5,'0',STR_PAD_LEFT),0,1,'C');

  $pdf->Ln(1);
  $pdf->Cell(100,5,'NOMBRE / NAME',1,0,'C');
  $pdf->Cell(30,5,'NACIONALIDAD',1,0,'C');
  $pdf->Cell(20,5,'IDENTIFICACION',1,0,'C');
  $pdf->Cell(40,5,'EXPEDICION',1,1,'C');
  $pdf->SetFont('Arial','',8);
  $pdf->Cell(100,5,($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']),1,0,'L');
  $pdf->Cell(30,5,($hotel->getLandGuest($datosHuesped[0]['pais_expedicion'])),1,0,'L');
  $pdf->Cell(20,5,$datosHuesped[0]['identificacion'],1,0,'R');
  $pdf->Cell(40,5,(substr($hotel->getCityExp($datosHuesped[0]['ciudad_expedicion']),0,21)),1,1,'L');

  foreach ($datosAcompanantes as $acompanante) {
    $pdf->Cell(100,5,($acompanante['apellido1'].' '.$acompanante['apellido2'].' '.$acompanante['nombre1'].' '.$acompanante['nombre2']),1,0,'L');

    $pdf->Cell(30,5,($hotel->getLandGUest($acompanante['pais_expedicion'])),1,0,'L');
    $pdf->Cell(20,5,$acompanante['identificacion'],1,0,'R');

    $pdf->Cell(40,5,(substr($hotel->getCityExp($acompanante['ciudad_expedicion']),0,21)),1,1,'L');    
  }

  $pdf->setY(75);
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(15,5,'Direccion',1,0,'L');
  $pdf->Cell(50,5,substr($datosHuesped[0]['direccion'],0,35),1,0,'L');
  $pdf->Cell(12,5,'Telefono',1,0,'L');
  $pdf->Cell(20,5,$datosHuesped[0]['telefono'],1,0,'L');
  $pdf->Cell(15,5,'Fecha Nac',1,0,'l');
  $pdf->Cell(18,5,$datosHuesped[0]['fecha_nacimiento'],1,0,'L');
  $pdf->Cell(10,5,'Ciudad',1,0,'L');
  $pdf->Cell(20,5,substr(($hotel->getCityExp($datosHuesped[0]['ciudad'])),0,13),1,0,'L');
  $pdf->Cell(10,5,'Pais',1,0,'L');
  $pdf->Cell(20,5,$hotel->getLandGuest($datosHuesped[0]['pais']),1,1,'L');
  
  $pdf->Cell(15,5,'Empresa',1,0,'L');
  if($regisCia==0){
    $pdf->Cell(80,5,'',1,0,'L');
  }else{    
    $pdf->Cell(80,5,substr($datosCompania[0]['empresa'],0,52),1,0,'L');
  }
  $pdf->Cell(10,5,'Nit',1,0,'L');
  if($regisCia==0){
    $pdf->Cell(20,5,'',1,0,'L');
  }else{
    $pdf->Cell(20,5,$datosCompania[0]['nit'].'-'.$datosCompania[0]['dv'],1,0,'L');
  }
  $pdf->Cell(10,5,'Celular',1,0,'l');
  if($regisCia==0){
    $pdf->Cell(20,5,'',1,0,'L');
  }else{
    $pdf->Cell(20,5,$datosCompania[0]['celular'],1,0,'L');    
  }
  $pdf->Cell(15,5,'Telefono',1,0,'L');
  if($regisCia==0){
    $pdf->Cell(20,5,'',1,1,'L');
  }else{
    $pdf->Cell(20,5,$datosCompania[0]['telefono'],1,1,'L');    
  }

  $pdf->Cell(20,5,'Motivo Viaje',1,0,'L');
  $pdf->Cell(30,5,substr($hotel->motivoViaje($datosReserva[0]['motivo_viaje']),0,20),1,0,'L');
  $pdf->Cell(20,5,'Procedencia',1,0,'L');
  $pdf->Cell(30,5,substr(($hotel->getCityExp($datosReserva[0]['origen_reserva'])),0,20),1,0,'L');
  $pdf->Cell(20,5,'Destino',1,0,'l');
  $pdf->Cell(30,5,substr(($hotel->getCityExp($datosReserva[0]['destino_reserva'])),0,20),1,0,'L');
  $pdf->Cell(10,5,'Email',1,0,'L');
  $pdf->Cell(30,5,substr($datosHuesped[0]['email'],0,23),1,1,'L');

  $pdf->Cell(20,5,'Ocupacion',1,0,'L');
  $pdf->Cell(40,5,substr($profesion,0,26),1,0,'L');
  $pdf->Cell(15,5,'Estadia',1,0,'L');
  $pdf->Cell(15,5,$datosReserva[0]['dias_reservados'].' Noc',1,0,'C');
  $pdf->Cell(15,5,'Habitacion',1,0,'L');
  $pdf->Cell(10,5,$datosReserva[0]['num_habitacion'],1,0,'C');
  $pdf->Cell(20,5,'Placa Vehiculo',1,0,'L');
  if($datosReserva[0]['placaVehiculo']!=''){
    $placa  = substr($datosReserva[0]['placaVehiculo'],0,22);
  }else{
    $placa  = '';
  }
  $pdf->Cell(15,5,$placa,1,0,'L');
  
  $pdf->Cell(20,5,'Recepcionista',1,0,'L');
  $pdf->Cell(20,5,$usuario,1,1,'L');
  $pdf->Cell(20,5,'Forma de Pago',1,0,'L');
  $pdf->Cell(50,5,$hotel->formaPago($datosReserva[0]['forma_pago']),1,0,'L');
  $pdf->Cell(20,5,'Reserva Nro ',1,0,'L');
  $pdf->SetFont('Arial','B',8);
  $pdf->Cell(20,5,$reserva,1,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(80,5,'FIRMA',0,1,'C');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(20,5,'Equipaje',1,0,'L');
  if($datosReserva[0]['equipaje']!=''){
    $equipaje  = substr($datosReserva[0]['equipaje'],0,22);
  }else{
    $equipaje  = '';
  }
  $pdf->Cell(90,5,SUBSTR($equipaje,0,58),1,1,'L');
  $pdf->SetFont('Arial','',14);
  $pdf->Cell(110,16,'Comentarios',1,0,'L');
  $pdf->MultiCell(80,16,'Acepto el Contrato de Hospedaje',0,'C');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,10,'PARA USO DEL HOTEL',1,1,'C');
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(20,5,'TARIFA $',1,0,'L');
  $pdf->Cell(20,5,number_format($datosReserva[0]['valor_diario'],2),1,0,'C');
  $pdf->Cell(26,5,'IVA 19% INCLUIDO',1,0,'C');
  $pdf->Cell(22,5,'LLEGADA',1,0,'L');
  $pdf->Cell(25,5,$datosReserva[0]['fecha_llegada'],1,0,'C');
  $pdf->Cell(22,5,'SALIDA',1,0,'L');
  $pdf->Cell(25,5,$datosReserva[0]['fecha_salida'],1,0,'C');
  $pdf->Cell(20,5,('Adultos / Niños'),1,0,'L');
  $pdf->Cell(10,5,$datosReserva[0]['can_hombres']+$datosReserva[0]['can_mujeres'].' / '.$datosReserva[0]['can_ninos'],1,1,'C');
  $pdf->SetFont('Arial','',6);
  $pdf->Ln(1);
  $pdf->MultiCell(190,3,($textoContrato),1,'J');

  $pdf->AddPage('P','letter');
  $pdf->Rect(10, 36, 190, 230);
  $pdf->Image('../../../img/'.LOGO,xPOS,10,tPOS);
  $pdf->SetFont('Arial','B',8);
  $pdf->Cell(190,5,NAME_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(190,3,'Nit: '.NIT_EMPRESA,0,1,'C');
  $pdf->Cell(190,3,(ADRESS_EMPRESA.' '.CIUDAD_EMPRESA.' '.PAIS_EMPRESA),0,1,'C');
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
  $pdf->Cell(100,5,($datosHuesped[0]['nombre_completo']),1,0,'L');
  $pdf->Cell(30,5,($hotel->getLandGUest($datosHuesped[0]['pais_expedicion'])),1,0,'L');
  $pdf->Cell(20,5,$datosHuesped[0]['identificacion'],1,0,'R');
  $pdf->Cell(40,5,(substr($hotel->getCityExp($datosHuesped[0]['ciudad_expedicion']),0,21)),1,1,'L');
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
  $pdf->MultiCell(190,5,('Declaro que todas la información suministrada es verídica, adicional autorizo a '.NAME_HOTEL.' el manejo de datos de acuerdo a su política de datos personales. En caso de presentar Síntomas relacionados con el COVID-19 autorizo a ('.NAME_HOTEL.'), a realizar el reporte respectivo de acuerdo a los protocolos implementados.'));

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

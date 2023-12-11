<?php 
  /// require_once '../../res/php/titles.php';
  require_once '../../res/php/app_topHotel.php'; 
  require_once '../../res/fpdf/fpdf.php';

  $reserva           = $_POST['reserva']; 
  $usuario           = $_POST['usuario']; 

  $datosReserva      = $hotel->getReservasDatos($reserva);
  $datosHuesped      = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);
  $datosAcompanantes = $hotel->getBuscarAcompanantesReserva($reserva);   
  $datosCompania     = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);
  
  $regisCia          = count($datosCompania) ;
  $fecha             = $hotel->getDatePms();

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Rect(10, 33, 190, 230);
  $pdf->Image('../../img/'.LOGO,xPOS,10,tPOS);
  $pdf->SetFont('Arial','B',8);
  $pdf->Cell(190,5,NAME_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(190,3,'Nit: '.NIT_EMPRESA,0,1,'C');
  $pdf->Cell(190,3,ADRESS_EMPRESA.' '.CIUDAD_EMPRESA.' '.PAIS_EMPRESA,0,1,'C');
  $pdf->Cell(190,3,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',7);
  $pdf->Cell(190,4,NAME_HOTEL,0,0,'C'); 
  $pdf->Ln(4);
  $pdf->SetFont('Arial','B',6);
  $pdf->Cell(190,4,'PRE-REGISTRO HOTELERO ',0,1,'R');
  $pdf->SetFont('Arial','',6);
  $pdf->Ln(1);
  $pdf->Cell(100,6,'NOMBRE / NAME',1,0,'C');
  $pdf->Cell(30,6,'NACIONALIDAD',1,0,'C');
  $pdf->Cell(20,6,'IDENTIFICACION',1,0,'C');
  $pdf->Cell(40,6,'EXPEDICION',1,1,'C');
  $pdf->SetFont('Arial','',8);
  $pdf->Cell(100,5,utf8_decode($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']),1,0,'L');
  $pdf->Cell(30,5,utf8_decode($hotel->getLandGUest($datosHuesped[0]['pais'])),1,0,'C');
  $pdf->Cell(20,5,$datosHuesped[0]['identificacion'],1,0,'R');
  if($datosHuesped[0]['tipo_identifica']=='10'){
    $expedicion = $hotel->getLandGUest($datosHuesped[0]['lugar_expedicion']);
  }else{
    $expedicion = $hotel->getCityExp($datosHuesped[0]['lugar_expedicion']);
  }
  $pdf->Cell(40,5,utf8_decode(substr($expedicion,0,21)),1,1,'L');

  foreach ($datosAcompanantes as $acompanante) {
    $pdf->Cell(100,5,utf8_decode($acompanante['apellido1'].' '.$acompanante['apellido2'].' '.$acompanante['nombre1'].' '.$acompanante['nombre2']),1,0,'L');
    if(!isset($acompanante['pais'])){
      $pdf->Cell(30,5,'',1,0,'C');
    }else{    
      $pdf->Cell(30,5,utf8_decode($hotel->getLandGUest($acompanante['pais'])),1,0,'C');
    }
    $pdf->Cell(20,5,$acompanante['identificacion'],1,0,'R');

    if($acompanante['tipo_identifica']=='10'){
      if(!isset($acompanante['lugar_expedicion'])){
        $expedicion = '';
      }else{
        $expedicion = $hotel->getLandGUest($acompanante['lugar_expedicion']);
      }
    }else{
      if(!isset($acompanante['lugar_expedicion'])){
        $expedicion = '';
      }else{
        $expedicion = $hotel->getCityExp($acompanante['lugar_expedicion']);
      }
    }
    $pdf->Cell(40,5,utf8_decode(substr($expedicion,0,21)),1,1,'L');    
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
  $pdf->MultiCell(190,3,utf8_decode('
  DERECHOS Y OBLIGACIONES DEL HOTEL. EL HOTEL suministra al HUESPED el servicio de arrendamiento de una habitación con sus accesorios, mediante el pago de los cánones precios vigentes en el momento de la prestación del servicio y de acuerdo a los planes disponibles. La tarifa ó el plan son los que aparecen en la tarjeta de registro hotelero. La prestación de estos servicios estará sujeta a la disponibilidad  y a los horarios, turnos o exigencia, físicas de los insumos bienes facilidades, o espacios necesarios para ella .A) EL HOTEL. Podrá en cualquier momento disponer el cambio de habitación a EL HUESPED deberá aceptarlo B) EL HOTEL tiene disponible a la vista del público las tarifas precios del servicio y hora de iniciación y salida a las cuales se sujeta el HUESPED C) EL HOTEL tiene derecho de retención y prenda sobre el equipaje y bienes e posesión del HUESPED derechos que se harán efectivos por el incumplimiento de las obligaciones por parte del HUESPED en este caso EL HOTEL podrá retener  prenda los mencionados equipajes y vienes durante un plazo de (30) días, contados partir del a fecha de incumplimiento, vencido el cual. EL HOTEL podrá disponer libremente de los objetos pignorados y con sus productos cubrir las obligaciones pendientes incluyendo intereses más el (20%) por concepto de costos y gastos. El excedente, si lo hubiere, será puesto a disposición del Huésped en caso de difícil quedan a salvo las acciones del acreedor. D) Si EL HOTEL se encuentra en la imposibilidad de cumplir con la reservación  aceptada  por escrito. Siempre que haya prepago se ve forzado a terminar anticipadamente el hospedaje a plazo terminado, deberá tener alojamiento para el HUESPED en otro establecimiento de tarifa similar. Si la tarifa del hotel sucedánea es inferior, EL HOTEL reembolsara la diferencia AL HUESPED y si es superior se asumirá por EL HOTEL. Pero procurara que en lo posible no halla diferencia de tarifas. DERECHOS Y OBLIGACIONES DEL HUESPED,- A) EL HUESPED declara conocer la tarifa. Cánones y precios del hotel y admite que estas se modifiquen sin previo aviso, B) EL HUESPED se obliga a pagar su valor contado en dinero efectivo, en el momento de la prestación de respectivo servicio y en todo caso al momento el cese de la permanencia del HUESPED en el HOTEL el día hotelero comprende el lapso 24 horas de permanencia del huésped, a partir de la iniciación que fija el HOTEL. La utilización parcial del día hotelero causa el pago de la tarifa completa. C) EL HUESPED será responsable hasta por la culpa leve de las obligaciones y la de sus acompañantes. Cualquier persona no registrada que haga uso el alojamiento exclusivamente reservado al HUESPED deberá registrarse y pagar un sobre cargo del 100% sobre canon vigente. D) EL HUESPED deberá observar una conducta decorosa y vestir de manera apropiada. EL HOTEL abstendrá de prestar sus servicios cuando el comportamiento o la indumentaria del HUESPED no sea la adecuada. E) EL HUESPED admite que la práctica de deportes, ejercicios físicos, conducción de naves o vehículos, utilización de elementos o herramientas y, en general toda actividad que signifique un riesgo que implica que el HUESPED tiene habilidades y el conocimiento que le permiten asumir dichos riesgos, así como la responsabilidad en caso que sufra cualquier daño o lección de la cual exima expresamente al HOTEL F) EL HUESPED se compromete a usar los muebles, equipos y en general las facilidades del HOTEL de manera adecuada, conservándolas en el estado en que se encuentran y por lo tanto responderá por cualquier daño o perdida  de los elementos y bienes del HOTEL , mas 50% a titulo de pena  multa . G) EL HUESPED reconoce la autoridad del gerente del HOTEL, en caso de controversia o conflicto, así como el derecho de inspección a vigilancia que los funcionarios del HOTEL tiene para garantizar la adecuada utilización de las unidades habitacionales de uso común. Este  hecho se ejercerá de manera razonable e iincluye la facultad de penetrar o registrar la habitación cuando a juicio del GERENTE DEL HOTEL sea preciso. EL HUESPED a su vez se obliga a observar los honorarios y normas fijadas por el HOTEL para prestación de sus servicios y facilidades el acceso a sus empleados para las labores de rutina en la habitación. TERMINACIÓN DEL CONTRATO.- el contrato de hospedaje termina: por vencimiento del plazo fijado pactado; B) por incumplimiento de cualquiera de las obligaciones de las partes, El incumplimiento del HUESPED no lo exonerara del pago del canon completa por el plazo pactado; C) cuando el contrato sea celebrado día o sea cuando no consta expresamente en la tarjeta del registro  hotelero el termino de la permanencia de HUESPED EN EL HOTEL. El contrato se dará por terminado al vencimiento del día hotelero fijado según el contrato,; D) cuando el contrato sea a termino determinado, terminara por el vencimiento de este, en cuyo caso EL HOTEL podrá disponer de la habitación. En caso de terminación anticipada EL HUESPED deberá pagar la tarifa correspondiente al plazo completo, a menos que exista una causa razonable que juicio del HOTEL ameriten la terminación anticipada del contrato, como son la calamidad  domestica, enfermedades del HUESPED o del grupo a su cargo, problemas del cupo aéreo etc. DESACUERDO DE LA TERMINACION:- si surge desacuerdo entre EL HUESPED Y EL HOTEL en cuanto a terminación del contrato, EL HOTEL además de la suspensión del servicio, tomara las medidas necesarias para que EL HUESPED pueda disponer de su equipaje y objetos personales o los trasladara a depósito seguro y adecuado sin responsabilidades  del HOTEL.PRUEBA DEL CONTRATO: - el contrato de hospedaje se prueba mediante la tarjeta de registro hotelero que el HOTEL expida, aceptada por el HUESPED la cual hace constar que este se adhiere a las estipulaciones aquí contenidas. EL HUESPED acepta expresamente que la suma liquidada de dinero que conste en la factura, prestada merito ejecutivo. SEGUROS: -  para responder por riesgos que afectan tanto a la persona como a los bienes del HUESPED, EL HOTEL  tiene a su disposición una póliza de seguro hotelero. SI EL HUESPED toma el seguro mencionado deberá pagar la prima diaria que la compañía de seguros ha señalado, se cual se adicionara a la factura de alojamiento, en todo caso al ocurrir un siniestro la responsabilidad del HOTEL se limita al cubrimiento del seguro. Si el HUESPED se abstiene de tomar este seguro asume la totalidad de los riesgos cubiertos por la póliza y en caso de siniestro renuncia a declamación alguna respecto del HOTEL. Esta póliza de seguro es de carácter voluntario. RESPONSABILIDAD DE PERDIDA: -  si no media entrega al HOTEL  de los objetos que el HUESPED  desea que se custodien, se exonera al HOTEL de toda responsabilidad en caso de pérdida, por tanto, los objetos de valor como joyas, cámaras, dinero, equipos o utensilios que permanezcan en la habitación o áreas del servicio diferentes a las que el HOTEL dispone para depósitos estarán bajo el único riesgo del HUESPED ya que en este caso EL HOTEL no asume responsabilidad alguna, en caso de pérdida o deterioro. EL HUESPED autoriza al HOTEL para llenar los espacios en blanco en la tarjeta del servicio hotelero'),1,'L');

    $file = '../imprimir/registros/preRegistro_Hotelero_'.str_pad($reserva,5,'0',STR_PAD_LEFT).'.pdf';
  $pdf->Output($file,'F');

  echo 'preRegistro_Hotelero_'.str_pad($reserva,5,'0',STR_PAD_LEFT).'.pdf';

?>

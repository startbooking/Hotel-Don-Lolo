<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topHotel.php'; 
  require '../../res/fpdf/fpdf.php';
  
  $reserva    = $_SESSION['reserva']; 
  $nroFolio   = $_SESSION['folio'];
  $nroFactura = $_SESSION['factura'];
  $tipofac    = $_SESSION['tipofac'];
  $idperfil   = $_SESSION['idperfil'];
 
  $datosReserva   = $hotel->getReservasDatos($reserva);
  $datosHuesped   = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);

  if($tipofac==2){ 
    $datosCompania  = $hotel->getSeleccionaCompania($idperfil);
  }

  $datosAgencia   = $hotel->getSeleccionaAgencia($datosReserva[0]['id_agencia']);
  $tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);

  $folios     = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura,$reserva,$nroFolio,1);
  $pagosfolio = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura,$reserva,$nroFolio,3);
  $tipoimptos = $hotel->getValorImptoFolio($nroFactura,$reserva,$nroFolio,2);
  $fecha      = $hotel->getDatePms();

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Rect(10, 50, 190, 199);
  $pdf->Image('../../img/logo.png',10,10,30);
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(190,7,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  /*
  
  $pdf->Cell(190,5,TIPOEMPRESA,0,1,'C');
  $pdf->Cell(190,5,utf8_decode(ADRESS_EMPRESA),0,1,'C');
  $pdf->Cell(190,5,CIUDAD_EMPRESA.' '.PAIS_EMPRESA,0,1,'C');
  $pdf->Cell(40,5,'',0,0,'C');
  $pdf->Cell(110,5,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,0,'C');
   */
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(40,5,'TIQUETE DE VENTA ',1,1,'C');
  $pdf->Cell(40,5,'',0,0,'C');
  $pdf->Cell(110,5,NAME_HOTEL,0,0,'C');
  $pdf->Cell(40,5,str_pad($nroFactura,5,'0',STR_PAD_LEFT),1,1,'C');
  $pdf->Ln(4);

  $pdf->SetFont('Arial','B',10);
  if($tipofac==2){
    if(!empty($datosCompania)){ 
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(30,5,'RAZON SOCIAL',0,0,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(70,5,utf8_decode($datosCompania[0]['empresa']),0,0,'L');
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(10,5,'NIT.',0,0,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(50,5,number_format($datosCompania[0]['nit'],0).'-'.$datosCompania[0]['dv'],0,1,'L');
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(30,5,'DIRECCION',0,0,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(70,5,utf8_decode($datosCompania[0]['direccion']),0,0,'L');
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(20,5,'CIUDAD',0,0,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(30,5,utf8_decode($hotel->getCityName($datosCompania[0]['ciudad'])),0,0,'L');
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(25,5,'TELEFONO',0,0,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(20,5,$datosCompania[0]['telefono'],0,1,'L');
    }
  }else{
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,5,'CLIENTE',0,0,'L');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(70,5,utf8_decode($datosHuesped[0]["apellido1"].' '.$datosHuesped[0]["apellido2"].' '.$datosHuesped[0]["nombre1"].' '.$datosHuesped[0]["nombre2"]),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(35,5,'IDENTIFICACION',0,0,'L');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(25,5,$datosHuesped[0]['identificacion'],0,1,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,5,'DIRECCION',0,0,'L');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(70,5,utf8_decode($datosHuesped[0]['direccion']),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(15,5,'CIUDAD',0,0,'L');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(30,5,substr(utf8_decode($hotel->getCityName($datosHuesped[0]['ciudad'])),0,12),0,0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(20,5,'TELEFONO',0,0,'L');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,5,$datosHuesped[0]['telefono'],0,1,'L');
  } 

  $pdf->SetFont('Arial','',10);
  $pdf->Cell(30,5,'Huesped ',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(70,5,utf8_decode($datosHuesped[0]["apellido1"].' '.$datosHuesped[0]["apellido2"].' '.$datosHuesped[0]["nombre1"].' '.$datosHuesped[0]["nombre2"]),0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,5,'Identificacion',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,5,$datosHuesped[0]['identificacion'],0,1,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(47,5,utf8_decode('ADULTOS / NIÑOS'),1,0,'C');  
  $pdf->Cell(47,5,'HABITACION',1,0,'C');
  $pdf->Cell(48,5,'TARIFA',1,0,'C');
  $pdf->Cell(48,5,'HORAL SALIDA',1,1,'C');
  $pdf->Cell(47,5,$datosReserva[0]["can_hombres"]+$datosReserva[0]["can_mujeres"].'/'.$datosReserva[0]["can_ninos"],1,0,'C');
  $pdf->Cell(47,5,$datosReserva[0]["num_habitacion"],1,0,'C');
  $pdf->Cell(48,5,$datosReserva[0]["tarifa"],1,0,'C');
  $pdf->Cell(48,5,date('H:m:s'),1,1,'C');

  $pdf->SetFont('Arial','',10);
  $pdf->Cell(47,5,'FECHA LLEGADA',1,0,'C');
  $pdf->Cell(47,5,'FECHA SALIDA',1,0,'C');
  $pdf->Cell(48,5,'FECHA EXPEDICION',1,0,'C');
  $pdf->Cell(48,5,'FECHA VENCIMIENTO',1,1,'C');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(47,5,$datosReserva[0]["fecha_llegada"],1,0,'C');
  $pdf->Cell(47,5,$datosReserva[0]["fecha_salida"],1,0,'C');
  $pdf->Cell(48,5,FECHA_PMS,1,0,'C');
  $pdf->Cell(48,5,FECHA_PMS,1,1,'C');

  $pdf->Ln(4);
  $pdf->Cell(85,5,'CONCEPTO',1,0,'C');
  $pdf->Cell(15,5,'CANT',1,0,'C');
  $pdf->Cell(30,5,'VALOR',1,0,'C');
  $pdf->Cell(30,5,'IMPTO',1,0,'C');
  $pdf->Cell(30,5,'TOTAL',1,1,'C');
  $pdf->SetFont('Arial','',10);

  $consumos = 0;
  $impto    = 0;
  $pagos    = 0;
  $total    = $consumos + $impto;
  foreach ($folios as $folio1) {
    $pdf->Cell(85,5,utf8_decode($folio1['descripcion_cargo']),1,0,'L');
    $pdf->Cell(15,5,$folio1['cant'],1,0,'C');
    $pdf->Cell(30,5,number_format($folio1['cargos'],2),1,0,'R');
    $pdf->Cell(30,5,number_format($folio1['imptos'],2),1,0,'R');
    $pdf->Cell(30,5,number_format($folio1['cargos']+$folio1['imptos'],2),1,1,'R');
    $consumos = $consumos + $folio1['cargos'];
    $impto    = $impto + $folio1['imptos'];
    $total    = $consumos + $impto;
    $pagos    = $pagos + $folio1['pagos']; 
  }
  $pdf->Cell(100,5,'',0,0,'L');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(60,5,'TOTAL ',1,0,'C');
  $pdf->Cell(30,5,number_format($total,2),1,1,'R');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,5,'SON :'. numtoletras($total),1,1,'L');
  $pdf->setY(155);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,5,'FORMAS DE PAGO ',1,1,'C');
  $pdf->Cell(100,5,'DETALLE',1,0,'C');
  $pdf->Cell(90,5,'VALOR',1,1,'R');
  $pagos    = 0;
  $pdf->SetFont('Arial','',10);
  foreach ($pagosfolio as $pagofolio) {  
    $pagos    = $pagos + $pagofolio['pagos']; 
    $pdf->Cell(100,5,$pagofolio['descripcion_cargo'],1,0,'L');
    $pdf->Cell(90,5,number_format($pagofolio['pagos'],2),1,1,'R');
  }
  $pdf->Cell(100,5,'',0,0,'L');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(60,5,'TOTAL ',1,0,'C');
  $pdf->Cell(30,5,number_format($pagos,2),1,1,'R');
  $pdf->setY(190);
  $pdf->Ln(3);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(105,5,'IMPUESTOS',1,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(45,5,'TIPO IMPUESTO',1,0,'C');
  $pdf->Cell(30,5,'BASE',1,0,'C');
  $pdf->Cell(30,5,'VALOR',1,1,'C');
  foreach ($tipoimptos as $tipoimpto) {  
    $pdf->Cell(45,5,$tipoimpto['descripcion_cargo'],1,0,'L');
    $pdf->Cell(30,5,number_format($tipoimpto['cargos'],2),1,0,'R');
    $pdf->Cell(30,5,number_format($tipoimpto['imptos'],2),1,1,'R');
  }
  
  $pdf->setY(225);
  $pdf->SetFont('Arial','',7);
  $pdf->MultiCell(95,4,'Favor Consignar a la Cuenta de Ahorros Nro 187 00019 060 de BANCOLOMBIA o Cuenta de Ahorros Nro 136 900103 815 de DAVIVIENDA a nombre de GREAT GROUP SAS',1,'C');
  $y = $pdf->GetY();
  $pdf->SetY(225);
  $pdf->SetX(105);
  $pdf->MultiCell(95,6,'  
                        Nombre                                             Identificacion

                        Firma                                              Fecha',1,'de DAVIVIENDA L');
  $pdf->SetY(233);
  $pdf->MultiCell(95,4,'FACTURA IMPRESA POR COMPUTADOR. Resolucion Nro 18762015917578 del 2019-07-26 Autoriza desde el No 1 al No 5000, Esta Factura de venta se asimila en todos sus efectos a una leta de cambio Art. 774 del Codigo de Comercio, Actvidad Economica Principal 5511 tarifa 4.00 x 1000',1,'C');
  $pdf->Ln(1);
  $pdf->MultiCell(190,4,utf8_decode('Entiendo mi Responsabilidad por esta cuenta sigue vigente y me hago responsable en el caso que la persona, compañia o asociacion indicada dejase de pagar parcial o totalmente la suma de los cargos alli especificados'),0,'C');

  $file = 'facturas/Factura_'.$nroFactura.'.pdf';
  $pdf->Output($file,'F');
?>

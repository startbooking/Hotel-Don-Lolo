<?php 
  
  require '../../../res/fpdf/fpdf.php';

  $datosReserva   = $hotel->getReservasDatos($reserva);
  $datosHuesped   = $hotel->getbuscaDatosHuesped($idhuesped);

  if($tipofac==2){ 
    $datosCompania  = $hotel->getSeleccionaCompania($idperfil);
    $diasCre = $datosCompania[0]['dias_credito'];
  }

  $fechaFac = FECHA_PMS;
  $fechaVen = $fechaFac;
  $fechaVen = strtotime ( '+ '.$diasCre.' day' , strtotime ( $fechaFac ) ) ;
  $fechaVen = date ( 'Y-m-j' , $fechaVen );
  
  $datosAgencia   = $hotel->getSeleccionaAgencia($datosReserva[0]['id_agencia']);
  $tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);

  $folios     = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura,$reserva,$nroFolio,1);
  $pagosfolio = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura,$reserva,$nroFolio,3);
  $tipoimptos = $hotel->getValorImptoFolio($nroFactura,$reserva,$nroFolio,2);
  $fecha      = $hotel->getDatePms();

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Rect(10, 46, 190, 210);
  $pdf->Image('../../../img/'.LOGO,xPOS,yPOS,tPOS);
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(190,7,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,5,'NIT: '.NIT_EMPRESA,0,1,'C');

  $pdf->Cell(190,5,utf8_decode(ADRESS_EMPRESA),0,1,'C');
  $pdf->Cell(190,5,utf8_decode(CIUDAD_EMPRESA).' '.PAIS_EMPRESA,0,1,'C');
  $pdf->Cell(40,5,'',0,0,'C');
  $pdf->Cell(110,5,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,0,'C');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(40,5,'ESTADO DE CUENTA ',1,1,'C');
  $pdf->Cell(40,5,'',0,0,'C');
  $pdf->Cell(110,5,NAME_HOTEL,0,0,'C');
  $pdf->Cell(40,5,'HC-'.str_pad($nroFactura,4,'0',STR_PAD_LEFT),1,1,'C');
  $pdf->Ln(5);

  $pdf->SetFont('Arial','B',10);
  if($tipofac==2){
    if(!empty($datosCompania)){ 
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(30,5,'RAZON SOCIAL',0,0,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(120,5,utf8_decode($datosCompania[0]['empresa']),0,0,'L');
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(10,5,'NIT.',0,0,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(30,5,number_format($datosCompania[0]['nit'],0).'-'.$datosCompania[0]['dv'],0,1,'L');
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(30,5,'DIRECCION',0,0,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(70,5,substr(utf8_decode($datosCompania[0]['direccion']),0,35),0,0,'L');
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(20,5,'CIUDAD',0,0,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(30,5,utf8_decode(substr($hotel->getCityName($datosCompania[0]['ciudad']),0,12)),0,0,'L');
      $pdf->SetFont('Arial','',10);
      $pdf->Cell(21,5,'TELEFONO',0,0,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(20,5,$datosCompania[0]['telefono'],0,1,'L');
    }
  }else{
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,5,'CLIENTE',0,0,'L');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(70,5,substr(utf8_decode($datosHuesped[0]["apellido1"].' '.$datosHuesped[0]["apellido2"].' '.$datosHuesped[0]["nombre1"].' '.$datosHuesped[0]["nombre2"]),0,30),0,0,'L');
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
    $pdf->Cell(15,5,$datosHuesped[0]['telefono'],0,1,'L');
  } 

  $pdf->SetFont('Arial','',10);
  $pdf->Cell(30,5,'Huesped ',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(70,5,substr(utf8_decode($datosHuesped[0]["apellido1"].' '.$datosHuesped[0]["apellido2"].' '.$datosHuesped[0]["nombre1"].' '.$datosHuesped[0]["nombre2"]),0,30),0,0,'L');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(25,5,'Identificacion',0,0,'L');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,5,$datosHuesped[0]['identificacion'],0,0,'L');
  $pdf->ln(2);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,5,utf8_decode(strtoupper(substr($datosReserva[0]['orden_reserva'],0,18))),0,1,'L');
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(38,5,utf8_decode('ADULTOS / NIÑOS'),1,0,'C');  
  $pdf->Cell(38,5,'HABITACION',1,0,'C');
  $pdf->Cell(38,5,'TARIFA',1,0,'C');
  $pdf->Cell(38,5,'HORAL SALIDA',1,0,'C');
  $pdf->Cell(38,5,'REGISTRO NRO',1,1,'C');
  $pdf->Cell(38,5,$datosReserva[0]["can_hombres"]+$datosReserva[0]["can_mujeres"].'/'.$datosReserva[0]["can_ninos"],1,0,'C');
  $pdf->Cell(38,5,$datosReserva[0]["num_habitacion"],1,0,'C');
  $pdf->Cell(38,5,number_format($datosReserva[0]["valor_diario"],2),1,0,'C');
  $pdf->Cell(38,5,date('H:m:s'),1,0,'C');

  $pdf->Cell(38,5,str_pad($datosReserva[0]["num_registro"],4,'0',STR_PAD_LEFT),1,1,'C');

  $pdf->SetFont('Arial','',9);
  $pdf->Cell(47,5,'FECHA LLEGADA',1,0,'C');
  $pdf->Cell(47,5,'FECHA SALIDA',1,0,'C');
  $pdf->Cell(48,5,'FECHA EXPEDICION',1,0,'C');
  $pdf->Cell(48,5,'FECHA VENCIMIENTO',1,1,'C');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(47,5,$datosReserva[0]["fecha_llegada"],1,0,'C');
  $pdf->Cell(47,5,$datosReserva[0]["fecha_salida"],1,0,'C');
  $pdf->Cell(48,5,FECHA_PMS,1,0,'C');
  $pdf->Cell(48,5,$fechaVen,1,1,'C');
  $pdf->SetFont('Arial','',10);

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
  $pdf->Cell(60,6,'TOTAL ',1,0,'C');
  $pdf->Cell(30,6,number_format($total,2),1,1,'R');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','',10);
  $pdf->MultiCell(190,5,'SON :'. numtoletras($total),1,'L');
  $pdf->setY(155);
  $pdf->SetFont('Arial','B',10);

  $y = $pdf->GetY();
  $pdf->SetY(226);
  $pdf->MultiCell(95,4,'



          Firma Cajero 
                        ',1,'C');
  $pdf->SetY(226);
  $pdf->SetX(105);
  $pdf->MultiCell(95,6,'  
                        Nombre                                             Identificacion

                        Firma                                              Fecha',1,'L');
  $pdf->Ln(1);
  $file = '../../imprimir/facturas/Factura_'.$nroFactura.'.pdf';
  $pdf->Output($file,'F');

  array_push($estadofactura,'Factura_'.$nroFactura.'.pdf') ;

?>


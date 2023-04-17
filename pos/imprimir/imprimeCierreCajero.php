<?php 

  $detalles        = $pos->getDetalleFacturaCajeroDia('A',$user, $idamb);
  $detalleAnuladas = $pos->getDetalleFacturaAnuladaCajeroDia('X',$user, $idamb);
  $pagos           = $pos->getDetalleFormasdePagoCajero('A',$user, $idamb);
  $pagosAnulados   = $pos->getDetalleFormasdePagoAnuladasCajero('X',$user, $idamb);
  $devoluciones    = $pos->getDevolucionUsuario($idamb,$user);
  $creditos        = $pos->getVentasCredito($idamb,$user);
  $abonos          = $pos->traeAbonosCaja($iduser, $idamb);
  $ventas          = $pos->getTotalProductosVendidosUsuario($idamb,$user);

  require_once '../../../res/fpdf/fpdf.php';
 
  $pdf = new FPDF(); 
  $pdf->AddPage('L','letter');
  $pdf->Image('../../../img/'.LOGO,10,5,25);
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(260,5,$amb,0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(260,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',10);
  $pdf->Ln(1); 
  /* $pdf->SetFont('Arial','B',10);
  $pdf->Cell(260,5,'INFORME DE VENTAS - BALANCE DIARIO USUARIO ',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(260,5,'USUARIO : '.$user.' Fecha : '.$fecha,0,1,'C');
  $pdf->Ln(2);

  $pdf->Cell(260,8,'FACTURAS GENERADAS ',1,1,'C');
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(15,6,'Fact.',1,0,'C');
  $pdf->Cell(25,6,'Neto ',1,0,'C');
  $pdf->Cell(20,6,'Impuesto ',1,0,'C');
  $pdf->Cell(20,6,'Propina ',1,0,'C');
  $pdf->Cell(20,6,'Descuento ',1,0,'C');
  $pdf->Cell(20,6,'Abonos ',1,0,'C');
  $pdf->Cell(25,6,'Pagado ',1,0,'C');
  $pdf->Cell(25,6,'Total ',1,0,'C');
  $pdf->Cell(30,6,'Usuario ',1,0,'C');
  $pdf->Cell(40,6,'Forma de Pago ',1,0,'C');
  $pdf->Cell(20,6,'Hora ',1,1,'C');

  $pdf->SetFont('Arial','',9);  
  $fact = 0;
  $neto = 0;
  $impt = 0;
  $prop = 0;
  $tota = 0;
  $desc = 0;
  $abon = 0;
  $pago = 0;

  foreach ($detalles as $detalle) {
    $fact = $fact + 1; 
    $neto = $neto + $detalle['valor_neto'];
    $impt = $impt + $detalle['impuesto'];
    $prop = $prop + $detalle['propina'];
    $desc = $desc + $detalle['descuento'];
    $abon = $abon + $detalle['abonos'];
    $pago = $pago + $detalle['pagado'];
    $tota = $tota + $detalle['pagado']+$detalle['abonos'];

    $pdf->Cell(15,6,$detalle['factura'],1,0,'R');
    $pdf->Cell(25,6,number_format($detalle['valor_neto'],2),1,0,'R');
    $pdf->Cell(20,6,number_format($detalle['impuesto'],2),1,0,'R');
    $pdf->Cell(20,6,number_format($detalle['propina'],2),1,0,'R');
    $pdf->Cell(20,6,number_format($detalle['descuento'],2),1,0,'R');
    $pdf->Cell(20,6,number_format($detalle['abonos'],2),1,0,'R');
    $pdf->Cell(25,6,number_format($detalle['pagado'],2),1,0,'R');
    $pdf->Cell(25,6,number_format($detalle['pagado']+$detalle['abonos'],2),1,0,'R');
    $pdf->Cell(30,6,$detalle['usuario'],1,0,'L');
    $pdf->Cell(40,6,substr($pos->nombrePago($detalle['forma_pago']),0,19),1,0,'L');
    $pdf->Cell(20,6,substr($detalle['fecha_factura'],11,8),1,1,'R');
  }
  $pdf->Cell(15,6,'Total',1,0,'C');
  $pdf->Cell(25,6,number_format($neto,2),1,0,'R');
  $pdf->Cell(20,6,number_format($impt,2),1,0,'R');
  $pdf->Cell(20,6,number_format($prop,2),1,0,'R');
  $pdf->Cell(20,6,number_format($desc,2),1,0,'R');
  $pdf->Cell(20,6,number_format($abon,2),1,0,'R');
  $pdf->Cell(25,6,number_format($pago,2),1,0,'R');
  $pdf->Cell(25,6,number_format($tota,2),1,1,'R'); */

  $pdf->Ln(5);

  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(260,8,'DETALLE FACTURAS ANULADAS ',1,1,'C');
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(20,6,'Fact.',1,0,'C');
  $pdf->Cell(20,6,'Com. ',1,0,'C');
  $pdf->Cell(20,6,'Mesa ',1,0,'C');
  $pdf->Cell(20,6,'Pax ',1,0,'C');
  $pdf->Cell(35,6,'Total Fact ',1,0,'C');
  $pdf->Cell(30,6,'Usuario ',1,0,'C');
  $pdf->Cell(80,6,'Motivo Anulacion ',1,0,'C');
  $pdf->Cell(35,6,'Hora ',1,1,'C');
  $pdf->SetFont('Arial','',9);

  $fact = 0;
  $neto = 0;
  $impt = 0;
  $prop = 0;
  $tota = 0;
  $desc = 0;

  foreach ($detalleAnuladas as $detalle) {
    $fact = $fact + 1;
    $neto = $neto + $detalle['valor_neto'];
    $impt = $impt + $detalle['impuesto'];
    $prop = $prop + $detalle['propina'];
    $desc = $desc + $detalle['descuento'];
    $tota = $tota + $detalle['valor_total'];

    $pdf->Cell(20,6,$detalle['factura'],1,0,'R');
    $pdf->Cell(20,6,$detalle['comanda'],1,0,'R');
    $pdf->Cell(20,6,$detalle['mesa'],1,0,'R');
    $pdf->Cell(20,6,$detalle['pax'],1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['valor_total'],2),1,0,'R');
    $pdf->Cell(30,6,$detalle['usuario_anulada'],1,0,'R');
    $pdf->Cell(80,6,$detalle['motivo_anulada'],1,0,'L');
    $pdf->Cell(35,6,$detalle['fecha_factura_anulada'],1,1,'R');
  }
  $pdf->Cell(80,6,'Total',1,0,'C');
  $pdf->Cell(35,6,number_format($neto,2),1,1,'R');

  $pdf->Ln(5);
 
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(260,8,'DETALLE FORMAS DE PAGO ',1,1,'C');
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(60,6,'Forma de pago.',1,0,'C');
  $pdf->Cell(25,6,'Cant. ',1,0,'C');
  $pdf->Cell(35,6,'SubTotal ',1,0,'C');
  $pdf->Cell(35,6,'Propina ',1,0,'C');
  $pdf->Cell(35,6,'Descuentos ',1,0,'C');
  $pdf->Cell(35,6,'Impuestos  ',1,0,'C');
  $pdf->Cell(35,6,'Total Fact ',1,1,'C');
  $pdf->SetFont('Arial','',9);

  $fact  = 0;
  $neto  = 0;
  $impt  = 0;
  $prop  = 0;
  $tota  = 0;
  $desc  = 0;
  $canti = 0;

  foreach ($pagos as $detalle) {
    $fact  = $fact + 1;
    $canti = $canti + $detalle['cant'];
    $neto  = $neto + $detalle['neto'];
    $impt  = $impt + $detalle['impto'];
    $prop  = $prop + $detalle['prop'];
    $desc  = $desc + $detalle['desc'];
    $tota = $tota + $detalle['pagado'];

    $pdf->Cell(60,6,$detalle['descripcion'],1,0,'L');
    $pdf->Cell(25,6,$detalle['cant'],1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['neto'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['prop'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['desc'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['impto'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['pagado'],2),1,1,'R');
  }
  $pdf->Cell(60,6,'Total',1,0,'C');
  $pdf->Cell(25,6,number_format($canti,0),1,0,'R');
  $pdf->Cell(35,6,number_format($neto,2),1,0,'R');
  $pdf->Cell(35,6,number_format($prop,2),1,0,'R');
  $pdf->Cell(35,6,number_format($desc,2),1,0,'R');
  $pdf->Cell(35,6,number_format($impt,2),1,0,'R');
  $pdf->Cell(35,6,number_format($tota,2),1,1,'R');

  $pdf->Ln(5);

  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(260,8,'DETALLE FORMAS DE PAGO ANULADAS ',1,1,'C');
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(60,6,'Forma de pago.',1,0,'C');
  $pdf->Cell(25,6,'Cant. ',1,0,'C');
  $pdf->Cell(35,6,'SubTotal ',1,0,'C');
  $pdf->Cell(35,6,'Propina ',1,0,'C');
  $pdf->Cell(35,6,'Descuentos ',1,0,'C');
  $pdf->Cell(35,6,'Impuestos  ',1,0,'C');
  $pdf->Cell(35,6,'Total Fact ',1,1,'C');
  $pdf->SetFont('Arial','',9);

  $fact  = 0;
  $neto  = 0;
  $impt  = 0;
  $prop  = 0;
  $tota  = 0;
  $desc  = 0;
  $canti = 0;

  foreach ($pagosAnulados as $detalle) {
    $fact  = $fact + 1;
    $canti = $canti + $detalle['cant'];
    $neto  = $neto + $detalle['neto'];
    $impt  = $impt + $detalle['impto'];
    $prop  = $prop + $detalle['prop'];
    $desc  = $desc + $detalle['desc'];
    $tota  = $tota + $detalle['total'];

    $pdf->Cell(60,6,$detalle['descripcion'],1,0,'L');
    $pdf->Cell(25,6,$detalle['cant'],1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['neto'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['prop'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['desc'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['impto'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['total'],2),1,1,'R');
  }
  $pdf->Cell(60,6,'Total',1,0,'C');
  $pdf->Cell(25,6,number_format($canti,0),1,0,'R');
  $pdf->Cell(35,6,number_format($neto,2),1,0,'R');
  $pdf->Cell(35,6,number_format($prop,2),1,0,'R');
  $pdf->Cell(35,6,number_format($desc,2),1,0,'R');
  $pdf->Cell(35,6,number_format($impt,2),1,0,'R');
  $pdf->Cell(35,6,number_format($tota,2),1,1,'R');
  $pdf->Ln(5);

  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(205,8,'ABONOS RECIBIDOS ',1,1,'C');
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(20,6,'Comanda. ',1,0,'C');
  $pdf->Cell(40,6,'Forma de Pago ',1,0,'C');
  $pdf->Cell(25,6,'Total Abono ',1,0,'C');
  $pdf->Cell(30,6,'Usuario ',1,0,'C');
  $pdf->Cell(70,6,'Detalle Abono ',1,0,'C');
  $pdf->Cell(20,6,'Hora ',1,1,'C');

  $pdf->SetFont('Arial','',9);
  $fact = 0;
  $neto = 0;
  $impt = 0;
  $prop = 0;
  $tota = 0;
  $desc = 0;

  foreach ($abonos as $detalle) {
    $fact = $fact + 1;
    $neto = $neto + $detalle['valor'];
    $pdf->Cell(20,6,$detalle['comanda'],1,0,'R');
    $pdf->Cell(40,6,substr($detalle['descripcion'],0,19),1,0,'L');
    $pdf->Cell(25,6,number_format($detalle['valor'],2),1,0,'R');
    $pdf->Cell(30,6,$detalle['usuario'],1,0,'L');
    $pdf->Cell(70,6,substr($detalle['comentarios'],0,35),1,0,'L');
    $pdf->Cell(20,6,substr($detalle['created_at'],11,8),1,1,'R');
  }
  $pdf->Cell(60,6,'Total',1,0,'C');
  $pdf->Cell(25,6,number_format($neto,2),1,1,'R');

  $pdf->Ln(5);

  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(195,8,'DETALLE VENTAS CREDITO DEL DIA ',1,1,'C');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(130,6,'Cliente',1,0,'C');
  $pdf->Cell(30,6,'Factura ',1,0,'C');
  $pdf->Cell(35,6,'Total Fact ',1,1,'C');
  $pdf->SetFont('Arial','',9);

  $fact  = 0;
  $neto  = 0;
  $impt  = 0;
  $prop  = 0;
  $tota  = 0;
  $desc  = 0;
  $canti = 0;
  if(count($creditos)==0){
    $pdf->Cell(195,5,'SIN VENTAS A CREDITO  ',1,1,'C');
    $pdf->Ln(2);

  }else{
    foreach ($creditos as $detalle) {
      $fact  = $fact + 1;
      $tota  = $tota + $detalle['valor_total'];

      $pdf->Cell(130,6,utf8_decode($detalle['apellido1'].' '.$detalle['apellido2'].' '.$detalle['nombre1'].' '.$detalle['nombre2']),1,0,'L');
      $pdf->Cell(30,6,$detalle['factura'],1,0,'R');
      $pdf->Cell(35,6,number_format($detalle['valor_total'],2),1,1,'R');
    }
    $pdf->Cell(130,6,'Total Ventas Credito',1,0,'C');
    $pdf->Cell(35,6,number_format($tota,2),1,1,'R');
  }
  $pdf->Ln(5);


  $pdf->SetFont('Arial', 'B', 11);
  $pdf->Cell(165, 5, 'PRODUCTOS VENDIDOS ', 1, 1, 'C');
  
  $pdf->SetFont('Arial', '', 9);
  
  $monto = 0;
  $impto = 0;
  $total = 0;
  $valprod = 0;
  $canti = 0;
  if (count($ventas) == 0) {
      $pdf->Ln(2);
      $pdf->Cell(190, 6, 'SIN PRODUCTOS VENDIDOS EN EL DIA', 1, 1, 'C');
      $pdf->Ln(2);
  } else {
      $pdf->SetFont('Arial', 'B', 11);
      $pdf->Cell(70, 6, 'Producto.', 1, 0, 'C');
      $pdf->Cell(20, 6, 'Cant. ', 1, 0, 'C');
      $pdf->Cell(25, 6, 'Valor. ', 1, 0, 'C');
      $pdf->Cell(25, 6, 'Impuesto. ', 1, 0, 'C');
      $pdf->Cell(25, 6, 'Total. ', 1, 1, 'C');
      $pdf->SetFont('Arial', '', 10);
  
      foreach ($ventas as $comanda) {
          $pdf->Cell(70, 5, utf8_decode(substr($comanda['nom'], 0, 30)), 0, 0, 'L');
          $pdf->Cell(20, 5, $comanda['cant'], 0, 0, 'C');
          $pdf->Cell(25, 5, number_format($comanda['ventas'], 2), 0, 0, 'R');
          $pdf->Cell(25, 5, number_format($comanda['imptos'], 2), 0, 0, 'R');
          $pdf->Cell(25, 5, number_format($comanda['total'], 2), 0, 1, 'R');
          $valprod = $valprod + $comanda['ventas'];
          $canti = $canti + $comanda['cant'];
          $monto = $monto + $comanda['ventas'];
          $impto = $impto + $comanda['imptos'];
          $total = $total + $comanda['total'];
      }
      $pdf->Ln(2);
      $pdf->SetFont('Arial', 'B', 10);
      $pdf->Cell(70, 6, 'Total ', 1, 0, 'L');
      $pdf->Cell(20, 6, number_format($canti, 0), 1, 0, 'R');
      $pdf->Cell(25, 6, number_format($monto, 2), 1, 0, 'R');
      $pdf->Cell(25, 6, number_format($impto, 2), 1, 0, 'R');
      $pdf->Cell(25, 6, number_format($total, 2), 1, 1, 'R');
      $pdf->SetFont('Arial', '', 10);
    }
  $pdf->Ln(5);


  $monto  = 0 ;
  $impto  = 0 ;
  $total  = 0 ;
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,8,'DEVOLUCION DE PRODUCTOS ',1,1,'C');
  $pdf->Cell(20,6,'Comanda.',1,0,'C');
  $pdf->Cell(20,6,'Mesa ',1,0,'C');
  $pdf->Cell(70,6,'Producto. ',1,0,'C');
  $pdf->Cell(20,6,'Cantidad',1,0,'C');
  $pdf->Cell(65,6,'Motivo Devolucion',1,1,'C');
  $pdf->SetFont('Arial','',9);

  if(count($devoluciones)==0){
    $pdf->Cell(195,5,'SIN DEVOLUCION DE PRODUCTOS  ',1,1,'C');
    $pdf->Ln(2);

  }else{
    foreach ($devoluciones as $comanda) {
      $pdf->Cell(20,5,$comanda['comanda'],1,0,'C');
      $pdf->Cell(20,5,$comanda['mesa'],1,0,'C');
      $pdf->Cell(70,5,$comanda['nom'],1,0,'L');
      $pdf->Cell(20,5,$comanda['cant'],1,0,'C');
      $pdf->Cell(65,5,$comanda['motivo_devo'],1,1,'L');
    }
  }
  $pdf->Ln(3);

  $pdf->AddPage('P','letter');
  $pdf->Image('../../../img/'.$logo,10,5,25);
  $pdf->SetFont('Arial','B',11);

  $pdf->Cell(190,5,$amb,0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,5,'BALANCE CAJA USUARIO '.$user,0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(195,4,'Fecha '.$fecha,0,1,'C'); 
  $pdf->Ln(2);

  $bases    = $pos->traeMovimientosCaja($fecha, $iduser, 0);
  $cajas    = $pos->traeMovimientosCaja($fecha, $iduser, 1);
  $carteras = $pos->traeCarteraCaja($fecha, $iduser,2);
  $pagos    = $pos->getDetalleFormasdePagoCajero('A',$user, $idamb);
  $abonos   = $pos->getDetalleAbonosFormasdePagoCajero($iduser, $idamb);

  $totbase  = 0 ;
  $totcaja  = 0 ;
  $totcart  = 0 ;
  $efecart  = 0 ;
  $totefec  = 0 ;
  $totvent  = 0 ;
  $totabono  = 0 ;
  $abonoefec = 0 ;

  if(count($bases)==0){
    $pdf->Ln(2);
    $pdf->Cell(190,5,'SIN BASE DE CAJA',1,1,'C');
    $pdf->Ln(2);
  }else{
    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(170,5,'BASE DE CAJA',1,1,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(70,6,'Concepto ',1,0,'C');
    $pdf->Cell(70,6,'Cajero. ',1,0,'C');
    $pdf->Cell(30,6,'Monto',1,1,'C');
    $pdf->SetFont('Arial','',9);
    foreach ($bases as $caja) {
      $totbase = $totbase + $caja['monto'];
      $pdf->Cell(70,5,$caja['concepto'],0,0,'l');
      $pdf->Cell(70,5,$caja['proveedor'],0,0,'L');
      $pdf->Cell(30,5,number_format($caja['monto'],2),0,1,'R');
    }
  }
  $pdf->Ln(2);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(70,6,'Total Base Caja',0,0,'L');
  $pdf->Cell(25,6,number_format($totbase,2) ,0,1,'C');
  $pdf->Ln(5);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,5,'COMPRAS BASE DE CAJA',1,1,'C');
  $pdf->Cell(70,6,'Concepto ',1,0,'C');
  $pdf->Cell(30,6,'Documento ',1,0,'C');
  $pdf->Cell(70,6,'Proveedor. ',1,0,'C');
  $pdf->Cell(20,6,'Valor',1,1,'C');
  $pdf->SetFont('Arial','',9);
  if(count($cajas)==0){
    $pdf->Cell(190,5,'SIN COMPRAS POR BASE DE CAJA',1,1,'C');
    $pdf->Ln(2);
  }else{
    foreach ($cajas as $caja) {
      $totcaja = $totcaja + $caja['monto'];
      $pdf->Cell(70,5,$caja['concepto'],0,0,'L');
      $pdf->Cell(30,5,$caja['documento'],0,0,'L');
      $pdf->Cell(70,5,$caja['proveedor'],0,0,'L');
      $pdf->Cell(20,5,number_format($caja['monto'],2),0,1,'R');
    }
  }

  $pdf->Ln(2);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(70,6,'Total Compras Por Caja',1,0,'L');
  $pdf->Cell(25,6,number_format($totcaja,2) ,1,1,'C');
  
  $pdf->Ln(5);
  $pdf->Cell(190,5,'RECAUDOS DE CARTERA  BASE DE CAJA',1,1,'C');
  $pdf->Cell(70,6,'Concepto ',1,0,'C');
  $pdf->Cell(90,6,'Proveedor. ',1,0,'C');
  $pdf->Cell(30,6,'Valor Pagado',1,1,'C');
  $pdf->SetFont('Arial','',9);
  if(count($carteras)==0){
    $pdf->Cell(190,5,'SIN RECAUDOS DE CARTERA POR BASE DE CAJA',1,1,'C');
    $pdf->Ln(2);
  }else{
    foreach ($carteras as $caja) {
      if ($caja['id_pago'] == 1) {
        $efecart = $efecart + $caja['monto'];
      }
      $totcart = $totcart + $caja['monto'];
      $pdf->Cell(70,5,$pos->traeClienteCartera($caja['proveedor']),0,0,'L');
      $pdf->Cell(90,5,$caja['concepto'],0,0,'L');
      $pdf->Cell(30,5,number_format($caja['monto'],2),0,1,'R');
    }
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(70,6,'Total Recuados de Cartera Por Caja',1,0,'L');
    $pdf->Cell(30,6,number_format($totcart,2) ,1,1,'R');
  }
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(100,5,'ABONOS DEL DIA BASE DE CAJA',1,1,'C');
  $pdf->Cell(70,6,'Concepto ',1,0,'C');
  $pdf->Cell(30,6,'Valor Abono',1,1,'C');
  $pdf->SetFont('Arial','',9);
  if(count($abonos)==0){
    $pdf->Cell(190,5,'SIN ABONOS EN EL DIA',1,1,'C');
    $pdf->Ln(2);
  }else{
    foreach ($abonos as $caja) {
      if($caja['formaPago']==1){
        $abonoefec = $abonoefec + $caja['total'];
      }
      $totabono = $totabono + $caja['total'];
      $pdf->Cell(70,5,$caja['descripcion'],0,0,'L');
      $pdf->Cell(30,5,number_format($caja['total'],2),0,1,'R');
    }
  }
  $pdf->Ln(2);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(70,6,'Total Abonos del Dia',1,0,'L');
  $pdf->Cell(30,6,number_format($totabono,2) ,1,1,'R');
  
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(110,5,'VENTAS DEL DIA BASE DE CAJA',0,1,'C');
  $pdf->SetFont('Arial','',9);
  if(count($pagos)==0){
    $pdf->Cell(110,5,'SIN VENTAS DEL DIA',0,1,'C');
    $pdf->Ln(2);
  }else{
    $pdf->Cell(70,6,'Concepto ',1,0,'C');
    $pdf->Cell(30,6,'Valor Facturado',1,1,'C');

    foreach ($pagos as $caja) {
      if($caja['id_pago']==1){
        $totefec = $totefec + $caja['pagado'];
      }
      $totvent = $totvent + $caja['pagado'];
      $pdf->Cell(70,5,$caja['descripcion'],0,0,'L');
      $pdf->Cell(30,5,number_format($caja['pagado'],2),0,1,'R');
    }
  }
  $pdf->Ln(2);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(70,6,'Total Ventas del Dia',1,0,'L');
  $pdf->Cell(30,6,number_format($totvent,2) ,1,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(70,6,strtoupper('Saldo Total Efectivo Caja '),1,0,'L');
  $pdf->Cell(30,6,number_format($totbase - $totcaja + $efecart + $totefec + $abonoefec,2) ,1,1,'C');
  $pdf->SetFont('Arial','',10);

  $pdf->Ln(3);

  $file = '../../imprimir/cierres/cierre_Cajero_'.$user.'_'.$fecha.'.pdf';
  $pdf->Output($file,'F');
?>

<?php 

  $detalles        = $pos->getDetalleFacturaCajeroDia('A',$user, $idamb);
  $detalleAnuladas = $pos->getDetalleFacturaAnuladaCajeroDia('X',$user, $idamb);
  $pagos           = $pos->getDetalleFormasdePagoCajero('A',$user, $idamb);
  $pagosAnulados   = $pos->getDetalleFormasdePagoAnuladasCajero('X',$user, $idamb);

  require_once '../../../res/fpdf/fpdf.php';

  $pdf = new FPDF();
  $pdf->AddPage('L','letter');
  $pdf->Image('../../../img/'.$logo,10,10,25);
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(260,6,$amb,0,1,'C');
  $pdf->Cell(260,7,'INFORME DE VENTAS - BALANCE DIARIO',0,1,'C');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(260,5,'USUARIO : '.$user,0,1,'C');
  $pdf->Cell(260,5,'Fecha : '.$fecha,0,1,'C');
  $pdf->Ln(5);

  $pdf->SetFont('Arial','B',11);  
  $pdf->Cell(260,7,'DETALLE FACTURAS GENERADAS ',1,1,'C');
  $pdf->SetFont('Arial','',10);  
  $pdf->Cell(15,6,'Fact.',1,0,'C');
  $pdf->Cell(15,6,'Com. ',1,0,'C');
  $pdf->Cell(15,6,'Mesa ',1,0,'C');
  $pdf->Cell(15,6,'Pax ',1,0,'C');
  $pdf->Cell(25,6,'Neto ',1,0,'C');
  $pdf->Cell(20,6,'Impuesto ',1,0,'C');
  $pdf->Cell(20,6,'Propina ',1,0,'C');
  $pdf->Cell(20,6,'Descuento ',1,0,'C');
  $pdf->Cell(25,6,'Total Fact ',1,0,'C');
  $pdf->Cell(30,6,'Usuario ',1,0,'C');
  $pdf->Cell(60,6,'Forma de Pago ',1,1,'C');

  $fact = 0;
  $neto = 0;
  $impt = 0;
  $prop = 0;
  $tota = 0;
  $desc = 0;

  foreach ($detalles as $detalle) {
    $fact = $fact + 1; 
    $neto = $neto + $detalle['valor_neto'];
    $impt = $impt + $detalle['impuesto'];
    $prop = $prop + $detalle['propina'];
    $desc = $desc + $detalle['descuento'];
    $tota = $tota + $detalle['pagado']-$detalle['cambio'];

    $pdf->Cell(15,6,$detalle['factura'],1,0,'R');
    $pdf->Cell(15,6,$detalle['comanda'],1,0,'R');
    $pdf->Cell(15,6,$detalle['mesa'],1,0,'R');
    $pdf->Cell(15,6,$detalle['pax'],1,0,'R');
    $pdf->Cell(25,6,number_format($detalle['valor_neto'],2),1,0,'R');
    $pdf->Cell(20,6,number_format($detalle['impuesto'],2),1,0,'R');
    $pdf->Cell(20,6,number_format($detalle['propina'],2),1,0,'R');
    $pdf->Cell(20,6,number_format($detalle['descuento'],2),1,0,'R');
    $pdf->Cell(25,6,number_format($detalle['pagado']-$detalle['cambio'],2),1,0,'R');
    $pdf->Cell(30,6,$detalle['usuario'],1,0,'L');
    $pdf->Cell(60,6,$pos->nombrePago($detalle['forma_pago']),1,1,'L');
  }
  $pdf->Cell(60,6,'Total',1,0,'C');
  $pdf->Cell(25,6,number_format($neto,2),1,0,'R');
  $pdf->Cell(20,6,number_format($impt,2),1,0,'R');
  $pdf->Cell(20,6,number_format($prop,2),1,0,'R');
  $pdf->Cell(20,6,number_format($desc,2),1,0,'R');
  $pdf->Cell(25,6,number_format($tota,2),1,1,'R');

  $pdf->Ln(5);

  $pdf->SetFont('Arial','B',11);  
  $pdf->Cell(260,7,'DETALLE FACTURAS ANULADAS ',1,1,'C');
  $pdf->SetFont('Arial','',10);  
  $pdf->Cell(25,6,'Fact.',1,0,'C');
  $pdf->Cell(25,6,'Com. ',1,0,'C');
  $pdf->Cell(25,6,'Mesa ',1,0,'C');
  $pdf->Cell(25,6,'Pax ',1,0,'C');
  $pdf->Cell(35,6,'Total Fact ',1,0,'C');
  $pdf->Cell(30,6,'Usuario ',1,0,'C');
  $pdf->Cell(95,6,'Motivo Anulacion ',1,1,'C');

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

    $pdf->Cell(25,6,$detalle['factura'],1,0,'R');
    $pdf->Cell(25,6,$detalle['comanda'],1,0,'R');
    $pdf->Cell(25,6,$detalle['mesa'],1,0,'R');
    $pdf->Cell(25,6,$detalle['pax'],1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['valor_total'],2),1,0,'R');
    $pdf->Cell(30,6,$detalle['usuario_anulada'],1,0,'L');
    $pdf->Cell(95,6,substr($detalle['motivo_anulada'],0,40),1,1,'L');
  }

  $pdf->Ln(5);

  $pdf->SetFont('Arial','B',11);  
  $pdf->Cell(260,6,'DETALLE FORMAS DE PAGO ',1,1,'C');
  $pdf->SetFont('Arial','',10);  
  $pdf->Cell(60,6,'Forma de pago.',1,0,'C');
  $pdf->Cell(25,6,'Cant. ',1,0,'C');
  $pdf->Cell(35,6,'SubTotal ',1,0,'C');
  $pdf->Cell(35,6,'Propina ',1,0,'C');
  $pdf->Cell(35,6,'Descuentos ',1,0,'C');
  $pdf->Cell(35,6,'Impuestos  ',1,0,'C');
  $pdf->Cell(35,6,'Total Fact ',1,1,'C');

  $fact = 0;
  $neto = 0;
  $impt = 0;
  $prop = 0;
  $tota = 0;
  $desc = 0;

  foreach ($pagos as $detalle) {
    $fact = $fact + 1; 
    $neto = $neto + $detalle['neto'];
    $impt = $impt + $detalle['impto'];
    $prop = $prop + $detalle['prop'];
    $desc = $desc + $detalle['desc'];
    $tota = $tota + $detalle['pagado']-$detalle['cambio'];
    /// $tota = $tota + $detalle['total'];

    $pdf->Cell(60,6,$detalle['descripcion'],1,0,'L');
    $pdf->Cell(25,6,$detalle['cant'],1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['neto'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['prop'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['desc'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['impto'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['pagado']-$detalle['cambio'],2),1,1,'R');
  }
  $pdf->Cell(85,6,'Total',1,0,'C');
  $pdf->Cell(35,6,number_format($neto,2),1,0,'R');
  $pdf->Cell(35,6,number_format($prop,2),1,0,'R');
  $pdf->Cell(35,6,number_format($desc,2),1,0,'R');
  $pdf->Cell(35,6,number_format($impt,2),1,0,'R');
  $pdf->Cell(35,6,number_format($tota,2),1,1,'R');



  $pdf->Ln(5);

  $pdf->SetFont('Arial','B',11);  
  $pdf->Cell(260,6,'DETALLE FORMAS DE PAGO ANULADAS ',1,1,'C');
  $pdf->SetFont('Arial','',10);  
  $pdf->Cell(60,6,'Forma de pago.',1,0,'C');
  $pdf->Cell(25,6,'Cant. ',1,0,'C');
  $pdf->Cell(35,6,'SubTotal ',1,0,'C');
  $pdf->Cell(35,6,'Propina ',1,0,'C');
  $pdf->Cell(35,6,'Descuentos ',1,0,'C');
  $pdf->Cell(35,6,'Impuestos  ',1,0,'C');
  $pdf->Cell(35,6,'Total Fact ',1,1,'C');

  $fact = 0;
  $neto = 0;
  $impt = 0;
  $prop = 0;
  $tota = 0;
  $desc = 0;

  foreach ($pagosAnulados as $detalle) {
    $fact = $fact + 1; 
    $neto = $neto + $detalle['neto'];
    $impt = $impt + $detalle['impto'];
    $prop = $prop + $detalle['prop'];
    $desc = $desc + $detalle['desc'];
    $tota = $tota + $detalle['pagado']-$detalle['cambio'];
    /// $tota = $tota + $detalle['total'];

    $pdf->Cell(60,6,$detalle['descripcion'],1,0,'L');
    $pdf->Cell(25,6,$detalle['cant'],1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['neto'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['prop'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['desc'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['impto'],2),1,0,'R');
    $pdf->Cell(35,6,number_format($detalle['pagado']-$detalle['cambio'],2),1,1,'R');
  }

  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(260,5,'COMANDAS ACTIVAS ',0,1,'C');
  
  $pdf->Ln(2);
  $pdf->Cell(20,6,'Comanda',1,0,'C');
  $pdf->Cell(20,6,'Mesa ',1,0,'C');
  $pdf->Cell(20,6,'PAX. ',1,0,'C');
  $pdf->Cell(40,6,'Usuario',1,0,'C');
  $pdf->Cell(20,6,'Hora',1,1,'C');
  $pdf->SetFont('Arial','',9);

  $comandas = $pos->getComandasActivasCajero($idamb,'A',$user);
  
  $monto  = 0 ;
  $impto  = 0 ;
  $total  = 0 ;
  if(count($comandas)==0){
    $pdf->Ln(2);
    $pdf->Cell(260,5,'SIN COMANDAS ACTIVAS',1,1,'C');
    $pdf->Ln(2);

  }else{
    foreach ($comandas as $comanda) {
      $total = $total + 1 ;
      $pdf->Cell(20,5,$comanda['comanda'],1,0,'C');
      $pdf->Cell(20,5,$comanda['mesa'],1,0,'C');
      $pdf->Cell(20,5,$comanda['pax'],1,0,'C');
      $pdf->Cell(40,5,$comanda['usuario'],1,0,'L');
      $pdf->Cell(20,5,substr($comanda['fecha_comanda'],11,5),1,1,'R');
    }
  }
  $pdf->Cell(100,6,'Total Comandas Activas',1,0,'C');
  $pdf->Cell(20,6,number_format($total,0),1,1,'R');

  $pdf->Ln(5);

  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(260,5,'COMANDAS ANULADAS ',0,1,'C');

  $comandas = $pos->getComandasAnuladasCajero($idamb,'X',$user);

  $monto  = 0 ;
  $impto  = 0 ;
  $total  = 0 ;
  if(count($comandas)==0){
    $pdf->Ln(2);
    $pdf->Cell(190,5,'SIN COMANDAS ANULADAS',0,0,'C');
    $pdf->Ln(2);

  }else{
    $pdf->Ln(2);
    $pdf->Cell(20,6,'Comanda.',1,0,'C');
    $pdf->Cell(20,6,'Mesa ',1,0,'C');
    $pdf->Cell(20,6,'PAX. ',1,0,'C');
    $pdf->Cell(20,6,'Hora',1,0,'C');
    $pdf->Cell(90,6,'Motivo Anulacion',1,1,'C');
    $pdf->SetFont('Arial','',9);
    foreach ($comandas as $comanda) {
      $pdf->Cell(20,5,$comanda['comanda'],1,0,'C');
      $pdf->Cell(20,5,$comanda['mesa'],1,0,'C');
      $pdf->Cell(20,5,$comanda['pax'],1,0,'C');
      $pdf->Cell(20,5,substr($comanda['fecha_anulada'],11,5),1,0,'R');
      $pdf->Cell(90,5,$comanda['motivo_anulada'],1,1,'R');
    }
  }
  $pdf->Ln(3);

  $devoluciones = $pos->getDevolucionUsuario($idamb,$user);

  $monto  = 0 ;
  $impto  = 0 ;
  $total  = 0 ;


  if(count($devoluciones)==0){
    $pdf->Ln(2);
    $pdf->Cell(190,5,'SIN DEVOLUCION DE PRODUCTOS  ',0,0,'C');
    $pdf->Ln(2);

  }else{
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(260,6,'DEVOLUCION DE PRODUCTOS ',0,1,'C');
    $pdf->Ln(2);
    $pdf->Cell(20,6,'Comanda.',1,0,'C');
    $pdf->Cell(20,6,'Mesa ',1,0,'C');
    $pdf->Cell(70,6,'Producto. ',1,0,'C');
    $pdf->Cell(20,6,'Cantidad',1,0,'C');
    $pdf->Cell(100,6,'Motivo Devolucion',1,1,'C');
    $pdf->SetFont('Arial','',9);
    foreach ($devoluciones as $comanda) {
      $pdf->Cell(20,5,$comanda['comanda'],1,0,'C');
      $pdf->Cell(20,5,$comanda['mesa'],1,0,'C');
      $pdf->Cell(70,5,$comanda['nom'],1,0,'L');
      $pdf->Cell(20,5,$comanda['cant'],1,0,'C');
      $pdf->Cell(100,5,$comanda['motivo_devo'],1,1,'L');
    }
  }
  $pdf->Ln(3);

  $file = '../../imprimir/cierres/cierre_Cajero_'.$user.'_'.$fecha.'.pdf';
  $pdf->Output($file,'F');
?>

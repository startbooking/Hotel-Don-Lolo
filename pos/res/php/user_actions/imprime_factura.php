<?php 

	require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
  require '../../../../res/fpdf/fpdf.php';

	clearstatcache();
	$nComa = $_SESSION['NUMERO_COMANDA'];
	$nFact = $_SESSION['NUMERO_FACTURA'];
	$amb   = $_SESSION['AMBIENTE_ID'];
	$pms   = $_SESSION['PMS'];

	include_once('encabezado_impresiones.php');

 	/* Resolucion de Facturacion Factura*/
/*  	$resol = $pos->getResolucionFacturacion($amb);

	$reso = $resol[0]['resolucion'];
	$rfec = $resol[0]['fecha'];
	$rpre = $resol[0]['prefijo'];
	$desd = $resol[0]['desde'];
	$hast = $resol[0]['hasta']; 
	$habi = $resol[0]['tipo'];

	if($habi==1){
		$tipo = "Habilita"; 
	}else{
		$tipo = "Autoriza";
	}
 */
	/* Encabezado de la Factura */
 	/* Numero de Mesa A Imprimir*/
 	$datosFac = $pos->getDatosFactura($amb,$nComa);

	$mes    = $datosFac[0]['mesa'];
	$pax    = $datosFac[0]['pax'];
	$coma   = $datosFac[0]['comanda'];
	$tot    = $datosFac[0]['valor_total'];
	$net    = $datosFac[0]['valor_neto'];
	$imp    = $datosFac[0]['impuesto'];
	$pro    = $datosFac[0]['propina'];
	$pag    = $datosFac[0]['pagado'];
	$cam    = $datosFac[0]['cambio'];
	$fec    = $datosFac[0]['fecha'];
	$usu    = $datosFac[0]['usuario_factura'];
	$cli    = $datosFac[0]['id_cliente'];
	$pms    = $datosFac[0]['pms'];
	$fpago  = $datosFac[0]['forma_pago'];

	/* Datos del Cliente */
	if($pms=='1'){
		$datosCliente = $pos->getDatosHuespedesenCasa($cli);
		$nrohabi      = $datosCliente[0]['num_habitacion'];
	  $file = 'ChequeCuenta_'.$nFact.'.pdf';
	}else{
		$datosCliente = $pos->datosCliente($cli); 
		$identif      = $datosCliente[0]['identificacion'];
	  $file = 'Factura_'.$prefijo.'-'.$nFact.'.pdf';
	}


	$cliente = $datosCliente[0]['apellido1'].' '.$datosCliente[0]['apellido2'].' '.$datosCliente[0]['nombre1'].' '.$datosCliente[0]['nombre2'];

	/* Productos a Imprimir */
	$productosventa = $pos->getProductosVendidosFactura($amb,$coma);

	$na    = 0;
	$val   = 0;
	$desto = 0;
	$subt  = 0;
	$impt  = 0;
	$time  = time();
	$sub   = 0;

	$pdf = new FPDF('P', 'mm', array(100,250));
	$pdf->SetMargins(5, 10 , 5);

  $pdf->AddPage();
  // $pdf->Image('../../../../img/'.$logo,5,10,20);
  $pdf->SetFont('Times','',12);
  /*
  $pdf->Cell(90,7,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(90,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  $pdf->Cell(90,5,TIPOEMPRESA,0,1,'C');
  $pdf->Cell(90,5,utf8_decode(ADRESS_EMPRESA),0,1,'C');
  $pdf->Cell(90,5,utf8_decode(CIUDAD_EMPRESA).' ',0,1,'C');
  $pdf->Cell(90,5,'Telefono '.CELULAR_EMPRESA,0,1,'C');
  */
  $pdf->Cell(90,5,'TIQUETE DE COMPRA',0,1,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(90,7,$_SESSION['NOMBRE_AMBIENTE'],0,1,'C');
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(90,4,'Fecha '.$fec.' Mesa '.$mes,0,1,'L');
  $pdf->Cell(90,4,'Usuario: '.$_SESSION['usuario'],0,1,'L');
  $pdf->Cell(50,4,'Forma de Pago: '.$fpago,0,1,'L');

	if($pms==0){
	  $pdf->Cell(70,4,'Estado de Cuenta Nro:  '.$prefijo.'-'.str_pad($nFact,5,'0',STR_PAD_LEFT),0,1,'L');
	  $pdf->Cell(65,4,'Cliente ' .substr(utf8_decode($cliente),0,20),0,0,'L');
	  $pdf->Cell(25,4,'Iden. '.$identif,0,1,'L');
	}else{
	  $pdf->Cell(70,4,'Cheque Cuenta Nro: '.str_pad($nFact,5,'0',STR_PAD_LEFT),0,1,'L');
	  $pdf->Cell(70,4,'Huesped '.substr(utf8_decode($cliente),0,24),0,0,'L');
	  $pdf->Cell(20,4,' Hab. '.$nrohabi,0,1,'L');
	}
  $pdf->Ln(2);

	$subt = 0;
	$impt = 0;
	$sub  = 0;
	$na   = 0;
	$val  = 0;
	$des  = 0;
	$imp  = 0;

	$pdf->Cell(60,4,'PRODUCTO',0,0,'C');
	$pdf->Cell(10,4,'CANT.',0,0,'C');
	$pdf->Cell(20,4,'VALOR',0,1,'C');
	$pdf->Ln(1);

	foreach ($productosventa as $producto) {
		$na  = $na  + $producto['cant']; 
		$val = $val + $producto['venta']; 
		$pdf->Cell(60,4,substr(utf8_decode($producto['nom']),0,25),0,0,'L');
		$pdf->Cell(10,4,$producto['cant'],0,0,'L');
		$pdf->Cell(20,4,number_format($producto['venta'],2,",","."),0,1,'R');

		$des = $des + $producto['descuento']; 
		$sub = $sub+$producto['venta'];
		$imp = $imp+$producto['valorimpto'];
	}

	$pdf->Ln(3);
	$pdf->Cell(70,4,'Subtotal',0,0,'R');
	$pdf->Cell(20,4,number_format($sub,2,",","."),0,1,'R');
	$pdf->Cell(70,4,'Descuento',0,0,'R');
	$pdf->Cell(20,4,number_format($des,2,",","."),0,1,'R');
	$pdf->Cell(70,4,'IMPOCONSUMO',0,0,'R');
	$pdf->Cell(20,4,number_format($imp,2,",","."),0,1,'R');
	$pdf->Cell(70,4,'Propina',0,0,'R');
	$pdf->Cell(20,4,number_format($pro,2,",","."),0,1,'R');
	$pdf->Ln(2);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(60,4,'Total Cuenta:',0,0,'L');
	$pdf->Cell(30,4,number_format($tot,2,",","."),0,1,'R');
	$pdf->Ln(2);
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(90,4,'Son :'.numtoletras($tot),0,1,'L');

	if($pms==1){
		$pdf->Ln(20);
		$pdf->Cell(90,4,str_repeat('_', 55),0,1,'L');
		$pdf->MultiCell(90,4,'Acepto se incluya en mi cuenta de Alojamiento el Presente Consumo',0,'C');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(90,4,'Firma Huesped',0,1,'C');
	}
	$pdf->Ln(3);
	$fp = fopen("../../../text/propina.txt", "r");
	while(!feof($fp)) {
		$linea = fgets($fp);
		$pdf->MultiCell(90,4,$linea,0,'L');
	}
	fclose($fp);
	$pdf->Ln(3);

	$pdf->Cell(45,4,WEB_EMPRESA,0,0,'L');
	$pdf->Cell(45,4,CORREO_EMPRESA,0,1,'R');

  $pdf->Output('../../../impresiones/'.$file,'F');
  
	echo $file;
?>
 
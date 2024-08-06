<?php 

	require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
  require '../../../../res/fpdf/fpdf.php';


	$nFact  = $_POST['factura'];
	$amb    = $_POST['idAmb'];
	$nomamb = $_POST['nomAmb'];

	$nComa = $pos->buscaComandaHistorico($nFact, $amb);

	include_once('encabezado_impresiones.php');

 	/* Resolucion de Facturacion Factura*/
 	$resol = $pos->getResolucionFacturacion($amb);
 	$pref  = $pos->getPrefijoAmbiente($amb);

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

	/* Encabezado de la Factura */
 	/* Numero de Mesa A Imprimir*/
 	/// echo $nComa;
 	$datosFac = $pos->getDatosHistoricoFactura($amb,$nComa);

 	/// echo print_r($datosFac);

	$mes    = $datosFac[0]['mesa'];
	$pax    = $datosFac[0]['pax'];
	$coma   = $datosFac[0]['comanda'];
	$tot    = $datosFac[0]['valor_total'];
	$net    = $datosFac[0]['valor_neto'];
	$imp    = $datosFac[0]['impuesto'];
	$pro    = $datosFac[0]['propina'];
	$pag    = $datosFac[0]['pagado'];
	$cam    = $datosFac[0]['cambio'];
	$fec    = $datosFac[0]['fecha_factura'];
	$usu    = $datosFac[0]['usuario_factura'];
	$cli    = $datosFac[0]['id_cliente'];
	$pms    = $datosFac[0]['pms'];
	$fpa    = $datosFac[0]['forma_pago'];

	$fpago = $pos->nombrePago($fpa);
	
	/* Datos del Cliente */
	if($pms=='1'){
		$datosCliente = $pos->getDatosHuespedesenCasa($cli);
		$nrohabi      = $datosCliente[0]['num_habitacion'];
	  $file = '../../../impresiones/ChequeCuenta_'.$pref.'_'.$nFact.'.pdf';
	}else{
		$datosCliente = $pos->datosCliente($cli); 
		$identif      = $datosCliente[0]['identificacion'];
	  $file = '../../../impresiones/Factura_'.$pref.'_'.$rpre.'-'.$nFact.'.pdf';
	}
	$cliente = $datosCliente[0]['apellido1'].' '.$datosCliente[0]['apellido2'].' '.$datosCliente[0]['nombre1'].' '.$datosCliente[0]['nombre2'];

	/* Productos a Imprimir */
	/*
	if($pms=='1'){
		$productosventa = $pos->getProductosVendidosOrden($amb,$coma);
	else{
	}*/
	$productosventa = $pos->getHistoricoProductosVendidosFactura($amb,$coma);
	$na    = 0;
	$val   = 0;
	$desto = 0;
	$subt  = 0;
	$impt  = 0;
	$time  = time();
	$sub   = 0;

	$pdf = new FPDF('P', 'mm', array(100,350));
	$pdf->SetMargins(5, 10 , 5);

  $pdf->AddPage();
  $pdf->Image('../../../../img/'.$logo,5,15,15);
  $pdf->SetFont('Times','B',14);
  $pdf->Cell(90,7,(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(90,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  $pdf->Cell(90,5,'Iva Regimen Comun',0,1,'C');
  $pdf->Cell(90,5,'NO SOMOS GRANDES CONTRIBUYENTES',0,1,'C');
  $pdf->Cell(90,5,'NI AGENTES RETENEDORES',0,1,'C');
  $pdf->Cell(90,5,(ADRESS_EMPRESA),0,1,'C');
  $pdf->Cell(90,5,(CIUDAD_EMPRESA.' '.PAIS_EMPRESA),0,1,'C');
  $pdf->Cell(90,5,'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA,0,1,'C');
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(90,7,$nomamb,0,1,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(90,5,'Fecha '.$fec.' Mesa '.$mes,0,1,'L');
  $pdf->Cell(90,5,'Usuario: TIK TAK ',0,1,'L');
  $pdf->Cell(90,5,'Forma de Pago: '.$fpago,0,1,'L');
	if($pms==0){
	  $pdf->Cell(70,5,'Factura de Venta Nro:  '.$rpre.'-'.str_pad($nFact,5,'0',STR_PAD_LEFT),0,1,'L');
	  $pdf->Cell(65,5,'Cliente '.substr($cliente,0,20),0,0,'L');
	  $pdf->Cell(25,5,'Iden. '.$identif,0,1,'L');
	}else{
	  $pdf->Cell(70,5,'Cheque Cuenta Nro: '.str_pad($nFact,5,'0',STR_PAD_LEFT),0,1,'L');
	  $pdf->Cell(70,5,'Huesped '.substr(($cliente),0,22),0,0,'L');
	  $pdf->Cell(20,5,' Hab. '.$nrohabi,0,1,'L');
	}
  $pdf->Ln(2);

		$subt = 0;
		$impt = 0;
		$sub  = 0;
		$na   = 0;
		$val  = 0;
		$des  = 0;
		$imp  = 0;
  $pdf->SetFont('Arial','B',11);

	  $pdf->Cell(60,4,'PRODUCTO',0,0,'C');
	  $pdf->Cell(10,4,'CANT.',0,0,'C');
	  $pdf->Cell(20,4,'VALOR',0,1,'C');
	  $pdf->Ln(1);
  $pdf->SetFont('Arial','',11);

		foreach ($productosventa as $producto) {
	    $na  = $na  + $producto['cant']; 
	    $val = $val + $producto['venta']; 
		  $pdf->Cell(60,5,($producto['nom']),0,0,'L');
		  $pdf->Cell(10,5,$producto['cant'],0,0,'L');
		  $pdf->Cell(20,5,number_format($producto['venta'],2,",","."),0,1,'R');

	    $des = $des + $producto['descuento']; 
			$sub = $sub+$producto['venta'];
			$imp = $imp+$producto['valorimpto'];
		}
	  $pdf->Ln(3);
	  $pdf->Cell(65,5,'Subtotal',0,0,'R');
	  $pdf->Cell(25,5,number_format($sub,2,",","."),0,1,'R');
	  $pdf->Cell(65,5,'Descuento',0,0,'R');
	  $pdf->Cell(25,5,number_format($des,2,",","."),0,1,'R');
	  $pdf->Cell(65,5,'IMPOCONSUMO',0,0,'R');
	  $pdf->Cell(25,5,number_format($imp,2,",","."),0,1,'R');
	  $pdf->Cell(65,5,'Propina',0,0,'R');
	  $pdf->Cell(25,5,number_format($pro,2,",","."),0,1,'R');
	  $pdf->Ln(2);
		$pdf->SetFont('Arial','B',12);
	  $pdf->Cell(60,5,'Total Cuenta:',0,0,'L');
	  $pdf->Cell(30,5,number_format($tot,2,",","."),0,1,'R');
  	$pdf->Ln(2);
		$pdf->SetFont('Arial','',8);
	  $pdf->Cell(90,5,'Son : '.numtoletras($tot),0,1,'L');

	  $pdf->SetFont('Arial','',10);

		if($pms==1){
	  	$pdf->Ln(20);
		  $pdf->Cell(90,5,str_repeat('_', 50),0,1,'L');
			$pdf->MultiCell(90,5,'Acepto se incluya en mi cuenta de Alojamiento el Presente Consumo',0,'C');
		  $pdf->Cell(90,4,'Firma Huesped',0,1,'C');
		}
  	$pdf->Ln(3);

		if($pms=='0'){
			$pdf->MultiCell(90,5,'Resolucion de Facturacion Dian Nro '.$reso.' de '.$rfec.' '.$tipo.' Desde '.$rpre.'-'.$desd.' Hasta '.$rpre.'-'.number_format($hast,0),1,'C');
		  $pdf->Ln(3);
		}
		$fp = fopen("../../../text/propina.txt", "r");
		while(!feof($fp)) {
			$linea = fgets($fp);
		  $pdf->MultiCell(90,4,$linea,0,'C');
		}
		fclose($fp);
  	$pdf->Ln(3);

	  $pdf->SetFont('Arial','',9);
	  $pdf->Cell(45,4,WEB_EMPRESA,0,0,'L');
	  $pdf->Cell(45,4,CORREO_EMPRESA,0,1,'R');

  $pdf->Output($file,'F');
  $pdf->Output();
?>
 
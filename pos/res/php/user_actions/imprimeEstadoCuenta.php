<?php 

  require '../../../../res/php/app_topPos.php'; 
  require '../../../../res/fpdf/fpdf.php';

	$nComa  = $_POST['cuenta'];
	$fec    = $_POST['fecha'];
	$amb    = $_POST['idamb'];
	$nomamb = $_POST['ambie'];
	$user   = $_POST['user'];


	include_once('encabezado_impresiones.php');

 	/* Resolucion de Facturacion Factura*/
 	$pref  = $pos->getPrefijoAmbiente($amb);

	/* Encabezado de la Factura */
 	/* Numero de Mesa A Imprimir*/

	$datosFac = $pos->getDatosComanda($nComa, $amb);
	
	$mesa     = $datosFac[0]['mesa'];
	$pax      = $datosFac[0]['pax'];
	
	/* Datos del Cliente */
  $file = '../../../impresiones/estadoCuenta_'.$pref.'_'.$nComa.'.pdf';
	$nameImpr     = 'estadoCuenta_'.$pref.'_'.$nComa.'.pdf';

	$productosventa = $pos->getProductosEstadoCuenta($amb,$nComa);
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
  $pdf->Image('../../../../img/'.$logo,5,10,20);
  $pdf->SetFont('Times','',14);
  
  $pdf->Cell(90,5,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(90,5,'NIT: '.NIT_EMPRESA,0,1,'C');
  /*
  $pdf->Cell(90,5,'Iva Regimen Comun',0,1,'C');
  $pdf->Cell(90,5,'NO SOMOS GRANDES CONTRIBUYENTES',0,1,'C');
  $pdf->Cell(90,5,'NI AGENTES RETENEDORES',0,1,'C');
  $pdf->Cell(90,5,utf8_decode(ADRESS_EMPRESA),0,1,'C');
  $pdf->Cell(90,5,utf8_decode(CIUDAD_EMPRESA),0,1,'C');
  $pdf->Cell(90,5,'Telefono '.CELULAR_EMPRESA,0,1,'C');
  $pdf->Cell(90,5,$nomamb,0,1,'C');
  $pdf->SetFont('Arial','',8);
  $pdf->Cell(50,7,'TIKTAK CAFE ',0,1,'C');
   */
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(90,7,'Fecha '.$fec.' Mesa '.$mesa,0,1,'L');
  $pdf->Cell(90,5,'Usuario: '.$user,0,1,'L');
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(90,7,'ESTADO DE CUENTA',0,1,'C');
  $pdf->SetFont('Arial','',12);  
  $pdf->Ln(2);

	$subt = 0;
	$impt = 0;
	$sub  = 0;
	$na   = 0;
	$val  = 0;
	$des  = 0;
	$imp  = 0;
	$pro  = 0;

  $pdf->SetFont('Arial','',10);

  $pdf->Cell(60,5,'PRODUCTO',0,0,'C');
  $pdf->Cell(10,5,'CANT.',0,0,'R');
  $pdf->Cell(20,5,'VALOR',0,1,'C');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','',10);

		foreach ($productosventa as $producto) {
	    $na  = $na  + $producto['cant']; 
	    $val = $val + $producto['venta']; 
			// $pdf->MultiCell(60,4,utf8_decode($producto['nom']),0,'L');
			/* 	
		  $pdf->Cell(60,4,utf8_decode(substr($producto['nom'],0,23)),0,0,'L');
		  $pdf->Cell(20,4,$producto['cant'],0,0,'R');
		  $pdf->Cell(10,4,number_format($producto['venta'],2,",","."),0,1,'R');
 			*/
			$pdf->Cell(60,5,substr(utf8_decode($producto['nom']),0,25),0,0,'L');
		  $pdf->Cell(10,5,$producto['cant'],0,0,'L');
		  $pdf->Cell(20,5,number_format($producto['venta'],2,",","."),0,1,'R');

			$imp = $imp+$producto['valorimpto'];
	    $des = $des + $producto['descuento']; 
			$sub = $sub+$producto['venta'];
			$tot= $sub + $imp - $des;
		}
	  $pdf->Ln(3);
	  $pdf->Cell(70,5,'Subtotal',0,0,'R');
	  $pdf->Cell(20,5,number_format($sub,2,",","."),0,1,'R');
	  $pdf->Cell(70,5,'Descuento',0,0,'R');
	  $pdf->Cell(20,5,number_format($des,2,",","."),0,1,'R');
	  /*	  
	  $pdf->Cell(65,5,'IMPOCONSUMO',0,0,'R');
	  $pdf->Cell(25,5,number_format($imp,2,",","."),0,1,'R');
	   */
	  $pdf->Cell(70,5,'Propina',0,0,'R');
	  $pdf->Cell(20,5,number_format($pro,2,",","."),0,1,'R');
	  $pdf->Ln(2);
		$pdf->SetFont('Arial','',10);
	  $pdf->Cell(70,5,'Total Cuenta:',0,0,'R');
	  $pdf->Cell(20,5,number_format($tot,2,",","."),0,1,'R');
  	$pdf->Ln(2);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(90,4,'Son :'.numtoletras($tot),0,1,'L');
	  /*
	  $pdf->Cell(45,5,'Son : '.numtoletras($tot),0,1,'L');
	  
	  $pdf->SetFont('Arial','',10);
		$fp = fopen("../../../text/propina.txt", "r");
		while(!feof($fp)) {
			$linea = fgets($fp);
		  $pdf->MultiCell(90,4,$linea,0,'C');
		}
		fclose($fp);
	   */
  	$pdf->Ln(3);

	  $pdf->SetFont('Arial','',6);
	  $pdf->Cell(45,4,WEB_EMPRESA,0,0,'L');
	  $pdf->Cell(45,4,CORREO_EMPRESA,0,1,'R');

  $pdf->Output($file,'F');
  echo  $nameImpr ;
  
?>
 
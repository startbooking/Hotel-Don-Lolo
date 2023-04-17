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
	$abonos   = $datosFac[0]['abonos'];

	
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

	$pdf = new FPDF('P', 'mm', array(50,350));
	$pdf->SetMargins(0, 3 , 0);
 
  $pdf->AddPage();
  $pdf->Image('../../../../img/'.LOGO,2,5,9);
  $pdf->SetFont('Arial','B',8);
  
  $pdf->Cell(50,4,$nomamb,0,1,'C');
  // $pdf->Cell(50,4,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(50,3,'NIT: '.NIT_EMPRESA,0,1,'C');
/*   $pdf->Cell(50,5,'Iva Regimen Comun',0,1,'C');
  $pdf->Cell(50,5,'NO SOMOS GRANDES CONTRIBUYENTES',0,1,'C');
  $pdf->Cell(50,5,'NI AGENTES RETENEDORES',0,1,'C');
 */  
	$pdf->Cell(50,3,utf8_decode(ADRESS_EMPRESA),0,1,'C');
  $pdf->Cell(50,3,utf8_decode(CIUDAD_EMPRESA.' '.PAIS_EMPRESA),0,1,'C');
  $pdf->Cell(50,3,'Movil '.CELULAR_EMPRESA,0,1,'C');
	$pdf->SetFont('Arial','B',8);
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(50,3,'Fecha '.$fec.' Mesa '.$mesa,0,1,'L');
  $pdf->Cell(50,3,'Usuario: '.$user,0,1,'L');
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(50,4,'ESTADO DE CUENTA',0,1,'C');
  $pdf->SetFont('Arial','',7);  
  $pdf->Ln(1);

	$subt = 0;
	$impt = 0;
	$sub  = 0;
	$na   = 0;
	$val  = 0;
	$des  = 0;
	$imp  = 0;
	$pro  = 0;

  $pdf->SetFont('Arial','B',7);

  $pdf->Cell(45,4,'PRODUCTO',0,1,'L');
  $pdf->Cell(30,4,'CANT.',0,0,'R');
  $pdf->Cell(15,4,'VALOR',0,1,'R');
  $pdf->Ln(1);
  $pdf->SetFont('Arial','',7);

		foreach ($productosventa as $producto) {
	    $na  = $na  + $producto['cant']; 
	    $val = $val + $producto['venta']; 
			$pdf->MultiCell(45,4,utf8_decode($producto['nom']),0,'L');
		  $pdf->Cell(30,4,$producto['cant'],0,0,'R');
		  $pdf->Cell(15,4,number_format($producto['venta'],2,",","."),0,1,'R');

			$imp = $imp+$producto['valorimpto'];
	    $des = $des + $producto['descuento']; 
			$sub = $sub+$producto['venta'];
			$tot = $sub + $imp - $des;
		}

		$tot = $tot - $abonos;
	  $pdf->Ln(1);
	  $pdf->Cell(25,4,'Subtotal',0,0,'R');
	  $pdf->Cell(20,4,number_format($sub,2,",","."),0,1,'R');
	  $pdf->Cell(25,4,'Descuento',0,0,'R');
	  $pdf->Cell(20,4,number_format($des,2,",","."),0,1,'R');
	  /*	  
	  $pdf->Cell(65,5,'IMPOCONSUMO',0,0,'R');
	  $pdf->Cell(25,5,number_format($imp,2,",","."),0,1,'R');
	   */
	  $pdf->Cell(25,4,'Propina',0,0,'R');
	  $pdf->Cell(20,4,number_format($pro,2,",","."),0,1,'R');
	  // $pdf->Ln(1);
	  $pdf->Cell(25,4,'Abonos',0,0,'R');
	  $pdf->Cell(20,4,number_format($abonos,2,",","."),0,1,'R');
	  $pdf->Ln(1);
		$pdf->SetFont('Arial','B',7);
	  $pdf->Cell(25,4,'Total Cuenta:',0,0,'L');
	  $pdf->Cell(20,4,number_format($tot,2,",","."),0,1,'R');
  	$pdf->Ln(2);
		$pdf->SetFont('Arial','',5);
	  $pdf->MultiCell(45,4,'Son :'.numtoletras($tot),0,'L');
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
	  // $pdf->Cell(23,4,WEB_EMPRESA,0,0,'L');
	  // $pdf->Cell(23,4,CORREO_EMPRESA,0,1,'R');

  $pdf->Output($file,'F');
  echo  $nameImpr ;
  
?>
 
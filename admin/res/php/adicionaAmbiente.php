<?php 
  
  require_once '../../../res/php/app_topAdmin.php'; 
	require_once '../../../res/phpqrcode/qrlib.php';

	$ambiente = strtoupper($_POST['nombreAdi']);
	$prefijo  = strtoupper($_POST['prefijoAdi']);
	$impto    = $_POST['imptoOption'];
	$factura  = $_POST['facturaAdi'];
	$orden    = $_POST['ordenAdi'];
	$comanda  = $_POST['comandaAdi'];
	$venta    = $_POST['ventaAdi'];
	$propina  = $_POST['propinaAdi'];
	$bodega   = $_POST['BodegaAdi'];
	$centro   = $_POST['centroAdi'];

	$name     = $_FILES['logoAdi']['name']; 
	$name_img = $_FILES['logoAdi']; 

	$logo        = $name;
	$directorio  = '../../../img/';
	$file_name   = $_FILES['logoAdi']['name'];
	$source      = $_FILES["logoAdi"]["tmp_name"];      
	$target_path = $directorio.$file_name;
	$fechaaud    = date('Y-m-d');

	$aFile       = crearThumbJPEG($source,$target_path,90,90,90); 	

	$adi = $admin->adicionaAmbiente($ambiente, $prefijo, $impto, $factura, $orden, $comanda, $venta, $propina, $bodega, $centro, $logo, $fechaaud);

	$url     = 'http://'.$_SERVER["SERVER_NAME"].'/encuestas.php?ambiente='.$adi;

	$filename       = '../../../pos/images/QRFiles/'.$adi.'.png';
	$CorectionError = "L";
	$tamCodeQR      = 10;


	QRcode::png($url, $filename, $CorectionError, $tamCodeQR, 2);

	echo $adi;


 ?>

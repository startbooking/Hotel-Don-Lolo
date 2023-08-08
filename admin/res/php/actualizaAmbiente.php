<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

	$id       = $_POST['idAmbienteMod'];
	$ambiente = strtoupper($_POST['nombreMod']);
	$prefijo  = strtoupper($_POST['prefijoMod']);
	$impto    = $_POST['imptoOption'];
	$factura  = $_POST['facturaMod'];
	$orden    = $_POST['ordenMod'];
	$comanda  = $_POST['comandaMod'];
	$venta    = $_POST['ventaMod'];
	$propina  = $_POST['propinaMod'];
	$bodega   = $_POST['BodegaMod'];
	$centro   = $_POST['centroMod'];
	$logoAnt  = $_POST['imgLogoMod'];

	$name     = $_FILES['logoAdi']['name']; 
	$name_img = $_FILES['logoAdi']; 

	
	if($name==''){
		$logo = $logoAnt;
	}else{
		$logo        = $name;
		$directorio  = '../../../img/';
		$file_name   = $_FILES['logoAdi']['name'];
		$source      = $_FILES["logoAdi"]["tmp_name"];      
		$target_path = $directorio.$file_name;
		$aFile       = crearThumbJPEG($source,$target_path,90,90,90); 	
  }

	$act = $admin->actualizaAmbiente($id, $ambiente, $prefijo, $impto, $factura, $orden, $comanda, $venta, $propina, $bodega, $centro, $logo);

	echo $act;


 ?>

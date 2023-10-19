<?php 
	session_start();
/* 	error_reporting(E_ALL); 
	ini_set('display_errors', '1');
 */  
	setlocale(LC_ALL,"es_CO.utf8","es_CO","esp")  ;
  date_default_timezone_set("America/Bogota");
	header('Content-Type: text/html');

  require_once 'rutas.php'; 
	require_once 'functionsAdmin.php';
	require_once 'functionsFE.php';
	require_once 'functionsHotel.php';	
	require_once 'funciones.php';
  require_once 'functionsInventario.php';

  $admin   = new Hotel_Admin();
  $user    = new User_Actions();
  $hotel   = new Hotel_Actions();
	$inven   = new Inventario_User(); 
  // $userFE  = new UserFE_Actions();

  $empresa = $admin->getInfoCia();
  $datosHotel = $admin->getDatosHotel();


  define("NAME_EMPRESA", $empresa[0]['empresa']);
  define("NIT_EMPRESA", $empresa[0]['nit'].'-'.$empresa[0]['dv']);
  define("ADRESS_EMPRESA", $empresa[0]['direccion']);
  define("TELEFONO_EMPRESA",$empresa[0]['telefonos']);
  define("CELULAR_EMPRESA", $empresa[0]['celular']);
  define("CODIGO_PAIS_EMPRESA", $empresa[0]['pais']);
  define("WEB_EMPRESA", $empresa[0]['web']);
  define("CORREO_EMPRESA", $empresa[0]['correo']);
  define("LOGO", $empresa[0]['logo']);
  define("TIPO_DOC", $empresa[0]['tipo_empresa']);
  define("CIIU", $empresa[0]['codigo_ciiu']);
  define("TIPOEMPRESA", $admin->getTypeCia($empresa[0]['tipo_empresa']));
  define('PAIS_EMPRESA', $hotel->getLandName($empresa[0]['pais']));
  define('CIUDAD_EMPRESA', $hotel->getCityName($empresa[0]['ciudad']));
  define('TIPOEMPRESA', $hotel->getTypeCia($empresa[0]['tipo_empresa']));
  define('MAIL_HOTEL', $datosHotel[0]['email']);
  define('ACTIVIDAD', $datosHotel[0]['actividad']);


  // define('REGIMEN', TIPOEMPRESA);

	
	if(isset($_GET['section']) && $_GET['section'] == 'proveedores' || isset($_GET['section']) && $_GET['section'] == 'nuevoDocumento'){
		$proveedores = $user->getCompanias(); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'productos'){
		$productos = $user->getCodigosVentas(4); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'formasPago'){
		$pagos = $user->getFormasPago(); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'docSoporte'){
		$documentos = $user->getDocumentoSoporte(); 
    // echo print_r($documentos);
  }

 ?> 
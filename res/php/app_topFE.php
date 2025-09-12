<?php 
	session_start();
 	// error_reporting(E_ALL); 
	// ini_set('display_errors', '1');

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

  $empresa = $admin->getInfoCia();
  $datosHotel = $admin->getDatosHotel();

  define("NAME_EMPRESA", $empresa['empresa']);
  define("NIT_EMPRESA", $empresa['nit'].'-'.$empresa['dv']);
  define("ADRESS_EMPRESA", $empresa['direccion']);
  define("TELEFONO_EMPRESA",$empresa['telefonos']);
  define("CELULAR_EMPRESA", $empresa['celular']);
  define("CODIGO_PAIS_EMPRESA", $empresa['pais']);
  define("WEB_EMPRESA", $empresa['web']);
  define("CORREO_EMPRESA", $empresa['correo']);
  define("LOGO", $empresa['logo']);
  define("TIPO_DOC", $empresa['tipo_empresa']);
  define("CIIU", $empresa['codigo_ciiu']);
  define("TIPOEMPRESA", $admin->getTypeCia($empresa['tipo_empresa']));
  define('PAIS_EMPRESA', $empresa['descripcion']);
  define('CIUDAD_EMPRESA', $empresa['municipio']);
  define('MAIL_HOTEL', $datosHotel[0]['email']);
  define('ACTIVIDAD', $datosHotel[0]['actividad']);

	if(isset($_GET['section']) && $_GET['section'] == 'proveedores' || isset($_GET['section']) && $_GET['section'] == 'nuevoDocumento'){
		$proveedores = $user->getCompanias(); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'productos'){
		$productos = $user->getCodigosVentas(4); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'formasPago'){
		$pagos = $user->getFormasPago(); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'docSoporte'){
		$documentos = $user->getDocumentoSoporte();    
  }traeRecaudosCartera

 ?> 
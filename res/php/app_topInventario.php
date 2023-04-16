<?php 
	session_start();
	error_reporting(E_ALL); 
	ini_set('display_errors', '1');
  setlocale(LC_ALL,"es_CO.utf8","es_CO","esp")  ;
  date_default_timezone_set("America/Bogota");

	require_once 'rutas.php'; 
	require_once 'functionsAdmin.php';
	require_once 'functionsInventario.php';
	require_once 'funciones.php';
	require_once 'funcionesInventario.php';

	$admin   = new Hotel_Admin();
	$inven   = new Inventario_User();
	
	$empresa = $admin->getInfoCia();

	define("NAME_EMPRESA", $empresa[0]['empresa']);
	define("NIT_EMPRESA", $empresa[0]['nit'].'-'.$empresa[0]['dv']);
	define("ADRESS_EMPRESA", $empresa[0]['direccion']);
	define("TELEFONO_EMPRESA",$empresa[0]['telefonos']);
	define("CELULAR_EMPRESA", $empresa[0]['celular']);
	define("CODIGO_PAIS_EMPRESA", $empresa[0]['pais']);
	define("PAIS_EMPRESA", $inven->getLandName($empresa[0]['pais']));
	define("CIUDAD_EMPRESA", $inven->getCityName($empresa[0]['ciudad']));
	define("WEB_EMPRESA", $empresa[0]['web']);
	define("CORREO_EMPRESA", $empresa[0]['correo']);
	define("LOGO", $empresa[0]['logo']);
	define("TIPO_DOC", $empresa[0]['tipo_empresa']);
	define("CIIU", $empresa[0]['codigo_ciiu']);
	define("TIPOEMPRESA", $admin->getTypeCia($empresa[0]['tipo_empresa']));

	if(!isset($_GET['section'])){
	}elseif(isset($_GET['section']) && $_GET['section'] == 'home'){
	}elseif(isset($_GET['section']) && $_GET['section'] == 'productos'){
  	$productos = $inven->getProductos(); 
	}elseif(isset($_GET['section']) && $_GET['section'] == 'proveedores'){
  	$proveedores = $inven->getCompanias(); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'formasdePago'){
  $pagos = $admin->getCodigosVentas(3); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'deptos'){
  	$deptos = $admin->getDeptosAreas(); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'centrosdeCosto'){
  	$centros = $admin->getCentrosCosto(); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'bodegas'){
		$bodegas = $admin->getBodegas();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'unidades'){
		$unidades = $admin->getUnidadesMedida();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'familias'){
		$familias = $admin->getFamiliasInventarios();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'grupos'){
		$grupos  = $admin->getGruposInventarios();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'subgrupos'){
		$subgrupos = $admin->getSubGruposInventarios();
	}


 ?> 
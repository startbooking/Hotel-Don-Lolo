<?php 
	/// session_start();
	error_reporting(E_ALL);
	// ini_set('display_errors', '1');
  setlocale(LC_ALL,"es_CO.utf8","es_CO","esp")  ;
  date_default_timezone_set("America/Bogota");

	require 'functions.php';
	require 'funciones.php';
	require 'rutas.php';

	$user    = new User_Actions();

	$empresa = $user->getInfoCia();

	define("NAME_EMPRESA", $empresa[0]['empresa']);

	$nit = number_format($empresa[0]['nit'],0);
	$nit = str_replace(",",".",$nit);

	define("NIT_EMPRESA", $nit.'-'.$empresa[0]['dv']);
	define("ADRESS_EMPRESA", $empresa[0]['direccion']);
	define("TELEFONO_EMPRESA",$empresa[0]['telefonos']);
	define("CELULAR_EMPRESA", $empresa[0]['celular']);
	define("PAIS_EMPRESA", $empresa[0]['pais']);
	define("CIUDAD_EMPRESA", $empresa[0]['ciudad']);
	define("WEB_EMPRESA", $empresa[0]['web']);
	define("CORREO_EMPRESA", $empresa[0]['correo']);
	define("LOGO_EMPRESA", $empresa[0]['logo']);
	define("TIPO_DOC", $empresa[0]['tipo_empresa']);
	define("CIIU", $empresa[0]['codigo_ciiu']);
	define("IP_ACCESS", $empresa[0]['ip_acceso']);
	define("TIPOEMPRESA", $user->getTypeCia($empresa[0]['tipo_empresa']));
	define("CMS", $empresa[0]['cms']);
	define("MMTO", $empresa[0]['mantenimiento']);

?>
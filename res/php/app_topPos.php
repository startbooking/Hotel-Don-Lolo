<?php 
	session_start();
	error_reporting(E_ALL); 
	ini_set('display_errors', '1');
  setlocale(LC_ALL,"es_CO.utf8","es_CO","esp")  ;
  setlocale(LC_MONETARY,"es_CO");
  date_default_timezone_set("America/Bogota");
	
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 
	require 'functionsPos.php';
	require 'functionsAdmin.php';
	require 'funcionesPos.php';
	require 'funciones.php'; 
	require 'rutas.php';
	
	$pos      = new Pos_Actions();
	$admin    = new Hotel_Admin();
	$empresa  = $admin->getInfoCia();

	define("NAME_EMPRESA", $empresa[0]['empresa']);
	define("NIT_EMPRESA", $empresa[0]['nit'].'-'.$empresa[0]['dv']);
	define("ADRESS_EMPRESA", $empresa[0]['direccion']);
	define("TELEFONO_EMPRESA",$empresa[0]['telefonos']);
	define("CELULAR_EMPRESA", $empresa[0]['celular']);
	define("ID_PAIS_EMPRESA", $empresa[0]['pais']);
	define("PAIS_EMPRESA", $pos->getLandName($empresa[0]['pais']));
	define("CIUDAD_EMPRESA", $pos->getCityName($empresa[0]['ciudad']));
	define("WEB_EMPRESA", $empresa[0]['web']);
	define("CORREO_EMPRESA", $empresa[0]['correo']);
	define("CIIU", $empresa[0]['codigo_ciiu']);
	define("REGIMEN", $empresa[0]['tipo_empresa']);
	define("TIPOEMPRESA", $pos->getTypeCia($empresa[0]['tipo_empresa']));

?> 
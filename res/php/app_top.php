<?php 
	/// session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
  setlocale(LC_ALL,"es_CO.utf8","es_CO","esp")  ;
  date_default_timezone_set("America/Bogota");

	require 'functions.php';
	require 'funciones.php';
	require 'rutas.php';

	$user    = new User_Actions();
	$empresa = $user->getInfoCia();

	define("NAME_EMPRESA", $empresa['empresa']);
	$pc = gethostname();
	$ip = $_SERVER['REMOTE_ADDR'];
	$nit = number_format($empresa['nit'],0);
	$nit = str_replace(",",".",$nit);

	define("NIT_EMPRESA", $nit.'-'.$empresa['dv']);
	define("ADRESS_EMPRESA", $empresa['direccion']);
	define("TELEFONO_EMPRESA",$empresa['telefonos']);
	define("CELULAR_EMPRESA", $empresa['celular']);
	define("PAIS_EMPRESA", $empresa['descripcion']);
	define("CIUDAD_EMPRESA", $empresa['municipio']);
	define("WEB_EMPRESA", $empresa['web']);
	define("CORREO_EMPRESA", $empresa['correo']);
	define("LOGO_EMPRESA", $empresa['logo']);
	define("TIPO_DOC", $empresa['tipo_empresa']);
	define("CIIU", $empresa['codigo_ciiu']);
	define("IP_ACCESS", $empresa['ip_acceso']);
	define("TIPOEMPRESA", $empresa['tipoEmpresa']);
	define("CMS", $empresa['cms']);
	define("MMTO", $empresa['mantenimiento']);

?>
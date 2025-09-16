<?php 
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
  setlocale(LC_ALL,"es_CO.utf8","es_CO","esp")  ;
  date_default_timezone_set("America/Bogota");

	require 'rutas.php'; 

	require 'funciones.php';
	require 'functionsAdmin.php';
	require 'funcionesAdmin.php';
	require 'functionsHotel.php'; 
	require 'funcionesHotel.php';

	$admin  = new Hotel_Admin();
	$hotel  = new Hotel_Actions(); 

	$datosHotel = $admin->getDatosHotel(); 
	$empresa    = $admin->getInfoCia();

  define('FECHA_PMS', $datosHotel[0]['fecha_auditoria']);
  define('CTA_DEPOSITO', $datosHotel[0]['cuenta_depositos']);
  define('CTA_CARGOS_PERD', $datosHotel[0]['cuenta_cargos_perdidos']);
  define('CTA_CARTERA', $datosHotel[0]['cuenta_cartera']);
	define("NAME_HOTEL", $datosHotel[0]['nombre_hotel']);
	define("NIT_HOTEL", $datosHotel[0]['nit_hotel'].'-'.$datosHotel[0]['nit_hotel']);
	define("MAIL_HOTEL", $datosHotel[0]['email']);
	define("IVA_INCLUIDO", $datosHotel[0]['iva_incluido']);
  define("MMTO", $datosHotel[0]['mantenimiento']);
	define("ADRESS_HOTEL", $datosHotel[0]['direccion']);
	define("PHONE_HOTEL", $datosHotel[0]['telefono']);
	define("FAX_HOTEL", $datosHotel[0]['fax']);
	define("MOVIL_HOTEL", $datosHotel[0]['celular']);
	define("CITY_HOTEL", $datosHotel[0]['ciudad']);
	define("LAND_HOTEL", $datosHotel[0]['pais']);
	define("CTA_MASTER", $datosHotel[0]['codigo_cta_master']);
	define("DEMO", $datosHotel[0]['hoteldemo']);
	define("NAME_EMPRESA", $empresa['empresa']);
	define("NIT_EMPRESA", $empresa['nit'].'-'.$empresa['dv']);
	define("ADRESS_EMPRESA", $empresa['direccion']);
	define("TELEFONO_EMPRESA",$empresa['telefonos']);
	define("CELULAR_EMPRESA", $empresa['celular']);
	define('PAIS_EMPRESA', $empresa['descripcion']);
	define('CIUDAD_EMPRESA', $empresa['municipio']);
	define("WEB_EMPRESA", $empresa['web']);
	define("CORREO_EMPRESA", $empresa['correo']);
	define("TIPO_DOC", $empresa['tipo_empresa']);
	define("CIIU", $empresa['codigo_ciiu']);
	define("TIPOEMPRESA", $admin->getTypeCia($empresa['tipo_empresa']));
	// define("TIPOEMPRESA", $admin->getTypeCia($empresa['tipo_empresa']));

	define("POS", $empresa['posMod']);
	define("INV", $empresa['invMod']);
	define("PMS", $empresa['pmsMod']);
	define("RES", $empresa['resMod']);
	define("FE", $empresa['feMod']);

	if(!isset($_GET['section'])){
	}elseif(isset($_GET['section']) && $_GET['section'] == 'home'){
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'dataCompany'){
 	}elseif(isset($_GET['section']) && $_GET['section'] == 'usuarios'){
  	$usuarios = $admin->getUsuariosSistema(); 
	}elseif(isset($_GET['section']) && $_GET['section'] == 'impuestos'){
  	$impuestos = $admin->getCodigosImptos(2);
  	$imptosDian = $admin->impuestosDian();
	}elseif(isset($_GET['section']) && $_GET['section'] == 'retenciones'){
  	$retenciones = $admin->getRetenciones();
  	$imptosDian = $admin->impuestosDian();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'formasdePago'){
  	$pagos = $admin->getCodigosFormasPago(3);
		$medios = $admin->traeMediosPago();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'deptos'){
  	$deptos = $admin->getDeptosAreas(); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'centrosdeCosto'){
  	$centros = $admin->getCentrosCosto(); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'bodegas'){
		$bodegas = $admin->getBodegas();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'ciudades'){
		$ciudades = $admin->getCiudades();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'unidades'){  
		$unidades = $admin->getUnidadesMedida();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'familias'){ 
		$familias = $admin->getFamiliasInventarios(); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'gruposInventario'){
		$grupos  = $admin->getGruposInventarios();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'subgrupos'){
		$subgrupos = $admin->getSubGruposInventarios();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'conversiones'){
		$conversiones = $admin->getConversionesUnidades();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'tipoMovimientos'){
		$tiposmovi = $admin->getTipoMovimientos();
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'agrupaciones'){
		$agrupaciones = $admin->getAgrupaciones();
	}elseif(isset($_GET['section']) && $_GET['section'] == 'codigosVentas'){ 
  	$codigos  = $admin->getCodigosVentas(1); 
	}elseif(isset($_GET['section']) && $_GET['section'] == 'interfacePMS'){ 
		$interfaces  = $admin->interfacePMS();
	  $ambientes = $admin->getAmbientes();
	}elseif(isset($_GET['section']) && $_GET['section'] == 'tipoHabitaciones'){ 
  	$tiposhab = $admin->getTipoHabitacion();  
	}elseif(isset($_GET['section']) && $_GET['section'] == 'sectoresHabitacion'){ 
  	$sectores = $admin->getSectorHabitacion(); 
	}elseif(isset($_GET['section']) && $_GET['section'] == 'habitaciones'){ 
  	$rooms = $admin->getHabitaciones(); 
	}elseif(isset($_GET['section']) && $_GET['section'] == 'paquetes'){ 
  	$paquetes = $admin->getPaquetes(); 
	}elseif(isset($_GET['section']) && $_GET['section'] == 'gruposTarifa'){ 
  	$tarifas = $admin->getTarifas();  
	}elseif(isset($_GET['section']) && $_GET['section'] == 'ambientes'){ 
  	$ambientes = $admin->getAmbientes(); 
	}elseif(isset($_GET['section']) && $_GET['section'] == 'tiposdePlatos'){ 
		$tipos     = $admin->getTipoPlatos(); 
		$ambientes = $admin->getAmbientes(); 
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'formasPagoPos'){
  	$pagos = $admin->getFormasPagoPos(); 
	}elseif(isset($_GET['section']) && $_GET['section'] == 'tiposdePlato'){ 
		$ambientes = $admin->getAmbientes(); 
		$tipos     = $admin->getTipoPlatos();  
	}elseif(isset($_GET['section']) && $_GET['section'] == 'equipos'){ 
  	$equipos = $admin->getAccesoDirecciones(); 
	}elseif(isset($_GET['section']) && $_GET['section'] == 'descuentos'){ 
		$ambientes  = $admin->getAmbientes(); 
		$descuentos = $admin->getDescuentos(); 
	}elseif(isset($_GET['section']) && $_GET['section'] == 'periodos'){ 
		$ambientes = $admin->getAmbientes(); 
		$periodos  = $admin->getPeriodos(); 
	}elseif(isset($_GET['section']) && $_GET['section'] == 'resolucionHotel'){ 
  	$resoluciones = $admin->getResoluciones(1); 	
	}


 ?> 
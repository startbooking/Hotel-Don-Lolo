<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

setlocale(LC_ALL, 'es_CO.utf8', 'es_CO', 'esp');
date_default_timezone_set('America/Bogota');

require_once 'rutas.php';
require_once 'functionsAdmin.php';
require_once 'functionsHotel.php';
require_once 'funciones.php';
require_once 'funcionesHotel.php';

$hotel = new Hotel_Actions();
$admin = new Hotel_Admin();

$datosHotel = $admin->getDatosHotel();
$empresa    = $admin->getInfoCia();

define('DEV', '1');
define('FECHA_PMS', $datosHotel[0]['fecha_auditoria']);
define('CTA_DEPOSITO', $datosHotel[0]['cuenta_depositos']);
define('CTA_CARGOS_PERD', $datosHotel[0]['cuenta_cargos_perdidos']);
define('CTA_CARTERA', $datosHotel[0]['cuenta_cartera']);
define('NAME_HOTEL', $datosHotel[0]['nombre_hotel']);
define('NIT_HOTEL', $datosHotel[0]['nit_hotel'] . '-' . $datosHotel[0]['dv_hotel']);
define('MAIL_HOTEL', $datosHotel[0]['email']);
// define('IVA_INCLUIDO', $datosHotel[0]['iva_incluido']);
define('MMTO', $datosHotel[0]['mantenimiento']);
define('ADRESS_HOTEL', $datosHotel[0]['direccion']);
define('PHONE_HOTEL', $datosHotel[0]['telefono']);
define('FAX_HOTEL', $datosHotel[0]['fax']);
define('MOVIL_HOTEL', $datosHotel[0]['celular']);
define('CITY_HOTEL', $datosHotel[0]['ciudad']);
define('LAND_HOTEL', $datosHotel[0]['pais']);
define('CTA_MASTER', $datosHotel[0]['codigo_cta_master']);
define('DEMO', $datosHotel[0]['hoteldemo']);

define('IVA_INCLUIDO', $empresa[0]['impto_incl']);
define('NAME_EMPRESA', $empresa[0]['empresa']);
define('NIT_EMPRESA', $empresa[0]['nit'] . '-' . $empresa[0]['dv']);
define('NIT', $empresa[0]['nit']);
define('ADRESS_EMPRESA', $empresa[0]['direccion']);
define('TELEFONO_EMPRESA', $empresa[0]['telefonos']);
define('CELULAR_EMPRESA', $empresa[0]['celular']);
define('ID_PAIS_EMPRESA', $empresa[0]['pais']);
define('PAIS_EMPRESA', $hotel->getLandName($empresa[0]['pais']));
define('CIUDAD_EMPRESA', $hotel->getCityName($empresa[0]['ciudad']));
define('CODE_CITY_COMPANY', $empresa[0]['ciudad']);
define('WEB_EMPRESA', $empresa[0]['web']);
define('CORREO_EMPRESA', $empresa[0]['correo']);
define('RNT', $empresa[0]['rnt']);
define('LOGO', $empresa[0]['logo']);
define('xPOS', $empresa[0]['xlogo']);
define('yPOS', $empresa[0]['ylogo']);
define('tPOS', $empresa[0]['tlogo']);
define('CIIU', $empresa[0]['codigo_ciiu']);
define('TIPOEMPRESA', $hotel->getTypeCia($empresa[0]['tipo_empresa']));
define('REGIMEN', TIPOEMPRESA);
define('TEXTORESOLUCION', $datosHotel[0]['resolucion']);
define('ACTIVIDAD', $datosHotel[0]['actividad']);
define('TEXTOBANCO', $datosHotel[0]['info_banco']);
define('TEXTOFACTURA', $datosHotel[0]['info_factura']);
define('PIEFACTURA', $datosHotel[0]['info_pie']);
define('FACTURADOR', $datosHotel[0]['facturador']);
define('TRA', $datosHotel[0]['tra']);


$notificaciones = [];

if (CTA_DEPOSITO == '0') {
    $cta = array('mensaje' => 'Sin Cuenta de Depositos Asignada');
    array_push($notificaciones, $cta);
};

$pc = gethostname();
$ip = $_SERVER['REMOTE_ADDR'];

$oFecha = strtotime(FECHA_PMS);
$hoy = date('d', $oFecha);
$mes = date("m", $oFecha);
$anio = date("Y", $oFecha);

if (!isset($_GET['section'])) {
} elseif (isset($_GET['section']) && $_GET['section'] == 'home') {
    $companias = $hotel->getCompanias();
} elseif (isset($_GET['section']) && $_GET['section'] == 'companias') {
    $companias = $hotel->getPerfilCompanias();
    $paices = $hotel->getPaices();
} elseif (isset($_GET['section']) && $_GET['section'] == 'agencias') {
    $agencias = $hotel->getAgencias();
} elseif (isset($_GET['section']) && $_GET['section'] == 'huespedesPerfil') {
    $huespedes = $hotel->getPerfilHuespedes();
} elseif (isset($_GET['section']) && $_GET['section'] == 'reservasActivas') {
    $companias = $hotel->getCompanias();
    $reservas = $hotel->getReservasActuales(1);
    $paices = $hotel->getPaices();
} elseif (isset($_GET['section']) && $_GET['section'] == 'forecast'|| $_GET['section'] == 'forecastOld') {
    $companias = $hotel->getCompanias();
    $reservas = $hotel->getReservasActuales(1);
    $paices = $hotel->getPaices();
} elseif (isset($_GET['section']) && $_GET['section'] == 'preregistros') {
    $reservas = $hotel->getReservasActuales(1);
} elseif (isset($_GET['section']) && $_GET['section'] == 'encasa') {
    $reservas = $hotel->getHuespedesenCasa(2, 'CA');
    $paices = $hotel->getPaices();
} elseif (isset($_GET['section']) && $_GET['section'] == 'grupos') {
    $grupos = $hotel->getGrupos();
} elseif (isset($_GET['section']) && $_GET['section'] == 'llegadasDelDia') {
    $hoy = $hotel->getDatePms();
    $reservas = $hotel->getReservasDia(FECHA_PMS, 1, 'ES');
    $paices = $hotel->getPaices();
} elseif (isset($_GET['section']) && $_GET['section'] == 'llegadaSinReserva') {
    $companias = $hotel->getCompanias();
} elseif (isset($_GET['section']) && $_GET['section'] == 'salidasDelDia') {
    $reservas = $hotel->getSalidasDia(FECHA_PMS, 2, 'CA');
} elseif (isset($_GET['section']) && $_GET['section'] == 'salidasRealizadas') {
    $reservas = $hotel->getSalidasRealizadas(FECHA_PMS, 2, 'SA');
} elseif (isset($_GET['section']) && $_GET['section'] == 'facturacionEstadia') {
    // $reservas = $hotel->getHuespedesenCasa(2,'CA');
} elseif (isset($_GET['section']) && $_GET['section'] == 'carteraClientes') {
    $clientes = $hotel->traeClientesCartera();
} elseif (isset($_GET['section']) && $_GET['section'] == 'facturacionHuesped') {
} elseif (isset($_GET['section']) && $_GET['section'] == 'ingresoConsumos') {
    $reservas = $hotel->getHuespedesenCasa(2, 'CA');
} elseif (isset($_GET['section']) && $_GET['section'] == 'cargosDelDia') {
    $companias = $hotel->getCompanias();
} elseif (isset($_GET['section']) && $_GET['section'] == 'cuentasCongeladas') {
    // $reservas = $hotel->getHuespedesenCasa(2, 'CO');
    $reservas = $hotel->traeBalanceHabitaciones('CO');
} elseif (isset($_GET['section']) && $_GET['section'] == 'facturasDiaNew') {
    $facturas = $hotel->getBuscaFacturasDia(FECHA_PMS);
} elseif (isset($_GET['section']) && $_GET['section'] == 'facturasDelDia') {
    $facturas = $hotel->getBuscaFacturasDia(FECHA_PMS);
} elseif (isset($_GET['section']) && $_GET['section'] == 'recibosCajaDelDia') {
    $recibos = $hotel->getBuscaRecibosDia(FECHA_PMS);
} elseif (isset($_GET['section']) && $_GET['section'] == 'notasCredito') {
    $notas = $hotel->getNotasCreditoDia(FECHA_PMS);
} elseif (isset($_GET['section']) && $_GET['section'] == 'objetosOlvidados') {
    $objetos = $hotel->objetosOlvidados();
} elseif (isset($_GET['section']) && $_GET['section'] == 'mantenimiento') {
    $mmtos = $hotel->habitacionesMantenimiento();
} 
 
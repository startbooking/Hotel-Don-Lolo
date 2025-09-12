<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
setlocale(LC_ALL, 'es_CO.utf8', 'es_CO', 'esp');
setlocale(LC_MONETARY, 'es_CO');
date_default_timezone_set('America/Bogota');

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

require_once 'functionsInventario.php';
require_once 'functionsPos.php';
require_once 'functionsAdmin.php';
require_once 'funcionesPos.php'; 
require_once 'funciones.php';
require_once 'rutas.php';

$pos = new Pos_Actions();
$admin = new Hotel_Admin();
$inven = new Inventario_User();
$empresa = $admin->getInfoCia();

define('NAME_EMPRESA', $empresa['empresa']);
define('NIT_EMPRESA', $empresa['nit'].'-'.$empresa['dv']);
define('ADRESS_EMPRESA', $empresa['direccion']);
define('TELEFONO_EMPRESA', $empresa['telefonos']);
define('CELULAR_EMPRESA', $empresa['celular']);
define('ID_PAIS_EMPRESA', $empresa['pais']);
define('PAIS_EMPRESA', $empresa['descripcion']);
define('CIUDAD_EMPRESA', $empresa['municipio']);
define('WEB_EMPRESA', $empresa['web']);
define('CORREO_EMPRESA', $empresa['correo']);
define('CIIU', $empresa['codigo_ciiu']);
define('REGIMEN', $empresa['tipo_empresa']);
define('TIPOEMPRESA', $pos->getTypeCia($empresa['tipo_empresa']));

?> 
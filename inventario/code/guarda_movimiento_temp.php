<?php
session_start();
// error_reporting(0);
include_once('../../Conn/Conn.php');
$array=array();

echo "entro a guardar";

$tipo        =$_POST['tipo'];
$tipomov     =$_POST['tipo_movi'];
$factura     =$_POST['factura'];
$fecha       =$_POST['fecha'];
$proveed     =$_POST['proveedor'];
$codigo      =$_POST['producto'];
$cantidad    =$_POST['cantidad'];
$unidad      =$_POST['unidad'];
$valoruni    =$_POST['valoruni'];
$valortot    =$_POST['valortot'];
$impuesto    =$_POST['impuesto'];
$descripcion =$_POST['nombre'];
$almacen     =$_POST['almacen'];
$pocentajeim =$_POST['porc_impu'];
$cod_impu    =$_POST['cod_impu'];

$fechaing    = date('Y-m-d h:m:s');
$usuario = $_SESSION['usuario'];

$cadena="INSERT INTO temp_movi(tipo, tipo_movi, fecha_movimiento, fecha_ingreso, id_proveedor, documento, producto, cantidad, unidad_alm, valor_unit, valor_total, porce_impto, impuesto, cod_impto, bodega, estado, usuario) VALUES ('$tipo','$tipomov','$fecha','$fechaing','$proveed','$factura','$codigo','$cantidad','$unidad','$valoruni','$valortot','$pocentajeim','$impuesto','$cod_impu','$almacen','1','$usuario')";

$resp = mysqli_query($conn,$cadena);


?>
<?php
session_start();
// error_reporting(0);
include_once('../../Conn/Conn.php');
$array=array();


$tipo          =$_POST['tipo'];
$numero        =$_POST['numero'];
$prefijo       =$_POST['prefijo'];
$tipomov       =$_POST['tipo_movi'];
$factura       =$_POST['factura'];
$fecha         =$_POST['fecha'];
$proveed       =$_POST['proveedor'];
$codigo        =$_POST['producto'];
$cantidad      =$_POST['cantidad'];
// $unidad     =$_POST['unidad'];
$valoruni      =$_POST['valoruni'];
$valortot      =$_POST['valortot'];
$impuesto      =$_POST['impuesto'];
//$descripcion =$_POST['nombre'];
//$almacen     =$_POST['almacen'];
//$pocentajeim =$_POST['porc_impu'];

$fechaing      = date('Y-m-d h:m:s');
$usuario       = $_SESSION['usuario'];

$sqltemp = "SELECT * FROM temp_movi WHERE producto = '$codigo' and tipo = '$tipo' and usuario = '$usuario' ";

if($resp = mysqli_query($conn,$sqltemp)){
	$rows = mysqli_fetch_assoc($resp);
	$almacen   = $rows['bodega'];
	$unidad    = $rows['unidad_alm'];
	$porc_impu = $rows['porce_impto'];
	$cod_impto = $rows['cod_impto'];
	$array     = $rows;
	if($porc_impu==""){
		$porc_impu = 0;
	};
}else{
	echo "0" ;
}


$cadena="INSERT INTO movimientos_inventario(tipo, tipo_movi, prefijo, numero, fecha_movimiento, fecha_ingreso, id_proveedor, producto, documento,cantidad, unidad_alm, valor_unit, valor_total, porce_impto, cod_impto, impuesto,bodega,estado,usuario) VALUES ('$tipo','$tipomov','$prefijo','$numero','$fecha','$fechaing','$proveed','$codigo','$factura','$cantidad','$unidad','$valoruni','$valortot', '$porc_impu','$cod_impto','$impuesto','$almacen','1','$usuario')";

if($resp = mysqli_query($conn,$cadena)){
	echo "Ejecuto Consulta adicionde productos";
	$sqlupd = "UPDATE productos_inve SET cen_prod = cen_prod + '$cantidad', exi_prod = exi_prod + '$cantidad' where cod_prod='$codigo'";
	if($resupd = mysqli_query($conn,$sqlupd)){
		echo "Actualizo Cantidades de Productos ";
	};

	$rescon = mysqli_query($conn,'UPDATE parametros_inv SET c_entradas = c_entradas + 1 where id= "1"');

}else{
	echo "0";
}



?>
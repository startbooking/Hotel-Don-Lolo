<?php

	require '../../../res/php/app_topInventario.php'; 

	$numeroMov       = $_POST['numeroMov'];
	$almacen         = $_POST['almacen'];
	$movimi          = $_POST['movimi'];
	$provee          = $_POST['provee'];
	$fecham          = $_POST['fecham'];
	$factur          = $_POST['factur'];
	$codigo          = $_POST['codigo'];
	$descripcion     = $_POST['descripci;on'];
	$subtotal        = $_POST['subtotal'];
	$unit            = $_POST['unit'];
	$desunid         = $_POST['desunid'];
	$impto           = $_POST['impto'];
	$desimpto        = $_POST['desimpto'];
	$total           = $_POST['total'];
	$producto        = $_POST['producto'];
	$porcentajeImpto = $_POST['porcentajeImpto'];
	$impuesto        = $_POST['impuesto'];
	$incluido        = $_POST['incluido'];
	$unidad          = $_POST['unidad'];
	$cantidad        = $_POST['cantidad'];
	$costo           = $_POST['costo'];

/*



$numero        =$_POST['numeroMov'];
$almacen     =$_POST['almacen'];
$tipo          =$_POST['tipo'];
$prefijo       =$_POST['prefijo'];
$tipomov       =$_POST['tipo_movi'];
$factura       =$_POST['factura'];
$fecha         =$_POST['fecha'];
$proveed       =$_POST['proveedor'];
$codigo        =$_POST['producto'];
$cantidad      =$_POST['cantidad'];
$valoruni      =$_POST['valoruni'];
$valortot      =$_POST['valortot'];
$impuesto      =$_POST['impuesto'];
//$descripcion =$_POST['nombre'];
//$almacen     =$_POST['almacen'];
//$pocentajeim =$_POST['porc_impu'];

*/
$fechaing      = date('Y-m-d h:m:s');
$usuario       = $_SESSION['usuario'];
/*
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
*/

$insertMovi = $inven->insertaMovimiento($numeroMov, $almacen, $movimi, $provee ,$fecham ,$factur, $codigo, $descripcion, $subtotal, $unit, $desunid, $impto ,$desimpto, $total, $producto, $porcentajeImpto, $impuesto, $incluido, $unidad, $cantidad, $costo);

echo $insertMovi;
/*

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
 */



?>
<?php
session_start();
// error_reporting(0);
include_once('../../Conn/Conn.php');
$tipo = $_POST['tipo'];
$usua = $_SESSION['usuario'];
$sqlmovi = "SELECT * FROM temp_movi WHERE usuario = '$usua' and tipo = '$tipo'";
$respmov = mysqli_query($conn,$sqlmovi);

$sqlnum = "SELECT c_entradas, prefijo_ent FROM parametros_inv where id = 1";
$resnum = mysqli_query($conn,$sqlnum);
$rownum = mysqli_fetch_assoc($resnum);
$nummovi = $rownum['c_entradas'];
$prefijo = $rownum['prefijo_ent'];

$rescon = mysqli_query($conn,'UPDATE parametros_inv SET c_entradas = c_entradas + 1 where id= "1"');

	while ($rows = mysqli_fetch_assoc($respmov)) {
		$tipo         =$rows['tipo'];
		$tipomov      =$rows['tipo_movi'];
		$fecha        =$rows['fecha_movimiento'];
		$fechaing     =$rows['fecha_ingreso'];
		$proveed      =$rows['id_proveedor'];
		$factura      =$rows['documento'];
		$codigo       =$rows['producto'];
		$cantidad     =$rows['cantidad'];
		$unidad       =$rows['unidad_alm'];
		$valoruni     =$rows['valor_unit'];
		$valortot     =$rows['valor_total'];
		$porcentajeim =$rows['porce_impto'];
		$impuesto     =$rows['impuesto'];
		$almacen      =$rows['bodega'];
		$estado       =$rows['estado'];
		$usuario      =$usua;

	/*registra en el kardex*/
		$cadena="INSERT INTO movimientos_inventario(tipo, tipo_movi, prefijo, numero, fecha_movimiento, fecha_ingreso, id_proveedor, documento, producto, cantidad, valor_unit, valor_total, porce_impto, impuesto, bodega, estado, usuario) VALUES('$tipo','$tipomov','$prefijo','$nummovi','$fecha','$fechaing','$proveed','$codigo','$factura','$codigo','$cantidad','$unidad','$valoruni',$valortot,'$porcentajeim','$impuesto',$almacen,'$estado','$usuario')";

		if($regent = mysqli_query($conn,$cadena)){
			$sqlupd = "UPDATE productos_inve SET cen_prod = cen_prod + cantidad, exi_prod = exi_prod + cantidad where cod_prod='$codigo'";
			$resupd = mysqli_query($conn,$sqlupd);			
		}else{
			echo "No Inserto Producto";
		}
	}
	$sqldele = "DELETE FROM temp_movi WHERE usuario = '$usua'";
	$resdele = mysqli_query($conn,$sqldele);
?>


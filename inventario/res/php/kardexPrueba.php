<?php 

require '../../../res/php/app_topHotel.php'; 

$query = "SELECT 
productos_inventario.id_producto, 
productos_inventario.nombre_producto, 
unidades.descripcion_unidad, 
movimientos_inventario.unidad_alm, movimientos_inventario.id_bodega, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0)) AS entradas, SUM(if(movimientos_inventario.movimiento=2,movimientos_inventario.cantidad,0)) AS salidas, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0) - if(movimientos_inventario.movimiento=2,movimientos_inventario.cantidad,0)) AS saldo, SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.valor_subtotal,0)) / SUM(if(movimientos_inventario.movimiento=1,movimientos_inventario.cantidad,0)) AS promedio FROM productos_inventario, movimientos_inventario, unidades WHERE movimientos_inventario.id_producto = productos_inventario.id_producto AND movimientos_inventario.estado = 1 AND productos_inventario.unidad_almacena = unidades.id_unidad AND movimientos_inventario.id_bodega = 1 AND month(fecha_movimiento) = 6 AND year(fecha_movimiento) = 2023 GROUP BY productos_inventario.nombre_producto ORDER BY productos_inventario.nombre_producto ASC" ; 


$saldo = $hotel->creaConsulta($query);


echo print_r($saldo);

?>
<?php
require '../../../res/php/app_topInventario.php';
$data = json_decode(file_get_contents('php://input'), true);
extract($data);
$fechaing = date('Y-m-d h:m:s');

foreach ($productos as $producto) {
  $insertMovi = $inven->insertaMovimientoTraslado(3, 2, $movSale, $numero, $fecha, $fechaing, $destino, $producto['producto'], $producto['cantidad'], $producto['unidadalm'], $producto['unit'], $producto['total'], $almacen, 1, $usuario);
  $insertMoviEnt = $inven->insertaMovimientoTraslado(3, 1, $movEntra, $numero, $fecha, $fechaing, $almacen, $producto['producto'], $producto['cantidad'], $producto['unidadalm'], $producto['unit'], $producto['total'], $destino, 1, $usuario);
}

include_once '../../views/prints/imprimeTraslado.php';

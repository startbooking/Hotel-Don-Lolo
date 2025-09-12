<?php

require '../../../../res/php/app_topPos.php';

// $idamb = $_POST['idamb'];
/*  $producto = strtoupper(strip_tags($_POST['producto']));
      $codigo = strtoupper(strip_tags($_POST['codigo']));
      $seccion = strtoupper(strip_tags($_POST['seccion']));
      $venta = strip_tags($_POST['venta']);
      $impto = strtoupper(strip_tags($_POST['impto']));
      $tipo = strtolower(strip_tags($_POST['tipo'])); */

extract($_POST);


if ($tipo == 0 || !isset($tipo)) {
    $receta = 0;
} else {
    $receta = $idrecetaAdi;
}

// $idamb = $_POST['idamb'];

$crea = $pos->adicionaProducto(strtoupper($producto), strtoupper($codigo), $seccion, $venta, $impto, $tipo, $receta, $id_ambiente, $unidadMed );

echo $crea;

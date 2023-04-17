<?php

require '../../../res/php/app_topInventario.php';

$tipo        = $_POST['tipo'];
$idusr       = $_POST['idusr'];
$usuario     = $_POST['usua'];
$provee      = $_POST['centro'];
$almacen     = $_POST['almacen'];
$fecha       = $_POST['fecha'];
$tipomovi    = $_POST['tipo'];
$recetas     = $_POST['listaRecetasReq'];

$movimi      = $_POST['tipoMov'];
$numeroMov   = $_POST['numero'];
$fechaing    = date('Y-m-d h:m:s');

$numeroSal = $numeroMov;

$productos = [];

foreach ($recetas as $key => $receta) {
  $receProd = $inven->getProductosRecetas($receta['codigo'], $receta['cantidad'], $receta['porciones']);
  $productos = array_merge($productos, $receProd);
}

foreach ($productos as $movimiento) {
  $unidad          = $movimiento['unidad_compra'];
  $unidadalm       = $movimiento['unidad_almacena'];

  if ($tipo == 1) {
    $conversion = $inven->buscaConversion($unidad, $unidadalm);
    $conver          = $conversion[0]['valor_conversion'];
    $factur          = $movimiento['factur'];
    $impto           = $movimiento['impto'];
    $desimpto        = $movimiento['desimpto'];
    $porcentajeImpto = $movimiento['porcentajeImpto'];
    $impuesto        = $movimiento['impuesto'];
    $incluido        = $movimiento['incluido'];
    $cantidad        = $movimiento['cantidad'] * $conver;
    $unit            = $movimiento['valor_promedio'] / $conver;
  } else {
    $factur          = 0;
    $impto           = 0;
    $desimpto        = 0;
    $porcentajeImpto = 0;
    $impuesto        = 0;
    $incluido        = 0;
    $cantidad        = ($movimiento['cantidad'] * $movimiento['cantPedida']) / $movimiento['porciones'];
    $unit            = $movimiento['valor_promedio'];
  }
  $subtotal        = $cantidad * $unit;
  $codigo          = $movimiento['id_producto'];
  $descripcion     = $movimiento['nombre_producto'];
  $total           = $subtotal + $impuesto;
  $producto        = $movimiento['id_producto'];
  $costo           = $movimiento['valor_costo'];

  $insertMovi = $inven->insertaMovimiento($tipomovi, $tipo, $movimi, $numeroMov, $fecha, $fechaing, $provee, $factur, $producto, $cantidad, $unidadalm, $unit, $subtotal, $total, $porcentajeImpto, $impuesto, $impto, $almacen, 1, $usuario);
  $tipoAlm = $inven->getAlmacenPrincipal($almacen);

  if ($tipo == 1) {
  } else if ($tipo == 2) {
  }

  if ($tipo == '1' && $tipoAlm == '1') {
    $prom = $inven->calculaPromedioProd($producto, $almacen);
    $inven->actualizaValorProd($producto, $prom[0]['entradas'], $prom[0]['salidas'], $prom[0]['saldo'], $prom[0]['valorentradas'], $prom[0]['valorsalidas'], $prom[0]['valorsaldo'], $prom[0]['promedio']);

    $prodRece = $inven->medidaProduccion($producto);

    $valorpro = ($prom[0]['promedio'] / $prodRece);

    $upd =  $inven->actualizapromedioReceta($producto, $valorpro);
  }
}

include_once '../../views/prints/imprimeSalidas.php';

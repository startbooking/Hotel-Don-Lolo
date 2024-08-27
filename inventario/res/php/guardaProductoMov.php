<?php

require '../../../res/php/app_topInventario.php';

extract($_POST);

$fechaing = date('Y-m-d h:m:s');
foreach ($movimientos as $movimiento) {
    $almacen = $movimiento['almacen'];
    $movimi = $movimiento['movimi'];
    $tipomovi = $movimiento['tipomovi'];
    $provee = $movimiento['provee'];
    $fecham = $movimiento['fecham'];
    $unidad = $movimiento['unidad'];
    $unidadalm = $movimiento['unidadalm'];

    if ($tipo == 1) {
        $conversion = $inven->buscaConversion($unidad, $unidadalm);
        if ($conversion) {
            $conver = $conversion[0]['valor_conversion'];
        } else {
            $conver = 1;
        }
        $factur = $movimiento['factur'];
        $impto = $movimiento['impto'];
        $desimpto = $movimiento['desimpto'];
        $porcentajeImpto = $movimiento['porcentajeImpto'];
        $impuesto = $movimiento['impuesto'];
        $incluido = $movimiento['incluido'];
        $cantidad = $movimiento['cantidad'] * $conver;
        $unit = $movimiento['unit'] / $conver;
    } else {
        $factur = 0;
        $impto = 0;
        $desimpto = 0;
        $porcentajeImpto = 0;
        $impuesto = 0;
        $incluido = 0;
        $cantidad = $movimiento['cantidad'];
        $unit = $movimiento['unit'];
    }
    $subtotal = $movimiento['subtotal'];
    $codigo = $movimiento['codigo'];
    $descripcion = $movimiento['descripcion'];
    $desunid = $movimiento['desunid'];
    $total = $movimiento['total'];
    $producto = $movimiento['producto'];
    $costo = $movimiento['costo'];

    $insertMovi = $inven->insertaMovimiento($tipomovi, $tipo, $movimi, $numeroMov, $fecham, $fechaing, $provee, $factur, $producto, $cantidad, $unidadalm, $unit, $subtotal, $total, $porcentajeImpto, $impuesto, $impto, $almacen, 1, $usuario);
    $tipoAlm = $inven->getAlmacenPrincipal($almacen);

    if ($tipo == 1) {
    } elseif ($tipo == 2) {
    }
    $prodRece = 1;

    if ($tipo == '1' && $tipoAlm == '1') {
        $prom = $inven->calculaPromedioProd($producto, $almacen);
        $inven->actualizaValorProd($producto, $prom[0]['entradas'], $prom[0]['salidas'], $prom[0]['saldo'], $prom[0]['valorentradas'], $prom[0]['valorsalidas'], $prom[0]['valorsaldo'], $prom[0]['promedio']);
        $prodRece = $inven->medidaProduccion($producto);

        $prodRece = $inven->medidaProduccion($producto);
        $valorpro = ($prom[0]['promedio'] / $prodRece);

        $upd = $inven->actualizapromedioReceta($producto, $valorpro);
    }
}

if ($tipo == 1) {
    include_once '../../views/prints/imprimeEntradas.php';
} elseif ($tipo == 2) {
    include_once '../../views/prints/imprimeSalidas.php';
}

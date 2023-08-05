<?php

    require '../../../res/php/app_topInventario.php';

    $numeroTra = $_POST['numeroTra'];
    $numeroEnt = $_POST['numeroEnt'];
    $numeroSal = $_POST['numeroSal'];
    $almacen = $_POST['alma'];
    $destino = $_POST['desti'];
    $movEnt = $_POST['movEntra'];
    $movSal = $_POST['movSale'];
    $provee = $_POST['desti'];
    $fecha = $_POST['fecha'];
    $usuario = $_POST['usuario'];
    $productos = $_POST['movimiento'];

    foreach ($productos as $producto) {
        $unit = $producto['unit'];
        $desunid = $producto['desunid'];
        $total = $producto['total'];
        $prod = $producto['producto'];
        $unidad = $producto['unidad'];
        $unidadalm = $producto['unidadalm'];
        $cantidad = $producto['cantidad'];
        $costo = $producto['costo'];
        $fechaing = date('Y-m-d h:m:s');

        $insertMovi = $inven->insertaMovimientoTraslado(3, 2, $movSal, $numeroTra, $fecha, $fechaing, $destino, $prod, $cantidad, $unidadalm, $unit, $total, $almacen, 1, $usuario);

        $insertMoviEnt = $inven->insertaMovimientoTraslado(3, 1, $movEnt, $numeroTra, $fecha, $fechaing, $almacen, $prod, $cantidad, $unidadalm, $unit, $total, $destino, 1, $usuario);
    }

    include_once '../../views/prints/imprimeTraslado.php';

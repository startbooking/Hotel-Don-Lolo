<?php

    require '../../../res/php/app_topInventario.php';

    $idusr = $_POST['usuario_id'];
    $user = $_POST['usuario'];
    $numero = $_POST['numero'];
    $centro = $_POST['centro'];
    $almacen = $_POST['almacen'];
    $fecha = $_POST['fecha'];
    $recetas = $_POST['recetas'];

    $productos = [];

    foreach ($recetas as $key => $receta) {
        $receProd = $inven->getProductosRecetas($receta['codigo'], $receta['cantidad'], $receta['porciones']);
        $productos = array_merge($productos, $receProd);
    }

    foreach ($productos as $key => $producto) {
        $codigo = $producto['id_producto'];
        $existe = $inven->buscaProductoRecetaReq($numero, $codigo);
        $cantidad = ($producto['cantidad'] * $producto['cantPedida']) / $producto['valor_conversion'];
        $costo = $producto['valor_promedio'];
        $total = $costo * $cantidad;
        if (count($existe) == 1) {
            $canti = $existe[0]['cantidad'];
            $val = $existe[0]['valor_unitario'];
            $nuecan = $canti + $cantidad;
            $valcant = $nuecan * $val;

            $upd = $inven->updateRequisicion($numero, $codigo, $nuecan, $valcant);
        } else {
            $unidadalm = $producto['unidad_almacena'];
            $inserta = $inven->insertaRequisicion($numero, $centro, $almacen, $fecha, $cantidad, $codigo, $costo, $total, $unidadalm, $user);
        }
    }

    include_once '../../views/prints/imprimeRequisicion.php';

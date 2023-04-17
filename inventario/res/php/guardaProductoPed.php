<?php

    require '../../../res/php/app_topInventario.php';

    $idusr = $_POST['usuario_id'];
    $user = $_POST['usuario'];
    $numero = $_POST['numero'];
    $centro = $_POST['centro'];
    $proveedor = $_POST['proveedor'];
    $fecha = $_POST['fecha'];
    $pedidos = $_POST['pedidos'];

    foreach ($pedidos as $pedido) {
        $cantidad = $pedido['cantidad'];
        $codigo = $pedido['codigo'];
        $costo = $pedido['costo'];
        $total = $pedido['total'];
        $unidadalm = $pedido['unidadalm'];

        $inserta = $inven->insertaPedido($numero, $centro, $proveedor, $fecha, $cantidad, $codigo, $costo, $total, $unidadalm, $user);
    }

    include_once '../../views/prints/imprimePedido.php';

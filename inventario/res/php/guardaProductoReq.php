<?php

    require '../../../res/php/app_topInventario.php';

    $idusr = $_POST['usuario_id'];
    $user = $_POST['usuario'];
    $numero = $_POST['numero'];
    $centro = $_POST['centro'];
    $almacen = $_POST['almacen'];
    $fecha = $_POST['fecha'];
    $prods = $_POST['requision'];

    $_SESSION['numeroRequsicion'] = $numero;

    foreach ($prods as $prod) {
        $cantidad = $prod['cantidad'];
        $codigo = $prod['codigo'];
        $costo = $prod['costo'];
        $total = $prod['total'];
        $unidadalm = $prod['unidadalm'];
        $inserta = $inven->insertaRequisicion($numero, $centro, $almacen, $fecha, $cantidad, $codigo, $costo, $total, $unidadalm, $user);
    }

    include_once '../../views/prints/imprimeRequisicion.php';

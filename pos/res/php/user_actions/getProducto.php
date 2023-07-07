<?php

    require '../../../../res/php/app_topPos.php';
    $codigo = $_POST['codigo'];
    $ambi = $_POST['ambi'];
    $productos = $pos->getProductosTipo($codigo, $ambi);

    echo json_encode($productos);

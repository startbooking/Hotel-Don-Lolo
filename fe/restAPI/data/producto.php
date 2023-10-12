<?php

require_once '../../../res/php/app_topFE.php';

// echo $_SERVER['REQUEST_METHOD'];

echo print_r($_GET);

extract($_GET);


if ($_SERVER['REQUEST_METHOD'] == 'GET') {  

    echo 'ENtro '; 
    /* $postBody = json_decode(file_get_contents('php://input'), true);
    echo print_r($postBody); */
    $id = $_GET('item');  

    echo $id;

   /*  $lista = $user->getDetalleProducto($id);
    header('Content-Type: application/json');
    echo json_encode($lista); */
    http_response_code(200);
}

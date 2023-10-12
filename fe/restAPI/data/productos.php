<?php

require_once '../../../res/php/app_topFE.php';

// echo $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {    

    if(isset($_GET['item'])){
        $id = $_GET['item'];
        $lista = $user->getDetalleProducto($id);
    }else{
        $lista = $user->getCodigosVentas(4);
    }
    header('Content-Type: application/json');    
    echo json_encode($lista);
    http_response_code(200);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postBody = json_decode(file_get_contents('php://input'), true);
    extract($postBody);
    $result = $user->ingresaProducto(strtoupper($nombreAdi), strtoupper($codigoAdi), $ImptosAdi, $unidad, $precioAdi, $pucAdi, $centroAdi, strtoupper($descripcionAdi), $usuario);
    echo json_encode($result);
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $postBody = json_decode(file_get_contents('php://input'), true);
    $nit = $postBody['nit'];
    $cliente = strtoupper($postBody['nombres']);
    $direccion = strtoupper($postBody['direccion']);
    $correo = $postBody['correo'];
    $telefono = $postBody['telefono'];
    $usuario = $postBody['usuario'];
    $idCliente = $postBody['idCliente'];

    $result = $user->actualizaCliente($nit, $cliente, $direccion, $correo, $telefono, $usuario, $idCliente);
    echo json_encode($result);
}

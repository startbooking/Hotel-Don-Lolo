<?php

require_once '../../../res/php/app_topFE.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaClientes = $_user->listaClientes();
    header('Content-Type: application/json');
    echo json_encode($listaClientes);
    http_response_code(200);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postBody = json_decode(file_get_contents('php://input'), true);
    extract($postBody);
    $result = $user->ingresaPago(strtoupper($nombre), $codigo, $tipo, $puc, $centro, strtoupper($descripcion), $usuario);
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

    $result = $_user->actualizaCliente($nit, $cliente, $direccion, $correo, $telefono, $usuario, $idCliente);
    echo json_encode($result);
}

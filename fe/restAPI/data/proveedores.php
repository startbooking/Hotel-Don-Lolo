<?php

require_once '../../../res/php/app_topFE.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listaClientes = $user->listaProductos();
    header('Content-Type: application/json');
    echo json_encode($listaClientes);
    http_response_code(200);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postBody = json_decode(file_get_contents('php://input'), true);
    extract($postBody);
    $result = $user->ingresaProveedor(strtoupper($empresa), strtoupper($apellido1), strtoupper($apellido2), strtoupper($nombre1), strtoupper($nombre2), $nit, $dv, strtoupper($direccion), $ciudad, $telefono, $celular, $correo, $web, $tipo_emp, $tipo_doc, $ciiu, $tipoAdquiriente, $tipoResponsabilidad, $responsabilidadTribu, $usuario);
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

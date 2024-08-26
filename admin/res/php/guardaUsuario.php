<?php

require '../../../res/php/app_topAdmin.php';

extract($_POST);

$claveIn = sha1(md5($usuario.$clave));

$guarda = $admin->insertUserNew(strtoupper($usuario), strtoupper($claveIn), strtoupper($apellidos), strtoupper($nombres), $identificacion, strtolower($correo), $telefono, $celular, $tipo, $Pos, $PMS, $Inv, $Fe, $idUsr);

echo json_encode($guarda);

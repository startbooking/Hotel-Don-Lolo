<?php

require '../../../res/php/app_topHotel.php';

extract($_POST);

$updateHuesped = $hotel->updateHuesped($txtIdHuespedUpd, strtoupper($identificaUpd), $tipodoc, strtoupper($apellido1), strtoupper($apellido2), strtoupper($nombre1), strtoupper($nombre2), $sexOption, strtoupper($direccion), $telefono, $celular, strtolower($correo), $fechanace, $paices, $ciudadUpd, $paisExpUpd, $ciudadExpUpd, $tipoAdquiriente, $tipoResponsabilidad, $responsabilidadTribu, $empresaUpd, $profesion, $edad);

echo json_encode($updateHuesped);
 
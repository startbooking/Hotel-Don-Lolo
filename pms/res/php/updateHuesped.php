<?php

require '../../../res/php/app_topHotel.php';

extract($_POST);

if(!isset($sexOption)){
  $sexOption = 1 ;
}

$updateHuesped = $hotel->updateHuesped($txtIdHuespedUpd, strtoupper($identificaUpd), $tipodoc, strtoupper($apellido1), strtoupper($apellido2), strtoupper($nombre1), strtoupper($nombre2), $sexOption, strtoupper($direccion), $telefono, $celular, strtolower($correo), $fechanace, $paices, $ciudadUpd, $paisExpUpd, $ciudadExpUpd, $tipoAdquiriente, $tipoResponsabilidad, $responsabilidadTribu, $empresaUpd, $profesion, $edad, $tarifaUpd, $formapagoUpd);

echo json_encode($updateHuesped);
 
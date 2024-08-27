<?php

require '../../../res/php/app_topHotel.php';

$id = $_POST['id'];
$idusr = $_POST['idusr'];
$directorio = '../../uploads';

if (!file_exists($directorio)) {
    mkdir($directorio, 0644) or exit('No se puede crear el directorio de extracci&oacute;n');
}

$dir  = opendir($directorio);
$rutaimg   =  '../../uploads';
$archivos = $_FILES['files']; //esto va a llegar en formato de array, si el name fue files[] 

foreach ($archivos['tmp_name'] as $indice => $tmp_name) {
    $nombre_real = $archivos['name'][$indice];
    $sube = move_uploaded_file($tmp_name, "../../uploads/$nombre_real");
    if ($sube == 1) {
        $img  = $hotel->insertImagenPerfil(1, $id, $nombre_real, 0, $idusr);
    }
}

echo $sube;

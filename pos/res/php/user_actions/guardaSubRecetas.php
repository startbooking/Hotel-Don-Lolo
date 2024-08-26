<?php
  require '../../../../res/php/app_topPos.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subRecetas = json_decode(file_get_contents('php://input'), true);

    foreach ($subRecetas as $subreceta ){
      $regis = $pos->guardaSubReceta($subreceta['idSubRece'],$subreceta['idReceta'],$subreceta['costoSubR'],$subreceta['cantidad'],$subreceta['usuario_id'],1);

      echo $regis;
    }

  }

?> 
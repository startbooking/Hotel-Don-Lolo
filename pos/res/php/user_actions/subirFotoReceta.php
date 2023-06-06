<?php

require '../../../../res/php/app_topPos.php';

$directorio = '../../../images/';
$idrec = $_POST['receta'];
echo $_POST['receta'];
/* foto
receta */

$dir = opendir($directorio);
foreach ($_FILES['images']['name'] as $name => $value) {
    $file_name = $_FILES['images']['name'][$name];
    $source = $_FILES['images']['tmp_name'][$name];

    $target_path = $directorio.$file_name;
    $aFile = crearThumbJPEG($source, $target_path, 600, 400, 90);

    if ($aFile == 1) {
        $img = $pos->updateFotoReceta($file_name, $idrec);
    }
}

<?php 

  require '../../../../res/php/rutas.php';
  require RUTA_ROOT.BASE_WEB.'res/php/config.php' ;
  require RUTA_ROOT.BASE_WEB.'res/php/app_top_admin.php'; 

  if ($_FILES['file']['name']) {
    if (!$_FILES['file']['error']) {
      $filename    = $_FILES['file']['name'];
      $destination = RUTA_ROOT.BASE_IMAGES.'pms/'.$filename; 
      $location    = $_FILES["file"]["tmp_name"];
      $saveImg     = move_uploaded_file($location, $destination);
     
      echo BASE_IMAGES .'pms/'.$filename;

    } else {
      echo $message = 'Ooops!  Your upload triggered the following error:  ' . $_FILES['file']['error'];
    }
  }
 ?>
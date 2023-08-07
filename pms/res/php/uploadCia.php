<?php

  require '../../../res/php/app_topHotel.php'; 


  $id         = $_POST['id'];
  $idusr      = $_POST['idusr'];
  $directorio = '../../uploads/';

  if(!file_exists($directorio)){
    mkdir($directorio, 0755) or die("No se puede crear el directorio de extracci&oacute;n");  
  }   

  $dir  = opendir($directorio); 

  foreach($_FILES["images"]['tmp_name'] as $key => $tmp_name){
    if($_FILES["images"]["name"][$key]) {
      $filename   = $_FILES["images"]["name"][$key]; 

      $source     = $_FILES["images"]["tmp_name"][$key]; 

      $rtOriginal =$_FILES['images']['tmp_name'][$key];      
      $typefile   = $_FILES['images']['type'][$key];

      $target_path = $directorio.'/'.$filename;
      $original    = imagecreatefromjpeg($source);

      $aFile = crearThumbJPEG($source,$target_path,600,480,90); 


      if($aFile==1){
        $img  = $hotel->insertImagenPerfil(2,$id,$filename,0, $idusr);
      }

    echo '1'; 
    }
  }


?>


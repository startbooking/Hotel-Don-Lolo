<?php 

  function subirImagen($input,$ruta,$namefile,$mini,$m_ancho,$m_alto){
    $NombreOriginal = basename($input['name']);
    $file_name      = $input['name'];
    $source         = $input['tmp_name'];      
    $Extension      = pathinfo($NombreOriginal, PATHINFO_EXTENSION);
    $rtOriginal     = $input['tmp_name'];
    $max_ancho      = $m_ancho; 
    $max_alto       = $m_alto;

    if ($Extension == "jpg" || $Extension == "jpeg") { 
      $original    = imagecreatefromjpeg($rtOriginal);
    } elseif ($Extension == "JPG") { 
      $original    = imagecreatefromjpeg($rtOriginal);
    } elseif ($Extension == "png") { 
      $original    = imagecreatefrompng($rtOriginal);
    } elseif ($Extension == "gif") { 
      $original    = imagecreatefromgif($rtOriginal);
    }

    list($ancho,$alto)=getimagesize($source);


    $x_ratio = $max_ancho / $ancho;
    $y_ratio = $max_alto / $alto;

    if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
        $ancho_final = $ancho;
        $alto_final = $alto;
    }else if(($x_ratio * $alto) < $max_alto){
      $ancho_final = ceil($y_ratio * $ancho);
      $alto_final = $max_alto;
    }else {
      $alto_final = ceil($x_ratio * $alto);
      $ancho_final = $max_ancho;
    }

    $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 

    imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
       
    //Destruir la original
    imagedestroy($original);

      if ($Extension == "jpg" || $Extension == "jpeg") { 
        if(imagejpeg($lienzo,$ruta.$namefile)){
          $mensaje = 11;
        } else {  
          $mensaje = 0;
        }
      } elseif ($Extension == "png") { 
        if(imagepng($lienzo,$ruta.$namefile)){
          $mensaje = 12;
        } else {  
          $mensaje = 0;
        }
      } elseif ($Extension == "JPG") { 
        if(imagejpeg($lienzo,$ruta.$namefile)){
          $mensaje = 13;
        } else {  
          $mensaje = 0;
        }
      } elseif ($Extension == "gif") { 
        if(imagegif($lienzo,$ruta.$namefile)){
          $mensaje = 14;
        } else {  
          $mensaje = 0;
        }
      }

    return $mensaje;
  }

  function estadoCompany($data){
    if ($data ==1){
      return '<span style="font-size:14px"class="label label-success">Activo</span>';
    }
    if($data ==2){
      return '<span style="font-size:14px"class="label label-warning">En Manteminienmto </span>';
    }
  }


  function tipo_menu($data){
    $admin = new Admin_Actions();
    if ($data ==1){
      return '<span class="label label-success">Main Menu</span>';
    }elseif($data==2){
      $menupadre = $admin->getMenuPadre($data);
      return '<span class="label label-info">'.$menupadre.'</span>';
    }elseif($data==3){
      return '<span class="label label-danger"> Menu Footer</span>';
    }
  }


  function estado_reserva($data){
    if ($data ==1){
      return '<span class="label label-success">Ingresada</span>';
    }
    if($data ==2){
      return '<span class="label label-warning">Cancelada</span>';
    }
    if($data ==3){
      return '<span class="label label-info">Confirmada</span>';
    }
  }


  function estado_social($data){
    if ($data ==1){
      return '<span class="label label-success">Activo</span>';
    }
    if($data ==2){
      return '<span class="label label-warning">Inactivo</span>';
    }
  }

  function estado_hotel($data){
    if ($data ==0){
      return '<span class="label label-info">Inscrito</span>';
    }
    if ($data ==1){
      return '<span class="label label-success">Activo</span>';
    }
    if($data ==2){
      return '<span class="label label-danger">Suspendido</span>';
    }
  }

  function estado_usuario($data){
    // echo $data;
    if ($data ==1){
      return '<span class="label label-success">Activo</span>';
    }elseif($data ==2){
      return '<span class="label label-danger">Bloqueado</span>';
    }
  }

  function tipo_usuario($data){
    if ($data ==1){
      return '<span class="label label-success">Administrador</span>';
    }elseif($data ==2){
      return '<span class="label label-warning">Booking User</span>';
    }elseif($data ==3){
      return '<span class="label label-info">CMS User</span>';
    }elseif($data ==4){
      return '<span class="label label-danger">Report User</span>';
    }
  }


  function estado_habitacion($data){
    if ($data ==1){
      return '<span class="label label-success">Activa</span>';
    }elseif($data ==2){
      return '<span class="label label-danger">Bloqueada</span>';
    }
  }

  function estado_articulo($data){
    if ($data ==1){
      return '<span class="label label-success">Publicada</span>';
    }elseif($data ==2){
      return '<span class="label label-danger">Sin Publicar</span>';
    }
  }

 ?>

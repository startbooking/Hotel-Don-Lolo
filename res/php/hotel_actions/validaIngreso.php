<?php
  
  require '../res/php/rutas.php';
  require '../res/php/config.php' ;
  require '../res/php/app_top.php'; 

  $fecha = date('Y-m-d');

  $usu     = strtoupper(addslashes($_POST["login"]));
  $pass    = strtoupper(addslashes($_POST["password"]));
  
  $pass3   = sha1(md5($usu.$pass));

  $admin = new Admin_Actions();
  $users = new User_Actions();

  $user = $admin->getLogin($usu,$pass3);
  if(!empty($user)){
    $array=array();
      $_SESSION["usuario_id"]   = $row['usuario_id'];
      $_SESSION["usuario"]      = $row['usuario'];
      $_SESSION["nombres"]      = $row['nombres'];
      $_SESSION["apellidos"]    = $row['apellidos'];
      $_SESSION["nivel"]        = $row['tipo'];
      $_SESSION["entro"]        = "SI" ;
      $_SESSION["activo"]       = $row['estado']; 
      $_SESSION["empresa_id"]   = $row['empresa_id']; 
      $array=$row;
      echo json_encode($array);  
  }else{
      echo '0';
  }
?>
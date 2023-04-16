<?php
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $fecha = date('Y-m-d');
  $usu   = strtoupper(addslashes($_POST["login"]));
  $pass  = strtoupper(addslashes($_POST["pass"]));
  $pass3 = sha1(md5($usu.$pass)); 

  $user = $hotel->getLogin($usu,$pass3);

  if(!empty($user)){
 
    $usuario = $_SESSION['usuario']; 
    $fecha   = FECHA_PMS;
   
    include_once '../../imprimir/imprimeCierreCajero.php';

    $filepdf = BASE_PMS.'imprimir/cajeros/cierre_Cajero_'.$_SESSION['usuario'].'_'.FECHA_PMS.'.pdf';

    $cierre = $hotel->cierreDiarioCajero($_SESSION['usuario']);

    echo $filepdf;

  }else{
    echo 0;
  }
?>
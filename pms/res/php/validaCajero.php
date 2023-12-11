<?php
  require_once '../../../res/php/titles.php';
  require_once '../../../res/php/app_topHotel.php'; 

  $fecha   = date('Y-m-d');
  $usu     = strtoupper(addslashes($_POST["login"]));
  $pass    = strtoupper(addslashes($_POST["pass"]));
  $pass3   = sha1(md5($usu.$pass)); 
  $usuario = $_POST["usuario"];

  $user = $hotel->getLogin($usu,$pass3);

  if(!empty($user)){
 
    $fecha   = FECHA_PMS;
   
    include_once '../../imprimir/imprimeCierreCajero.php';

    $filepdf = BASE_PMS.'imprimir/cajeros/cierre_Cajero_'.$usuario.'_'.FECHA_PMS.'.pdf';
    $cierre = $hotel->cierreDiarioCajero($usuario);
    echo $filepdf;

  }else{
    echo 0;
  }
?>
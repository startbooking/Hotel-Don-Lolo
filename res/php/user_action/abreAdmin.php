<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_top.php'; 

  $usr   = $_POST['user'];
  $usrId = $_POST['userId'];

  $users = $user->getSesionLogin($usrId);
  $cia   = $user->getInfoCia();

  $_SESSION["usuario_id"] = $users[0]['usuario_id'];
  $_SESSION["usuario"]    = $users[0]['usuario'];
  $_SESSION["nombres"]    = $users[0]['nombres'];
  $_SESSION["apellidos"]  = $users[0]['apellidos'];
  $_SESSION["nivel"]      = $users[0]['tipo'];
  $_SESSION["cajeropos"]  = $users[0]['estado_usuario_pos'];
  $_SESSION["cajeropms"]  = $users[0]['estado_usuario_pms'];
  $_SESSION["activo"]     = $users[0]['estado']; 
  $_SESSION["empresa_id"] = $users[0]['empresa_id']; 
  $_SESSION["entro"]      = "SI" ;

	$cajero = $_SESSION["cajeropms"] ; 
	$user   = $_SESSION["usuario"] ; 

  $_SESSION['CON'] =  $cia[0]['con'];
  $_SESSION['INV'] =  $cia[0]['inv']; 
  $_SESSION['COM'] =  $cia[0]['com']; 
  $_SESSION['CXP'] =  $cia[0]['cxp'];
  $_SESSION['CXC'] =  $cia[0]['cxc'];
  $_SESSION['POS'] =  $cia[0]['pos'];
  $_SESSION['TAR'] =  $cia[0]['tar'];
  $_SESSION['PMS'] =  $cia[0]['pms'];  
  $_SESSION['RES'] =  $cia[0]['res'];    



?>

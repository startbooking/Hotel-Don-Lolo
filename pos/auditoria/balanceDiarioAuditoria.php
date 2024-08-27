<?php

  require_once '../../res/php/app_topPos.php';

  $fecha  = $_POST['fecha'];
  $idamb  = $_POST['idamb'];
  $amb    = $_POST['nomamb'];
  $pref   = $_POST['prefijo'];
  $logo   = $_POST['logo']; 
  $user   = $_POST['user']; 
  $iduser = $_POST['iduser']; 

  require_once '../imprimir/imprimeBalanceDiarioAuditoria.php'; 


<?php

  require_once '../../res/php/app_topPos.php';

  $fecha = $_POST['fecha'];
  $idamb = $_POST['idamb'];
  $nomamb = $_POST['nomamb'];
  $pref = $_POST['prefijo'];
  $logo = $_POST['logo'];
  $user = $_POST['user'];
  $iduser = $_POST['iduser'];

  /*
  $anio = substr($fecha, 0, 4);
  $mes  = substr($fecha, 5, 2);
  $dia  = substr($fecha, 8, 2);
  */

  $fechanueva = strtotime('+1 day', strtotime($fecha));
  $fechanueva = date('Y-m-d', $fechanueva);
  $cambiaFecha = $pos->cambiaFechaAuditoria($idamb, $fechanueva);
  $cierra = $pos->cambiaEstadoTodosCajero(0);
  // echo json_encode($cambiaFecha);
  echo $fechanueva;

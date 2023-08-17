<?php

  require_once '../../res/php/app_topPos.php';

  $fecha = $_POST['fecha'];
  $idamb = $_POST['idamb'];
  $nomamb = $_POST['nomamb'];
  $pref = $_POST['prefijo'];
  $logo = $_POST['logo'];
  $user = $_POST['user'];
  $iduser = $_POST['iduser'];

  $anio = substr($fecha, 0, 4);
  $mes  = substr($fecha, 5, 2);
  $dia  = substr($fecha, 8, 2);

  require_once '../imprimir/imprimeDiarioFormasdePago.php';
 
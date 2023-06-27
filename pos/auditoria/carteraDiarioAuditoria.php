<?php

  require_once '../../res/php/app_topPos.php';

  $fecha = $_POST['fecha'];
  $idamb = $_POST['idamb'];
  $nomamb = $_POST['nomamb'];
  $pref = $_POST['prefijo'];
  $logo = $_POST['logo'];
  $user = $_POST['user'];
  $iduser = $_POST['iduser'];

  $creditos = $pos->getVentasCreditodelDia($idamb);


  require_once '../imprimir/imprimeCarteraDiarioAuditoria.php';


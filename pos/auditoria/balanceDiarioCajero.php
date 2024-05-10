<?php

  require_once '../../res/php/app_topPos.php';

  $fecha = $_POST['fecha'];
  $idamb = $_POST['idamb'];
  $amb   = $_POST['nomamb'];
  $logo  = $_POST['logo']; 
  $cajeros = $pos->getCajerosActivos($idamb);

  foreach ($cajeros as $key => $cajero) {
      $user = $cajero['usuario'];
      $iduser = $cajero['usuario_id'];

      if ($cajero['estado_usuario_pos'] == 1) {
          include '../imprimir/imprimeCierreCajeroAuditoria.php';
      }
      $estado = $pos->cambiaEstadoCajero($iduser, 2);
  }
 
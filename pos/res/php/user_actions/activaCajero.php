<?php

  require '../../../../res/php/app_topPos.php';

  $iduser = $_POST['usuario_id'];

  $estado = $pos->cambiaEstadoCajero($iduser, 1);

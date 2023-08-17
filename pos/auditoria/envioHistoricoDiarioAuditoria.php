<?php

  require_once '../../res/php/app_topPos.php';

  $fecha = $_POST['fecha'];
  $idamb = $_POST['idamb'];
  $nomamb = $_POST['nomamb'];
  $pref = $_POST['prefijo'];
  $logo = $_POST['logo'];
  $user = $_POST['user'];
  $iduser = $_POST['iduser'];

  $coma = $pos->enviaHistoricoComandas($idamb);
  $deta = $pos->enviaHistoricoDetalleComandas($idamb);
  $fact = $pos->enviaHistoricoFacturas($idamb);
  $deta = $pos->enviaHistoricoDetalleFacturas($idamb);
  $caja = $pos->enviaHistoricoCaja($idamb);
  $hisAbon = $pos->enviaHistoricoAbonos($idamb);
  $elicoma = $pos->eliminaComandas($idamb);
  $elicaja = $pos->eliminaCaja($idamb);
  $elicaja = $pos->eliminaAbonos($idamb);
  $elidetacoma = $pos->eliminaDetelleComandas($idamb);
  $elifact = $pos->eliminaFacturas($idamb);
  $elidetafact = $pos->eliminaDetelleFacturas($idamb);

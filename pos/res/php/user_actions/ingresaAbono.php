<?php

  require '../../../../res/php/app_topPos.php';

  $user = $_POST['user'];
  $iduser = $_POST['idusr'];
  $idamb = $_POST['idamb'];
  $nomamb = $_POST['nomamb'];
  $fecha = $_POST['fecha'];
  $fpago = $_POST['fpago'];
  $productos = $_POST['productos'];
  $textopago = $_POST['textopago'];
  $comanda = $_POST['comanda'];
  $totabo = $_POST['monto'];
  $comenta = strtoupper($_POST['comenta']);
  $logo = $_POST['logo'];

  $numAbo = $pos->getNumeroAbono($idamb);
  $upd = $pos->updateNumeroAbono($idamb, $numAbo + 1);

  $ingabo = $pos->ingresoAbono($iduser, $idamb, $fecha, $comanda, $totabo, $comenta, $numAbo, $fpago);

  $abo = $pos->ingresoAbonoTotal($comanda, $totabo, $idamb);

  include_once 'imprime_abono.php';

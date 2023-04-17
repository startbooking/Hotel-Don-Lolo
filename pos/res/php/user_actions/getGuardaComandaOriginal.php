<?php
  require '../../../../res/php/app_topPos.php';
  $usu = $_POST['user'];
  $nrocomanda = $_POST['comanda'];
  $fecha = $_POST['fecha'];
  $amb = $_POST['idamb'];
  $nomamb = $_POST['nomamb'];
  $imptoInc = $_POST['imptoInc'];
  $productos = $_POST['productos'];
  $cliente = strtoupper($_POST['cliente']);

  $borra = $pos->borraComandaOrginal($nrocomanda, $amb);

  $subtotal = 0;
  $imptos = 0;
  $total = 0;
  foreach ($productos as $comandaventa) {
      $subt = round($comandaventa['venta'], 0);
      $impt = $comandaventa['valorimpto'];
      $ingresa = $pos->ingresoProductosComanda($amb, $usu, $comandaventa['producto'], $subt, $comandaventa['cant'], $comandaventa['importe'], $comandaventa['codigo'], $nrocomanda, $comandaventa['impto'], $impt);
      $subtotal = $subtotal + $subt;
      $imptos = $imptos + $impt;
      $total = $total + ($subt + $impt);
  }

  $aplicades = $pos->updateValorComanda($nrocomanda, $amb, $subtotal, $imptos, $total);

  echo $nrocomanda;
  ?> 
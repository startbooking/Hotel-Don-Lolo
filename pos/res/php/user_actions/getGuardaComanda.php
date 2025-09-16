<?php
  require '../../../../res/php/app_topPos.php';
  extract($_POST);

  $numerocomanda = $pos->getNumeroComanda($id_ambiente);
  $nrocomanda = $numerocomanda + 1;
  $nuevonumero = $pos->updateNumeroComanda($id_ambiente, $nrocomanda);
  $subtotal = 0;
  $imptos = 0;
  $total = 0;

  foreach ($productos as $comandaventa) {
    $subt = round($comandaventa['venta'], 2);
    $impt = $comandaventa['valorimpto'];
    $ingresa = $pos->ingresoProductosComanda($id_ambiente, $usuario, $comandaventa['producto'], $subt, $comandaventa['cant'], $comandaventa['importe'], $comandaventa['codigo'], $nrocomanda, $comandaventa['impto'], $impt);
  }


  $valComma = $pos->traeProductosVentaTotal($nrocomanda, $id_ambiente);

  $subtotal = $valComma[0]['baseimpto'];
  $imptos = $valComma[0]['valimpto'];
  $total = $valComma[0]['total'];

  $nuevacomanda = $pos->ingresoNuevaComanda($nrocomanda, $id_ambiente, $mesa, $pax, $usuario, $fecha_auditoria, 'A');
  $actMesa = $pos->actualizaEstadoMesa($mesa, $id_ambiente, 'O');

  $aplicades = $pos->updateValorComanda($nrocomanda, $id_ambiente, $subtotal, $imptos, $total);

  echo $nrocomanda;
  ?> 
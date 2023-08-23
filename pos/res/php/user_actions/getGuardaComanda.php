<?php
  require '../../../../res/php/app_topPos.php';
  $usu = $_POST['user'];
  $pax = $_POST['pax'];
  $mesa = $_POST['mesa'];
  $fecha = $_POST['fecha'];
  $amb = $_POST['idamb'];
  $nomamb = $_POST['nomamb'];
  $imptoInc = $_POST['imptoInc'];
  $productos = $_POST['productos'];
  $cliente = strtoupper($_POST['cliente']);

  $numerocomanda = $pos->getNumeroComanda($amb);
  $nrocomanda = $numerocomanda + 1;
  $nuevonumero = $pos->updateNumeroComanda($amb, $nrocomanda);
  $subtotal = 0;
  $imptos = 0;
  $total = 0;

  foreach ($productos as $comandaventa) {
    $subt = round($comandaventa['venta'], 2);
    $impt = $comandaventa['valorimpto'];
    $ingresa = $pos->ingresoProductosComanda($amb, $usu, $comandaventa['producto'], $subt, $comandaventa['cant'], $comandaventa['importe'], $comandaventa['codigo'], $nrocomanda, $comandaventa['impto'], $impt);
  }


  $valComma = $pos->traeProductosVentaTotal($nrocomanda, $amb);

  $subtotal = $valComma[0]['baseimpto'];
  $imptos = $valComma[0]['valimpto'];
  $total = $valComma[0]['total'];

  $nuevacomanda = $pos->ingresoNuevaComanda($nrocomanda, $amb, $mesa, $pax, $usu, $fecha, 'A', $cliente);
  $actMesa = $pos->actualizaEstadoMesa($mesa, $amb, 'O');

  $aplicades = $pos->updateValorComanda($nrocomanda, $amb, $subtotal, $imptos, $total);

  $_SESSION['NUMERO_COMANDA'] = $nrocomanda;
  $_SESSION['AMBIENTE_ID'] = $amb;
  $_SESSION['NOMBRE_AMBIENTE'] = $nomamb;
  $_SESSION['usuario'] = $usu;

  echo $nrocomanda;
  ?> 
<?php

  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 

  $comanda   = $_POST['comanda'];
  $idusr     = $_POST['idusr'];
  $motivo    = strtoupper($_POST['motivo']);
  $descuento = $_POST['descuento'];
  $ambiente  = $_POST['idamb'];

  $dias      = array("domingo","lunes","martes","miercoles","jueves","viernes","sabado");
  $fecha     = $_POST['fecha'];
  $nDia      = $dias[date('N', strtotime($fecha))];
  $hoy       = date("Y-m-d H:i:s");
  $hora      = date('H:i');

  $tipod = 0;
  $porce = 0;

  $aplicades = $pos->updateDescuentos($comanda, $ambiente, $descuento,$tipod,$porce,0, $motivo, $idusr);

  $prodDescs = $pos->getProductosComandaVenta($comanda,$ambiente);

  foreach ($prodDescs as $producto) {
    $valor    = round(round($producto['venta'] * $porce ,0)/100,0);
    $neto     = $producto['venta'] - $valor;
    $valimpto = round(($neto * $producto['impto']/100),0);
    $descu    = $pos->updateDescuentoProducto($producto['id'],$valor,$porce,$valimpto);
  }

  echo $porce ;


?>

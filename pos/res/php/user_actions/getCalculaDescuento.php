<?php

  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 

  $comanda   = $_POST['comanda'];
  $idusr     = $_POST['idusr'];
  $motivo    = strtoupper($_POST['motivo']);
  $descuento = $_POST['tipodes'];
  $ambiente  = $_POST['idamb'];

  $dias      = array("domingo","lunes","martes","miercoles","jueves","viernes","sabado");
  $fecha     = $_POST['fecha'];
  $nDia      = $dias[date('N', strtotime($fecha))];
  $hoy       = date("Y-m-d H:i:s");
  $hora      = date('H:i');

  $montodes = $pos->getMontoDescuento($ambiente,$nDia,$descuento) ;

  if(count($montodes)==0){
    $tipod = 0;
    $porce = 0;
    $monto = 0;
  }else{
    if($montodes[0]['porcentaje']!=0){
      $tipod = 1;
    }else{
      $tipod = 2;
    }
    $porce = $montodes[0]['porcentaje'];
    $monto = $montodes[0]['valor'];
  }

  $valdescu  = $montodes[0]['porcentaje'];

  $prodDescs = $pos->getProductosComandaVenta($comanda,$ambiente);
  if($montodes[0]['porcentaje']!=0){
    foreach ($prodDescs as $producto) {
      $valor    = round(round($producto['venta'] * $porce ,2)/100,2);
      $neto     = $producto['venta'] - $valor;
      $valimpto = round(($neto * $producto['impto']/100),2);
      $descu    = $pos->updateDescuentoProducto($producto['id'],$valor,$porce,$valimpto);
      $monto    = $monto + $valor;
    }
  }

  $aplicades = $pos->updateDescuentos($comanda, $ambiente, $descuento, $tipod, $porce, $monto, $motivo, $idusr);

  echo $monto ;

?>

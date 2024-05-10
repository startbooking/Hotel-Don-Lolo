<?php
  require '../../../res/php/app_topInventario.php';
  
  extract($_POST);
  
  
  // $movimiento = inven->traeDatosMovimiento($numero,$tipo);
  
  include_once '../../views/prints/reImprimeTraslado.php';

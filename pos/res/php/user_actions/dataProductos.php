<?php 

  require '../../../../res/php/app_topPos.php'; 
  
  $idamb = 2;
  $prods = $pos->getTotalProductosVendidos($idamb);

  $array = array();
  $i = 0;
  $array[] = ['PRODUCTO','VALOR'];
  foreach ($prods as $prod) {
    $producto = $prod['nom'];
    $unidades_vendidas = $prod['cant'];
    $array['cols'][] = array('type' => 'string'); 
    $array['rows'][] = array('c' => array( array('v'=> $producto), array('v'=>(int)$unidades_vendidas)) );
  }

  echo json_encode($array);

?>
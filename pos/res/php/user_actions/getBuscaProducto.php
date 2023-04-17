<?php
  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php';
  $codigo = strtoupper($_POST['textoBusqueda']);
  $ambi = $_POST['id_ambiente'];
  $productos = $pos->getBuscaProducto($codigo, $ambi);

  echo json_encode($productos);

  ?> 
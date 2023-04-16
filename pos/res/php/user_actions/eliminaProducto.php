<?php 

  require '../../../../res/php/app_topPos.php'; 

  $id = $_POST['id'];

  $eli = $pos->eliminaProducto($id);
  echo $eli; 

 ?>

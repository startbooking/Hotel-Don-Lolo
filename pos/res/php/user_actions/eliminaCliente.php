<?php 

  require '../../../../res/php/app_topPos.php'; 

	$idusr = $_POST['idusr'];

  $eli = $pos->eliminaCliente($idusr);
  echo $eli; 

 ?>

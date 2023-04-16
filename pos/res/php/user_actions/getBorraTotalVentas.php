<?php

	require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 

	$xusu    = $_POST['usuario'];
	$amb     = $_POST['amb'];

  $venta = $pos->EliminaComanda($xusu,$amb) ;
  
  /// echo $venta;

?>
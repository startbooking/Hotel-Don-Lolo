<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['id'];

	$elimina = $admin->eliminaFormaPagoPos($id) ;

	echo $elimina ;

 ?>

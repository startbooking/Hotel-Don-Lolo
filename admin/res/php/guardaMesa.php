<?php 
	
  require '../../../res/php/app_topAdmin.php'; 
  extract($_POST);
	$mesa = $admin->insertMesa($ambienteAdi,$mesaAdi, $paxAdi) ;
	echo $mesa ;

 ?>

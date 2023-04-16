<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$descri = strtoupper(addslashes($_POST['descri']));

	$guarda = $admin->insertGrupoTarifa($descri) ;

	echo $guarda ;

 ?>

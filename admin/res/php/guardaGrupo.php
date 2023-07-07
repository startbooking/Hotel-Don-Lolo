<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id    = $_POST['familiaGrp'];
	$grupo = strtoupper(addslashes($_POST['nombreGrp']));

	$guarda = $admin->insertGrupoInv($id,$grupo) ;

	echo $guarda ;

 ?>

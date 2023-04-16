<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id      = $_POST['idGrupoMod'];
	$familia = $_POST['familiaGrpMod'];
	$grupo   = strtoupper($_POST['grupoMod']);
	
	$guarda = $admin->updateGrupoInv($id,$familia,$grupo) ;

	echo $guarda ;

 ?>

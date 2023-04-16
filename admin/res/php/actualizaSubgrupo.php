<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id       = $_POST['idSubGrupoMod'];
	$familia  = $_POST['familiaSubGrpMod'];
	$grupo    = $_POST['grupoSubGrupoMod'];
	$subgrupo = strtoupper(addslashes($_POST['descripSubGrupoMod']));

	$guarda = $admin->actualizaSubgrupo($id, $familia, $grupo, $subgrupo) ;

	echo $guarda ;

 ?>

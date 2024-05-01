<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id       = $_POST['idSubGrupoEli'];
	/*
	$familia  = $_POST['familiaSubGrpEli'];
	$grupo    = $_POST['grupoSubGrupoEli'];
	$subgrupo = strtoupper(addslashes($_POST['descripSubGrupoEli']));
	*/

	$guarda = $admin->eliminaSubgrupo($id) ;

	echo $guarda ;

 ?>

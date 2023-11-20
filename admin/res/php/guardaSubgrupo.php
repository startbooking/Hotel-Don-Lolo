<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id       = $_POST['id'];
	$grupo    = $_POST['grupo'];
	$subgrupo = strtoupper(addslashes($_POST['subgrupo']));

	$guarda = $admin->insertSubgrupo($id,$grupo,$subgrupo) ;

	echo $guarda ;

 ?>

<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_top.php'; 

	$id      = $_POST['id'];
	$usuario = strtoupper(addslashes($_POST['usuario']));
	$clave   = strtoupper(addslashes($_POST['clave']));
	
	$claveIn = sha1(md5($usuario.$clave));

	$cambiaClave = $user->updateUserPass($usuario, $claveIn, $id) ;

	echo $cambiaClave ;

 ?>

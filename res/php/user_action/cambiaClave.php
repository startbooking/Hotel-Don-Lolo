<?php 

  require '../app_top.php'; 

	$id    = $_POST["id"];
	$usu   = strtoupper(addslashes($_POST["usuario"]));
	$nueva = strtoupper(addslashes($_POST["nuevaclave"]));

	$nuevacla = sha1(md5($usu.$nueva));
	$cambia   = $user->cambiaClaveUsuario($nuevacla, $usu, $id); 

	echo $cambia ;
?>
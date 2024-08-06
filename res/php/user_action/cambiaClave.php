<?php 

  require '../app_top.php'; 
	extract($_POST);

	$pass3 = sha1(md5(strtoupper($usuario) . strtoupper($claveactual)));

	$compara = $user->comparaPass($usuario, $pass3);

	if($compara==0){
		echo $compara;
	}else {
		$nueva = sha1(md5(strtoupper($usuario) . strtoupper($nuevaclave)));
		$cambia   = $user->cambiaClaveUsuario($nueva, $usuario);  
		echo $cambia;
	}
?>
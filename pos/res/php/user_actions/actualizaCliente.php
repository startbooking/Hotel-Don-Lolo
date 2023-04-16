<?php
	  require '../../../../res/php/titles.php';
	  require '../../../../res/php/app_topPos.php'; 
	
		$id             = $_POST["idCli"];
		$apellido1      = strtoupper(strip_tags($_POST["apellido1"]));
		$apellido2      = strtoupper(strip_tags($_POST["apellido2"]));
		$nombre1        = strtoupper(strip_tags($_POST["nombre1"]));
		$nombre2        = strtoupper(strip_tags($_POST["nombre2"]));
		$direccion      = strtoupper(strip_tags($_POST["direccion"]));
		$telefono       = strtoupper(strip_tags($_POST["telefono"]));
		$celular        = strtoupper(strip_tags($_POST["celular"]));
		$correo         = strtolower(strip_tags($_POST["correo"]));
		$identificacion = strtoupper(strip_tags($_POST["identificacion"]));
		$tipodoc        = $_POST["tipodoc"];
		
		$cliente = $pos->actualizaCliente($id,$nombre1,$nombre2,$apellido1,$apellido2,$identificacion,$direccion,$telefono,$celular,$correo,$tipodoc);

		echo $cliente;

?>	
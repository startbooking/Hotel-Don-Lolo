<?php

	  require '../../../res/php/app_topInventario.php'; 

		$empresa   = strtoupper(addslashes($_POST["empresa"]));
		$nit       = $_POST["nit"];
		$direccion = strtoupper(addslashes($_POST["direccion"]));
		$digito    = $_POST["dv"];
		$telefono  = $_POST["telefono"];
		$celular   = $_POST["celular"];
		$email     = $_POST["correo"];
		$web       = $_POST["web"];
		$tipo_emp  = $_POST["tipo_emp"];
		$tipo_doc  = $_POST["tipo_doc"];
		$ciiu      = $_POST["ciiu"];
		$ciudad    = $_POST["ciudad"];
		$usuario   = $_POST["usuario"];

		if (!isset($_POST['nombre1'])){
			$nombre = "" ;
		}else{
			$nombre  = $_POST["nombre1"];
		}
		if (!isset($_POST['nombre2'])){
			$nombre2 =  "";
		}else{
			$nombre2 = $_POST["nombre2"];
		}
		if (!isset($_POST['apellido1'])){
			$apellido = "" ;
		}else{
			$apellido  = $_POST["apellido1"];
		}
		if (!isset($_POST['apellido2'])){
			$apellido2 = "" ;
		}else{
			$apellido2 = $_POST["apellido2"];
		}
		
		$creaProv = $inven->insertProveedor($empresa, $nit, $direccion, $digito, $telefono, $celular, $email, $web, $tipo_emp, $tipo_doc, $ciiu, $ciudad, $usuario);


?>	
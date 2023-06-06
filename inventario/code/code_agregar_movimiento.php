<?php
/*-----------------------
Autor: Obed Alvarado
http://www.obedalvarado.pw
Fecha: 27-02-2016
Version de PHP: 5.6.3
----------------------------*/
	# conectare la base de datos
	/*Inicia validacion del lado del servidor*/

	include_once('../../Conn/Conn.php');
		echo $_POST['productos']
	 	if (empty($_POST['bodega'])){
			$errors[] = "Sin Bodega Asignada al Movimiento";
	 	}else if (empty($_POST['tipomovi'])){
			$errors[] = "Sin Asignar Tipo de Movimiento ";
	 	}else if (empty($_POST['fecha'])){
			$errors[] = "Sin fecha Asociada al Movimiento";
	 	}else if (empty($_POST['proveedor'])){
			$errors[] = "Sin Proveedor Asignado al Movimiento";
	 	}else if (empty($_POST['factura'])){
			$errors[] = "Sin Numero de Factura Asignada al Movimiento";
	 	}else if ($_POST['productos']==0){
	 		echo $_POST['productos'];
	 		echo "Sin Productos al movimiento"
			$errors[] = "Sin Productos Asociados al Movimiento";
		} else if (
			!empty($_POST['bodega']) && 
			!empty($_POST['tipomovi'])){
		// escaping, additionally removing everything that could be (html/javascript-) code
		$empresa   = strtoupper(mysqli_real_escape_string($conn,(strip_tags($_POST["empresa"],ENT_QUOTES))));
		$nit       = $_POST["nit"];
		$direccion = strtoupper(mysqli_real_escape_string($conn,(strip_tags($_POST["direccion"],ENT_QUOTES))));
		$digito    = $_POST["digito"];
		$telefono  = $_POST["telefono"];
		$telefono2 = $_POST["telefono2"];
		$celular   = $_POST["celular"];
		$fax       = $_POST["fax"];
		$email     = $_POST["correo"];
		$web       = $_POST["web"];
		$tipo_emp  = $_POST["tipo_emp"];
		$tipo_doc  = $_POST["tipo_doc"];
		$ciiu      = $_POST["ciiu"];
		$pais      = $_POST["paices"];
		$ciudad    = $_POST["ciudad"];

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
		
		$sql="INSERT INTO proveedores (empresa, nombre, nombre2, apellido, apellido2, direccion, nit, digito, tipo_doc, telefono, telefono2, celular, fax, correo, web, pais, ciudad, tipo_emp, cod_ciiu, activo) VALUES ('$empresa', '$nombre', '$nombre2', '$apellido', '$apellido2', '$direccion', '$nit', '$digito', '$tipo_doc', '$telefono', '$telefono2', '$celular', '$fax', '$email', '$web', '$pais', '$ciudad', '$tipo_emp', '$ciiu', 1)";

		$query_update = mysqli_query($conn,$sql);
		if ($query_update){
			$messages[] = "El Proveedor sido Creado Satisfactoriamente.";
		} else{
			$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($conn);
		}
	} else {
		$errors []= "Error desconocido.";
	}
		
	if (isset($errors)){
		?>
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span class="glyphicon glyphicon-off"></span></button>
			<strong>Precaucion</strong> 
			<?php
				foreach ($errors as $error) {
					echo $error;
			}
			?>
		</div>
		<?php
	}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert"><span class="glyphicon glyphicon-off"></span></button>
						<strong>Atencion !</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>	
<?php
	# conectare la base de datos
	include_once('../../Conn/Conn.php');
	/*Inicia validacion del lado del servidor*/
	 	if (empty($_POST['id_prov'])){
			$errors[] = "Proveedor no Seleccionado";
		}elseif(!empty($_POST['id_prov'])){
			// escaping, additionally removing everything that could be (html/javascript-) code
			$id  = $_POST['id_prov'];
			$cod = $_POST['cod_prov'];
			$cventas = "SELECT * from movimientos_inventario where id_proveedor = '$id'";
			$vtas = mysqli_query($conn,$cventas);
			$vrow = mysqli_num_rows($vtas);
			if($vrow>0){
				$errors[] = "Proveedor con Movimientos de Inventarios , No Pemitido Eliminar";
			}else{
				$sql="DELETE FROM proveedores WHERE id_prov = '$id' ";
				$query_delete = mysqli_query($conn,$sql);
				if ($query_delete){
					$messages[] = "El Proveedor han sido eliminados satisfactoriamente.";
				}else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($conn);
				}
			}
		}else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span class="glyphicon glyphicon-off"></span></button>
					<strong style="color:#252121">Precaucion !</strong> 
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
					<strong style="color:#252121">Proveedor Eliminado Con Exito !!</strong>
					<?php
						foreach ($messages as $message) {
							/// echo $message;
						}
					?>
			</div>
			<?php
		}

?>	
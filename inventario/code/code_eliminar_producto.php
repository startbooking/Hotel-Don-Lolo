<?php
	# conectare la base de datos
	include_once('../../Conn/Conn.php');
	/*Inicia validacion del lado del servidor*/
	 	if (empty($_POST['id_prod'])){
			$errors[] = "Producto no Seleccionado";
		}elseif(!empty($_POST['id_prod'])){
			// escaping, additionally removing everything that could be (html/javascript-) code
			$id  = $_POST['id_prod'];
			$cod = $_POST['cod_prod'];
			$cventas = "SELECT * from movimientos_inventario where producto = '$cod'";
			$vtas = mysqli_query($conn,$cventas);
			$vrow = mysqli_num_rows($vtas);
			if($vrow>0){
				$errors[] = "Producto con Movimientos de Inventarios, No Pemitido Eliminar";
			}else{
				$sql="DELETE FROM productos_inve WHERE cod_prod = '$cod' ";
				$query_delete = mysqli_query($conn,$sql);
				if ($query_delete){
					$messages[] = "El Producto han sido eliminados satisfactoriamente.";
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
					<strong style="color:#252121">Producto Eliminado Con Exito !!</strong>
					<?php
						foreach ($messages as $message) {
							echo $message;
						}
					?>
			</div>
			<?php
		}

?>	
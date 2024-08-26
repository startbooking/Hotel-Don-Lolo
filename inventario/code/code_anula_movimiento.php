<?php
	# conectare la base de datos
	include_once('../../Conn/Conn.php');

	$alm    = $_POST['almacen'];
	$num    = $_POST['numero'];
	$tip    = $_POST['tipo'];
	$tipmov = $_POST['tipomov'];

	/*Inicia validacion del lado del servidor*/
	$sql="UPDATE movimientos_inventario SET estado = 2 WHERE bodega = '$alm' and numero = '$num' and tipo = '$tip' and tipo_movi = '$tipmov' ";
	$query_update = mysqli_query($conn,$sql);
	if ($query_update){
		$messages[] = "El Movimiento ha Sido Anulado Con Exito.";
	}else{
		$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($conn);
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
					<strong style="color:#252121">Atencion  !!</strong>
					<?php
						foreach ($messages as $message) {
							echo $message;
						}
					?>
			</div>
			<?php
		}

?>	
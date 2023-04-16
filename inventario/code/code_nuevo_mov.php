<?php
	
	session_start();
	/// include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
  include_once "../../Conn/Conn.php";
	if ($_POST['productos']==0){
		$errors[] = "Sin Productos ingresados a este Movimiento";
	}else if(empty($_POST['bodega'])){
	  $errors[] = "Sin Bodega Asignada al Movimiento";
	}else if(empty($_POST['tipomovi'])){
	  $errors[] = "Sin Tipo de Movimiento Asignado";
	}else if (empty($_POST['fecha'])){
		$errors[] = "Fecha en Blanco";
	}else if ($_POST['proveedor']==""){
		$errors[] = "Sin Proveedor Seleccionado";
	}else if (empty($_POST['factura'])){
		$errors[] = "Numero de Factura de Compra en Blanco no Permitido";
	}else if($_POST['productos']>=1) {
	
		/* Connect To Database*/
		// escaping, additionally removing everything that could be (html/javascript-) code
		$session    = $_POST['session'];
		$tipo       = $_POST["tipo"];
		$tipomovi   = $_POST["tipomovi"];
		$fecha      = $_POST["fecha"];
		$proveedor  = $_POST["proveedor"];
		$factura    = $_POST["factura"];
		$bodega     = $_POST["bodega"];
		$date_added = date("Y-m-d H:i:s");
		$usuario    = $_SESSION["usuario"];
		$fecha      = $fecha;
		$id_par     = 1; 
		$numsql = "SELECT c_entradas FROM parametros_inv WHERE id = '$id_par'";
		$numres = mysqli_query($conn,$numsql);
		$numrow = mysqli_num_rows($numres);
		if($numrow==1){
			$resrow = mysqli_fetch_array($numres);
			$numero = $resrow['c_entradas'];
			$numentra = $numero + 1;
			$sql_act = "UPDATE parametros_inv SET c_entradas = $numentra WHERE id = '$id_par'";
			$resp = mysqli_query($conn,$sql_act);
		}

		$tmpsql = "SELECT * FROM tmp_movi WHERE session_id = '$session'";
		$tmpres = mysqli_query($conn,$tmpsql);
		$tmprow = mysqli_fetch_array($tmpres);
		echo 
		while($row = mysqli_fetch_array($tmprow)){
			$valor    = $row["valor"];
			$cantidad = $row["cantidad"];
			$codigo   = $row["codigo"];
			$vunit    = $valor / $cantidad ;
			echo $valor;
			echo $cantidad;
			echo $codigo;
			$sql="INSERT INTO movimientos_inventario (tipo,tipo_movi,fecha_movimiento,id_proveedor, producto, cantidad, valor_unit, valor_total, bodega, usuario, fecha_ingreso, estado, requisicion, numero) VALUES ('$tipo','$tipomovi','$fecha','$proveedor','$codigo','$cantidad','$vunit', '$valor', '$bodega','$usuario','$date_added',1,'$factura','$numero')";
			//				$sql="INSERT INTO movimientos_inventario (tipo, tipo_movi, fecha_movimiento, id_proveedor, producto, cantidad, valor_unit, valor_total, bodega, est_movi, usu_movi,fecha_ingreso) VALUES ('$tipo','$tipomovi','$fecha','$proveedor','$codigo','$cantidad','$valor/$cantidad','$valor','$bodega',1,'$usuario','$date_added')";
			$query_new_insert = mysqli_query($conn,$sql);
		}
		$messages[] = "Entrada Ingresada Con exito";
		$messages[] = "Movimiento Numero".$numero;
	
	}

		
	if (isset($errors)){			
		?>
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span class="fa fa-circle-o-notch"></span></button>
				<h3 style='color:#362121;font-weight: 600'>Error!</h3>
				<ul>
				<?php
					foreach ($errors as $error) {
						?>
							<li style="margin-left:15px;font-size:2,5em"> <?=$error?> </li>
						<?php
						}
					?>
				</ul>
		</div>
		<?php
	
	}
	if (isset($messages)){
		
		?>
		<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>¡Bien hecho!</strong>
				<?php
					foreach ($messages as $message) {
							echo $message;
						}
					?>
		</div>
		<?php
	}

?>
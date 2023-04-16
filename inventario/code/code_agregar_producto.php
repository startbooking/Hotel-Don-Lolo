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
	
	 if (empty($_POST['codigo'])){
			$errors[] = "Codigo vacio";
		} else if (empty($_POST['producto'])){
			$errors[] = "Producto Vacio";
		}   else if (
			!empty($_POST['codigo']) && 
			!empty($_POST['producto'])
		){
			// escaping, additionally removing everything that could be (html/javascript-) code
			$codigo   =strtoupper(mysqli_real_escape_string($conn,(strip_tags($_POST["codigo"],ENT_QUOTES))));
			$producto =strtoupper(mysqli_real_escape_string($conn,(strip_tags($_POST["producto"],ENT_QUOTES))));
			$familia   = $_POST["familia"];
			$grupo     = $_POST["grupos"];
			$subgrupo  = $_POST["subgrupo"];
			$compra    = $_POST["compra"];
			$almacena  = $_POST["almacena"];
			$procesa   = $_POST["procesa"];
			$costo     = $_POST["costo"];
			$promedio  = $_POST["promedio"];
			$minimo    = $_POST["minimo"];
			$maximo    = $_POST["maximo"];

			if (!isset($_POST['porciona'])){
				$porciona = 0 ;
			}else{
				$porciona  = $_POST["porciona"];
			}
			if (!isset($_POST['equivale'])){
				$equivale = 0 ;
			}else{
				$equivale  = $_POST["equivale"];
			}
			if (!isset($_POST['cantidad']) && empty($_POST['cantidad'])){
				$cantidad = 0 ;
			}else{
				$cantidad  = $_POST["cantidad"];
			}
			$ubicacion = strtolower(mysqli_real_escape_string($conn,(strip_tags($_POST["ubicacion"],ENT_QUOTES))));
			// productos_pos (codigo, nombre, seccion, vlr_costo, impuesto, tipo_producto) VALUES ('$codigo','$producto','$seccion','$costo','$impto','$tipo')
			
			$sql="INSERT INTO productos_inve (nom_prod, cod_prod, cod_familia, cod_grupo, cod_subgrupo, uco_prod, ucp_prod, upr_prod, pco_prod, ppo_prod, stock_min, stock_max,  pri_prod, vpo_prod, por_prod, ubicacion) VALUES ('$producto', '$codigo', '$familia', '$grupo', '$subgrupo', '$compra', '$almacena', '$procesa', '$costo', '$promedio', '$minimo', '$maximo', '$porciona', '$cantidad', '$equivale', '$ubicacion')
			";

			$query_update = mysqli_query($conn,$sql);
			if ($query_update){
				$messages[] = "El Producto sido guardados satisfactoriamente.";
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
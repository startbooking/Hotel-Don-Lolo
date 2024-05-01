<?php
  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
	$codigo    = strtoupper($_POST['valorBusqueda']);
	$ambi      = $_POST['id'];
	$productos = $pos->getBuscaProducto($codigo, $ambi);

	if(count($productos)==0){
		echo '<h3 align="center" style="font-size:2em;color:#A20909;font-weight:bold"> Sin Productos Asignados</h3>';
	}

	else{ ?>
		<div class="container">
			<h3 align ='center' style='font-size:2em;color:#261414;font-weight:bold'> Seleccione el Producto</h3>
		</div>
		<div class="container"> 
		<?php 
		foreach ($productos as $producto) { 
			?>
			<button id="productos" class="btn btn-danger btnPos" onClick="getVentasRecu(this.name)" name="<?php echo $producto['producto_id']; ?>" type="button"><?php echo $producto['nom']?></button> 

			<?php 		
		}
		?>
		</div>
		<?php 
	}
?>
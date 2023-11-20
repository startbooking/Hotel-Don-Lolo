<?php
	
  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
	$codigo = $_POST['codigo'];
	$ambi   = $_POST['ambi'];


	$productos = $pos->getProductosTipo($codigo,$ambi);
	
	if(count($productos)==0){ ?> 
		<div class="container">	
			<h3 align="center" style="color:#A20909;font-weight:bold"> Sin Productos Asignados</h3>
		</div>
		<?php 
	}else{ ?>	
		<div class="container">	 
			<h3 align ='center' style='color:#261414;font-weight:bold'> Seleccione el Producto</h3>
		</div>
		<div class="container centrarBotones"  style="margin-top:15px;padding:0px">
			<?php 
			foreach ($productos as $producto) { ?>
				<button id="productos" class="btn btn-danger btnPos btnProd" onClick="getVentasRecu(this.name)" name="<?php echo $producto['producto_id']; ?>" type="button"><?php echo $producto['nom']?></button> 
				<?php 		
			}
			?>
		</div>
		<?php 
	}
?>
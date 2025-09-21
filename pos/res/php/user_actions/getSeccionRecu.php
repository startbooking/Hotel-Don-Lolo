<?php
	extract($_POST);
  
  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
	$secciones = $pos->getSeccionesPos($id_ambiente); 

?>
	<div class="container-fluid centrarBotones" style="width: 100%;padding:0px;margin:0px">
		<?php  
		foreach ($secciones as $seccion) : ?>
			<button class="btn btn-success btnPos btnSecc" onClick="getProductoRecu(this.name,<?=$idamb?>);" type="button" name='<?php echo $seccion['id_seccion']; ?>'  style="" title="<?php echo $seccion['nombre_seccion']; ?>"><span><?php echo $seccion['nombre_seccion']; ?></span> </button> 
			<?php
		endforeach
		?>
	</div>
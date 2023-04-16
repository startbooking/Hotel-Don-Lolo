<?php 

  require_once '../../../res/php/titles.php';
  require_once '../../../res/php/app_topHotel.php'; 

	$id     = $_POST['id'];
	$images = $hotel->muestraImagenes(2,$id);

?>
<div class="special-grids">
	<div class="featured-destinations main_galeria">
		<ul class='galeria'>
			<?php 
		 	foreach($images as $image): 
				$extension = pathinfo($image['nombre_imagen'], PATHINFO_EXTENSION);
		 		?>
 				<li class="galeria_item">
	        <a 
	        	data-toggle="modal" 
          	data-id="<?=$id?>" 
          	data-exte="<?=$extension?>" 
          	data-imagen="<?=BASE_PMS?>uploads/<?php echo $image['nombre_imagen']?>" 
	          href="#myModalMuestraDocumentoCia">
	          <?php 
	          if($extension=='pdf'){ ?>
	          	<object style='width:100%;overflow:hidden' data='<?=BASE_PMS?>uploads/<?php echo $image['nombre_imagen']?>'></object>
							<?php 
	          }else{ ?>
	        		<img class='images' src="<?=BASE_PMS?>uploads/<?php echo $image['nombre_imagen']?>" alt="">
							<?php 
	        	}
	           ?>
	      	</a> 
	      </li>
      <?php endforeach;  ?> 
    </ul>
	</div>
	<div class="clearfix"> </div>
</div>


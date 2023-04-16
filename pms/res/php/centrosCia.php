<?php 

  require '../../../res/php/app_topHotel.php'; 

  $idCia =  $_POST['idCia'];


  $centros = $hotel->getTraecentros($idCia);

  foreach ($centros as $centro) { ?>
		<option value="<?=$centro['id_centro']?>"><?=$centro['descripcion_centro']?></option>
		<?php 
	}	
?>    		


<?php 

  require '../../../res/php/app_topHotel.php'; 

  $companias = $hotel->getCompanias();

  foreach ($companias as $compania) { ?>
		<option value="<?=$compania['id_compania']?>"><?=$compania['empresa'].' '.$compania['nit'].'-'.$compania['dv']?></option>
		<?php 
	}	
?>    		


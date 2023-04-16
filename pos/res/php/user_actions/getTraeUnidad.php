<?php
	
  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
	
	$id         = $_POST['id'];
	$infoUnidad = $pos->buscaUnidad($id);

	echo $infoUnidad
	
	?>	 
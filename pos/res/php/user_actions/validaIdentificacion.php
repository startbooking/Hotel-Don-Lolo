<?php 

  require '../../../../res/php/app_topPos.php';

	$iden = $_POST['iden'];

  $identifica = $pos->buscaIdentificacion($iden) ;

  echo $identifica; 


 ?>

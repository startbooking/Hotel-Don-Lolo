<?php 

  require '../../../../res/php/app_topPos.php'; 

	$idusr = $_POST['idusr'];

  $cartera = $pos->traeCarteraCliente($idusr) ;

  if(count($cartera)==0){
    $eli = $pos->eliminaCliente($idusr);
    echo $eli;
  }else{
    echo '0' ;
  }


 ?>

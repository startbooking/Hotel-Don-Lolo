<?php

require '../../../res/php/app_topHotel.php';

$docus = $hotel->getTipoDocumento();
 
 echo json_encode($docus);
 
?>
  




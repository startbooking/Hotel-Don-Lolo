<?php

require '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$mmto = $hotel->treHabitacionesMmto($tipo);
 
 echo json_encode($mmto);
 
?>
  




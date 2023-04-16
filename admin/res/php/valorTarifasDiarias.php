<?php
  require '../../../res/php/app_topAdmin.php'; 

  $idtarifa  = $_POST['idtarifa'];
  $fecha   = date('Y-m-d'); 

  $dayrates = $admin->getDayRates($idhotel,$idroom);
  $regis = Count($dayrates);

  if($regis>0){
    $array = array(); 
    foreach ($dayrates as $dayrate):
      $array[] = $dayrate;
    endforeach ;
    echo json_encode($array); 
  }else{
    echo "0";
  }

?>


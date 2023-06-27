<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

	$id     = $_POST['idHotel'];
	$hotel  = strtoupper($_POST['nameHotelUpd']);
	$direc  = strtoupper($_POST['adressUpd']);
	$ciuda  = $_POST['cityUpd'];
	$habit  = $_POST['HabitacionesUpd'];
	$camas  = $_POST['CamasUpd'];
	$horas  = $_POST['horaUpd'];
	$email  = $_POST['emailUpd'];
	$tele   = $_POST['phoneUpd'];
	$celu   = $_POST['movilUpd'];
	$ctade  = $_POST['ctaMasted'];
	$iddep  = $_POST['idperfilctaMasted'];
	
	$upd = $admin->updateHotel($id, $hotel, $direc, $ciuda, $habit, $camas, $horas, $email, $tele, $celu, $ctade, $iddep);

	echo $upd;


 ?>

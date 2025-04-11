<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

	$id    = $_POST['idHotel'];
	$factu = $_POST['facturaUpd'];
	$depo  = $_POST['depositosUpd'];
	$abono = $_POST['abonosUpd'];
	$reser = $_POST['reservaUpd'];
	$regis = $_POST['registroUpd'];
	$decre = $_POST['decretoUpd'];
	$efec  = $_POST['efectivoUpd'];
	$avan  = $_POST['avanceUpd'];
	$pagos = $_POST['pagosUpd'];
	$reca  = $_POST['recaudosUpd'];
	$ctaco = $_POST['ctaConUpd'];
	$mmto  = $_POST['mmtoUpd'];
	
	$upd = $admin->updateConsecutivoHotel($id, $factu, $depo, $abono, $reser, $regis, $decre, $efec, $avan, $pagos, $reca, $ctaco, $mmto);

	echo $upd;


 ?>

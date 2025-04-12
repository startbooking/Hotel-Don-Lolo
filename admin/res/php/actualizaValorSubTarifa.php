<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['idValSubTariMod'];
	// $idhab = $_POST['valTipoHabitMod'];
	$desde = $_POST['desdeFechaMod'];
	$hasta = $_POST['hastaFechaMod'];
	$uno   = $_POST['valorUnPaxMod'];
	$dos   = $_POST['valorDosPaxMod'];
	$tre   = $_POST['valorTresPaxMod'];
	$cua   = $_POST['valorCuatroPaxMod'];
	$cin   = $_POST['valorCincoPaxMod'];
	$sei   = $_POST['valorSeisPaxMod'];
	$adi   = $_POST['valorAdicionalMod'];
	$nin   = $_POST['valorNinoMod'];

	$actual = $admin->updateValorSubgrupoTarifa($id, $desde, $hasta, $uno, $dos, $tre, $cua, $cin, $sei, $adi, $nin) ;

	echo $actual ;

 ?>

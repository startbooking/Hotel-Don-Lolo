<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$idsub = $_POST['idSubTariAdiMod'];
	$idhab = $_POST['valTipoHabit'];
	$desde = $_POST['desdeFechaAdi'];
	$hasta = $_POST['hastaFechaAdi'];
	$uno   = $_POST['valorUnPax'];
	$dos   = $_POST['valorDosPax'];
	$tre   = $_POST['valorTresPax'];
	$cua   = $_POST['valorCuatroPax'];
	$cin   = $_POST['valorCincoPax'];
	$sei   = $_POST['valorSeisPax'];
	$adi   = $_POST['valorAdicional'];
	$nin   = $_POST['valorNino'];

	$guarda = $admin->insertValorSubgrupoTarifa($idsub, $idhab, $desde, $hasta, $uno, $dos, $tre, $cua, $cin, $sei, $adi, $nin) ;

	echo $guarda ;

 ?>

<?php
	include_once('encabezado_empresa.php');

	$ambie = $pos->getInfoAmbiente($amb);

	$nombre     = $ambie[0]['nombre'];
	$prefijo    = $ambie[0]['prefijo'];
	$codigo     = $ambie[0]['codigo']; 
	$propina    = $ambie[0]['propina'];
	$servicio   = $ambie[0]['servicio'];
	$bodega     = $ambie[0]['id_bodega'];
	$t_propina  = $ambie[0]['texto_propina'];
	$t_servicio = $ambie[0]['texto_servicio'];
	$impuesto   = $ambie[0]['impuesto'];
	$logo       = $ambie[0]['logo'];
	
?>


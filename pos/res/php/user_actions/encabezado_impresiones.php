<?php
	include_once('encabezado_empresa.php');

	$ambie = $pos->getInfoAmbiente($id_ambiente);

	$nombre     = $ambie['nombre'];
	$prefijo    = $ambie['prefijo'];
	$codigo     = $ambie['codigo']; 
	$propina    = $ambie['propina'];
	$servicio   = $ambie['servicio'];
	$bodega     = $ambie['id_bodega'];
	$t_propina  = $ambie['texto_propina'];
	$t_servicio = $ambie['texto_servicio'];
	$impuesto   = $ambie['impuesto'];
	$logo       = $ambie['logo'];
	
?>


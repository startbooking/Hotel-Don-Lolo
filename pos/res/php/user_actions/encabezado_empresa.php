<?php 
	$datosEmpresa    = $admin->getInfoCia();

	$empresa   = $datosEmpresa[0]['empresa'];
	$nit       = strtr(number_format($datosEmpresa[0]['nit'],0),",",".").'-'.$datosEmpresa[0]['dv'];
	$direccion = $datosEmpresa[0]['direccion'];
	$telefono  = $datosEmpresa[0]['telefonos'];
	$celular   = $datosEmpresa[0]['celular'];
	$ciudad    = $datosEmpresa[0]['ciudad'];
	$web       = $datosEmpresa[0]['web'];
	$tipoc     = $datosEmpresa[0]['tipo_empresa'];

 ?>

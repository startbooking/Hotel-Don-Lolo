<?php 
	$datosEmpresa    = $admin->getInfoCia();

	$empresa   = $datosEmpresa['empresa'];
	$nit       = strtr(number_format($datosEmpresa['nit'],0),",",".").'-'.$datosEmpresa['dv'];
	$direccion = $datosEmpresa['direccion'];
	$telefono  = $datosEmpresa['telefonos'];
	$celular   = $datosEmpresa['celular'];
	$ciudad    = $datosEmpresa['ciudad'];
	$web       = $datosEmpresa['web'];
	$tipoc     = $datosEmpresa['tipo_empresa'];

 ?>

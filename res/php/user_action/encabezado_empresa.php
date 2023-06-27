<?php 

  require '../rutas.php';
  require '../app_top.php'; 

  $empresa = $user->getInfoCia();

	$empresa   = $empresa[0]['empresa'];
	$nit       = $empresa[0]['nit'];
	$div       = '-'.$empresa[0]['dv'];
	$direccion = $empresa[0]['direccion'];
	$telefono  = $empresa[0]['telefonos'];
	$celular   = $empresa[0]['celular'];
	$pais      = $empresa[0]['pais'];
	$ciudad    = $empresa[0]['ciudad'];
	$web       = $empresa[0]['web'];
	$correo    = $empresa[0]['correo'];
	$logo      = $empresa[0]['logo'];
	$tipoc     = $empresa[0]['tipo_empresa'];
	$ciiu      = $empresa[0]['codigo_ciiu'];

	$tipoEmpresa = $user->getTypeCia($tipoc);

 ?>

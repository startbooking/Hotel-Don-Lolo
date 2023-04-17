<?php 
  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 

	$clientes = $pos->getClientes();
	foreach ($clientes as $cliente) { ?>
		<option value="<?=$cliente['id_cliente']?>"><?=$cliente['apellido1'].' '.$cliente['apellido2'].' '.$cliente['nombre1'].' '.$cliente['apellido2']?></option> 
		<?php 
	}
	?>
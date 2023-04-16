<?php 
	include_once('../../Conn/funciones.php');
	$onit = $_POST['codigo'];
	if(empty($onit)){
	 $digito = "";
	}else{
		$digito = calcularDV($onit);
	}
	// return $digito;
?>
<input type="text" class="form-control" id="digito" name="digito" value="<?=$digito?>" readonly>

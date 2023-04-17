<?php 
  require '../../../res/php/funciones.php'; 

	$dvnit = $_POST['codigo'];

	if(empty($dvnit)){
	 $digito = "";
	}else{
		$digito = calcularDV($dvnit);
	}
	echo $digito;
?>

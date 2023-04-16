<?php 
	$resultado = $_POST['valorCaja1'] - $_POST['valorCaja2']; 
	if($resultado<0){
		$resultado = $resultado * -1;
		$titulo = 'Cambio / Vueltas';
		echo "<label name='resultado' class='avisoVta avisCambio'>";
	}else{
		echo "<label name='resultado' class='avisoVta avisoSaldo'>";
		$titulo = 'Saldo Pendiente';
	}
	?>
	<?php 
	echo $titulo. ' $ '.number_format($resultado,2,",",".");
	?>
</label>


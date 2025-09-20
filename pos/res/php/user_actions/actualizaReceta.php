<?php
	  require '../../../../res/php/app_topPos.php'; 
		extract($_POST);

		if (isset($_POST["subreceta"])) {
			$subreceta   = 1;
		} else {
			$subreceta   = 0;
		}

		$porImp = $pos->traePorcentajeImpto($impto);

		$vlrNeto = round($vlrVenta / (1+($porImp/100)),2);
		$vlrImpt = (($vlrNeto * $porImp)/ 100);
		$vlrPorc = $vlrNeto / $porcion;

		$actua = $pos->actualizaReceta(trim(strtoupper($receta)), $porcion, $tipoReceta, $impto, $subreceta, $vlrVenta, $vlrNeto, $vlrImpt, $vlrPorc, $margen, $tiempo, trim(strtoupper($preparacion)), strtoupper($montaje), $idReceta)	;	

		echo $actua;

?>


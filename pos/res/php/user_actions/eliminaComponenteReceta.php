<?php
		require_once '../../../../res/php/app_topPos.php'; 
		extract($_POST);
		$crea = $pos->eliminaMateriaPrima($cod);

		$valorCosto = $pos->traeCosto($receta);	
		$valorventa = $pos->traeVenta($receta);
		$porCosto   = 0;
		$valorPorci = 0;
		if(count($valorventa)>0){
			$valorPorci = $valorCosto / $valorventa[0]['cantidad'];
			if($valorventa[0]['valor_porcion']!=0){
				$porCosto   = ($valorPorci / $valorventa[0]['valor_porcion'])*100 ;
			}
		}

		$actCosto = $pos->actualizaCosto($receta,$porCosto, $valorCosto, $valorPorci);

		echo print_r($actCosto);
?>	
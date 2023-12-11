<?php
	  require '../../../../res/php/app_topPos.php';  
	
		$produc  = $_POST["idProd"];
		$receta  = $_POST["idRece"];
		$unidad  = $_POST["uniMedida"];
		$cantid  = $_POST["cantidad"];
		$valuni  = $_POST["valUnita"];
		$valtot  = $_POST["valTotal"];
		$usuario = $_POST["usuario"];
		
		$valorPorci = 0 ;
		$porCosto   = 0;

		$crea = $pos->adicionaMateriaPrima($produc, $receta, $unidad, $cantid, $valuni, $valtot, $usuario);

		$valorCosto = $pos->traeCosto($receta);
		$valorventa = $pos->traeVenta($receta);

		if(count($valorventa)>0){
			$valorPorci = $valorCosto / $valorventa[0]['cantidad'];
			if($valorventa[0]['valor_porcion'] ==0){
				$porCosto   = 0;
			}else{				
				$porCosto   = ($valorPorci / $valorventa[0]['valor_porcion'])*100 ;
			}
		}

		$actCosto = $pos->actualizaCosto($receta,$porCosto, $valorCosto, $valorPorci);

		echo $crea;

?>	
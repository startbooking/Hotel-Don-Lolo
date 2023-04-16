<?php
	  require '../../../res/php/app_topInventario.php'; 
	
		$id      = $_POST["id"];
		$tipo    = $_POST["tipo"];
		$bodega  = $_POST["bodega"];

		$usuario = $_POST["usuario"];

		$anula = $inven->anulaMovimiento($id, $tipo, $usuario)	;	
		$tipoAlm = $inven->getAlmacenPrincipal($bodega);

		if($tipo=='1' && $tipoAlm=='1'){

			$movimientos = $inven->getMovimientos($tipo,$id, $bodega);
			foreach ($movimientos as $key => $value) {
				$prom = $inven->calculaPromedioProd($value['id_producto'],$bodega);
				$inven->actualizaValorProd($value['id_producto'], $prom[0]['entradas'], $prom[0]['salidas'], $prom[0]['saldo'], $prom[0]['valorentradas'], $prom[0]['valorsalidas'], $prom[0]['valorsaldo'], $prom[0]['promedio']);
				$prodRece = $inven->medidaProduccion($value['id_producto']);

				$valpro  = $prom[0]['promedio'] / $prodRece; 

				$upd = $inven->actualizapromedioReceta($value['id_producto'],$valpro);

			}

		}


		echo $anula;

?>	
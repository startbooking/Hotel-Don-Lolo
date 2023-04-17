<?php 

	$fecha   = FECHA_PMS;
	$folio   = 1;
	$canti   = 1;
	$refer   = $fecha; 
	$detalle = 'Cargo Noche del '.$fecha	; 
	$regis   = 0;
	
	$cargoshab = $hotel->getCargoTodasHabitaciones(CTA_MASTER);

		foreach ($cargoshab as $cargohab) { 
			if($cargohab['cargo_habitacion']!=1){  
				$codigo      = $hotel->buscaCodigoTipoHabitacion($cargohab['tipo_habitacion']);
				$codigoVenta = $hotel->buscaTextoCodigoVenta($codigo);
				$valor       = $cargohab['valor_diario'];
				$totalcargo  = $valor * $canti; 
				$iva         = $codigoVenta[0]['id_impto'];
				$textocodigo = $codigoVenta[0]['descripcion_cargo'];
				$codigocar   = $codigoVenta[0]['id_cargo'];
				$turismo     = $cargohab['causar_impuesto'];
				$baseimpto   =  0;
				if($iva==0){
					$impuesto = 0; 
				}else{
					$porcentaje = $hotel->getPorcentajeIvaCargo($iva);
					$porcImpto  = $porcentaje[0]['porcentaje_impto'];
					$imptoTuri  = $porcentaje[0]['decreto_turismo'];

					if(IVA_INCLUIDO==1){	
						$nuevototal = round($totalcargo/((100+$porcImpto)/100),0);
						if($turismo==2 && $imptoTuri==1){
							$impuesto = 0;
						}else{
							$impuesto   = $totalcargo - $nuevototal;
						}
						$totalcargo = $nuevototal;
					}else{
						if($turismo==2 && $imptoTuri==1){
							$impuesto = 0;
						}else{
							$impuesto = round($totalcargo*($porcImpto/100),0);
						}
					}
				}

				if($impuesto<>0){
					$baseimpto = $totalcargo; 
				}

				$valor1  = $impuesto + $totalcargo;
				$numero  = $cargohab['num_reserva'];
				$room    = $cargohab['num_habitacion'];
				$idhues  = $cargohab['id_huesped'];

				$cargos = $hotel->insertCargosConsumos($codigocar, $textocodigo, $valor1, $canti, $refer, $folio, $detalle, $numero, $idhues, $usuario, $idusuario, $fecha, $room, $totalcargo, $impuesto, $baseimpto, $iva);

				$uRC = $hotel->updateRoomChange($numero);
			}
		}

?>

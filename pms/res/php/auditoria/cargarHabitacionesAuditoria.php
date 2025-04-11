<?php 
	// require '../../../../res/php/app_topHotel.php'; 
  // require '../../res/php/titles.php';
	/// echo 'Entro';
  /*
  
  require '../../res/php/app_topHotel.php'; 



	$folio   = 1;
	$canti   = 1;
	$usuario = $_SESSION['usuario'];


	$fecha   = FECHA_PMS;
	$refer   = FECHA_PMS; 
	$detalle = 'Cargo Noche del '.FECHA_PMS	; 
	$regis   = 0;
	
	$cargoshab = $hotel->getCargoTodasHabitaciones(CTA_MASTER);

	echo print_r($cargoshab);
   */

/*

		foreach ($cargoshab as $cargohab) { 
			if($cargohab['cargo_habitacion']==1){  
			}else{
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
						$nuevototal = round($totalcargo/((100+$porcImpto)/100),2);
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
							$impuesto = round($totalcargo*($porcImpto/100),2);
						}
					}
				}

				if($impuesto<>0){
					$baseimpto = $totalcargo; 
				}

				$valor1  =  $impuesto + $totalcargo;
				$numero  = $cargohab['num_reserva'];
				$room    = $cargohab['num_habitacion'];
				$idhues  = $cargohab['id_huesped'];
				$usuario = $_SESSION['usuario'];

				$cargos = $hotel->insertCargosConsumos($codigocar, $textocodigo, $valor1, $canti, $refer, $folio, $detalle, $numero, $idhues, $usuario, $fecha, $room, $totalcargo, $impuesto, $baseimpto, $iva);

				$uRC = $hotel->updateRoomChange($numero);
			}
		}
 */

?>

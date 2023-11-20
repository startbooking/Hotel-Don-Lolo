<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $reserva             = $_POST['reserva'];
  $_SESSION['reserva'] = $reserva;

  $datosReserva   = $hotel->getReservasDatos($reserva);
  $datosHuesped   = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);
  $datosCompania  = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);
  $tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);
  $saldofolio1    = $hotel->saldoFolio($reserva,1);
  $saldofolio2    = $hotel->saldoFolio($reserva,2);
  $saldofolio3    = $hotel->saldoFolio($reserva,3);
  $saldofolio4    = $hotel->saldoFolio($reserva,4);

 ?> 

<div class="container-fluid" style="padding-top:10px 15px;margin-top:20px;margin-bottom: 50px">
	<form class="form-horizontal" id="formHuespedes" action="javascript:guardaHuesped()" method="POST">
    <div class="panel panel-success">
    	<div class="panel-heading">
				<div class="panel-title">
          <input type="hidden" name="folioActivo" id="folioActivo" value="0">
          <input type="hidden" name="reservaActual" id="reservaActual" value="<?=$reserva?>">
          <h3 class="w3ls_head tituloPagina">Estado Cuenta Huesped</h3>
				</div>
    		<div class="container-fluid	">
					<div class="form-group">
			      <label for="apellidos" class="col-sm-1 control-label">Habitacion</label>
			      <div class="col-sm-1">
			        <input type="text" class="form-control" id="apellidos" placeholder="" value="<?php echo $datosReserva[0]['num_habitacion'] ?>" readonly>
			      </div>
			      <label for="apellidos" class="col-sm-2 control-label">Huesped </label>
			      <div class="col-sm-4">
			        <input type="text" class="form-control" id="apellidos" placeholder="" value="<?=$datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2']?>" readonly>
			      </div>
			      <label for="nombres" class="col-sm-2 control-label">Identificacion</label>
			      <div class="col-sm-2">
			        <input type="text" class="form-control" id="nombres" placeholder="" value="<?=$datosHuesped[0]['identificacion']?>" readonly>
			      </div>
		      </div>
					<div class="form-group">
					  <label for="llegada" class="col-sm-1 control-label">Llegada</label>
					  <div class="col-sm-2">
					    <input type="text" class="form-control" name="llegada" id="llegada" readonly="" value="<?=$datosReserva[0]['fecha_llegada']?>"> 
					  </div>
					  <label for="noches" class="col-sm-1 control-label">Noches</label>
					  <div class="col-sm-1">
					    <input type="text" class="form-control" name="noches" id="noches" readonly="" value='<?=$datosReserva[0]['dias_reservados']?>'>
					  </div>
					  <label for="salida" class="col-sm-1 control-label">Salida</label>
					  <div class="col-sm-2">
					    <input type="text" class="form-control" name="salida" id="salida" readonly="" value="<?=$datosReserva[0]['fecha_salida']?>">
					  </div>
					</div>
					<div class="form-group">
					  <label for="hombres" class="col-sm-1 control-label">Hombres</label>
					  <div class="col-sm-1">
					    <input type="text" class="form-control" name="hombres" id="hombres" required="" value="<?=$datosReserva[0]['can_hombres']?>" readonly>
					  </div>
					  <label for="mujeres" class="col-sm-1 control-label">Mujeres</label>
					  <div class="col-sm-1">
					    <input type="text" class="form-control" name="mujeres" id="mujeres" required="" value='<?=$datosReserva[0]['can_mujeres']?>' readonly>
					  </div>
					  <label for="ninos" class="col-sm-1 control-label">Niños</label>
					  <div class="col-sm-1">
					    <input type="text" class="form-control" name="ninos" id="ninos" required="" value="<?=$datosReserva[0]['can_ninos']?>" readonly >
					  </div>
					</div>
			    <?php 
			    if(!empty($datosReserva[0]['id_compania'])){
            if(!empty($datosCompania)){?>
  			      <div class="form-group">
  			        <label for="direccion" class="col-sm-2 control-label">Empresa </label>
  			        <div class="col-sm-4">
  			          <input type="text" class="form-control" id="direccion" placeholder="" value="<?=$datosCompania[0]['empresa']?>" readonly>
  			          <input type="hidden" name="idcia" id="idcia" value="<?=$datosCompania[0]['id_compania']?>">
  			        </div>
  			        <label for="nombres" class="col-sm-2 control-label">Nit</label>
  			        <div class="col-sm-4">
  			          <input type="text" class="form-control" id="nit" placeholder="" value="<?=$datosCompania[0]['nit'].'-'.$datosCompania[0]['dv']?>" readonly>
  			        </div>
  			      </div>
  			    <?php
            }
			    } 
					?>
		    </div> 
    	</div>
    	<div class="panel-body">
			  <div class="container-fluid">
			  	<h2>Folios Consumos</h2>
          <div id="mensajeCargo"></div>
				  <ul class="nav nav-tabs nav-justified">
				    <li class="active">
              <a data-toggle="tab" onclick="activaFolio(<?=$reserva?>,1)">Folio 1
              <?php 
              if($saldofolio1<> 0){ ?>
                  <span class="badge badge-danger fa fa-usd botonSaldo"> </span> 
                <?php 
              }
              ?>
              </a>
            </li>
				    <li>
              <a data-toggle="tab" onclick="activaFolio(<?=$reserva?>,2)">Folio 2 
                <?php 
                if($saldofolio2<> 0){ ?>
                  <span class="badge badge-danger fa fa-usd botonSaldo"> </span> 
                  <?php 
                }
                ?>
              </a>
            </li>
				    <li>
              <a data-toggle="tab" onclick="activaFolio(<?=$reserva?>,3)">Folio 3
                <?php 
                if($saldofolio3<> 0){ ?>
                  <span class="badge badge-danger fa fa-usd botonSaldo"> </span> 
                  <?php 
                }
                ?>
              </a>
            </li>
				    <li>
              <a data-toggle="tab" onclick="activaFolio(<?=$reserva?>,4)">Folio 4
                <?php 
                if($saldofolio4<> 0){ ?>
                  <span class="badge badge-danger fa fa-usd botonSaldo"> </span> 
                  <?php 
                }
                ?>
              </a>
            </li>
				  </ul>
				  <div class="tab-content">
						<div id="folio1" class="tab-pane fade in active">
							<div class="saldoFolioRoom1">
                <script>
                  reserva = $("#reservaActual").val();
                  activaFolio(reserva,1);
                </script>
              </div>
						</div>
						<div id="folio2" class="tab-pane fade">
							<div class="saldoFolioRoom2"></div>
						</div>
						<div id="folio3" class="tab-pane fade">
							<div class="saldoFolioRoom3"></div>
						</div>
						<div id="folio4" class="tab-pane fade">
							<div class="saldoFolioRoom4"></div>
						</div>
					</div>
				</div>				  
    	</div>
    	<div class="panel-footer" style="background-color:lightgoldenrodyellow">
    		<div class="container-fluid" id='saldoReserva'></div>
        <div class="container-fluid" style='padding: 0px'>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">              
              <a type="button" class="btn btn-warning" href="facturacion.php">Regresar</a>
              <a 
                type           ="button" class="btn btn-success" 
                data-toggle    ="modal" 
                data-target    ="#myModalSalidaHuesped"
                data-id        ="<?php echo $datosReserva['num_reserva']?>" 
                data-idhues    ="<?php echo $datosReserva['id_huesped']?>" 
                data-idcia     ="<?php echo $datosReserva['id_compania']?>" 
                data-nrohab    ="<?php echo $datosReserva['num_habitacion']?>" 
                data-apellidos ="<?php echo $datosReserva['apellidos']?>" 
                data-nombres   ="<?php echo $datosReserva['nombres']?>" 
                data-llegada   ="<?php echo $datosReserva['fecha_llegada']?>" 
                data-salida    ="<?php echo $datosReserva['fecha_salida']?>" 
                data-tarifa    ="<?php echo descripcionTarifa($datosReserva['tarifa'])?>" 
                data-valor="<?php echo $datosReserva['valor_diario']?>" 
                >
                Salida Huesped
              </a>
            </div>
          </div>          	
        </div>     
    	</div>
    </div>
	</form>
</div>

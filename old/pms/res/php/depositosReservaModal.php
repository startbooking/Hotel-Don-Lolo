<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $reserva  =  $_POST['reserva'];

  $datosReserva = $hotel->getReservasDatos($reserva); 
  $depositos    = $hotel->getDepositosReservas($reserva);

?> 

<div class="container-fluid" style="padding:0px;margin-top:10px;">
	<form class="form-horizontal" id="formHuespedes" action="#" method="POST">
    <div class="panel panel-success">
    	<div class="panel-heading" style="padding:5px;">
    		<div class="container-fluid" style="padding:0px;">
					<div class="form-group">
			      <label for="apellidos" class="col-sm-2 control-label">Habitacion</label>
			      <div class="col-sm-2">
			        <input type="text" class="form-control" id="apellidos" placeholder="" value="<?php echo $datosReserva[0]['num_habitacion'] ?>" readonly>
			      </div>
			      <label for="apellidos" class="col-sm-2 control-label">Huesped </label>
			      <div class="col-sm-6">
			        <input type="text" class="form-control" id="apellidos" placeholder="" value="<?=$datosReserva[0]['nombre_completo']?>" readonly>
			      </div>
		      </div>
					<div class="form-group">
					  <label for="llegada" class="col-sm-2 control-label">Llegada</label>
					  <div class="col-sm-3">
					    <input type="text" class="form-control" name="llegada" id="llegada" readonly="" value="<?=$datosReserva[0]['fecha_llegada']?>"> 
					  </div>
					  <label for="noches" class="col-sm-1 control-label">Noches</label>
					  <div class="col-sm-2">
					    <input type="text" class="form-control" name="noches" id="noches" readonly="" value='<?=$datosReserva[0]['dias_reservados']?>'>
					  </div>
					  <label for="salida" class="col-sm-1 control-label">Salida</label>
					  <div class="col-sm-3">
					    <input type="text" class="form-control" name="salida" id="salida" readonly="" value="<?=$datosReserva[0]['fecha_salida']?>">
					  </div>
					</div>
		    </div>
    	</div>
    	<div class="panel-body" style="padding:5px">
			  <div class="container-fluid" style="padding:0">
          <div class="table-responsive-lg">
            <table id="example1" class="table modalTable table-bordered">
              <thead class="warning">
                <tr>
                  <th>Deposito</th>
                  <th>Forma de Pago</th>
                  <th>Descripcion</th>
                  <th>Fecha</th>
                  <th>Valor</th>
                  <th>Usuario</th>
                  <th>Doc</th>
                </tr>
              </thead>
              <tbody>
                  <?php 
                  $pagos = 0;
                  foreach ($depositos as $deposito): 
                    $pagos = $pagos + $deposito['pagos_cargos']; 
                    $docu  = $hotel->buscaDocumentoDeposito($deposito['concecutivo_deposito']);
                  ?>
                  <tr align="right">
                    <td><?=$deposito['concecutivo_deposito']?></td>
                    <td align="left"><?=$deposito['descripcion_cargo']?></td>
                    <td align="left"><?=$deposito['informacion_cargo']?></td>
                    <td><?=$deposito['fecha_cargo']?></td>
                    <td><?=number_format($deposito['pagos_cargos'],2)?></td>
                    <td><?=$hotel->nombreUsuario($deposito['id_usuario'])?></td>
                    <td>
                      <?php 
                        if($docu!=''){ ?>
                          <a 
                            class="btn btn-danger btn-xs" 
                            data-toggle="modal" 
                            data-imagen="<?=BASE_PMS?>uploads/<?php echo $docu?>" 
                            title="Ver Comprobante de Deposito"
                            href="#myModalMuestraDeposito">
                            <i class="fa fa-file"></i>
                          </a> 
                          <?php
                        }
                      ?>
                    </td>

                  </tr>
                  <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <div class="container-fluid" style="padding:5px;background-color:#dff0d8">
            <div class="form-group">
              <label for="apellidos" class="col-sm-3 control-label">Total Deposito</label>
              <div class="col-sm-3">
                <input align="right" type="text" class="form-control" id="saldototal" placeholder="" value="<?php echo number_format($pagos,2)?>" readonly>
              </div>
            </div>
          </div>				
        </div>				  
    	</div>
    </div>
	</form>
</div>

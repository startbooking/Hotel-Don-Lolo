<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
	$reserva =  $_POST['reserva'];
	$estado  =  $_POST['estado'];

  $datosReserva = $hotel->getReservasDatos($reserva); 

	/// echo print_r($datosReserva);  
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
			  <div class="container-fluid" style="padding:0 10px">
			  	<h5 style="margin:10px;font-weight: 600;font-size: 14px;font-family: 'Ubuntu'">Observaciones</h5>
          <div class="col-md-12">
          	<?php 
          	if($estado==1){ ?>
	            <textarea name="" value=""><?= strtoupper($datosReserva[0]['observaciones'])?></textarea>
							<?php 
          	}else{ ?>
	            <textarea name="" value=""><?= strtoupper($datosReserva[0]['observaciones_cancela'])?></textarea>
						<?php 
          	}
          	?>
          </div>
        </div>				  
    	</div>
    </div>
	</form>
</div>

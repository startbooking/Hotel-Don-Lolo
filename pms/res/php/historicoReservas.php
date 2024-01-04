<?php 

  require_once '../../../res/php/app_topHotel.php'; 

  $id       = $_POST['id'];
  $reservas = $hotel->getHistoricoReservas($id);

	if(count($reservas)==0){ ?>
		<div class="alert alert-warning"><h3>Sin Historico de Reservas</h3></div>
	<?php 
	}else{ 
		?>
	  <div class='table-responsive'>
	    <table id="example1" class="table modalTable table-bordered">
	      <thead>
	        <tr class="warning" style="font-weight: bold">
	          <td>Nro</td>
	          <td>Tipo Hab.</td>
	          <td>Hab.</td>
	          <td>Llegada</td>
	          <td>Salida</td>
	          <td>Noches</td>
	          <td>Hom</td>
	          <td>Muj</td>
	          <td>Nin</td>
	          <td>Estado</td>
	          <td>Accion</td>
	        </tr>
	      </thead>
	      <tbody>
	        <?php
	        foreach ($reservas as $reserva) { ?>
	          <tr style='font-size:12px'>
	            <td><?php echo $reserva['num_reserva']?></td>
	            <td style="text-align:left;"><?php echo $reserva['descripcion_habitacion']; ?></td>
	            <td><?php echo $reserva['num_habitacion']; ?></td>
	            <td><?php echo $reserva['fecha_llegada']; ?></td>
              <?php 
              if($reserva['salida_checkout']!=Null){ ?>
                <td><?php echo $reserva['salida_checkout']; ?></td>
                <td style="text-align:center;"><?php echo $dateDifference = abs(strtotime($reserva['fecha_llegada']) - strtotime($reserva['salida_checkout']))/(60 * 60 * 24); ?></td>
                <?php 
              }else{ ?>
                <td><?php echo $reserva['fecha_salida']; ?></td>
                <td style="text-align:center;"><?php echo $reserva['dias_reservados']; ?></td>
                <?php 
              }
	            ?>
              <td style="text-align:center;"><?php echo $reserva['can_hombres']; ?></td>
	            <td style="text-align:center;"><?php echo $reserva['can_mujeres']; ?></td>
	            <td style="text-align:center;"><?php echo $reserva['can_ninos']; ?></td>
	            <td><?php echo estadoReserva($reserva['estado']); ?></td>
	            <td style="text-align:left;" style="width: 18%">
								<div class="btn-group" role="group" aria-label="Basic example">
                  <button 
                  	style="height: 22px;padding:2px 10px;font-size:12px" 
                  	type="button" 
                  	class="btn btn-info"   
                    data-toggle ="modal" 
                    data-target  ="#myModalVerInformacionEstadia"  
                    data-reserva ="<?php echo $reserva['num_reserva']?>" 
                    title="Ver Reserva" >
                    <i class='fa fa-file-text'></i>
                    
                  </button>
                  <?php  
                  if($reserva['estado']=='SA'){?> 
	                  <button 
	                  	style="height: 22px;padding:2px 10px;font-size:12px" 
	                  	type="button" 
	                  	class="btn btn-danger" 
	                    data-toggle ="modal" 
	                    data-target ="#myModalverFacturaReserva" 
	                    data-reserva ="<?php echo $reserva['num_reserva']?>" 
	                    title="Ver Facturas Estadia Actual" >
	                    <i class="fa-regular fa-file-lines"></i>
	                  </button>
	                  <?php 
                  }
                  ?> 
	                <button type="button" 
		                class="btn btn-success btn-xs"
	                	style="height: 22px;padding:2px 10px;font-size:12px" 
		                onclick="imprimirHistoricoRegistro('<?=$reserva['num_registro']?>')" 
                    title="Ver Registro Hotelero"
		                >
		                <i class="fa fa-book" aria-hidden="true"></i>
		              </button >
                  <button 
                    class              ="btn btn-warning btn-xs"
                    style              ="height: 22px;padding:2px 10px;font-size:12px" 
                    data-toggle        ="modal" 
                    data-target        = "#myModalAcompanantesHistoricoReserva"
                    data-id            ="<?php echo $reserva['num_reserva']?>" 
                    data-tipohab       ="<?php echo $reserva['descripcion_habitacion']?>"  
                    data-nrohab        ="<?php echo $reserva['num_habitacion']?>" 
                    data-nombre        ="<?php echo $reserva['nombre_completo']?>" 
                    data-llegada       ="<?php echo $reserva['fecha_llegada']?>" 
                    data-salida        ="<?php echo $reserva['fecha_salida']?>" 
                    data-noches        ="<?php echo $reserva['dias_reservados']?>" 
                    data-hombres       ="<?php echo $reserva['can_hombres']?>" 
                    data-mujeres       ="<?php echo $reserva['can_mujeres']?>" 
                    data-ninos         ="<?php echo $reserva['can_ninos']?>" 
                    data-orden         ="<?php echo $reserva['orden_reserva']?>" 
                    data-tipo          ="<?php echo $reserva['tipo_reserva']?>" 
                    data-tarifa        ="<?php echo $hotel->getDescripcionTarifa($reserva['tarifa'])?>" 
                    data-valor         ="<?php echo $reserva['valor_diario']?>" 
                    data-observaciones ="<?php echo $reserva['observaciones']?>" 
                    title              ="Ver Acompañantes de la Estadia"
                    >
                    <i class="fa fa-users" aria-hidden="true"></i>
                  </button>
                </div> 	            	
	            </td>			
	          </tr>
	          <?php 
	        }
	        ?>
	      </tbody>
	    </table>
	  </div>
    <table id="tablaReservas" class="table modalTable table-bordered" style="display:none">
      <thead>
        <tr class="warning" style="font-weight: bold">
          <td>Reserva Nro</td>
          <td>Tipo Hab.</td>
          <td>Hab.</td>
          <td>Llegada</td>
          <td>Salida</td>
          <td>Noches</td>
          <td>Hombres</td>
          <td>Mujeres</td>
          <td>Niños</td>
          <td>Estado</td>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($reservas as $reserva) { ?>
          <tr style='font-size:12px'>
            <td><?php echo $reserva['num_reserva']?></td>
            <td><?php echo $reserva['descripcion_habitacion']; ?></td>
            <td><?php echo $reserva['num_habitacion']; ?></td>
            <td><?php echo $reserva['fecha_llegada']; ?></td>
            <td><?php echo $reserva['fecha_salida']; ?></td>
            <td style="text-align:center;"><?php echo $reserva['dias_reservados']; ?></td>
            <td style="text-align:center;"><?php echo $reserva['can_hombres']; ?></td>
            <td style="text-align:center;"><?php echo $reserva['can_mujeres']; ?></td>
            <td style="text-align:center;"><?php echo $reserva['can_ninos']; ?></td>
            <td><?php echo estadoReserva($reserva['estado']); ?></td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>

	<?php 
	}

 ?>
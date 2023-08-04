<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$id       = $_POST['id'];
	$reservas = $hotel->getReservasEsperadasCia($id);

	if(count($reservas)==0){ ?>
		<div class="alert alert-warning"><h3 class="tituloPagina">Sin Reservas Activas </h3></div>
	<?php 
	}else{
		?>
	  <div class='table-responsive' style="overflow: auto;max-height: 400px;">
	    <table id="example1" class="table table-bordered">
	      <thead>
	        <tr class="warning" style="font-weight: bold">
	          <td>Reserva</td>
	          <td>Huesped</td>
	          <td>Tipo Hab.</td>
	          <td>Hab.</td>
	          <td>Llegada</td>
	          <td>Salida</td>
	          <td>Noches</td>
	          <td>Estado</td>
	        </tr>
	      </thead>
	      <tbody>
	        <?php
	        foreach ($reservas as $reserva) { ?>
	          <tr style='font-size:12px;text-align:left'>
	            <td><?php echo $reserva['num_reserva']?></td>
	            <td style="text-align:left;"><?php echo $reserva['nombre_completo']; ?></td>
	            <td><?php echo $reserva['descripcion_habitacion']; ?></td>
	            <td><?php echo $reserva['num_habitacion']; ?></td>
	            <td><?php echo $reserva['fecha_llegada']; ?></td>
	            <td><?php echo $reserva['fecha_salida']; ?></td>
	            <td align="center"><?php echo $reserva['dias_reservados']; ?></td>
	            <td><?php echo estadoReserva($reserva['estado']); ?></td>
	          </tr>
	          <?php 
	        }
	        ?>
	      </tbody>
	    </table>
	  </div>
	<?php 
	}

 ?>
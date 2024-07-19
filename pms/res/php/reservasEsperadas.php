<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$id       = $_POST['id'];
	$reservas = $hotel->getReservasEsperadas($id);

	if(count($reservas)==0){ ?>
		<div class="alert alert-warning"><h3 class="tituloPagina">Sin Reservas Activas </h3></div>
	<?php 
	}else{
		?>
	  <div class='table-responsive'>
	    <table id="example1" class="table table-bordered">
	      <thead>
	        <tr class="warning" style="font-weight: bold">
	          <td>Reserva Nro</td>
	          <td>Tipo Hab.</td>
	          <td>Nro Hab.</td>
	          <td>Llegada</td>
	          <td>Salida</td>
	          <td>Noches</td>
	          <td>Hombres</td>
	          <td>Mujeres</td>
	          <td>Estado</td>
	        </tr>
	      </thead>
	      <tbody>
	        <?php
	        foreach ($reservas as $reserva) { ?>
	          <tr style='font-size:12px'>
	            <td><?php echo $reserva['num_reserva']?></td>
	            <td align="left"><?php echo $reserva['descripcion_habitacion']; ?></td>
	            <td><?php echo $reserva['num_habitacion']; ?></td>
	            <td><?php echo $reserva['fecha_llegada']; ?></td>
	            <td><?php echo $reserva['fecha_salida']; ?></td>
	            <td align="center"><?php echo $reserva['dias_reservados']; ?></td>
	            <td align="center"><?php echo $reserva['can_hombres']; ?></td>
	            <td align="center"><?php echo $reserva['can_mujeres']; ?></td>
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
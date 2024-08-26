<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$buscar = $_POST['buscar'];
	$fecha  = FECHA_PMS;

	$huespedes = $hotel->getBuscarHuespedReserva($buscar);

	if(count($huespedes)==0){ ?>
		<h4 align="center" class="bg-red" style="padding:10px"><span style="font-size:24px;font-weight: 700;font-family: 'ubuntu';">Sin Huespedes Encontrados</span></h4>
	<?php 
	}else{
		?>
		<div class="container-fluid">
		  <div class='table-responsive'>
		    <table id="example1" class="table table-bordered">
		      <thead>
		        <tr class="warning" style="font-weight: bold">
		          <td>Identificacion</td>
		          <td>Huesped</td>
		          <td>Correo</td>
		          <td>Accion</td>
		        </tr>
		      </thead>
		      <tbody>
		        <?php
		        foreach ($huespedes as $huesped) { ?>
		          <tr style='font-size:12px'>
		            <td style="padding: 3px 5px;"><?php echo $huesped['identificacion']?></td>
		            <td style="padding: 3px 5px;"><?php echo $huesped['apellido1'].' '.$huesped['apellido2'] .' '.$huesped['nombre1'].' '.$huesped['nombre2']; ?></td>
		            <td style="padding: 3px 5px;"><?php echo $huesped['email']; ?></td>
		            <td style="padding: 3px 5px;text-align:center;">
		            	<button onclick="seleccionaCambioHuespedReserva(<?=$huesped['id_huesped']?>)" type="button" class="btn btn-info btn-xs"><i class="fa fa-check-square" aria-hidden="true"></i>
		            	</button>
		            </td>
		          </tr>
		          <?php 
		        }
		        ?>
		      </tbody>
		    </table>
		  </div>
	  </div>
	<?php 
	}
 ?>

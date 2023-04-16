<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$idres = $_POST['idres'];
	$fecha = FECHA_PMS; 
	
	$huespedes = $hotel->getBuscarAcompanantesReserva($idres);

	if(count($huespedes)==0){ ?>
		<h4 align="center" class="bg-red" style="padding:10px"><span style="font-size:24px;font-weight: 700;font-family: 'ubuntu';">Sin Acompañantes</span></h4>
	<?php 
	}else{
		?>
	  <div class='table-responsive'>
	    <table id="example1" class="table table-bordered">
	      <thead>
	        <tr class="warning" style="font-weight: bold">
	          <td>Identificacion</td>
	          <td>Nombres Acompañantes</td>
	          <td>Sexo</td>
	        </tr>
	      </thead>
	      <tbody>
	        <?php
		        foreach ($huespedes as $huesped) { ?>
		          <tr style='font-size:12px'>
		            <td style="padding: 3px 5px;text-align: left"><?php echo $huesped['identificacion']?></td>
		            <td style="padding: 3px 5px;"><?php echo $huesped['nombre_completo']; ?></td>
		            <td style="padding: 3px 5px;text-align: right;"><?php echo sexo($huesped['sexo']); ?></td>
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

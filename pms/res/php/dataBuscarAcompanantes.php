<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$idres = $_POST['idres'];
	$fecha = FECHA_PMS; 
	
	$huespedes = $hotel->getBuscarAcompanantesReserva($idres);

	if(count($huespedes)==0){ ?>
		<div class="alert alert-warning" >
			<h4 style="text-align:center;" ><span style="font-size:24px;font-weight: 700;font-family: 'ubuntu';color:#0009;">Sin Acompañantes</span></h4>
		</div>
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
	          <td>Accion</td>
	        </tr>
	      </thead>
	      <tbody>
	        <?php
		        foreach ($huespedes as $huesped) { ?>
		          <tr style='font-size:12px'>
		            <td style="padding: 3px 5px;text-align:left"><?php echo $huesped['identificacion']?></td>
		            <td style="padding: 3px 5px;"><?php echo $huesped['nombre_completo']; ?></td>
		            <td style="padding: 3px 5px;"><?php echo sexo($huesped['sexo']); ?></td>
		            <td style="padding: 3px 5px;text-align:center;">
		            	<button 
		            		onclick="eliminaAcompanante(<?=$huesped['id']?>)" 
		            		type="button" 
		            		class="btn btn-danger btn-xs" 
		            		>
		            		<i class="fa fa-user-times" aria-hidden="true"></i>
		            	</button>
		            </td>
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

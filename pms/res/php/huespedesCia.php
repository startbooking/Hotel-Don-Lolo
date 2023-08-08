<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$id        = $_POST['id'];
	$huespedes = $hotel->getHuespedesCia($id);

	if(count($huespedes)==0){ ?>
		<div class="alert alert-warning"><h3 class="tituloPagina">Sin Huespedes Asociados </h3></div>
	<?php 
	}else{
		?>
	  <div class='table-responsive'>
	    <table id="example1" class="table table-bordered">
	      <thead>
	        <tr class="warning" style="font-weight: bold;">
	          <td >Identificacion</td>
	          <td >Huesped</td>
	          <td>Celular</td>
	          <td>Correo</td>
	        </tr>
	      </thead>
	      <tbody>
	        <?php
	        foreach ($huespedes as $huesped) { ?>
	          <tr style='font-size:12px'>
	            <td align="left"><?php echo $huesped['identificacion']?></td>
	            <td align="left"><?php echo $huesped['nombre_completo']; ?></td>
	            <td><?php echo $huesped['celular']; ?></td>
	            <td align="left"><?php echo $huesped['email']; ?></td>
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
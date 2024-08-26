<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

	$id        = $_POST['id'];
	$contactos = $hotel->getContactosCia($id);

	if(count($contactos)==0){ ?>
		<div class="alert alert-warning"><h3 class="tituloPagina">Sin Contactos Asociados </h3></div>
	<?php 
	}else{
		?>
	  <div class='table-responsive'>
	    <table id="example1" class="table table-bordered">
	      <thead>
	        <tr class="warning" style="font-weight: bold;">
	          <td >Identificacion</td>
	          <td >Apellidos</td>
	          <td >Nombres</td>
	          <td>Celular</td>
	          <td>Telefono</td>
	          <td>Ext</td>
	          <td>Correo</td>
	          <td>Accion</td>
	        </tr>
	      </thead>
	      <tbody>
	        <?php
	        foreach ($contactos as $contacto) { ?>
	          <tr style='font-size:12px'>
	            <td align="left"><?php echo $contacto['identificacion']?></td>
	            <td align="left"><?php echo $contacto['apellidos']; ?></td>
	            <td align="left"><?php echo $contacto['nombres']; ?></td>
	            <td align="right"><?php echo $contacto['celular']; ?></td>
	            <td align="right"><?php echo $contacto['telefono']; ?></td>
	            <td align="right"><?php echo $contacto['extencion']; ?></td>
	            <td align="left"><?php echo $contacto['email']; ?></td>
	            <td>
	            	<div class="btn-group">
								  <button type="button" class="btn btn-info btn-xs" title="Modificar Contacto"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
								  <button type="button" class="btn btn-warning btn-xs" title="Eliminar Contacto"><i class="fa fa-ban" aria-hidden="true"></i></button>
								  <button type="button" class="btn btn-success btn-xs" title="Cambiar de Compania"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
								</div> 
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
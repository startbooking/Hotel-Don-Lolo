<?php

require '../../../res/php/app_topAdmin.php';
$id = $_POST['id'];
$tarifasgrupo = $admin->getTarifasGrupo($id);

?>
<table id="tablaSubTarifas" class="table table-bordered table-resposive">
  <thead>
    <tr>
      <th>Sub Grupo</th> 
      <th>Accion</th> 
    </tr> 
  </thead>
  <tbody>
		<?php
        foreach ($tarifasgrupo as $tarifagrupo) { ?>
			<tr>
		    <td id='nombre'><?php echo $tarifagrupo['descripcion_tarifa']; ?></td>
		    <td align="center" style="width: 25%">
		      <div class="btn-toolbar" role="toolbar">
		        <div class="btn-group" role="group">
		          <button type="button" class="btn btn-info btn-xs" 
								data-toggle  ="modal" 
								data-target  ="#myModalModificaSubtarifa" 
								data-id      ="<?php echo $tarifagrupo['id_tarifa']; ?>" 
								data-idgrupo ="<?php echo $tarifagrupo['id_grupo_tarifa']; ?>" 
								data-descri  ="<?php echo $tarifagrupo['descripcion_tarifa']; ?>" 
		            title="Modificar la Tarifa Actual" >
		            <i class='fa fa-pencil-square'></i>
		          </button>
		          <button type="button" class="btn btn-danger btn-xs"
		          	data-toggle  ="modal" 
								data-target  ="#myModalEliminaSubtarifa" 
								data-id      ="<?php echo $tarifagrupo['id_tarifa']; ?>" 
								data-idgrupo ="<?php echo $tarifagrupo['id_grupo_tarifa']; ?>" 
								data-descri  ="<?php echo $tarifagrupo['descripcion_tarifa']; ?>" 
		            title="Eimina el Sub Grupo de Tarifa Actual" >
		            <i class='fa fa-trash'></i>
		          </button> 
		        </div>
		        <div class="btn-group" role="group" aria-label="...">
		          <button type="button" class="btn btn-success btn-xs" 
								data-toggle  ="modal" 
								data-target  ="#myModalValoresSubTarifas" 
								data-id      ="<?php echo $tarifagrupo['id_tarifa']; ?>" 
								data-idgrupo ="<?php echo $tarifagrupo['id_grupo_tarifa']; ?>" 
								data-descri  ="<?php echo $tarifagrupo['descripcion_tarifa']; ?>" 
		            title="Tipos de Habitaciones de la Sub Tarifa Actual" >
		            <i class='fa fa-window-restore'></i>
		          </button>
		        </div>		        
		        <div class="btn-group" role="group" aria-label="...">
		          <button type="button" class="btn btn-warning btn-xs" 
								data-toggle  ="modal" 
								data-target  ="#myModalPaquetesSubTarifas" 
								data-id      ="<?php echo $tarifagrupo['id_tarifa']; ?>" 
								data-idgrupo ="<?php echo $tarifagrupo['id_grupo_tarifa']; ?>" 
								data-descri  ="<?php echo $tarifagrupo['descripcion_tarifa']; ?>" 
		            title="PAquetes Asociados a la Sub Tarifa Actual" >
		            <i class='fa fa-cubes'></i>
		          </button>
		        </div>		        
		      </div>
		    </td>
			</tr>
			<?php
        }
?>
  </tbody>
</table>

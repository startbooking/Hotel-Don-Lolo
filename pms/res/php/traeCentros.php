<?php 

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php'; 
$id    =  $_POST['id'];

$centros = $hotel->getTraecentros($id);

$regis = count($centros); 

foreach ($centros as $centro) { ?>
  <tr style='font-size:12px'>
    <td style="padding:3px 5px"><?php echo $centro['descripcion_centro']; ?></td>
    <td style="padding:3px 5px"><?php echo $centro['responsable']; ?></td>
    <td style="padding:3px 5px">
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-info btn-xs" 
          data-toggle ="modal" 
          data-target ="#myModalModificaCentroCia" 
          data-id     ="<?php echo $centro['id_centro']?>" 
          data-descri ="<?php echo $centro['descripcion_centro']?>" 
          data-respon  ="<?php echo $centro['responsable']?>" 
          title="Modificar El Centro de Costo Actual" >
          <i class='fa fa-pencil-square'></i>
        </button>
        <button type="button" class="btn btn-danger btn-xs" 
          data-toggle ="modal" 
          data-target ="#myModalEliminaCentroCia" 
          data-id     ="<?php echo $centro['id_centro']?>" 
          data-descri ="<?php echo $centro['descripcion_centro']?>" 
          data-respon  ="<?php echo $centro['responsable']?>" 
          title="Elimina El Centro de Costo Actual" >
          <i class='fa fa-trash'></i>
        </button>
      </div> 
    </td>
  </tr>
  <?php 
}

<?php
  require '../../../res/php/app_topAdmin.php'; 

  $id    = $_POST['id'];
  $fecha = date('Y-m-d');

  $valtarifas = $admin->getValorSubTarifas($id);

?>

  <table id="tablaSubTarifas" class="table table-bordered table-resposive">
    <thead>
      <tr>
        <th>Tipo Habitacion</th>
        <th>Desde Fecha</th>
        <th>Hasta Fecha</th>
        <th>Accion</th>
      </tr>
    </thead> 
    <tbody>
      <?php 
      foreach ($valtarifas as $valtarifa) { ?>
        <tr>
          <td id='nombre'><?php echo $valtarifa["descripcion_habitacion"]?></td>
          <td id='nombre'><?php echo $valtarifa["desde_fecha"]?></td>
          <td id='nombre'><?php echo $valtarifa["hasta_fecha"]?></td>
          <td align="center" style="width: 20%">
            <div class="btn-toolbar" role="toolbar"> 
              <div class="btn-group" role="group">
                <button 
                  type        ="button" 
                  class       ="btn btn-info btn-xs" 
                  data-toggle ="modal" 
                  data-target ="#myModalModificaValorSubTarifa" 
                  data-id     ="<?php echo $valtarifa['id']?>" 
                  data-tipoha ="<?php echo $valtarifa['id_tipohabitacion']?>" 
                  data-valuno ="<?php echo $valtarifa['valor_un_pax']?>" 
                  data-valdos ="<?php echo $valtarifa['valor_dos_pax']?>" 
                  data-valtre ="<?php echo $valtarifa['valor_tre_pax']?>" 
                  data-valcua ="<?php echo $valtarifa['valor_cua_pax']?>" 
                  data-valcin ="<?php echo $valtarifa['valor_cin_pax']?>" 
                  data-valsei ="<?php echo $valtarifa['valor_sei_pax']?>" 
                  data-valadi ="<?php echo $valtarifa['valor_adicional']?>" 
                  data-valnin ="<?php echo $valtarifa['valor_nino']?>" 
                  data-desde  ="<?php echo $valtarifa['desde_fecha']?>" 
                  data-hasta  ="<?php echo $valtarifa['hasta_fecha']?>" 
                  title       ="Modificar Valores de la Tarifa Actual" >
                  <i class='fa fa-pencil-square'></i>
                </button>
                <button type="button" class="btn btn-danger btn-xs"
                  data-toggle  ="modal" 
                  data-target  ="#myModalEliminaValorSubtarifa" 
                  data-id      ="<?php echo $valtarifa['id']?>" 
                  title="Eimina el Valor de la Tarifa Actual" >
                  <i class='fa fa-trash'></i>
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

<?php
  require '../../../res/php/app_topAdmin.php';

  $id = $_POST['id'];
  $fecha = date('Y-m-d');

  $paquetes = $admin->getPaquetesTarifa($id);

  ?> 

  <table id="tablaPaquetes" class="table table-bordered table-resposive">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tarifa</th>
        <th>Paquete</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($paquetes as $paquete) { ?>
        <tr>
          <td id='nombre'><?php echo $paquete['id']; ?></td>
          <td id='nombre'><?php echo $paquete['descripcion_tarifa']; ?></td>
          <td id='nombre'><?php echo $paquete['descripcion']; ?></td>
          <td align="center" style="width: 20%">
            <div class="btn-toolbar" role="toolbar"> 
              <div class="btn-group" role="group">
                <button type="button" class="btn btn-info btn-xs" 
                  data-toggle  ="modal" 
                  data-target  ="#myModalModificaPaqueteTarifa" 
                  data-id      ="<?php echo $valtarifa['id']; ?>" 
                  title="Modificar Paquete de la Tarifa Actual" >
                  <i class='fa fa-pencil-square'></i>
                </button>
                <button type="button" class="btn btn-danger btn-xs"
                  data-toggle  ="modal" 
                  data-target  ="#myModalEliminaPaqueteTarifa" 
                  data-id      ="<?php echo $valtarifa['id']; ?>" 
                  title="Eimina Paquete de la Tarifa Actual" >
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

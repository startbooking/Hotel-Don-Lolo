<div class="content-wrapper">
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row" style="padding:5px 0;">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_ADM ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="resolucionHotel">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cubes"></i> Resoluciones de Facturacion</h3>
          </div>
          <div class="col-lg-6" style="text-align:right">
            <a
              data-target="#myModalResolucion"
              data-toggle="modal"
              type="button"
              class="btn btn-success">
              <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
              Adicionar Resolucion</a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div class="col-lg-10 col-lg-offset-1">
          <div class="container-fluid">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr class="warning">
                  <td>Resolucion</td>
                  <td>Desde Numero</td>
                  <td>Hasta Numero</td>
                  <td>Prefijo</td>
                  <td>Fecha</td>
                  <td>Vigencia</td>
                  <td>Estado</td>
                  <td>Accion</td>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($resoluciones as $resolucion) { ?>
                  <tr style='font-size:12px'>
                    <td><?php echo $resolucion['resolucion']; ?></td>
                    <td style="text-align:left"><?php echo $resolucion['desde']; ?></td>
                    <td style="text-align:left"><?php echo $resolucion['hasta']; ?></td>
                    <td style="text-align:left"><?php echo $resolucion['prefijo']; ?></td>
                    <td style="text-align:left"><?php echo $resolucion['fecha']; ?></td>
                    <td style="text-align:center"><?php echo estadoResolucion($resolucion['estado']); ?></td>
                    <td style="text-align:left"><?php echo $resolucion['vigencia']; ?></td>
                    <td style="text-align:center;padding:3px;width: 17%">
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <?php
                        if ($resolucion['estado'] == 2) { ?>
                          <button
                            type="button"
                            class="btn btn-info btn-xs"
                            data-toggle="modal"
                            data-target="#myModalModifica"
                            data-resolucion='<?php echo htmlspecialchars(json_encode($resolucion)); ?>'
                            title="Modificar la Resolucion Actual">
                            <i class='fa fa-pencil-square'></i>
                          </button>
                        <?php }
                        if ($resolucion['estado'] != 1) { ?>
                          <button
                            type="button"
                            class="btn btn-danger btn-xs"
                            data-toggle="modal"
                            data-id="<?php echo $resolucion['id'] ?>"
                            data-estado="<?php echo $resolucion['estado'] ?>"
                            title="Elimina la Resolucion Actual"
                            onclick="eliminaResolucion(<?= $resolucion['id']; ?>,<?= $resolucion['estado']; ?>)">
                            <i class='fa fa-trash'></i>
                          </button>
                        <?php
                        }
                        if ($resolucion['estado'] == 2) { ?>
                          <button
                            type="button"
                            class="btn btn-success btn-xs"
                            data-toggle="modal"
                            data-id="<?php echo $resolucion['id'] ?>"
                            data-estado="<?php echo $resolucion['estado'] ?>"
                            title="Activar la Resolucion Actual"
                            onclick="estadoResolucion(<?= $resolucion['id']; ?>,<?= $resolucion['estado']; ?>,1)">
                            <i class='fa fa-check'></i>
                          </button>
                        <?php }  ?>
                        <?php
                        if ($resolucion['estado'] == 1) { ?>
                          <button
                            type="button"
                            class="btn btn-warning btn-xs"
                            data-toggle="modal"
                            data-id="<?php echo $resolucion['id'] ?>"
                            data-estado="<?php echo $resolucion['estado'] ?>"
                            title="Desactivar la Resolucion Actual"
                            onclick="estadoResolucion(<?= $resolucion['id']; ?>,<?= $resolucion['estado']; ?>,0)">
                            <i class='fa fa-ban'></i>
                          </button>
                        <?php }  ?>
                      </div>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
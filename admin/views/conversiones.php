<div class="content-wrapper">
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row" style="padding:5px 0;">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_ADM ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="conversiones">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cubes"></i> Conversiones Unidades</h3>
          </div>
          <div class="col-lg-6" align="right">
            <a
              data-toggle="modal"
              type="button" class="btn btn-success" href="#myModalAdicionarConversion">
              <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
              Adicionar Conversion</a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div class="col-lg-6 col-lg-offset-3">
          <div class="container-fluid">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr class="warning">
                  <td>Unidad</td>
                  <td>Conversion</td>
                  <td>Valor</td>
                  <td>Accion</td>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($conversiones as $conversion) { ?>
                  <tr style='font-size:12px'>
                    <td al><?php echo $conversion['descripcion_unidad']; ?></td>
                    <td al><?php echo $admin->getConversion($conversion['id_conversion']); ?></td>
                    <td align="right"><?php echo number_format($conversion['valor_conversion']); ?></td>
                    <td align="center" style="padding:3px;">
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info btn-xs"
                          data-toggle="modal"
                          data-target="#myModalModificaConversion"
                          data-id="<?php echo $conversion['id'] ?>"
                          data-unid="<?php echo $conversion['id_unidad'] ?>"
                          data-desc="<?php echo $conversion['descripcion_unidad'] ?>"
                          data-conv="<?php echo $conversion['id_conversion'] ?>"
                          data-valo="<?php echo $conversion['valor_conversion'] ?>"
                          title="Modificar la Conversion Actual">
                          <i class='fa fa-pencil-square'></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs"
                          data-toggle="modal"
                          data-target="#myModalEliminaConversion"
                          data-id="<?= $conversion['id'] ?>"
                          data-unid="<?= $conversion['id_unidad'] ?>"
                          data-desc="<?= $conversion['descripcion_unidad'] ?>"
                          data-conv="<?= $conversion['id_conversion'] ?>"
                          data-valo="<?= $conversion['valor_conversion'] ?>"
                          title="Elimina la Conversion Actual">
                          <i class='fa fa-trash'></i>
                        </button>
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
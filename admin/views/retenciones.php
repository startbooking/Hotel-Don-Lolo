
    <div class="content-wrapper" style="margin-bottom: 50px">
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row" style="padding:5px 0;">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_ADM ?>">
                <input type="hidden" name="ubicacion" id="ubicacion" value="retenciones">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-bank"></i> Retenciones </h3>
              </div>
              <div class="col-lg-6" align="right">
                <a
                  data-toggle="modal"
                  class='btn btn-success'
                  href="#myModalAdicionaRetencion">
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                  Adicionar Retencion</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr class="warning">
                    <td>Retencion</td>
                    <td>% Ret</td>
                    <td>Base Retencion</td>
                    <td>PUC</td>
                    <td>Tipo DIAN</td>
                    <td>Accion</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($retenciones as $impuesto) { ?>
                    <tr style='font-size:12px'>
                      <td><?php echo $impuesto['descripcionRetencion']; ?></td>
                      <td align="right"><?php echo number_format($impuesto['porcentajeRetencion'], 2); ?></td>
                      <td style="width: 20%;text-align:right;"><?php echo number_format($impuesto['baseRetencion'],2); ?></td>
                      <td style="width: 20%"><?php echo $impuesto['codigoPuc']; ?></td>
                      <td><?php echo strtoupper($impuesto['name']); ?></td>
                      <td align="center" style="padding:3px;width: 12%">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button
                            type="button"
                            class="btn btn-info btn-xs"
                            data-toggle="modal"
                            data-retencion='<?php echo htmlspecialchars(json_encode($impuesto)); ?>'
                            data-target="#myModalModificaRetencion"
                            title="Modificar El Impuesto Actual">
                            <i class='fa fa-pencil-square'></i>
                          </button>
                          <button
                            type="button"
                            class="btn btn-danger btn-xs"
                            title="Elimina El Impuesto Actual"
                            onclick="eliminaRetencion('<?=$impuesto['descripcionRetencion'];?>',<?=$impuesto['idRetencion']?>)">
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
      </section>
    </div>
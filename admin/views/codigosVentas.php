<div class="content-wrapper">
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_ADM ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="codigosVentas">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-money"></i> Codigos de Ventas </h3>
          </div>
          <div class="col-lg-6" style="text-align:right;">
            <a style="margin:20px 0"
              data-toggle="modal"
              class='btn btn-success'
              href="#myModalAdicionarCodigoVentas">
              <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
              Adicionar Codigo de Ventas</a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div class="container-fluid">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr class="warning">
                  <td>Descripcion </td>
                  <td>Impuesto</td>
                  <td>Centro de Costo</td>
                  <td>Descripcion Contable</td>
                  <td>PUC</td>
                  <td>Estado</td>
                  <td>Accion</td>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($codigos as $codigo) {
                  /* $nombre = $codigo['descripcion_cargo'];
                  */
                  $id = $codigo['id_cargo']; 
                ?>
                  <tr style='font-size:12px'>
                    <td><?php echo $codigo['descripcion_cargo']; ?></td>
                    <td><?php echo $hotel->getDescripcionIva($codigo['id_impto']); ?></td>
                    <td><?php echo $admin->getAgrupacion($codigo['grupo_vta']); ?></td>
                    <td><?php echo $codigo['descripcion_contable']; ?></td>
                    <td><?php echo $codigo['cuenta_puc']; ?></td>
                    <td><?php echo estadoPago($codigo['restringido']); ?></td>
                    <td style="padding:3px;width: 10%;text-align:center;">
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info btn-xs"
                          data-toggle="modal"
                          data-target="#myModalModificaCodigoVentas"
                          data-id="<?php echo $codigo['id_cargo'] ?>"
                          data-impto="<?php echo $codigo['id_impto'] ?>"
                          data-descri="<?php echo $codigo['descripcion_cargo'] ?>"
                          data-grupo="<?php echo $codigo['grupo_vta'] ?>"
                          data-puc="<?php echo $codigo['cuenta_puc'] ?>"
                          data-centro="<?php echo $codigo['centroCosto'] ?>"
                          data-contab="<?php echo $codigo['descripcion_contable'] ?>"
                          title="Modificar El Codigo de Ventas Actual">
                          <i class='fa fa-pencil-square'></i>
                        </button>
                        <button type="button" class="btn btn-warning btn-xs"
                          data-nombre="<?php echo htmlspecialchars($codigo['descripcion_cargo']); ?>"
                          title="Elimina El Codigo de Ventas Actual"
                          id="<?php echo $codigo['id_cargo'] ?>"
                          onclick="eliminaCodigo(this.id, this.getAttribute('data-nombre'))">
                          <i class='fa fa-trash'></i>
                        </button>
                        <!-- 
                            <button type="button" class="btn btn-warning btn-xs" 
                              data-nombre ="<?php echo $codigo['descripcion_cargo'] ?>" 
                              title="Elimina El Codigo de Ventas Actual"
                              name="<?= $id ?>"
                              id="<?= $id ?>"
                              onclick=eliminaCodigo(this.name,<?php echo $id; ?>)>
                              <i class='fa fa-trash'></i>

                            </button>
                            <button type="button" class="btn btn-warning btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalEliminaCodigoVentas" 
                              data-id     ="<?php echo $codigo['id_cargo'] ?>" 
                              data-impto  ="<?php echo $codigo['id_impto'] ?>" 
                              data-descri ="<?php echo $codigo['descripcion_cargo'] ?>" 
                              data-grupo  ="<?php echo $codigo['grupo_vta'] ?>" 
                              data-puc    ="<?php echo $codigo['cuenta_puc'] ?>" 
                              data-contab ="<?php echo $codigo['descripcion_contable'] ?>" 
                              title="Elimina El Codigo de Ventas Actual" >
                              <i class='fa fa-trash'></i>
                            </button> -->
                        <?php
                        if ($codigo['restringido'] == 1) {
                          $color = 'btn-success';
                        } else {
                          $color = 'btn-danger';
                        }
                        ?>
                        <a type="button" class="btn <?= $color ?> btn-xs"
                          href="javascript:activaPago(<?php echo $codigo['id_cargo'] ?>,<?= $codigo['restringido'] ?>)"
                          title="Restringir Pago Actual">
                          <i class='fa fa-toggle-off'></i>
                        </a>
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
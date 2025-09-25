<div class="content-wrapper">
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row" style="padding:5px 0;">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_ADM; ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="ambientes">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cube"></i> Interface POS - PMS</h3>
          </div>
          <div class="col-lg-6" align="right">
            <a
              data-toggle="modal"
              type="button" 
              class="btn btn-success" 
              href="#myModalAdicionarInterface">
              <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Adicionar Interface</a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div class="container-fluid">
          <div class="container-fluid">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <th>Ambiente</th>
                  <th>Impuesto</th>
                  <th>Codigo Cargo PMS</th>
                  <th>Tipo</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($interfaces as $interface) { ?>
                  <tr align="left">
                    <td><?php echo $interface['nombre']; ?></td>
                    <td><?php echo $interface['descripcion_impto']; ?></td>
                    <td><?php echo $interface['descripcion_cargo']; ?></td>
                    <td style="text-align:center:"><?php echo tipo_interface($interface['tipo_codigo']); ?></td>
                    <td align="center">
                      <div class="btn-toolbar" role="toolbar" aria-label="...">
                        <div class="btn-group" role="group" aria-label="...">
                          <button type="button" class="btn btn-info btn-xs"
                            data-toggle="modal"
                            data-target="#myModalModificaInterface"
                            data-interface='<?php echo htmlspecialchars(json_encode($interface)); ?>'
                            title="Modificar la Interface Actual">
                            <i class='fa fa-pencil-square'></i>
                          </button>
                        </div>
                        <div class="btn-group" role="group" aria-label="">
                          <button type="button" class="btn btn-danger btn-xs"
                            data-toggle="modal"
                            onclick="eliminaInterface(<?php echo $interface['id']; ?>)"
                            title="Elimina la Interface Actual">
                            <i style="font-size:16px" class="fa fa-ban" aria-hidden="true"></i>
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
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
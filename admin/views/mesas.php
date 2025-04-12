<?php
$mesas     = $admin->getMesasAmbiente();
$ambientes = $admin->getAmbientes();
?>

<div class="content-wrapper">
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_ADM ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="mesas">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cube"></i> Mesas POS </h3>
          </div>
          <div class="col-lg-6" align="right">
            <a
              data-toggle="modal"
              style="margin:20px 0" type="button" class="btn btn-success" href="#myModalAdicionarMesa">
              <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Adicionar Mesa</a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div class="container-fluid">
          <div class="container-fluid">
            <div class="col-md-8 col-md-offset-2">
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Ambiente</th>
                    <th>Mesa</th>
                    <th>Puestos</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($mesas as $mesa) { ?>
                    <tr align="right">
                      <td align="left"><?php echo $mesa["nombre"] ?></td>
                      <td><?php echo $mesa["numero_mesa"] ?></td>
                      <td><?php echo $mesa["puestos"] ?></td>
                      <td align="center">
                        <div class="btn-toolbar" role="toolbar" aria-label="...">
                          <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn btn-info btn-xs"
                              data-toggle="modal"
                              data-target="#myModalModificaMesa"
                              data-idmesa="<?= $mesa['id'] ?>"
                              data-ambi="<?= $mesa['nombre'] ?>"
                              data-idambi="<?= $mesa['id_ambiente'] ?>"
                              data-nromesa="<?= $mesa['numero_mesa'] ?>"
                              data-pers="<?= $mesa['puestos'] ?>"
                              title="Modifica la Mesa Actual">
                              <i class='fa fa-pencil-square'></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-xs"
                              data-toggle="modal"
                              data-target="#myModalEliminaMesa"
                              data-idmesa="<?= $mesa['id'] ?>"
                              data-ambi="<?= $mesa['nombre'] ?>"
                              data-idambi="<?= $mesa['id_ambiente'] ?>"
                              data-nromesa="<?= $mesa['numero_mesa'] ?>"
                              data-pers="<?= $mesa['puestos'] ?>"
                              title="Elimina la Mesa Actual">
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

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
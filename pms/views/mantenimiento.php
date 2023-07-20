
<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <input type="hidden" name="fechaweb" id="fechaweb" value="<?php echo FECHA_PMS; ?>">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="mantenimiento">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-wrench" aria-hidden="true"></i> Mantenimiento Habitaciones </h3>
          </div>
          <div class="col-lg-6 col-md-6" style="text-align:right;">
            <a 
              class="btn btn-success"
              data-toggle="modal" 
              href="#myModalAdicionaMantenimiento">
              <i class="fa fa-plus" aria-hidden="true"></i>Adicionar Mantenimiento </a>
          </div> 
        </div>
      </div>
      <div class="panel-body">
        <div id="imprimeMantenimiento"></div>
        <div class="table-responsive"> 
          <table id="example1" class="table modalTable table-bordered">
            <thead>
              <tr class="warning">
                <td>Hab.</td>
                <td>Motivo</td>
                <td>Desde Fecha</td>
                <td>Hasta Fecha</td>
                <td>Bloqueada</td>
                <td>Estado</td>
                <td>Inventario</td>
                <td>Accion</td>
              </tr>
            </thead>
            <tbody>
              <?php
              echo print_r($mmtos);
              foreach ($mmtos as $mmto) {
                  ?>
                <tr style='font-size:12px'>
                  <td><?php echo $hotel->getNumeroHab($mmto['id_habitacion']); ?></td>
                  <td><?php echo $mmto['descripcion_grupo']; ?></td>
                  <td><?php echo $mmto['desde_fecha']; ?></td>
                  <td><?php echo $mmto['hasta_fecha']; ?></td>
                  <td style="text-align:center;"><?php echo estadoInventario($mmto['tipo_bloqueo']); ?></td>
                  <td style="text-align:center;"><?php echo estadoMmto($mmto['estado_mmto']); ?></td>
                  <td style="text-align:center;"><?php echo estadoInventario($mmto['retirar_inventario']); ?></td>
                  <td>
                    <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                        <ul class="nav navbar-nav" style="width:100%;">
                          <li class="dropdown submenu" style="width:100%;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding: 3px 5px;font-weight: 500;width:100%">Ficha Mantenimiento
                            <span style="position:absolute;top:13px;right:5px;" class="caret"></span></a>
                            <ul class="dropdown-menu" style="float:left;margin-left:none;top:40px;left: -195px">  
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $mmto['id_mmto']; ?>" 
                                  href="#myModalInformacionMmto">
                                  <i class="fa-solid fa-user-gear"></i> Informacion Mantenimiento</a> 
                              </li>
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $mmto['id_mmto']; ?>" 
                                  data-mmto="<?php echo $mmto['descripcion_grupo']; ?>" 
                                  data-observa="<?php echo $mmto['observaciones']; ?>" 
                                  data-room="<?php echo $hotel->getNumeroHab($mmto['id_habitacion']); ?>"
                                  href="#myModalAdicionaObservacionesMantenimiento">
                                  <i class="fa-solid fa-pen-to-square"></i> Adicionar Observaciones</a> 
                              </li>
                              <li>
                                <a 
                                  onclick="imprimirOrdenM('<?php echo $mmto['id_mmto']; ?>')" 
                                  >
                                <i class="fa-solid fa-print"></i>
                                Imprimir Orden de Trabajo</a> 
                              </li>
                              <?php
                                if ($mmto['estado_mmto'] == 1) { ?>
                                <li>
                                  <a data-toggle="modal" 
                                    data-id="<?php echo $mmto['id_mmto']; ?>" 
                                    data-room="<?php echo $hotel->getNumeroHab($mmto['id_habitacion']); ?>"
                                    href="#myModalTerminaMmto">
                                  <i class="fa fa-sign-out" aria-hidden="true"></i>
                                  Terminar Mantenimiento</a> 
                                </li>
                                <?php
                                }
                              ?>
                            </ul>
                          </li>
                        </ul>
                      </div>
                    </nav>                      
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
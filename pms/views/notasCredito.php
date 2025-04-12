  <div class="content-wrapper">
      <section class="content" style="height: 780px;">
          <div class="content" style="margin-bottom: 50px">
              <div class="panel panel-success">
                  <div class="panel-heading">
                      <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
                      <input type="hidden" name="ubicacion" id="ubicacion" value="notasCredito">
                      <input type="hidden" name="pasos" id="pasos">
                      <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black"></i> Notas Credito del Dia</h3>
                  </div>
                  <div class="datos_ajax_delete"></div>
                  <form id="formCierreDiario" class="form-horizontal" method="POST" enctype="multipart/form-data">
                      <div class="panel-body">
                          <div class="row"> 
                              <?php
                                $regis = count($notas);
                                if ($regis == 0) { ?>
                                  <div class="col-xs-12" id="muestraResultado" style="font-size:12px;text-align:center;">
                                      <h4 class="bg-red-gradient" style="padding:10px;text-align: center;font-weight: 600;">Sin Notas Credito Creadas En el Dia <span style="font-size:16px;font-weight: 600;font-family: 'ubuntu'"></span></h4>
                                  </div>
                              <?php
                                } else { ?>
                                  <div class="col-xs-12" id="muestraResultado" style="font-size:12px">
                                      <div class="table-responsive">
                                          <table id="example1" class="table table-bordered">
                                              <thead>
                                                  <tr class="warning centro">
                                                      <td>Nota Credito</td>
                                                      <td>Factura</td>
                                                      <td>Motivo Anulacion</td>
                                                      <td>Fecha Recibo</td>
                                                      <td>Usuario</td>
                                                      <td>Accion</td>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php

                                                    foreach ($notas as $nota) {
                                                    ?>
                                                      <tr style='font-size:12px'>
                                                          <td style="padding:3px 5px;"><?php echo $nota['numeroNC']; ?></td>
                                                          <td style="padding:3px 5px;"><?php echo $nota['facturaAnulada']; ?></td>
                                                          <td style="padding:3px 5px"><?php echo $nota['motivoAnulacion']; ?></td>
                                                          <td style="padding:3px 5px;"><?php echo $nota['fechaNC']; ?></td>
                                                          <td style="padding:3px 5px;text-align:right;"><?php echo $nota['usuario']; ?></td>
                                                          <td style="padding:3px 5px;text-align:center;">
                                                              <button class="btn btn-success btn-xs" type="button" data-toggle="modal" data-fechanota="<?= $nota['fechaNC'] ?>" data-numero="<?= $nota['numeroNC'] ?>" href="#myModalVerNotaCredito" title="Ver Nota Credito">
                                                                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                              </button>

                                                          </td>
                                                      </tr>
                                                  <?php
                                                    }
                                                    ?>
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              <?php
                                }
                                ?>
                              <!-- <div class="col-lg-6" id="Factura">
                                    <object id="verFactura" width="100%" height="500" data=""></object>
                                </div> -->
                          </div>
                      </div>
                      <div class="panel-footer">
                          <div class="row">
                              <div class="col-md-4 col-md-offset-4">
                                  <div class="col-xs-12" style="padding:0">
                                      <a type="button" class="btn btn-warning btn-block" href="home"><i class="fa fa-reply"></i> Regresar</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </section>
  </div>
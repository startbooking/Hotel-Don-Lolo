    <div class="content-wrapper">
      <section class="content" style="height: 780px;">
        <div class="content" style="margin-bottom: 50px">
          <div class="panel panel-success">
            <div class="panel-heading">
              <div class="row">
                <div class="col-lg-6">
                  <h3 class="w3ls_head tituloPagina">
                    <span class="glyphicon glyphicon-briefcase" style="font-size:36px;color:black"></span>
                    Recaudos de Cartera
                  </h3> 
                </div>
                <div class="col-lg-6" align="right">
                  <a
                    style="margin:10px 0" type="button" class="btn btn-success" href="adicionaRecaudoCartera">
                    <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                    Adicionar Recaudo</a>
                </div>
              </div>
            </div>
            <div class="datos_ajax_delete"></div>
            <form id="formCierreDiario" class="form-horizontal" method="POST" enctype="multipart/form-data">
              <div class="panel-body">
                <div class="row">
                  <?php
                  $regis = count($recaudos);
                  if ($regis == 0) { ?>
                    <div class="col-xs-12" id="muestraRecaudos" style="font-size:12px;text-align:center;">
                      <h4 class="bg-red-gradient" style="padding:10px;text-align: center;font-weight: 600;">Sin Recaudos de Cartera Creados En el Dia <span style="font-size:16px;font-weight: 600;font-family: 'ubuntu'"></span></h4>
                    </div>
                  <?php
                  } else { ?>
                    <div class="col-xs-12" id="muestraRecaudos">
                      <div class="table-responsive">
                        <table id="example1" class="table table-bordered">
                          <thead>
                            <tr class="warning">
                              <td>Recaudo Nro</td>
                              <td>Fecha Recaudo</td>
                              <td>Compañia</td>
                              <td>Nit</td>
                              <td>Valor</td>
                              <td>Accion</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            foreach ($recaudos as $recibo) {
                            ?>
                              <tr style='font-size:12px'>
                                <td numRec><?php echo $recibo['numeroRecaudo']; ?></td>
                                <td numRec><?php echo $recibo['fechaRecaudo']; ?></td>
                                <td style="numRec"><?php echo $recibo['empresa']; ?></td>
                                <td class="tr" style="numRec"><?php echo $recibo['nit'] . '-' . $recibo['dv']; ?></td>
                                <td class="tr" style="numRec"><?php echo number_format($recibo['totalRecaudo'], 2); ?></td>
                                <td class="tc">
                                  <div class="btn-group">
                                    <button class="btn btn-info btn-xs" onclick="mostrarRecaudo('<?php echo $recibo['numeroRecaudo']; ?>')" type="button">
                                      <i class="fa fa-file-pdf" aria-hidden="true" title="Ver Recaudo"></i>
                                    </button>
                                    <button class="btn btn-danger btn-xs">
                                      <i class="fa fa-trash" aria-hidden="true" title="Anular Recaudo"></i>
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
                  <?php
                  }?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
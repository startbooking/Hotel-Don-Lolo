
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">
                <input type="hidden" name="ubicacion" id="ubicacion" value="resoluciones">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cubes"></i> Resoluciones de Facturacion</h3>
              </div>
              <div class="col-lg-6" style="text-align:right">
                <a 
                  data-target  ="#myModalAdicionarResolucion" 
                  data-toggle  ="modal" 
                  style        ="margin:20px 0" 
                  type         ="button" 
                  class        ="btn btn-success" 
                  >
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                   Adicionar Resolucion</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="col-lg-8 col-lg-offset-2">              
              <div class="container-fluid"> 
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr class="warning">
                      <td>Resolucion</td>
                      <td>Desde Num</td>
                      <td>Hasta Num</td>
                      <td>Prefijo</td>
                      <td>Fecha</td>
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
                        <td style="text-align:left"><?php echo estadoResolucion($resolucion['estado']); ?></td>
                        <td style="text-align:center;padding:3px;width: 17%">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button 
                              type        ="button" 
                              class       ="btn btn-info btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalModificaResolucion" 
                              data-id     ="<?php echo $resolucion['id']?>" 
                              title       ="Modificar la Resolucion Actual" >
                              <i class='fa fa-pencil-square'></i>
                            </button>
                            <button 
                              type        ="button" 
                              class       ="btn btn-danger btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalEliminaResolucion" 
                              data-id     ="<?php echo $resolucion['id']?>" 
                              title       ="Elimina la Resolucion Actual" >              
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

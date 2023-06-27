
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">
                <input type="hidden" name="ubicacion" id="ubicacion" value="bodegas">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cubes"></i> Bodegas Almacenamiento</h3>
              </div>
              <div class="col-lg-6" align="right">
                <a 
                  data-target  ="#myModalAdicionarBodega" 
                  data-bodegas ="<?php echo count($bodegas)?>" 
                  data-toggle  ="modal" 
                  style        ="margin:20px 0" 
                  type         ="button" 
                  class        ="btn btn-success" 
                  >
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                   Adicionar Bodega</a>
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
                      <td>Bodega</td>
                      <td>Tipo Bodega</td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($bodegas as $bodega) { ?>
                      <tr style='font-size:12px'>
                        <td al><?php echo $bodega['descripcion_bodega']; ?></td>
                        <td align="left"><?php echo tipoBodega($bodega['tipo_bodega']); ?></td>
                        <td align="center" style="padding:3px;width: 17%">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button 
                              type        ="button" 
                              class       ="btn btn-info btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalModificaBodega" 
                              data-id     ="<?php echo $bodega['id_bodega']?>" 
                              data-descri ="<?php echo $bodega['descripcion_bodega']?>" 
                              data-tipo ="<?php echo $bodega['tipo_bodega']?>" 
                              title       ="Modificar la Bodega Actual" >
                              <i class='fa fa-pencil-square'></i>
                            </button>
                            <button 
                              type        ="button" 
                              class       ="btn btn-danger btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalEliminaBodega" 
                              data-id     ="<?php echo $bodega['id_bodega']?>" 
                              data-descri ="<?php echo $bodega['descripcion_bodega']?>" 
                              data-tipo ="<?php echo $bodega['tipo_bodega']?>" 
                              title       ="Elimina la Bodega Actual" >              
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

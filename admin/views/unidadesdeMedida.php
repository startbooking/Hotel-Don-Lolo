
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row" style="padding:5px 0;"> 
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="unidades">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cubes"></i> Unidades de Medida</h3>
              </div>
              <div class="col-lg-6" align="right">
                <a 
                  data-toggle="modal" 
                  type="button" class="btn btn-success" href="#myModalAdicionarUnidad">
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                   Adicionar Unidad</a>
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
                      <td>Unidad de Medida</td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($unidades as $unidad) { ?>
                      <tr style='font-size:12px'>
                        <td al><?php echo $unidad['descripcion_unidad']; ?></td>
                        <td align="center" style="padding:3px;">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-info btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalModificaUnidad" 
                              data-id     ="<?php echo $unidad['id_unidad']?>" 
                              data-unidad ="<?php echo $unidad['descripcion_unidad']?>" 
                              title="Modificar la Unidad de Medida Actual" >
                              <i class='fa fa-pencil-square'></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalEliminaUnidad" 
                              data-id     ="<?php echo $unidad['id_unidad']?>" 
                              data-unidad ="<?php echo $unidad['descripcion_unidad']?>" 
                              title="Elimina la Unidad de Medida Actual" >
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

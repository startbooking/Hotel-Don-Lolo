
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="gruposInventario">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cubes"></i> Grupos de Inventario</h3>
              </div>
              <div class="col-lg-6" align="right">
                <a 
                  data-toggle="modal" 
                  style="margin:20px 0" type="button" class="btn btn-success" href="#myModalAdicionarGrupo">
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                   Adicionar Grupo</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="col-lg-8 col-lg-offset-2">              
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr class="warning">
                    <td>Grupo Almacenamiento</td>
                    <td>Familia</td>
                    <td>Accion</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($grupos as $grupo) { ?>
                    <tr style='font-size:12px'>
                      <td><?php echo $grupo['descripcion_grupo']; ?></td>
                      <td><?php echo $admin->getDescriptionFamilia($grupo['id_familia']); ?></td>
                      <td align="center" style="padding:3px;">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-info btn-xs" 
                            data-toggle  ="modal" 
                            data-target  ="#myModalModificaGrupo" 
                            data-id      ="<?php echo $grupo['id_grupo']?>" 
                            data-familia ="<?php echo $grupo['id_familia']?>" 
                            data-grupo   ="<?php echo $grupo['descripcion_grupo']?>" 
                            title        ="Modificar el Grupo de Inventario Actual" >
                            <i class='fa fa-pencil-square'></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-xs" 
                            data-toggle  ="modal" 
                            data-target  ="#myModalEliminaGrupo" 
                            data-id      ="<?php echo $grupo['id_grupo']?>" 
                            data-familia ="<?php echo $grupo['id_familia']?>" 
                            data-grupo  ="<?php echo $grupo['descripcion_grupo']?>" 
                            title="Elimina el Grupo de Inventario Actual" >
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
            <div class="col-lg-6 col-lg-offset-3">
            </div>
          </div>
        </div>
      </section>
    </div>

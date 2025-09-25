    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success"> 
          <div class="panel-heading"> 
            <div class="row" style="padding:5px 0;">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="subgrupos">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cubes"></i> Sub Grupos de Inventarios</h3>
              </div>
              <div class="col-lg-6" align="right">
                <a 
                  data-toggle="modal" 
                  type="button" class="btn btn-success" href="#myModalAdicionarSubGrupo">
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                   Adicionar SubGrupo</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="container-fluid"> 
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr class="warning">
                    <td>SubGrupo</td>
                    <td>Grupo</td>
                    <td>Familia</td>
                    <td>Accion</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($subgrupos as $subgrupo) { ?>
                    <tr style='font-size:12px'>
                      <td al><?php echo $subgrupo['descripcion_subgrupo']; ?></td>
                      <td al><?php echo $subgrupo['descripcion_grupo']; ?></td>
                      <td al><?php echo $admin->getDescriptionFamilia($subgrupo['id_familia']); ?></td>
                      <td align="center" style="padding:3px;width: 12%">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-info btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalModificaSubGrupo" 
                            data-id     ="<?php echo $subgrupo['id_subgrupo']?>" 
                            data-descri ="<?php echo $subgrupo['descripcion_subgrupo']?>" 
                            data-idgrup ="<?php echo $subgrupo['id_grupo']?>" 
                            data-idfami ="<?php echo $subgrupo['id_familia']?>" 
                            title="Modificar El Subgrupo de Inventarios Actual" >
                            <i class='fa fa-pencil-square'></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalEliminaSubgrupo" 
                            data-id     ="<?php echo $subgrupo['id_subgrupo']?>" 
                            data-descri ="<?php echo $subgrupo['descripcion_subgrupo']?>" 
                            data-idfami ="<?php echo $subgrupo['id_familia']?>" 
                            data-idgrup ="<?php echo $subgrupo['id_grupo']?>" 
                            title="Elimina El Subgrupo de Inventarios Actual" >
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
      </section>
    </div>


    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="centrosdeCosto">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cubes"></i> Centros de Costo</h3>
              </div>
              <div class="col-lg-6" align="right">
                <a 
                  data-toggle="modal" 
                  style="margin:20px 0" type="button" class="btn btn-success" href="#myModalAdicionarCentro">
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                   Adicionar Centro</a>
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
                      <td>Centro de Costo</td>
                      <td>Departamento</td>
                      <td>PUC Costo</td>
                      <td>PUC Gasto</td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($centros as $centro) { ?>
                      <tr style='font-size:12px'>
                        <td width="22px"><?php echo $centro['descripcion_centro']; ?></td>
                        <td width="22px"><?php echo $admin->getDepto($centro['id_depto']); ?></td>
                        <td width="22px"><?php echo $centro['puc1_costo']; ?></td>
                        <td width="22px"><?php echo $centro['puc1_gasto']; ?></td>
                        <td align="center" style="padding:3px;width: 12%">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-info btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalModificaCentro" 
                              data-id     ="<?php echo $centro['id_centrocosto']?>" 
                              data-descri ="<?php echo $centro['descripcion_centro']?>" 
                              data-depto  ="<?php echo $centro['id_depto']?>" 
                              data-costo  ="<?php echo $centro['puc1_costo']?>" 
                              data-gasto  ="<?php echo $centro['puc1_gasto']?>" 
                              title="Modificar El Centro de Costo Actual" >
                              <i class='fa fa-pencil-square'></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalEliminaCentro" 
                              data-id     ="<?php echo $centro['id_centrocosto']?>" 
                              data-descri ="<?php echo $centro['descripcion_centro']?>" 
                              data-depto  ="<?php echo $centro['id_depto']?>" 
                              data-costo  ="<?php echo $centro['puc1_costo']?>" 
                              data-gasto  ="<?php echo $centro['puc1_gasto']?>" 
                              title="Elimina El Centro de Costo Actual" >
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

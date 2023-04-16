    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row"> 
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">  
                <input type="hidden" name="ubicacion" id="ubicacion" value="gruposTarifa">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-money"></i> Grupos de Tarifas </h3>
              </div>
              <div class="col-lg-6" align="right">
                <a style="margin:20px 0" 
                  data-toggle="modal" 
                  class = 'btn btn-success'
                  href="#myModalAdicionarGrupoTarifa">
                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> 
                 Adicionar Grupos de Tarifas</a> 
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="col-md-6 col-md-offset-3">
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Descripcion</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    foreach ($tarifas as $tarifa) {
                      ?>
                      <tr>
                        <td><?php echo $tarifa["descripcion"]?></td>
                        <td align="center" style="width: 20%">
                          <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group" role="group">
                              <button type="button" class="btn btn-info btn-xs" 
                                data-toggle ="modal" 
                                data-target ="#myModalModificaGrupoTarifa" 
                                data-id     ="<?php echo $tarifa['id']?>" 
                                data-descri ="<?php echo $tarifa['descripcion']?>" 
                                title="Modificar la Tarifa Actual" >
                                <i class='fa fa-pencil-square'></i>
                              </button>
                              <button type="button" class="btn btn-danger btn-xs" 
                                data-toggle ="modal" 
                                data-target ='#myModalEliminaGrupoTarifa' 
                                data-id     ='<?php echo $tarifa['id']?>'
                                data-descri ='<?php echo $tarifa['descripcion']?>' 
                                title="Elimina la Tarifa Actual" >
                                <i class='fa fa-trash'></i>
                              </button>
                            </div>
                            <div class="btn-group" role="group" aria-label="...">
                              <button 
                                type        ='button'
                                class       ='btn btn-alert btn-xs'
                                data-toggle ='modal'
                                data-target ='#myModalTarifasAsociadas'
                                data-id     ='<?php echo $tarifa['id']?>'
                                data-descri ='<?php echo $tarifa['descripcion']?>'
                                title       ="Tarifas Asociadas al Grupo Actual" >
                                <i class='fa fa-calculator'></i>
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
      </section>
    </div>

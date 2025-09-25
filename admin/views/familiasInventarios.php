
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row" style="padding:5px 0;">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="familias">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cubes"></i> Familias de Inventarios</h3>
              </div>
              <div class="col-lg-6" align="right">
                <a 
                  data-toggle="modal" 
                  type="button" class="btn btn-success" 
                  href="#myModalAdicionarFamilia">
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                   Adicionar Familia</a>
              </div>
            </div>
          </div> 
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="col-lg-6 col-lg-offset-3">              
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr class="warning">
                    <td>Familia Inventarios</td>
                    <td>Accion</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($familias as $familia) { ?>
                    <tr style='font-size:12px'>
                      <td al><?php echo $familia['descripcion_familia']; ?></td>
                      <td align="center" style="padding:3px;width: 17%">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-info btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalModificaFamilia" 
                            data-id     ="<?php echo $familia['id_familia']?>" 
                            data-familia ="<?php echo $familia['descripcion_familia']?>" 
                            title="Modificar la Familia de Inventarios Actual" >
                            <i class='fa fa-pencil-square'></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalEliminaFamilia" 
                            data-id     ="<?php echo $familia['id_familia']?>" 
                            data-familia ="<?php echo $familia['descripcion_familia']?>" 
                            title="Elimina la Familia de Inventarios Actual" >
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

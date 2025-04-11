
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success"> 
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">  
                <input type="hidden" name="ubicacion" id="ubicacion" value="formasPagoPos">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-money"></i> Formas de Pago Puntos de Venta</h3>
              </div>
              <div class="col-lg-6" align="right">
                <a style="margin:20px 0" 
                  data-toggle="modal" 
                  class = 'btn btn-success'
                  href="#myModalAdicionarFormaPagoPos">
                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                 Adicionar Formas de Pago</a> 
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="col-lg-8 col-lg-offset-2">            
              <div class="table-responsive"> 
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr class="warning">
                      <td>Forma de Pago</td>
                      <td>PUC</td>
                      <td>Descripcion Contable</td>
                      <td>PMS </td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($pagos as $pago) { ?>
                      <tr style='font-size:12px'>
                        <td><?php echo $pago['descripcion']; ?></td>
                        <td><?php echo $pago['cuenta_puc']; ?></td>
                        <td><?php echo $pago['descripcion_contable']; ?></td>
                        <td><?php 
                          if($pago['pms']==1){
                            $color = 'btn-success';
                          }else{
                            $color = 'btn-danger';
                          }
                          ?>
                          <a type="button" class="btn <?=$color?> btn-xs" 
                            >
                            <i class='fa fa-toggle-off'></i>
                          </a>
                      </td>
                        <td align="center" style="padding:3px;width: 12%">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-info btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalModificaFormaPagoPos" 
                              data-id     ="<?php echo $pago['id_pago']?>" 
                              data-descri ="<?php echo $pago['descripcion']?>" 
                              data-puc    ="<?php echo $pago['cuenta_puc']?>" 
                              data-descon ="<?php echo $pago['descripcion_contable']?>" 
                              data-pms    ="<?php echo $pago['pms']?>" 
                              title       ="Modificar la Forma de Pago Actual" >
                              <i class='fa fa-pencil-square'></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalEliminaFormaPagoPos" 
                              data-id     ="<?php echo $pago['id_pago']?>" 
                              data-descri ="<?php echo $pago['descripcion']?>" 
                              data-puc    ="<?php echo $pago['cuenta_puc']?>" 
                              data-descon ="<?php echo $pago['descripcion_contable']?>" 
                              data-pms    ="<?php echo $pago['pms']?>" 
                              title       ="Elimina Forma de Pago Actual" >
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

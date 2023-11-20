
    <div class="content-wrapper"> 
      <section class="container-fluid">
        <div class="panel panel-success"> 
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_FE?>">  
                <input type="hidden" name="ubicacion" id="ubicacion" value="formasPago">
                <h3 class="w3ls_head tituloPagina">
                <i class="fa-solid fa-hand-holding-dollar"></i>
                Formas de Pago </h3>
              </div>
              <div class="col-lg-6">
                <a  
                  data-toggle="modal" 
                  data-edita="0"
                  class = 'btn btn-success pull-right'
                  href="#myModalPagos">
                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                Adicionar Forma de Pago</a> 
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="col-lg-10 col-lg-offset-1">            
              <div class="table-responsive"> 
                <table id="example1" class="table table-bordered" style="width:100%;">
                  <thead>
                    <tr class="warning">
                      <td>Forma de Pago</td>
                      <td>PUC</td>
                      <td>Tipo</td>
                      <td>Codigo DIAN</td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($pagos as $pago) { ?>
                      <tr style='font-size:12px'>
                        <td><?php echo $pago['descripcion_cargo']; ?></td>
                        <td><?php echo $pago['cuenta_puc']; ?></td>
                        <td><?php echo tipoPagoDian($pago['formaPagoDian']); ?></td>
                        <td class="derecha"><?php echo $pago['identificador_dian']; ?></td>
                        <td style="padding:3px;width: 12%;text-align:center;">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-info btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalModificaFormaPago" 
                              data-id     ="<?php echo $pago['id_cargo']?>" 
                              data-descri ="<?php echo $pago['descripcion_cargo']?>" 
                              data-puc    ="<?php echo $pago['cuenta_puc']?>" 
                              title="Modificar El Impuesto Actual" >
                              <i class='fa fa-pencil-square'></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalEliminaFormaPago" 
                              data-id     ="<?php echo $pago['id_cargo']?>" 
                              data-descri ="<?php echo $pago['descripcion_cargo']?>" 
                              data-puc    ="<?php echo $pago['cuenta_puc']?>" 
                              title="Elimina Forma de Pago Actual" >
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


    <?php include_once 'views/modal/modalPagos.php'; ?> 

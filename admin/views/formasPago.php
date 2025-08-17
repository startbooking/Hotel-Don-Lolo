
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success"> 
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">  
                <input type="hidden" name="ubicacion" id="ubicacion" value="formasdePago">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-money"></i> Formas de Pago </h3>
              </div>
              <div class="col-lg-6" style="text-align:right;">
                <a style="margin:20px 0" 
                  data-toggle="modal" 
                  class = 'btn btn-success'
                  href="#myModalAdicionarFormaPago">
                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                Adicionar Formas de Pago</a> 
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="table-responsive"> 
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr class="warning">
                    <td>Forma de Pago</td>
                    <td>PUC</td>
                    <td>Descripcion Contable</td>
                    <td>Tipo Neg.</td>
                    <td>Medio Pago DIAN</td>
                    <td>Estado</td>
                    <td>Accion</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($pagos as $pago) { ?>
                    <tr style='font-size:12px'>
                      <td><?php echo $pago['descripcion_cargo']; ?></td>
                      <td><?php echo $pago['cuenta_puc']; ?></td>
                      <td><?php echo $pago['descripcion_contable']; ?></td>
                      <td align="center"><?php echo tipoPagoDian($pago['identificador_dian']); ?></td>
                      <td align="left"><?php echo strtoupper($pago['name']); ?></td>
                      <td align="center"><?php echo estadoPago($pago['restringido']); ?></td>
                      <td align="center" style="padding:3px;width: 12%">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-info btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalModificaFormaPago" 
                            data-id     ="<?php echo $pago['id_cargo']?>" 
                            data-descri ="<?php echo $pago['descripcion_cargo']?>" 
                            data-puc    ="<?php echo $pago['cuenta_puc']?>" 
                            data-contab ="<?php echo $pago['descripcion_contable']?>" 
                            data-forma ="<?php echo $pago['identificador_dian']?>" 
                            data-medio ="<?php echo $pago['medioPagoDian']?>" 
                            title="Modificar El Impuesto Actual" >
                            <i class='fa fa-pencil-square'></i>
                          </button>
                          <button type="button" class="btn btn-warning btn-xs" 
                            data-toggle ="modal" 
                            data-target ="#myModalEliminaFormaPago" 
                            data-id     ="<?php echo $pago['id_cargo']?>" 
                            data-descri ="<?php echo $pago['descripcion_cargo']?>" 
                            data-puc    ="<?php echo $pago['cuenta_puc']?>" 
                            data-contab ="<?php echo $pago['descripcion_contable']?>" 
                            data-forma ="<?php echo $pago['identificador_dian']?>" 
                            data-medio ="<?php echo $pago['medioPagoDian']?>" 
                            title="Elimina Forma de Pago Actual" >
                            <i class='fa fa-trash'></i>
                          </button>
                          <?php 
                          if($pago['restringido']==1){
                            $color = 'btn-success';
                          }else{
                            $color = 'btn-danger';
                          }
                          ?>
                          <a type="button" class="btn <?=$color?> btn-xs" 
                            href="javascript:activaPago(<?php echo $pago['id_cargo']?>,<?=$pago['restringido']?>)"
                            title="Restringir Pago Actual">
                            <i class='fa fa-toggle-off'></i>
                          </a>
                        </div> 
                      </td>
                    </tr>
                    <?php 
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="col-lg-10 col-lg-offset-1">
            </div>
          </div>
        </div>
      </section>
    </div>

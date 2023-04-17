    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">  
                <input type="hidden" name="ubicacion" id="ubicacion" value="tipoHabitaciones">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-money"></i> Tipo de Habitaciones </h3>
              </div>
              <div class="col-lg-6" align="right">
                <a style="margin:20px 0" 
                  data-toggle="modal" 
                  class = 'btn btn-success'
                  href="#myModalAdicionarTipoHabitacion">
                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                 Adicionar Tipo de Habitaciones</a> 
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
                      <td>Abreviatura </td>
                      <td>Descripcion</td>
                      <!-- <td>Tipo</td> -->
                      <td>Estado</td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($tiposhab as $tipohab) { ?>
                      <tr style='font-size:12px'>
                        <td><?php echo $tipohab['codigo']; ?></td>
                        <td><?php echo $tipohab['descripcion_habitacion']; ?></td>
                        <td><?php echo estadoTipoHabi($tipohab['active_at']); ?></td>
                        <td align="center" style="padding:3px;width: 17%">
                          <?php 
                          if($tipohab['active_at']==1){
                            $color = 'btn-success';
                          }else{
                            $color = 'btn-danger';
                          }
                          ?>
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-info btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalModificaTipoHabitacion" 
                              data-id     ="<?php echo $tipohab['id']?>" 
                              data-codigo ="<?php echo $tipohab['codigo']?>" 
                              data-descri ="<?php echo $tipohab['descripcion_habitacion']?>" 
                              data-sector ="<?php echo $tipohab['sector_habitacion']?>" 
                              data-venta  ="<?php echo $tipohab['deptoventa_habitacion']?>" 
                              data-activa ="<?php echo $tipohab['active_at']?>" 
                              title="Modificar El Tipo de Habitacion Actual" >
                              <i class='fa fa-pencil-square'></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalEliminaTipoHabitacion" 
                              data-id     ="<?php echo $tipohab['id']?>" 
                              data-codigo ="<?php echo $tipohab['codigo']?>" 
                              data-descri ="<?php echo $tipohab['descripcion_habitacion']?>" 
                              data-venta  ="<?php echo $tipohab['deptoventa_habitacion']?>" 
                              data-activa ="<?php echo $tipohab['active_at']?>" 
                              title="Elimina El Tipo de Habitacion Actual" >
                              <i class='fa fa-trash'></i>
                            </button>
                            <button type="button" class="btn <?=$color?> btn-xs" 
                              onclick="javascript:activaTipoHabi(<?php echo $tipohab['id']?>,<?=$tipohab['active_at']?>)"
                              title="Bloquear Tipo de Habitacion Actual">
                              <i class='fa fa-toggle-off'></i>
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

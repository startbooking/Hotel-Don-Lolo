    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">  
                <input type="hidden" name="ubicacion" id="ubicacion" value="sectoresHabitacion">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-money"></i> Sector de Habitaciones </h3>
              </div>
              <div class="col-lg-6" align="right">
                <a style="margin:20px 0" 
                  data-toggle="modal" 
                  class = 'btn btn-success'
                  href="#myModalAdicionarSectorHabtacitacion">
                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                 Adicionar Sector de Habitaciones</a> 
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="col-lg-6 col-lg-offset-3">
              <div class="table-responsive"> 
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr class="warning">
                      <td>Descripcion</td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($sectores as $sector) { ?>
                      <tr style='font-size:12px'>
                        <td><?php echo $sector['descripcion_sector']; ?></td>
                        <td align="center" style="padding:3px;">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-info btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalModificaSectorHabitacion" 
                              data-id     ="<?php echo $sector['id_sector']?>" 
                              data-descr  ="<?php echo $sector['descripcion_sector']?>" 
                              title="Modificar El Sector de Habitacion Actual" >
                              <i class='fa fa-pencil-square'></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalEliminaSectorHabitacion" 
                              data-id     ="<?php echo $sector['id_sector']?>" 
                              data-descr  ="<?php echo $sector['descripcion_sector']?>" 
                              title="Elimina El Sector de Habitacion Actual" >
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

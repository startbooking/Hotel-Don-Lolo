
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="equiposAsociados">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-desktop"></i> Equipos Asociados al Sistema</h3>
              </div>
              <div class="col-lg-6" align="right">
                <a 
                  data-toggle="modal" 
                  style="margin:20px 0" type="button" class="btn btn-success" href="#myModalAdicionarEquipo">
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                   Adicionar Equipo</a>
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
                      <td>IP Equipo</td>
                      <td>Descripcion</td>
                      <td>Estado</td>
                      <td>Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($equipos as $equipo) { ?>
                      <tr style='font-size:12px'>
                        <td al><?php echo $equipo['direccion']; ?></td>
                        <td al><?php echo $equipo['descripcion']; ?></td>
                        <td align="right"><?php echo estado($equipo['actived_at']); ?></td>
                        <td align="center" style="padding:3px;width: 17%">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button 
                              type        ="button" 
                              class       ="btn btn-info btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalModificaEquipo" 
                              data-id     ="<?php echo $equipo['id']?>" 
                              data-direc  ="<?php echo $equipo['direccion']?>" 
                              data-descri ="<?php echo $equipo['descripcion']?>" 
                              data-estado ="<?php echo $equipo['actived_at']?>" 
                              title       ="Modificar el Equipo Actual" >
                              <i class='fa fa-pencil-square'></i>
                            </button>

                            <button 
                              type        ="button" 
                              class       ="btn btn-warning btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalEliminaEquipo" 
                              data-id     ="<?php echo $equipo['id']?>" 
                              data-direc  ="<?php echo $equipo['direccion']?>" 
                              data-descri ="<?php echo $equipo['descripcion']?>" 
                              data-estado ="<?php echo $equipo['actived_at']?>" 
                              title       ="Elimina el Equipo Actual" >
                              <i class='fa fa-trash'></i>
                            </button>
                            <?php 
                            if($equipo['actived_at']==1){
                              $color = 'btn-success';
                            }else{
                              $color = 'btn-danger';
                            }
                            ?>
                            <a type="button" class="btn <?=$color?> btn-xs" 
                              href="javascript:activaEquipo(<?php echo $equipo['id']?>,<?=$equipo['actived_at']?>)"
                              title="BLoquear Equipo Actual">
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
            </div>
          </div>
        </div>
      </section>
    </div>

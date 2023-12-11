    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">  
                <input type="hidden" name="ubicacion" id="ubicacion" value="habitaciones">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-money"></i> Habitaciones </h3>
              </div>
              <div class="col-lg-6" align="right">
                <a style="margin:20px 0" 
                  data-toggle="modal" 
                  class = 'btn btn-success'
                  href="#myModalAdicionarHabitacion">
                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                 Adicionar Habitacion</a> 
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="container-fluid">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Numero Hab</th>
                      <th>Tipo de Habitacion</th>
                      <th>Sector</th>
                      <th>Camas</th>
                      <th>Huespedes</th>
                      <th>Estado</th>
                      <th>Accion</th>
                    </tr>
                  </thead>  
                  <tbody>
                    <?php foreach ($rooms as $room): ?>
                      <tr>
                        <td><?php echo $room["numero_hab"]?></td>
                        <td><?php echo $admin->getDescrTipoHab($room["id_tipohabitacion"])?></td>
                        <td><?php echo $admin->getDescrSectorHab($room["id_sector"])?></td>
                        <td align="center"><?php echo $room["camas"]?></td>
                        <td align="center"><?php echo $room["pax"]?></td>
                        <td><?php echo estadoTipoHabi($room["active_at"])?></td>
                        <td align="center" style="padding:3px;width: 17%">
                          <?php 
                          if($room['active_at']==1){
                            $color = 'btn-success';
                          }else{
                            $color = 'btn-danger';
                          }
                          ?>
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-info btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalModificaHabitacion" 
                              data-id     ="<?php echo $room['id']?>" 
                              data-numero ="<?php echo $room['numero_hab']?>" 
                              data-tipo ="<?php echo $room['id_tipohabitacion']?>" 
                              data-pax   ="<?php echo $room['pax']?>" 
                              data-camas  ="<?php echo $room['camas']?>" 
                              data-sector  ="<?php echo $room['id_sector']?>" 
                              title="Modificar la Habitacion Actual" >
                              <i class='fa fa-pencil-square'></i>
                            </button>
                            <button type="button" class="btn btn-warning btn-xs" 
                              data-toggle ="modal" 
                              data-target ="#myModalEliminaHabitacion" 
                              data-id     ="<?php echo $room['id']?>" 
                              data-numero ="<?php echo $room['numero_hab']?>" 
                              data-tipo ="<?php echo $room['id_tipohabitacion']?>" 
                              data-pax   ="<?php echo $room['pax']?>" 
                              data-camas  ="<?php echo $room['camas']?>" 
                              data-sector  ="<?php echo $room['id_sector']?>" 
                              title="Elimina la Habitacion Actual" >
                              <i class='fa fa-trash'></i>
                            </button>
                            <button type="button" class="btn <?=$color?> btn-xs" 
                              onclick="javascript:activaHabitacion(<?php echo $room['id']?>,<?=$room['active_at']?>)"
                              title="Bloquear Habitacion Actual">
                              <i class='fa fa-toggle-off'></i>
                            </button>                            
                          </div> 
                        </td>
                      </tr>                        
                    <?php endforeach ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </section>
    </div>

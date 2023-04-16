<?php 
  $ciudades  = $hotel->getCiudadesPais($empresa[0]['pais']);
  $rooms     = $admin->getHabitaciones(); 
  $huespedes = $admin->getPerfilHuesped(); 

?>

<div class="content-wrapper" style="margin-bottom: 50px"> 
  <form id="updateHotel" class="form-horizontal" action="javascript:updateHotel()" method="POST" enctype="multipart/form-data">
    <section class="content">
      <div class="panel panel-success">
        <div class="panel-heading"> 
          <div class="row">
            <div class="col-lg-6">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
              <input type="hidden" name="ubicacion" id="ubicacion" value="home">
              <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cogs"></i> Configuracion Hotel </h3>
            </div>
            <div class="col-lg-6" align="right">
              <button type="submit" name="edit_settings" class="btn btn-success btnPpal"><i class="fa fa-save"></i> Actualizar </button>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
              <?php 
                foreach ($datosHotel as $cia) { 
                  ?>
                  <input type="hidden" name="idHotel" id="idHotel" value="<?=$cia['id']?>">
                  <div class="form-group">
                    <label class="control-label col-lg-2">Hotel</label>
                    <div class="col-lg-6 col-md-6">
                      <input class="form-control" type="text" name="nameHotelUpd" id="nameHotelUpd" value="<?=$cia['nombre_hotel']?>" required>
                    </div>
                    <label class="control-label col-lg-2">Fecha Auditoria </label>
                    <div class="col-lg-2 col-md-2">
                      <input class="form-control" type="text" name='auditoriaUpd' id='auditoriaUpd' value="<?=$cia['fecha_auditoria']?>" disabled>  
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-2">Direccion</label>
                    <div class="col-lg-4 col-md-4">
                      <input class="form-control" type="text" name="adressUpd" id="adressUpd" value="<?=$cia['direccion']?>"  required>
                    </div>
                    <label class="control-label col-lg-2">Ciudad</label>
                    <div class="col-lg-4 col-md-4">
                      <select name="cityUpd" id="cityUpd" required="" >
                        <?php 
                        foreach ($ciudades as $ciudad) { ?>
                          <option value="<?=$ciudad['id_ciudad']?>" 
                            <?php 
                              if($cia['ciudad']== $ciudad['id_ciudad']){
                                echo 'selected' ;
                              }
                            ?>
                            ><?=$ciudad['municipio'].' ' .$ciudad['depto']?></option>
                          <?php 
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group" >
                    <label class="control-label col-lg-2" for="">Habitaciones</label>
                    <div class="col-lg-2 col-md-2" >
                      <input class="form-control" type="text" name="HabitacionesUpd" id="HabitacionesUpd" value="<?=$cia['habitaciones']?>" required>
                    </div> 
                    <label class="control-label col-lg-2" for="">Camas</label>
                    <div class="col-lg-2 col-md-2" >
                      <input class="form-control" type="text" name="CamasUpd" id="CamasUpd" value="<?=$cia['camas']?>" required>
                    </div> 
                    <label class="control-label col-lg-2" for="">Hora Salida</label>
                    <div class="col-lg-2 col-md-2" >
                      <input style="line-height: 15px" class="form-control" type="time" name="horaUpd" id="horaUpd" value="<?=$cia['hora_salida']?>" required>
                    </div>          
                  </div>
                  
                  <div class="form-group" >
                    <label class="control-label col-lg-2" for="">EMail</label>
                    <div class="col-lg-4 col-md-4" >
                      <input class="form-control" type="text" name="emailUpd" id="emailUpd" value="<?=$cia['email']?>" required>
                    </div>          
                    <label class="control-label col-lg-2" for="">Telefono</label>
                    <div class="col-lg-4 col-md-4" >
                      <input class="form-control" maxlength="14" minlength="7" type="text" name="phoneUpd" id="phoneUpd" value="<?=$cia['telefono']?>">
                    </div>          
                  </div> 
                  <div class="form-group" >
                    <label class="control-label col-lg-2" for="">Celular</label>
                    <div class="col-lg-4 col-md-4" >
                      <input class="form-control" maxlength="10" minlength="10" type="text" name="movilUpd" id="movilUpd" value="<?=$cia['celular']?>" required>
                    </div>          
                  </div> 
                  <div class="form-group">
                    <label for="seccion" class="control-label col-lg-2 col-md-2">Cuenta Depositos </label>
                    <div class="col-lg-4 col-md-4">
                      <select class="form-control" name="ctaMasted" id="ctaMasted" required>
                        <option value="">Cuenta Maestra</option>
                        <?php 
                        foreach ($rooms as $room) {
                          ?>
                          <option value="<?= $room['id']?>" 
                            <?php 
                              if($cia['cuenta_depositos']== $room['id']){
                                echo 'selected' ;
                              }
                            ?>
                            ><?php echo $room['numero_hab']?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                    <label for="seccion" class="control-label col-lg-2 col-md-2">Perfil Depositos </label>
                    <div class="col-lg-4 col-md-4">
                      <select class="form-control" name="idperfilctaMasted" id="idperfilctaMasted" required>
                        <option value="">Seleccione el Perfil de la Cuenta Maestra</option>
                        <?php 
                        foreach ($huespedes as $huesped) {
                          ?>
                          <option value="<?= $huesped['id_huesped']?>" 
                            <?php 
                              if($cia['id_perfil_depositos']== $huesped['id_huesped']){
                                echo 'selected' ;
                              }
                            ?>
                            ><?php echo $huesped['nombre_completo']?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <?php 
                }
              ?>
            </div>
          </div>              
        </div>
        <div class="panel-footer"> </div>
      </div>
    </section>
  </form>
</div>





<?php
$ciudades = $hotel->getCiudadesPais($empresa['pais']);
$rooms = $admin->getHabitaciones();
$huespedes = $admin->getPerfilHuesped();
$infoTextos = $admin->getInfoTextosFacturaHotel()
?>

<div class="content-wrapper" style="margin-bottom: 0px">
  <section class="content">
    <input type="hidden" name="idHotel" id="idHotel" value="<?php echo $datosHotel[0]['id']; ?>">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row" style="padding:5px 0;">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_ADM ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="infoHotel">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-bank"></i> Informacion Hotel </h3>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="row-fluid">
          <ul class="nav nav-tabs">
            <li class="active">
              <a href="#infoHotel" class="" data-toggle="tab">
                <i style="color:black;" class="fa fa-cogs fa-2x"></i>
                Configuracion Hotel
              </a>
            </li>
            <li>
              <a href="#infoPieFac" class="" data-toggle="tab">
                <i class="fa-regular fa-file-lines fa-2x"></i>
                Textos Factura
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane pd0 active" id="infoHotel">
              <form id="updateHotel" class="pd0 form-horizontal" action="javascript:updateHotel()" method="POST" enctype="multipart/form-data">
                <section class="row-fluid">
                  <div class="panel panel-success">
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                          <?php
                          foreach ($datosHotel as $cia) {
                          ?>
                            <div class="form-group">
                              <label class="control-label col-sm-2">Hotel</label>
                              <div class="col-lg-6 col-sm-6">
                                <input class="form-control" type="text" name="nameHotelUpd" id="nameHotelUpd" value="<?php echo $cia['nombre_hotel']; ?>" required>
                              </div>
                              <label class="control-label col-sm-2">Fecha Auditoria </label>
                              <div class="col-lg-2 col-sm-2">
                                <input class="form-control" type="text" name='auditoriaUpd' id='auditoriaUpd' value="<?php echo $cia['fecha_auditoria']; ?>" disabled>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2">Direccion</label>
                              <div class="col-lg-6 col-md-6">
                                <input class="form-control" type="text" name="adressUpd" id="adressUpd" value="<?php echo $cia['direccion']; ?>" required>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2">Ciudad</label>
                              <div class="col-lg-4 col-md-4">
                                <select name="cityUpd" id="cityUpd" required="">
                                  <?php
                                  foreach ($ciudades as $ciudad) { ?>
                                    <option value="<?php echo $ciudad['id_ciudad']; ?>"
                                      <?php
                                      if ($cia['ciudad'] == $ciudad['id_ciudad']) {
                                        echo 'selected';
                                      }
                                      ?>><?php echo $ciudad['municipio'] . ' ' . $ciudad['depto']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="">Habitaciones</label>
                              <div class="col-lg-2 col-sm-2">
                                <input class="form-control" type="text" name="HabitacionesUpd" id="HabitacionesUpd" value="<?php echo $cia['habitaciones']; ?>" required>
                              </div>
                              <label class="control-label col-sm-2" for="">Camas</label>
                              <div class="col-lg-2 col-sm-2">
                                <input class="form-control" type="text" name="CamasUpd" id="CamasUpd" value="<?php echo $cia['camas']; ?>" required>
                              </div>
                              <label class="control-label col-sm-2" for="">Hora Salida</label>
                              <div class="col-lg-2 col-sm-2">
                                <input style="line-height: 15px" class="form-control" type="time" name="horaUpd" id="horaUpd" value="<?php echo $cia['hora_salida']; ?>" required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-sm-2" for="">EMail</label>
                              <div class="col-lg-4 col-sm-4">
                                <input class="form-control" type="text" name="emailUpd" id="emailUpd" value="<?php echo $cia['email']; ?>" required>
                              </div>
                              <label class="control-label col-sm-2" for="">Telefono</label>
                              <div class="col-lg-4 col-sm-4">
                                <input class="form-control" maxlength="14" minlength="7" type="text" name="phoneUpd" id="phoneUpd" value="<?php echo $cia['telefono']; ?>">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-2" for="">Celular</label>
                              <div class="col-lg-4 col-sm-4">
                                <input class="form-control" maxlength="10" minlength="10" type="text" name="movilUpd" id="movilUpd" value="<?php echo $cia['celular']; ?>" required>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="seccion" class="control-label col-lg-2 col-sm-2">Cuenta Depositos </label>
                              <div class="col-lg-4 col-md-4">
                                <select class="form-control" name="ctaMasted" id="ctaMasted" required>
                                  <option value="">Cuenta Maestra</option>
                                  <?php
                                  foreach ($rooms as $room) {
                                  ?>
                                    <option value="<?php echo $room['numero_hab']; ?>"
                                      <?php
                                      if ($cia['cuenta_depositos'] == $room['numero_hab']) {
                                        echo 'selected';
                                      }
                                      ?>><?php echo $room['numero_hab']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                              <label for="seccion" class="control-label col-lg-2 col-sm-2">Perfil Depositos </label>
                              <div class="col-lg-4 col-md-4">
                                <select class="form-control" name="idperfilctaMasted" id="idperfilctaMasted" required>
                                  <option value="">Seleccione el Perfil de la Cuenta Maestra</option>
                                  <?php
                                  foreach ($huespedes as $huesped) {
                                  ?>
                                    <option value="<?php echo $huesped['id_huesped']; ?>"
                                      <?php
                                      if ($cia['id_perfil_depositos'] == $huesped['id_huesped']) {
                                        echo 'selected';
                                      } ?>><?php echo $huesped['nombre_completo']; ?></option>
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
                    <div class="panel-footer derecha">
                      <button id="infoHotel" type="submit" name="edit_settings" class="btn btn-success btnPpal"><i class="fa fa-save"></i> Actualizar </button>
                    </div>
                  </div>
                </section>
              </form>
            </div>
            <div class="tab-pane pd0" id="infoPieFac">
              <form id="updatePieFact" class="pd0 form-horizontal" method="POST" enctype="multipart/form-data">
                <section class="row-fluid">
                  <div class="panel panel-success">
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-lg-10 col-lg-offset-1">
                          <?php
                          foreach ($infoTextos as $texto) {
                          ?>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-xs-12">Titulo Factura</label>
                              <div class="col-lg-10 col-md-10 col-xs-12">
                                <textarea name="tituloFac" id="tituloFac" cols="30" rows="3"><?php echo $cia['actividad']; ?></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-xs-12">Informacion Banco</label>
                              <div class="col-lg-10 col-md-10 col-xs-12">
                                <textarea name="infoBanco" id="infoBanco" cols="30" rows="3"><?php echo $cia['info_banco']; ?></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-xs-12">Informacion Factura</label>
                              <div class="col-lg-10 col-md-10 col-xs-12">
                                <textarea name="infoFact" id="infoFact" cols="30" rows="3"><?php echo $cia['info_factura']; ?></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2 col-xs-12" for="">Pie Factura</label>
                              <div class="col-lg-10 col-md-10 col-xs-12">
                                <textarea name="infoPie" id="infoPie" cols="30" rows="3"><?php echo $cia['info_pie']; ?></textarea>
                              </div>
                            </div>
                          <?php
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="panel-footer derecha">
                      <button id="btnInfoPie" type="button" onclick="javascript:updatePieFact()" name="edit_settings" class="btn btn-success btnPpal"><i class="fa fa-save"></i> Actualizar </button>
                    </div>
                  </div>
                </section>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>
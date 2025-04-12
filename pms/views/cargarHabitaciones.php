    <div class="content-wrapper">
      <section class="content" style="height: 780px;display: flex;justify-content: center;">
        <div class="col-md-8 center-block" style="margin: 50px 0;">
          <div class="panel panel-success">
            <div class="panel-heading">
              <div class="row">
                <div class="col-lg-9">
                  <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
                  <input type="hidden" name="ubicacion" id="ubicacion" value="index.php">
                  <h3 class="w3ls_head tituloPagina"> <i class="fa fa-money icon" style="font-size:36px;color:black"></i> Cargar Habitaciones</h3>
                </div>
              </div>
            </div>
            <div class="datos_ajax_delete"></div>
            <form id="formCargarHabitaciones" class="form-horizontal" action="javascript:cargarHabitaciones()" method="POST" enctype="multipart/form-data">
              <div class="panel-body">
                <div class="form-group">
                  <label for="roomOption" style="margin-top:3px;" class="col-sm-3 control-label">Cargar</label>
                  <div class="col-sm-9">
                    <div class="col-sm-6">
                      <div class="form-check form-check-inline">
                        <input style="margin-top:5px" class="form-check-input" type="radio" name="roomOption" id="inlineRadio1" value="1" onclick="cambiaEstadoCargarHabitaciones(this.value)">
                        <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio1">Una Habitacion</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-check form-check-inline">
                        <input style="margin-top:5px" class="form-check-input" type="radio" name="roomOption" id="inlineRadio2" value="2" checked onclick="cambiaEstadoCargarHabitaciones(this.value)">
                        <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio2">Todas</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group" id='habitacionesCasa' style="display:none">
                  <label for="cargarHabitacion" class="col-sm-3 control-label">Habitacion </label>
                  <div class="col-sm-9">
                    <select name="cargarHabitacion" id="cargarHabitacion">
                      <option value="">Seleccione Habitacion</option>
                      <?php
                      $habitaciones = $hotel->getHuespedesenCasasinCtaMaster(2, 'CA', CTA_MASTER);
                      foreach ($habitaciones as $habitacion) { ?>
                        <option value="<?php echo $habitacion['num_reserva']; ?>"><?php echo $habitacion['num_habitacion'] . ' ' . $habitacion['apellido1'] . ' ' . $habitacion['apellido2'] . ' ' . $habitacion['nombre1'] . ' ' . $habitacion['nombre2']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div id="aviso"></div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                    <div class="col-lg-6 col-md-6" style="padding:0">
                      <a type="button" class="btn btn-warning btn-block" href="<?php echo BASE_PMS; ?>index.php"><i class="fa fa-reply"></i> Regresar</a>
                    </div>
                    <div class="col-lg-6 col-md-6" style="padding:0">
                      <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Procesar</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
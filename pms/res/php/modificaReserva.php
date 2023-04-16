<?php 
  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $path        = $_SERVER['PHP_SELF']; 
  $reserva     = $_POST['reserva'];
  $datareserva = $hotel->getReservaActual($reserva);
  $huesped     = $hotel->getbuscaDatosHuesped($datareserva[0]['id_huesped']);

  if(!empty($datareserva[0]['id_compania'])){
    $cia =  $hotel->getSeleccionaCompania($datareserva[0]['id_compania']);
  }

?>
        <div class="panel panel-success" id='pantallaModificaReserva'>
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
                <input type="hidden" name="ubicacion" id="ubicacion" value="reservas.php">
                <h3 class="w3ls_head tituloPagina">Modificacion Reservas</h3>
              </div>
            </div>
          </div>
          <form class="form-horizontal" id="formReservas" action="javascript:guardaReserva()" method="POST">
            <div class="panel-body">
              <div class="divHuesped">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Identificacion</label>
                  <div class="col-sm-2">
                    <input type="hidden" name="tipoocupacion" value="1">
                    <input type="text" class="form-control" name="identifica" id="identifica" placeholder="Identificacion" required="" value="<?=$huesped[0]['identificacion']?>">
                  </div>
                  <div class="col-sm-4" style="padding:0">
                    <div class="col-sm-6">
                      <div class="form-check form-check-inline">
                        <?php 
                        if($datareserva[0]['tipo_reserva']==1){ ?>
                          <input style="margin-top:10px" class="form-check-input" type="radio" name="habitacionOption" id="inlineRadio1" value="1" checked readonly>
                        <?php 
                        }else{ ?>
                          <input style="margin-top:10px" class="form-check-input" type="radio" name="habitacionOption" id="inlineRadio1" value="1" readonly>
                        <?php 
                        }
                        ?>
                        <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Habitacion</label>
                      </div>                    
                    </div>
                    <div class="col-sm-6">
                      <div class="form-check form-check-inline">
                        <?php 
                        if($datareserva[0]['tipo_reserva']==2){ ?>
                          <input style="margin-top:10px" class="form-check-input" type="radio" name="habitacionOption" id="inlineRadio2" value="2" checked readonly>
                        <?php 
                        }else{?>
                          <input style="margin-top:10px" class="form-check-input" type="radio" name="habitacionOption" id="inlineRadio2" value="2" readonly >
                          <?php 
                        }
                        ?>
                        <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">Dormitorio</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-2">Apellidos</label>
                  <div class="col-lg-4 col-md-3">
                    <input class="form-control padInput" type="text" name="txtApellidosCon" id='txtApellidosCon' value='<?=$huesped[0]['apellidos']?>' readonly>
                  </div>
                  <label class="control-label col-lg-2">Nombres</label>
                  <div class="col-lg-4 col-md-3">
                    <input class="form-control padInput" type="text" name="txtNombresCon" id='txtNombresCon' value='<?=$huesped[0]['apellidos']?>' readonly>
                  </div> 
                  <!--<a class="btn btn-success" type="button" href="<?=BASE_PMS?>paginas\nuevoHuesped.php"><i class="fa fa-user"></i> Adicionar Huesped</a> -->
                </div>
                <div id="datoshuesped"></div>
              </div>
              <?php 
              if(!empty($datareserva[0]['id_compania'])){
               ?>
                <div class="form-group">
                  <label for="direccion" class="col-sm-2 control-label">Empresa </label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="direccion" placeholder="" value="<?=$cia[0]['empresa']?>" readonly>
                    <input type="hidden" name="idcia" id="idcia" value="<?=$cia[0]['id_compania']?>">
                  </div>
                  <label for="nombres" class="col-sm-2 control-label">Nit</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="nit" placeholder="" value="<?=$cia[0]['nit'].'-'.$cia[0]['dv']?>" readonly>
                  </div>
                </div>
                <!--<div class="form-group">
                  <label for="direccion" class="col-sm-2 control-label">Direccion </label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="direccion" placeholder="" value="<?=$cia[0]['direccion']?>" readonly>
                  </div>
                  <label for="nombres" class="col-sm-2 control-label">Correo</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="nombres" placeholder="" value="<?=$cia[0]['email']?>" readonly>
                  </div>
                </div> -->
                <?php
                } 
              ?>
              <div class="form-group">
                <label for="llegada" class="col-sm-1 control-label">Llegada</label>
                <div class="col-sm-3">
                  <input type="date" class="form-control" name="llegada" id="llegada" required="" value="<?=$datareserva[0]['fecha_llegada']?>"> 
                </div>
                <label for="noches" class="col-sm-1 control-label">Noches</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" name="noches" id="noches" required="" value='<?=$datareserva[0]['dias_reservados']?>' min='1' onchange="sumarDias()">
                </div>
                <label for="salida" class="col-sm-1 control-label">Salida</label>
                <div class="col-sm-3">
                  <input type="date" onblur="restaFechas()" class="form-control" name="salida" id="salida" required="" value="<?=$datareserva[0]['fecha_salida']?>">
                </div>
              </div>
              <div class="form-group">
                <label for="hombres" class="col-sm-1 control-label">Hombres</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" name="hombres" id="hombres" required="" value="<?=$datareserva[0]['can_hombres']?>" min=0>
                </div>
                <label for="mujeres" class="col-sm-1 control-label">Mujeres</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" name="mujeres" id="mujeres" required="" value='<?=$datareserva[0]['can_mujeres']?>' min=0>
                </div>
                <label for="ninos" class="col-sm-1 control-label">Niños</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" name="ninos" id="ninos" required="" value="<?=$datareserva[0]['can_ninos']?>" min=0> 
                </div>
              </div>
              <div class="form-group">
                <label for="tipohabi" class="col-sm-2 control-label">Tipo Habitacion</label>
                <div class="col-sm-4">
                  <select name="tipohabi" id="tipohabi" required onblur="seleccionaHabitacion()">
                    <option value="">Seleccione el Tipo de Habitacion</option>
                    <?php 
                      $tipos = $hotel->getTipoHabitacion();
                      foreach ($tipos as $tipo) {
                      ?>
                      <option value="<?=$tipo['tipo_habi']?>"><?=$tipo['des_habi']?></option>
                      <?php 
                      }
                    ?>
                  </select>
                </div>
                <label for="nrohabitacion" class="col-sm-2 control-label">Nro Habitacion</label>
                <div class="col-sm-4">
                  <div id="habitaciones">
                    <input type="text" class="form-control" id="" required="" value="" min=0> 
                    
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="tarifahab" class="col-sm-2 control-label">Tipo Tarifa</label>
                <div class="col-sm-4">
                  <div id="tarifas">
                    <select name="">
                      <option value="">Seleccione la tarifa</option>
                    </select>
                  </div>
                </div>
                <label for="valortar" class="col-sm-2 control-label">Valor Tarifa</label>
                <div class="col-sm-4">
                  <div id="valortarifas">
                    <input type="text" class="form-control" name="valortar" id="valortar" required="" value="0" min=0> 
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="tarifahab" class="col-sm-2 control-label">Procedencia</label>
                <div class="col-sm-4">
                  <select name="origen" id="origen">
                    <option value="">Seleccione la Procedencia</option>
                    <?php 
                      $ciudades = $hotel->getCiudades();
                      foreach ($ciudades as $ciudad) { ?>
                        <option value="<?=$ciudad['id_ciudad']?>"><?=$ciudad['municipio'].' '.$ciudad['depto']?></option>}
                        option
                        <?php 
                      }
                     ?>
                  </select>
                </div>
                <label for="tarifahab" class="col-sm-2 control-label">Destino</label>
                <div class="col-sm-4">
                  <select name="destino" id="destino">
                    <option value="">Seleccione el Destino</option>
                    <?php 
                      $ciudades = $hotel->getCiudades();
                      foreach ($ciudades as $ciudad) { ?>
                        <option value="<?=$ciudad['id_ciudad']?>"><?=$ciudad['municipio'].' '.$ciudad['depto']?></option>}
                        option
                        <?php 
                      }
                     ?>
                  </select>
                </div>
              </div>            
              <div class="form-group">
                <label for="motivo" class="col-sm-2 control-label">Motivo Viaje</label>
                <div class="col-sm-2">
                  <select name="motivo" id="motivo">
                    <option value="">Seleccione el Motivo</option>
                    <?php 
                    $motivos = $hotel->getMotivoGrupo('MVI');
                    foreach ($motivos as $motivo) { ?>
                      <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>}
                      option
                      <?php 
                    }
                     ?>
                  </select>
                </div>
                <label for="tarifahab" class="col-sm-2 control-label">Fuente de Reserva</label>
                <div class="col-sm-2">
                  <select name="fuente" id="fuente">
                    <option value="">Seleccione Fuente</option>
                    <?php 
                      $motivos = $hotel->getMotivoGrupo('FRE');
                      foreach ($motivos as $motivo) { ?>
                        <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>}
                        option
                        <?php 
                      }
                     ?>
                  </select>
                </div>
                <label for="tarifahab" class="col-sm-2 control-label">Segmento</label>
                <div class="col-sm-2">
                  <select name="segmento" id="segmento">
                    <option value="">Seleccione el Segmento</option>
                    <?php 
                      $motivos = $hotel->getMotivoGrupo('SME');
                      foreach ($motivos as $motivo) { ?>
                        <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>}
                        option
                        <?php 
                      }
                     ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="motivo" class="col-sm-2 control-label">Observaciones</label>
                <div class="col-sm-10">
                  <textarea style="height: 5em !important;min-height: 5em" name="observaciones" id="observaciones" class="form-control" rows="4"></textarea>
                </div>
                
              </div>                 
            </div>
            <div class="panel-footer">
              <div class="btn-group" style="width: 30%;margin-left:35%">
                <a style="width: 50%" type="button" class="btn btn-warning" href="<?=BASE_PMS?>paginas/reservas.php">Cancelar</a>
                <button style="width: 50%" class="btn btn-success" align="right">Procesar</button>
              </div>     
            </div>
          </form>
        </div>



?>



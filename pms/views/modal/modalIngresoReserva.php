<div class="modal fade" id="myModalIngresoReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="glyphicon glyphicon-off"></span>
            </button>
            <h3 class="modal-title" id="exampleModalLabel">Ingresa Reserva</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body">
            <input type="hidden" name="idregis" id="txtIdReserva" value="">
            <div class="form-group">
              <label class="form-label col-lg-2 col-md-2">Tipo Habitacion</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control" type="text" name="txtTipoHab" id="txtTipoHab" required>
              </div>
              <label class="form-label col-lg-2 col-md-2">Numero</label>
              <div class="col-lg-2 col-md-2 col-md-2">
                <input class="form-control" type="text" name='txtNumeroHab' id='txtNumeroHab' required>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label col-lg-2 col-md-2">Apellidos</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control" type="text" name="txtApellidos" id='txtApellidos' value='0'>
              </div>
              <label class="form-label col-lg-2 col-md-2">Nombres</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control" type="text" name="txtNombres" id='txtNombres' value='0'>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label col-lg-2 col-md-2">Fecha Llegada</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control" type="text" name="txtLlegada" id='txtLlegada' value='0'>
              </div>
              <label class="form-label col-lg-1">Noches</label>
              <div class="col-lg-1 col-md-1">
                <input class="form-control" type="text" name="txtNoches" id="txtNoches" value='0'>
              </div>
              <label class="form-label col-lg-2 col-md-2">Fecha Salida</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control" type="text" name="txtSalida" id='txtSalida' value='1'>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label col-lg-2 col-md-2">Hombres</label>
              <div class="col-lg-2 col-md-2 col-md-2">
                <input class="form-control" type="text" name="txtHombres" id='txtHombres' value='0'>
              </div>
              <label class="form-label col-lg-2 col-md-2">Mujeres</label>
              <div class="col-lg-2 col-md-2 col-md-2">
                <input class="form-control" type="text" name="txtMujeres" id='txtMujeres' value='0'>
              </div>
              <label class="form-label col-lg-2 col-md-2">Niños</label>
              <div class="col-lg-2 col-md-2 col-md-2">
                <input class="form-control" type="text" name="txtNinos" id='txtNinos' value='0'>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label col-lg-2 col-md-2" for="">Comentarios</label>
              <div class="col-lg-10 col-md-10">
                <textarea class="form-control" id="areaComentarios" name="areaComentarios" placeholder="Comentarios de la Reserva"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="archivo" class="col-sm-2 control-label">Tarifa</label>
              <div class="col-sm-2">
                <input class="form-control" type="text" name="txtTarifa" id="txtTarifa" value=0 required="">
              </div>
              <label for="archivo" class="col-sm-3 control-label">Valor Alojamiento</label>
              <div class="col-sm-4">
                <input class="form-control" type="text" name="txtValorTarifa" id="txtValorTarifa" value=0 required="">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-6 col-lg-offset-3">
                <div class="col-lg-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Regresar</button>
                </div>
                <div class="col-lg-6">
                  <button class="btn btn-primary btn-block" id="btnSaveRoom">Guardar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


<div class="modal fade" id="myModalAdicionaReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
          </button>
          <h3 class="modal-title" id="exampleModalLabel">Nueva Reserva</h3>
        </div>
        <div class="modal-body" id="modalReservasIns">
          <div id="mensaje" style="margin-bottom:-30px"></div>
          <form class="form-horizontal" id="formReservas" action="javascript:guardaReserva()" method="POST">
            <div class="panel panel-success" id='pantallaNuevaReserva'>
              <div class="panel-heading">
                <div class="form-group">
                  <input type="hidden" name="tipoocupacion" value="1">
                  <input type="hidden" name="estadoocupacion" value="ES">
                  <label for="inputEmail3" class="col-sm-2 control-label">Huesped</label>
                  <div class="form-group has-success has-feedback col-sm-5">
                    <div class="input-group" style="padding-left:15px;">
                      <input type="text" class="form-control" id="buscarHuesped" aria-describedby="inputGroupSuccess4Status" style="background:#FFF">
                      <span class="input-group-addon" style="padding:1px;border:none">
                        <a data-toggle="modal"
                          href="#myModalBuscaHuesped">
                          <i style="padding:5px 10px" class="fa fa-search" aria-hidden="true"></i>
                        </a>
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-4" align="right" style="padding-right: 0">
                    <a
                      class="btn btn-success"
                      data-toggle="modal"
                      href="#myModalAdicionaPerfil">
                      <i class="fa fa-user-plus" aria-hidden="true"></i> Adicionar Huesped
                    </a>
                  </div>
                </div>
                <div id="datosHuespedAdi"></div>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tipo Alojamiento</label>
                  <div class="col-sm-3">
                    <select name="habitacionOption" id="habitacionOption">
                      <option value="1">Habitacion</option>
                      <option value="2">Dormitorio</option>
                      <option value="3">Motor Home</option>
                      <option value="4">Camping</option>
                      <option value="5">Cuenta Maestra</option>
                    </select>
                  </div>
                  <label for="inputEmail3" class="col-sm-2 control-label">Decreto 297 </label>
                  <div class="col-sm-2 ondisplay">
                    <div class="wrap">
                      <div class="col-sm-6" style="padding:0;height: 15px">
                        <div class="form-check form-check-inline">
                          <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio1" value="1" checked>
                          <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1">NO</label>
                        </div>
                      </div>
                      <div class="col-sm-6" style="padding:0;height: 15px">
                        <div class="form-check form-check-inline">
                          <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio2" value="2">
                          <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">SI</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="llegada" class="col-sm-2 control-label">Llegada</label>
                  <div class="col-sm-3" style="padding-right: 20px">
                    <input type="date" class="form-control" name="llegada" id="llegada" required="" value="<?php echo FECHA_PMS; ?>" min="<?php echo FECHA_PMS; ?>">
                  </div>
                  <label for="noches" class="col-sm-1 control-label">Noches</label>
                  <div class="col-sm-2">
                    <input type="number" class="form-control" name="noches" id="noches" required="" value='1' min='1' onchange="sumarDias()">
                  </div>
                  <label for="salida" class="col-sm-1 control-label">Salida</label>
                  <div class="col-sm-3" style="padding-right: 20px">
                    <input type="date" onfocus="sumarDias()" onblur="restaFechas()" class="form-control" name="salida" id="salida" required="" value="<?php echo FECHA_PMS; ?>" min="<?php echo FECHA_PMS; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="hombres" class="col-sm-2 control-label">Hombres</label>
                  <div class="col-sm-1" style='padding-right: 5px'>
                    <input type="number" class="form-control" name="hombres" id="hombres" required="" value="0" min=0>
                  </div>
                  <label for="mujeres" class="col-sm-1 control-label">Mujeres</label>
                  <div class="col-sm-1" style='padding-right: 5px'>
                    <input type="number" class="form-control" name="mujeres" id="mujeres" required="" value='0' min=0>
                  </div>
                  <label for="ninos" class="col-sm-1 control-label">Niños</label>
                  <div class="col-sm-1" style='padding-right: 5px'>
                    <input type="number" class="form-control" name="ninos" id="ninos" required="" value="0" min=0>
                  </div>
                  <label for="orden" class="col-sm-2 control-label">Orden Nro</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="orden" id="orden" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tipohabi" class="col-sm-2 control-label">Tipo Habitacion</label>
                  <div class="col-sm-4">
                    <select name="tipohabi" id="tipohabi" required onfocus="asignaTipoHabitacion()" onblur="seleccionaHabitacion()">
                      <option value="">Seleccione el Tipo de Habitacion</option>
                    </select>
                  </div>
                  <label for="nrohabitacion" class="col-sm-2 control-label">Nro Habitacion</label>
                  <div class="col-sm-4">
                    <select name="nrohabitacion" id="nrohabitacion" required onblur='seleccionaTarifas()'>
                      <option value="">Seleccione la Habitacion</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tarifahab" class="col-sm-2 control-label">Tipo Tarifa</label>
                  <div class="col-sm-4">
                    <div id="tarifas">
                      <select name="" required="">
                        <option value="">Seleccione la Tarifa</option>
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
                        <option value="<?php echo $ciudad['id_ciudad']; ?>"><?php echo $ciudad['municipio'] . ' ' . $ciudad['depto']; ?></option>}
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
                        <option value="<?php echo $ciudad['id_ciudad']; ?>"><?php echo $ciudad['municipio'] . ' ' . $ciudad['depto']; ?></option>}
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="motivo" class="col-sm-2 control-label">Motivo Viaje</label>
                  <div class="col-sm-4">
                    <select name="motivo" id="motivo">
                      <option value="">Seleccione el Motivo</option>
                      <?php
                      $motivos = $hotel->getMotivoGrupo('MVI');
                      foreach ($motivos as $motivo) { ?>
                        <option value="<?php echo $motivo['id_grupo']; ?>"><?php echo $motivo['descripcion_grupo']; ?></option>}
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <label for="tarifahab" class="col-sm-2 control-label">Fuente de Reserva</label>
                  <div class="col-sm-4">
                    <select name="fuente" id="fuente">
                      <option value="">Seleccione Fuente</option>
                      <?php
                      $motivos = $hotel->getMotivoGrupo('FRE');
                      foreach ($motivos as $motivo) { ?>
                        <option value="<?php echo $motivo['id_grupo']; ?>"><?php echo $motivo['descripcion_grupo']; ?></option>}
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tarifahab" class="col-sm-2 control-label">Segmento</label>
                  <div class="col-sm-4">
                    <select name="segmento" id="segmento">
                      <option value="">Seleccione el Segmento</option>
                      <?php
                      $motivos = $hotel->getMotivoGrupo('SME');
                      foreach ($motivos as $motivo) { ?>
                        <option value="<?php echo $motivo['id_grupo']; ?>"><?php echo $motivo['descripcion_grupo']; ?></option>}
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <label for="formapago" class="col-sm-2 control-label">Forma de Pago </label>
                  <div class="col-sm-4">
                    <select name="formapago" id="formapago">
                      <option value="">Seleccione La Forma de Pago</option>
                      <?php
                      $codigos = $hotel->getCodigosConsumos(3);
                      foreach ($codigos as $codigo) { ?>
                        <option value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
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
                  <button style="width: 50%" type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                  <button style="width: 50%" class="btn btn-success" align="right"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
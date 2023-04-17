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
                  <div class="form-group has-success has-feedback col-sm-6" >
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
                      <i class="fa fa-user-plus" aria-hidden="true"></i>  Adicionar Huesped
                    </a>
                  </div>
                </div>
                <div id="datosHuespedAdi"></div>
              </div>
              <div class="panel-body" style="padding: 5px 15px;">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Decreto 297 </label>
                  <div class="col-sm-2 ondisplay">
                    <div class="wrap">
                      <div class="col-sm-6" style="padding:0;height: 15px">
                        <div class="form-check form-check-inline">
                          <input style="margin-top:5px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio1" value="1" checked>
                          <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >NO</label>
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
                    <input type="date" class="form-control" name="llegada" id="llegada" required="" value="<?=FECHA_PMS?>" min="<?=FECHA_PMS?>"> 
                  </div>
                  <label for="noches" class="col-sm-1 control-label">Noches</label>
                  <div class="col-sm-2">
                    <input type="number" class="form-control" name="noches" id="noches" required="" value='1' min='1' onchange="sumarDias()">
                  </div>
                  <label for="salida" class="col-sm-1 control-label">Salida</label>
                  <div class="col-sm-3" style="padding-right: 20px">
                    <input type="date" onfocus="sumarDias()" onblur="restaFechas()" class="form-control" name="salida" id="salida" required="" value="<?=FECHA_PMS?>" min="<?=FECHA_PMS?>">
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
                    <select name="tipohabi" id="tipohabi" required onblur="seleccionaHabitacion()">
                      <option value="">Seleccione el Tipo de Habitacion</option>
                      <?php 
                        $tipos = $hotel->getTipoHabitacion();
                        foreach ($tipos as $tipo) {?>
                          <option value="<?=$tipo['id']?>"><?=$tipo['descripcion_habitacion']?></option>
                          <?php 
                        }
                      ?>                      
                    </select>
                  </div>
                  <label for="nrohabitacion" class="col-sm-2 control-label">Nro Habitacion</label>
                  <div class="col-sm-4">
                    <select name="nrohabitacion" id="nrohabitacion" required onblur='seleccionaTarifas()'>
                    </select>                        
                  </div>
                </div>
                <div class="form-group">
                  <label for="tarifahab" class="col-sm-2 control-label">Tipo Tarifa</label>
                  <div class="col-sm-4">
                    <div >
                      <select name="tarifahab" required="" id="tarifahab" onblur="valorHabitacion(this.value)">
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
                          <option value="<?=$ciudad['id_ciudad']?>"><?=$ciudad['municipio'].' '.$ciudad['depto']?></option>
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
                          <option value="<?=$ciudad['id_ciudad']?>"><?=$ciudad['municipio'].' '.$ciudad['depto']?></option>
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
                        <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>
                        <?php 
                      }
                      ?>
                    </select>
                  </div>
                  <label for="tarifahab" class="col-sm-2 control-label">Fuente Reserva</label>
                  <div class="col-sm-4">
                    <select name="fuente" id="fuente">
                      <option value="">Seleccione Fuente</option>
                      <?php 
                        $motivos = $hotel->getMotivoGrupo('FRE');
                        foreach ($motivos as $motivo) { ?>
                          <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>
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
                          <option value="<?=$motivo['id_grupo']?>"><?=$motivo['descripcion_grupo']?></option>
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
                          <option value="<?=$codigo['id_cargo']?>"><?=$codigo['descripcion_cargo']?></option>
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

<div class="modal fade" id="myModalInformacionReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">  
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Cancelar Reserva</h3>
          </div>
          <div class="modal-body modalReservas">
            <div class="form-group">
              <label class="control-label col-lg-2">Reserva Nro</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="idregis" id="txtIdReservaInf" value="">
              </div>
              <label class="control-label col-lg-2">Tipo Hab.</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtTipoHab" id="txtTipoHabInf" readonly>
              </div>
              <label class="control-label col-lg-1">Numero</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name='txtNumeroHabInf' id='txtNumeroHabInf' readonly>    
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Huesped</label>
              <div class="col-lg-8 col-md-8">
                <input class="form-control padInput" type="text" name="txtHuespedInf1" id="txtHuespedInf1" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Llegada</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtLlegadaInf" id='txtLlegadaInf' value='0' readonly>
              </div>
              <label class="control-label col-lg-1">Noches</label>
              <div class="col-lg-2 col-md-2">
                <input style="margin:0;padding:5px" class="form-control padInput" type="text" name="txtNochesInf" id="txtNochesInf" value='0' readonly>
              </div>
              <label class="control-label col-lg-1">Salida</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtSalidaInf" id='txtSalidaInf' value='1' readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="hombres" class="col-sm-2 control-label">Hombres</label>
              <div class="col-sm-1" style='padding-right: 5px'>
                <input type="number" class="form-control" name="txtHombresInf" id="txtHombresInf" readonly>
              </div>
              <label for="mujeres" class="col-sm-1 control-label">Mujeres</label>
              <div class="col-sm-1" style='padding-right: 5px'>
                <input type="number" class="form-control" name="txtMujeresInf" id="txtMujeresInf" readonly>
              </div>
              <label for="ninos" class="col-sm-1 control-label">Niños</label>
              <div class="col-sm-1" style='padding-right: 5px'>
                <input type="number" class="form-control" name="txtNinosInf" id="txtNinosInf" readonly> 
              </div>
              <label for="orden" class="col-sm-2 control-label">Orden Nro</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" name="orden" id="orden" value="" min=0>
              </div> 
            </div>
            <div class="form-group">
              <label for="archivo" class="col-sm-2 control-label">Tarifa</label>
              <div class="col-sm-4">
                <input class="form-control padInput" type="text" name="txtTarifaInf" id="txtTarifaInf" value=0 readonly="">
              </div>
              <label for="archivo" class="col-sm-2 control-label">Valor</label>
              <div class="col-sm-3">
                <input class="form-control padInput" type="text" name="txtValorTarifaInf" id="txtValorTarifaInf" value=0 readonly="">
              </div>
            </div>
            <div class="form-group">
              <label for="motivo" class="col-sm-2 control-label">Observaciones</label>
              <div class="col-sm-10">
                <textarea style="height: 5em !important;min-height: 5em" name="areaComentariosInf" id="areaComentariosInf" class="form-control" rows="4" readonly=""></textarea>
              </div>                    
            </div>
            <div class="form-group">
              <label for="tarifahab" class="col-sm-2 control-label">Creada Por</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="createdusr" id="createdusr" value="" readonly="">
              </div>
              <label for="formapago" class="col-sm-2 control-label">Fecha - Hora </label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="fechaCrea" id="fechaCrea" value="" readonly="">
              </div>
            </div>
              
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-4" style="text-align: center">
                <button style="width: 50%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>  

<div class="modal fade" id="myModalModificaReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form class="form-horizontal" id="formUpdateReservas" action="javascript:updateReserva()" method="POST">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">   
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Modificar Reserva</h3>
            <div id="mensaje"></div>
          </div>
          <div class="modal-body" id="modalReservasUpd"  style="padding:10px"> 
            <div id="mensaje" style="margin-bottom:-30px"></div>
          </div>
        </div>
      </div> 
    </div>
  </form>
</div>

<div class="modal fade" id="myModalCancelaReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form class="form-horizontal" id="formUpdateReservas" action="javascript:cancelaReserva()" method="POST">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">   
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Cancelar Reserva Actual</h3>
            <div id="mensaje"></div>
          </div>
          <div class="modal-body" id="modalReservaCan"  style="padding:10px"> 
            <div id="mensaje" style="margin-bottom:-30px"></div>
          </div>
        </div>
      </div> 
    </div>
  </form>
</div>

<div class="modal fade" id="myModalIngresoReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:ingresaReserva()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Ingresa Reserva</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body modalReservas">
            <input type="hidden" name="idregis" id="txtIdReservaIng" value="">
            <div class="form-group">
              <label class="control-label col-lg-2">Tipo Habitacion</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtTipoHab" id="txtTipoHab" readonly="">
              </div>
              <label class="control-label col-lg-2">Numero</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name='txtNumeroHab' id='txtNumeroHab' readonly="">    
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">1r Apellido</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtApellido1" id="txtApellido1" readonly>
              </div>
              <label class="control-label col-lg-2">2o Apellidos</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtApellido2" id="txtApellido2" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">1r Nombre</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name='txtNombre1' id='txtNombre1' readonly >    
              </div>
              <label class="control-label col-lg-2">2o Nombre</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name='txtNombre2' id='txtNombre2' readonly >    
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Fecha Llegada</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtLlegada" id='txtLlegada' value='0' readonly="">
              </div>
              <label class="control-label col-lg-1">Noc</label>
              <div class="col-lg-1 col-md-1">
                <input class="form-control padInput" style="margin:0;padding:5px" type="text" name="txtNoches" id="txtNoches" value='0' readonly="">
              </div>
              <label class="control-label col-lg-2">Fecha Salida</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtSalida" id='txtSalida' value='1' readonly="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Hombres</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtHombres" id='txtHombres' value='0' readonly="">
              </div>
              <label class="control-label col-lg-2">Mujeres</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtMujeres" id='txtMujeres' value='0' readonly="">
              </div>
              <label class="control-label col-lg-2">Niños</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtNinos" id='txtNinos' value='0' readonly="">
              </div>
            </div>
            <div class="form-group" >
              <label class="control-label col-lg-2" for="">Comentarios</label>
              <div class="col-lg-10 col-md-10" >
                <textarea class="form-control padInput" id="areaComentarios" name="areaComentarios" readonly="" style="height: 5em !important;min-height: 5em"></textarea>  
              </div>          
            </div> 
            <div class="form-group">
              <label for="archivo" class="col-sm-2 control-label">Tarifa</label>
              <div class="col-sm-3">
                <input class="form-control padInput" type="text" name="txtTarifa" id="txtTarifa" readonly="">
              </div>
              <label for="archivo" class="col-sm-3 control-label">Tarifa</label>
              <div class="col-sm-4">
                <input class="form-control padInput" type="text" name="txtValorTarifa" id="txtValorTarifa" value=0 >
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-6 col-lg-offset-3" >
                <div class="col-lg-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Regresar</button>
                </div>
                <div class="col-lg-6">
                  <button class="btn btn-primary btn-block" id="btnSaveRoom">Ingresar</button>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalInformacionHuesped" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Informacion del Huesped</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body">
            <input type="hidden" name="idregis" id="txtIdReservaHue" value="">
            <div class="form-group">
              <label class="control-label col-lg-2">1r Apellido</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtApellido1" id="txtApellido1" readonly>
              </div>
              <label class="control-label col-lg-2">2o Apellidos</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtApellido2" id="txtApellido2" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">1r Nombre</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name='txtNombre1' id='txtNombre1' readonly >    
              </div>
              <label class="control-label col-lg-2">2o Nombre</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name='txtNombre2' id='txtNombre2' readonly >    
              </div>
            </div>
            <div class="form-horizontal" id="datosHuesped" style="padding:0"></div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-4" >
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div> 

<div class="modal fade" id="myModalDepositoReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="form-horizontal" id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">  
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Deposito a Reserva</h3>
          </div> 
          <div id="imprimeDeposito"></div>
          <div class="modal-body modalReservas">
            <form method="POST" name="formDepositoReserva" id="formDepositoReserva" style='padding:0' enctype="multipart/form-data" action='javascript:ingresaDeposito()'>
              <div class="form-group">
                <label class="control-label col-lg-2">Reserva Nro</label>
                <div class="col-lg-2 col-md-2">
                  <input class="form-control padInput" type="text" name="txtIdReservaDep" id="txtIdReservaDep" value="">
                </div>
                <label class="control-label col-lg-2">Tipo Hab.</label>
                <div class="col-lg-3 col-md-3">
                  <input class="form-control padInput" type="text" name="txtTipoHab" id="txtTipoHab" readonly>
                </div>
                <label class="control-label col-lg-1">Numero</label>
                <div class="col-lg-2 col-md-2">
                  <input class="form-control padInput" type="text" name='txtNumeroHab' id='txtNumeroHab' readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-2">Huesped</label>
                <div class="col-lg-10 col-md-10">
                  <input class="form-control padInput" type="text" name="txtHuesped" id="txtHuesped" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-2">Llegada</label>
                <div class="col-lg-3 col-md-3">
                  <input class="form-control padInput" type="text" name="txtLlegada" id='txtLlegada' value='0' readonly>
                </div>
                <label class="control-label col-lg-1">Noc</label>
                <div class="col-lg-1 col-md-1">
                  <input style="margin:0;padding:5px" class="form-control padInput" type="text" name="txtNoches" id="txtNoches" value='0' readonly>
                </div>
                <label class="control-label col-lg-2">Salida</label>
                <div class="col-lg-3 col-md-3">
                  <input class="form-control padInput" type="text" name="txtSalida" id='txtSalida' value='1' readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="form-label control-label col-lg-2">Hombres</label>
                <div class="col-lg-2 col-md-2">
                  <input class="form-control padInput" type="text" name="txtHombres" id='txtHombres' value='0' readonly>
                </div>
                <label class="form-label control-label col-lg-2">Mujeres</label>
                <div class="col-lg-2 col-md-2">
                  <input class="form-control padInput" type="text" name="txtMujeres" id='txtMujeres' value='0' readonly>
                </div>
                <label class="form-label control-label col-lg-2">Niños</label>
                <div class="col-lg-2 col-md-2">
                  <input class="form-control padInput" type="text" name="txtNinos" id='txtNinos' value='0' readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="archivo" class="col-sm-2 control-label">Tarifa</label>
                <div class="col-sm-2">
                  <input class="form-control padInput" type="text" name="txtTarifa" id="txtTarifa" value=0 readonly="">
                </div>
                <label for="archivo" class="col-sm-2 control-label">Valor</label>
                <div class="col-sm-3">
                  <input class="form-control padInput" type="text" name="txtValorTarifa" id="txtValorTarifa" value=0 readonly="">
                </div>
              </div>
              <div class="divs divDeposito">
                <div class="form-group">
                  <input type="hidden" name="txtIdHuespedDep" id="txtIdHuespedDep" value="">
                  <label class="control-label col-lg-3" for="formadePago">Forma de Pago</label>
                  <div class="col-lg-9 col-md-" >
                    <select name="formadePago" id="formadePago" required>
                      <option value="">Forma de Pago</option>
                      <?php 
                        $codigos = $hotel->getCodigosConsumos(3);
                        foreach ($codigos as $codigo) { ?>
                          <option value="<?=$codigo['id_cargo']?>"><?=$codigo['descripcion_cargo']?></option>
                          <?php  
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="txtValorDeposito" class="col-sm-3 control-label">Valor Deposito</label>
                  <div class="col-sm-3">
                    <input class="form-control padInput" type="number" name="txtValorDeposito" id="txtValorDeposito" value="" min="0" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="txtValorDeposito" class="col-sm-3 control-label">Comprobante</label>
                  <div class="col-sm-9">
                    <input type="file" name="images[]" id="imgSelect" multiple class='form-control' accept='.jpg'style="min-height: 35px">
                  </div>
                </div>
                <div class="form-group">
                  <label for="txtDetalleDeposito" class="col-sm-3 control-label">Detalle del Deposito </label>
                  <div class="col-sm-9">
                    <input class="form-control padInput" type="text" name="txtDetalleDeposito" id="txtDetalleDeposito" value='' placeholder="Informacion del Deposito ">
                  </div>
                </div>
              </div>
              <div class="btn-group" style="float: right">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                <button class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Procesar</button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalAsignarCompania" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="row-fluid imprime_productos_mov" > 
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
          <h4 class="modal-title" id="myModalLabel">Asignar Compañia a la Reserva</h4>
        </div>
        <div id="mensage"></div>
        <form class="form-horizontal" id="formActualizaCia" action="javascript:actualizaCiaRecepcion()" method="POST">
          <div class="modal-body">
            <div class="form-horizontal" id="companias">
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-6 col-lg-offset-3" >
                <div class="col-lg-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                </div>
                <div class="col-lg-6">
                  <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Procesar</button>
                </div>                
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> 

<div class="modal fade bs-example-modal-lg" id="myModalInformacionCompania" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 class="modal-title" id="myModalLabel">Compañia Asociada a la Estadia</h4>
      </div>
      <div class="modal-body">
        <div id="mensaje"></div>
        <div id="datosCia"></div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i>  Regresar</button>
      </div>
    </div> 
  </div>
</div>

<div class="modal fade" id="myModalBuscaHuesped" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Huesped Encontrados</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body" id="huespedesEncontrados">
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-4" >
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalVerDepositos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:ingresaAbonos()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document" id="">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Depositos a Reserva</h3>
          </div>
          <div class="modal-body">
            <div id="depositoHuesped" style="margin :-20px 0 -30px 0;font-size: 12px"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalReasignarHuesped" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:asignaHuespedes()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document" id="">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Reasigna Huesped a la Reserva</h3>
          </div>
          <div class="modal-body">
            <div class="panel-heading">
              <div class="form-group">
                <input type="hidden" name="tipoocupacion" value="1">
                <input type="hidden" name="estadoocupacion" value="ES">
                <input type="hidden" name="nroreserva" id="nroreserva" value="">
                <label for="inputEmail3" class="col-sm-2 control-label">Huesped</label>
                <div class="form-group has-success has-feedback col-sm-8" >
                  <div class="input-group" style="padding-left:15px;">
                    <input type="text" class="form-control" id="buscarHuespedRes" aria-describedby="inputGroupSuccess4Status" style="background:#FFF;border:1px solid black">
                    <span class="input-group-addon" style="padding:1px;border:none">
                      <a data-toggle="modal" 
                        href="#myModalBuscaHuespedRes">
                        <i style="padding:5px 10px" class="fa fa-search" aria-hidden="true"></i>
                      </a>
                    </span>
                  </div>
                </div>
                <div class="col-sm-2" align="right" style="padding-right: 0">
                  <a 
                    class="btn btn-info"
                    data-toggle="modal" 
                    href="#myModalAdicionaPerfil">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                     Adicionar
                  </a>
                </div>
              </div>
              <div id="datosHuespedAdi"></div>
            </div>
            <div id="depositoHuesped" style="margin :-20px 0 -30px 0;font-size: 12px"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-success" data-dismiss="modal"><i class="fa fa-save"></i> Actualizar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalBuscaHuespedRes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Huesped Encontrados</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body" id="huespedesEncontradosRes"></div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-4" >
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalMuestraDeposito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span>
        </button>
        <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-user-plus"></i> Comprobante de Deposito</h4>
        <div class="container-fluid" ></div>
        <div class="modal-body">
          <img id="muestraDocumento" src="" alt="" style="width: 100%">
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          </div>        
        </div>
      </div>
    </div> 
  </div>
</div>


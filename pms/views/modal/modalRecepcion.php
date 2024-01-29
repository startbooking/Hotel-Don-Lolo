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
              <label class="control-label col-xs-2">Reserva Nro</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="idregis" id="txtIdReservaInf" value="">
              </div>
              <label class="control-label col-xs-2">Tipo Hab.</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtTipoHab" id="txtTipoHabInf" readonly>
              </div>
              <label class="control-label col-xs-1">Numero</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name='txtNumeroHabInf' id='txtNumeroHabInf' readonly>    
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-2">Huesped</label>
              <div class="col-lg-8 col-md-8">
                <input class="form-control padInput" type="text" name="txtHuespedInf1" id="txtHuespedInf1" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-2">Llegada</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtLlegadaInf" id='txtLlegadaInf' value='0' readonly>
              </div>
              <label class="control-label col-xs-1">Noches</label>
              <div class="col-lg-2 col-md-2">
                <input style="margin:0;padding:5px" class="form-control padInput" type="text" name="txtNochesInf" id="txtNochesInf" value='0' readonly>
              </div>
              <label class="control-label col-xs-1">Salida</label>
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
                <input class="form-control padInput derecha" type="text" name="txtValorTarifaInf" id="txtValorTarifaInf" value=0 readonly="">
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
              <label class="control-label col-xs-2">1r Apellido</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtApellido1" id="txtApellido1" readonly>
              </div>
              <label class="control-label col-xs-2">2o Apellido</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtApellido2" id="txtApellido2" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-2">1r Nombre</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name='txtNombre1' id='txtNombre1' readonly >    
              </div>
              <label class="control-label col-xs-2">2o Nombre</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name='txtNombre2' id='txtNombre2' readonly >    
              </div>
            </div>
            <div id="datosHuespedInfo"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>            
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
 
<div class="modal fade" id="myModalCambiaHabitacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:cambiaHabitacion()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">   
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span> 
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Cambiar Habitacion</h3>
            <div id="mensaje"></div>
          </div>
          <div class="modal-body modalReservas" id="cambiaHabitacion">
          </div>
          <div class="modal-footer" style="text-align: center">
            <div class="btn-group" style="width: 40%;">
              <button style="width: 50%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
              <button style="width: 50%" class="btn btn-success" align="right"><i class="fa fa-save"></i> Procesar</button>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </form> 
</div> 

<div class="modal fade" id="myModalCambiaTarifa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="formCambiarHabitacion" class="form-horizontal" action="javascript:cambiaTarifa()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">  
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Cambiar Tarifa</h3>
            <div id="mensajeAct"></div>
          </div>
          <div class="modal-body">
            <input type="hidden" name="txtIdReservaTar" id="txtIdReservaTar" value="">
            <div id="modalCambiarTarifa"></div>
          </div>
          <div class="modal-footer" style="text-align: center">
            <div class="btn-group" style="width: 40%;">
              <button style="width: 50%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
              <button style="width: 50%" class="btn btn-success" align="right"><i class="fa fa-save"></i> Actualizar</button>
            </div>               
          </div>
        </div>
      </div>
    </div>
  </form>
</div> 

<div class="modal fade" id="myModalCancelaReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:cancelaReserva()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Cancelar Reserva</h3>
          </div>
          <div class="modal-body modalReservas">
            <!-- <input type="hidden" name="idregis" id="txtIdReservaCan" value=""> -->
            <div class="form-group">
              <label class="control-label col-lg-2">Reserva Nro</label>
              <div class="col-lg-2 col-md-2">
                <input type="text" name="txtIdReservaCan" id="txtIdReservaCan" value="">
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
              <label class="control-label col-lg-2">Apellidos</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtApellidos" id='txtApellidos' value='0' readonly>
              </div>
              <label class="control-label col-lg-2">Nombres</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtNombres" id='txtNombres' value='0' readonly>
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
              <label class="control-label control-label col-lg-2">Hombres</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtHombres" id='txtHombres' value='0' readonly>
              </div>
              <label class="control-label control-label col-lg-2">Mujeres</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtMujeres" id='txtMujeres' value='0' readonly>
              </div>
              <label class="control-label control-label col-lg-2">Niños</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtNinos" id='txtNinos' value='0' readonly>
              </div>
            </div>
            <div class="form-group" >
              <label class="form-label col-lg-2" for="">Comentarios</label>
              <div class="col-lg-10 col-md-10" >
                <textarea class="form-control padInput" id="areaComentarios" name="areaComentarios" style="height: 5em !important;min-height: 5em" readonly></textarea>  
              </div>          
            </div>
            <div class="form-group">
              <label for="archivo" class="col-sm-2 control-label">Tarifa</label>
              <div class="col-sm-4">
                <input class="form-control padInput" type="text" name="txtTarifa" id="txtTarifa" value=0 readonly="">
              </div>
              <label for="archivo" class="col-sm-2 control-label">Valor</label>
              <div class="col-sm-3">
                <input class="form-control padInput" type="text" name="txtValorTarifa" id="txtValorTarifa" value=0 readonly="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2" for="">Motivo</label>
              <div class="col-lg-8 col-md-8" >
                <select name="motivoCancela" id="motivoCancela" required>
                  <option value="">Motivo Cancelacion Reserva</option>
                  <?php
                  $motivos = $hotel->getMotivoCancelacion(1);
                  foreach ($motivos as $motivo) { ?>
                    <option value="<?php echo $motivo['id_cancela']; ?>"><?php echo $motivo['descripcion_motivo']; ?></option>}
                     option 
                    <?php
                  }
                  ?>
                </select>
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
                  <button class="btn btn-primary btn-block">Procesar</button>
                </div>                
              </div>
            </div>
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
            <div class="form-group">
              <label class="control-label col-lg-2">Reserva Nro</label>
              <div class="col-lg-2 col-md-2">
                <input type="text" name="idregis" id="txtIdReservaInf" value="">
              </div>
              <label class="control-label col-lg-2">Tipo Hab.</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtTipoHab" id="txtTipoHab" readonly="">
              </div>
              <label class="control-label col-lg-2">Numero</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name='txtNumeroHab' id='txtNumeroHab' readonly="">    
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Apellidos</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtApellidos" id='txtApellidos' value='0' readonly="">
              </div>
              <label class="control-label col-lg-2">Nombres</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtNombres" id='txtNombres' value='0' readonly="">
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
              <label class="control-label control-label col-lg-2">Hombres</label>
              <div class="col-lg-1 col-md-1" style="padding-right: 5px">
                <input class="form-control padInput" type="text" name="txtHombresInf" id='txtHombresInf' value='0' readonly>
              </div>
              <label class="control-label control-label col-lg-2">Mujeres</label>
              <div class="col-lg-1 col-md-1" style="padding-right: 5px">
                <input class="form-control padInput" type="text" name="txtMujeresInf" id='txtMujeresInf' value='0' readonly>
              </div>
              <label class="control-label control-label col-lg-2">Niños</label>
              <div class="col-lg-1 col-md-1" style="padding-right: 5px">
                <input class="form-control padInput" type="text" name="txtNinosInf" id='txtNinosInf' value='0' readonly>
              </div>
              <label for="orden" class="col-sm-2 control-label">Orden Nro</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" name="orden" id="orden" value="" readonly>
              </div> 
            </div>
            <div class="form-group">
              <label class="control-label control-label col-lg-2">Hombres</label>
              <div class="col-lg-1 col-md-1" style="padding-right: 5px">
                <input class="form-control padInput" type="text" name="txtHombresInf" id='txtHombresInf' value='0' readonly>
              </div>
              <label class="control-label control-label col-lg-2">Mujeres</label>
              <div class="col-lg-1 col-md-1" style="padding-right: 5px">
                <input class="form-control padInput" type="text" name="txtMujeresInf" id='txtMujeresInf' value='0' readonly>
              </div>
              <label class="control-label control-label col-lg-2">Niños</label>
              <div class="col-lg-1 col-md-1" style="padding-right: 5px">
                <input class="form-control padInput" type="text" name="txtNinosInf" id='txtNinosInf' value='0' readonly>
              </div>
              <label for="orden" class="col-sm-2 control-label">Orden Nro</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" name="orden" id="orden" value="" readonly>
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
              <div class="col-sm-4">
                <input class="form-control padInput" type="text" name="txtTarifa" id="txtTarifa" readonly="">
              </div>
              <label for="archivo" class="col-sm-1 control-label">Valor</label>
              <div class="col-sm-3">
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
  
<div class="modal fade" id="myModalModificaEstadia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form class="form-horizontal" id="formUpdateEstadia" action="javascript:updateEstadia()" method="POST">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="panel panel-default">
            <div class="panel-heading">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="glyphicon glyphicon-off"></span>
              </button> 
              <h3 class="modal-title" id="exampleModalLabel">Modificar Estadia</h3>
            </div>
            <div class="panel-body">
              <div id="modalReservasEst"></div>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </form>
</div>

<div class="modal fade" id="myModalAnulaIngreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:anulaIngreso()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Anular Ingreso</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body modalReservas">
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Reserva</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control" type="text" name="idregis" id="txtIdReservaAnu" value="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Tipo Habitacion</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtTipoHab" id="txtTipoHabAnu" readonly="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Numero</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name='txtNumeroHab' id='txtNumeroHabAnu' readonly="">    
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Huesped</label>
              <div class="col-lg-10 col-md-10">
                <input class="form-control padInput" type="text" name="txtNombresAnu2" id='txtNombresAnu2' value='0' readonly="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Fecha Llegada</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtLlegada" id='txtLlegadaAnu' value='0' readonly="">
              </div>
              <label class="control-label col-lg-1 col-md-1">Noc</label>
              <div class="col-lg-1 col-md-1">
                <input class="form-control padInput" style="margin:0;padding:5px" type="text" name="txtNoches" id="txtNochesAnu" value='0' readonly="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Fecha Salida</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtSalida" id='txtSalidaAnu' value='1' readonly="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Hombres</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtHombres" id='txtHombresAnu' value='0' readonly="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Mujeres</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtMujeres" id='txtMujeresAnu' value='0' readonly="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Niños</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtNinos" id='txtNinosAnu' value='0' readonly="">
              </div>
            </div>
            <div class="form-group" >
              <label class="control-label col-lg-2 col-md-2" for="">Comentarios</label>
              <div class="col-lg-10 col-md-10" >
                <textarea class="form-control padInput" id="areaComentariosAnu" name="areaComentarios" readonly="" style="height: 5em !important;min-height: 5em"></textarea>  
              </div>          
            </div> 
            <div class="form-group">
              <label for="archivo" class="col-sm-2 control-label">Tarifa</label>
              <div class="col-sm-4">
                <input class="form-control padInput" type="text" name="txtTarifa" id="txtTarifaAnu" readonly="">
              </div>
              <label for="archivo" class="col-sm-1 control-label">Valor</label>
              <div class="col-sm-2">
                <input class="form-control padInput" style="text-align:right;" type="text" name="txtValorTarifaAnu" id="txtValorTarifaAnu" value=0 >
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3" >
                <div class="col-lg-6 col-md-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                </div>
                <div class="col-lg-6 col-md-6">
                  <button class="btn btn-primary btn-block" id="btnSaveRoom"><i class="fa fa-save"></i> Procesar</button>
                </div>                
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
          <div id="mensaje"></div>
          <div id="modalReservasUpd"></div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalAsignarCompania" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content"> 
      <div class="row-fluid imprime_productos_mov" > 
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
          <h4 class="modal-title" id="myModalLabel">Asignar Compañia a la Estadia</h4>
        </div>
        <div id="mensage"></div>
        <form class="form-horizontal" id="formActualizaCia" action="javascript:actualizaCiaRecepcion()" method="POST">
          <div class="modal-body">
            <div class="form-horizontal" id="companias">
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-md-6 col-md-offset-3" >
                <div class="col-md-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                </div>
                <div class="col-md-6">
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 class="modal-title" id="myModalLabel">Compañia Asociada a la Estadia</h4>
      </div>
      <div class="modal-body">
        <div id="mensaje"></div>
        <div id="datosCiaInfo"></div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
      </div>
    </div> 
  </div>
</div>

<div class="modal fade" id="myModalVerDepositos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:ingresaAbonos()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document" id="">
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
            <h3 class="modal-title" id="exampleModalLabel">Reasigna Huesped a la Estadia</h3>
          </div>
          <div class="modal-body">
            <div class="panel-heading">
              <div class="form-group">
                <input type="hidden" name="tipoocupacion" value="1">
                <input type="hidden" name="estadoocupacion" value="ES">
                <input type="hidden" name="nroreserva" id="nroreserva" value="">
                <label for="inputEmail3" class="col-sm-2 control-label">Huesped</label>
                <div class="form-group has-success has-feedback col-sm-10" >
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
              </div>
              <div id="datosHuespedAdi"></div>
            </div>
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

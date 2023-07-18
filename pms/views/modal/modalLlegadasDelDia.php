<div class="modal fade" id="myModalRegistraReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:ingresaReserva()" method="POST" enctype="multipart/form-data">
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
          <div class="modal-body modalReservas">
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Reserva Nro</label>
              <div class="col-lg-2 col-md-2 ">
                <input class="form-control padInput" type="text" name="idregis" id="txtIdReservaIng" value="">
              </div>
              <label class="control-label col-lg-2 col-md-1">Tipo Hab.</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtTipoHabIng" id="txtTipoHabIng" readonly="">
              </div>
              <label class="control-label col-lg-1 col-md-1">Numero</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name='txtNumeroHabIng' id='txtNumeroHabIng' readonly="">    
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Huesped</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtHuespedIng" id='txtHuespedIng' value='0' readonly="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Fecha Llegada</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtLlegadaIng" id='txtLlegadaIng' value='0' readonly="">
              </div>
              <label class="control-label col-lg-1 col-md-1">Noc</label>
              <div class="col-lg-1 col-md-1">
                <input class="form-control padInput" style="margin:0;padding:5px" type="text" name="txtNochesIng" id="txtNochesIng" value='0' readonly="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Fecha Salida</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtSalidaIng" id='txtSalidaIng' value='1' readonly="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Hombres</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtHombresIng" id='txtHombresIng' value='0' readonly="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Mujeres</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtMujeresIng" id='txtMujeresIng' value='0' readonly="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Niños</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtNinosIng" id='txtNinosIng' value='0' readonly="">
              </div>
            </div>
            <div class="form-group" >
              <label class="control-label col-lg-2 col-md-2" for="">Comentarios</label>
              <div class="col-lg-10 col-md-10" >
                <textarea class="form-control padInput" id="areaComentariosINg" name="areaComentariosINg" readonly="" style="height: 5em !important;min-height: 5em"></textarea>  
              </div>          
            </div> 
            <div class="form-group">
              <label for="archivo" class="col-sm-2 control-label">Tarifa</label>
              <div class="col-sm-4">
                <input class="form-control padInput" type="text" name="txtTarifaIng" id="txtTarifaIng" readonly="">
              </div>
              <label for="archivo" class="col-sm-1 control-label">Valor</label>
              <div class="col-sm-3">
                <input class="form-control padInput" style="text-align:right;padding:0 3px;" type="text" name="txtValorTarifaIng" id="txtValorTarifaIng" value=0 >
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-md-6 col-md-offset-3" >
                <div class="col-md-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-primary btn-block" id="btnSaveRoom"><i class="fa fa-briefcase"></i> Registrar</button>
                </div>                
              </div>
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
                <input type="text" name="idregis" id="txtIdReservaAnu" value="">
                <!--<input class="form-control padInput" type="text" name="txtTipoHab" id="txtTipoHab" readonly=""> -->
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
              <label class="control-label col-lg-2 col-md-2">Apellidos</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtApellidos" id='txtApellidosAnu' value='0' readonly="">
              </div>
              <label class="control-label col-lg-2 col-md-2">Nombres</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtNombres" id='txtNombresAnu' value='0' readonly="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2 col-md-2">Fecha Llegada</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtLlegada" id='txtLlegadaAnu' value='0' readonly="">
              </div>
              <label class="control-label col-lg-1">Noc</label>
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
              <div class="col-sm-3">
                <input class="form-control padInput" type="text" name="txtTarifa" id="txtTarifaAnu" readonly="">
              </div>
              <label for="archivo" class="col-sm-3 control-label">Valor</label>
              <div class="col-sm-4">
                <input class="form-control padInput" type="text" name="txtValorTarifaAnu" id="txtValorTarifaAnu" value=0 >
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-6 col-lg-offset-3" >
                <div class="col-lg-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                </div>
                <div class="col-lg-6">
                  <button class="btn btn-primary btn-block" id="btnSaveRoom"><i class="fa fa-breifcase"></i> Registrar</button>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

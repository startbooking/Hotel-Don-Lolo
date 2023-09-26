<div class="modal fade" id="myModalInformacionReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">  
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button>  
            <h3 class="modal-title" id="exampleModalLabel">Cancelar Reserva</h3>
          </div>
          <div id="datos_ajax_register"></div> 
          <div class="modal-body modalReservas">
            <input type="hidden" name="idregis" id="txtIdReservaInf" value="">
            <div class="form-group">
              <label class="control-label col-lg-2">Tipo Habitacion</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtTipoHab" id="txtTipoHabInf" readonly>
              </div>
              <label class="control-label col-lg-2">Numero</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name='txtNumeroHabInf' id='txtNumeroHabInf' readonly>    
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Apellidos</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtApellidosInf" id='txtApellidosInf' value='0' readonly>
              </div>
              <label class="control-label col-lg-2">Nombres</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtNombresInf" id='txtNombresInf' value='0' readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Llegada</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtLlegadaInf" id='txtLlegadaInf' value='0' readonly>
              </div>
              <label class="control-label col-lg-1">Noc</label>
              <div class="col-lg-2 col-md-2">
                <input style="margin:0;padding:5px" class="form-control padInput" type="text" name="txtNochesInf" id="txtNochesInf" value='0' readonly>
              </div>
              <label class="control-label col-lg-1">Salida</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control padInput" type="text" name="txtSalidaInf" id='txtSalidaInf' value='1' readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label control-label col-lg-2">Hombres</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtHombresInf" id='txtHombresInf' value='0' readonly>
              </div>
              <label class="control-label control-label col-lg-2">Mujeres</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtMujeresInf" id='txtMujeresInf' value='0' readonly>
              </div>
              <label class="control-label control-label col-lg-2">Niños</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control padInput" type="text" name="txtNinosInf" id='txtNinosInf' value='0' readonly>
              </div>
            </div>
            <div class="form-group" >
              <label class="form-label col-lg-2" for="">Comentarios</label>
              <div class="col-lg-10 col-md-10" >
                <textarea class="form-control padInput" id="areaComentariosInf" name="areaComentariosInf" placeholder="Comentarios de la Reserva" style="height: 5em !important;min-height: 5em" readonly></textarea>  
              </div>          
            </div>
            <div class="form-group">
              <label for="archivo" class="col-sm-2 control-label">Tarifa</label>
              <div class="col-sm-3">
                <input class="form-control padInput" type="text" name="txtTarifaInf" id="txtTarifaInf" value=0 readonly="">
              </div>
              <label for="archivo" class="col-sm-2 control-label">Valor</label>
              <div class="col-sm-3">
                <input class="form-control padInput derecha" type="text" name="txtValorTarifaInf" id="txtValorTarifaInf" value=0 readonly="">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-4" >
                <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Regresar</button>
              </div>
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
          <div id="datos_ajax_register"></div>
          <div class="modal-body modalReservas">
            <input type="hidden" name="idregis" id="txtIdReservaCan" value="">
            <div class="form-group">
              <label class="control-label col-lg-2">Tipo Habitacion</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtTipoHab" id="txtTipoHab" readonly>
              </div>
              <label class="control-label col-lg-2">Numero</label>
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
                <textarea class="form-control padInput" id="areaComentarios" name="areaComentarios" placeholder="Comentarios de la Reserva" style="height: 5em !important;min-height: 5em" readonly></textarea>  
              </div>          
            </div>
            <div class="form-group">
              <label for="archivo" class="col-sm-2 control-label">Tarifa</label>
              <div class="col-sm-3">
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
                  $motivos = $hotel->getMotivoCancelacion();
                  foreach ($motivos as $motivo) { ?>
                    <option value="<?=$motivo['id_cancela']?>"><?=$motivo['descripcion_motivo']?></option>}
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
                <textarea class="form-control padInput" id="areaComentarios" name="areaComentarios" placeholder="Comentarios de la Reserva" readonly="" style="height: 5em !important;min-height: 5em"></textarea>  
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
      <div class="modal-dialog modal-md" role="document">
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
              <label class="form-label col-lg-2">Apellidos</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtApellidos" id="txtApellidos" readonly>
              </div>
              <label class="form-label col-lg-2">Nombres</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name='txtNombres' id='txtNombres' readonly >    
              </div>
            </div>
            <div class="form-group">
              <label class="form-label col-lg-2">Documento</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtDocumento" id='txtDocumento' value='0' readonly>
              </div>
              <label class="form-label col-lg-2">Tipo Doc</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtTipoDoc" id='txtTipoDoc' value='0' readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label col-lg-2">Direccion</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtDireccion" id='txtDireccion' value='0' readonly>
              </div>
              <label class="form-label col-lg-2">Telefono</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtTelefono" id='txtTelefono' value='0' readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label col-lg-2">eMail</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txteMail" id='txteMail' value='0' readonly>
              </div>
              <label class="form-label col-lg-2">Celular</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" style="margin:0;padding:5px" type="text" name="txtCelular" id="txtCelular" value='0' readonly>
              </div>
            </div>
            <div class="form-group ">
              <label class="form-label col-lg-2">Fecha Nac.</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtFecha" id='txtFecha' value='1' readonly>
              </div>
            </div>
            <div class="form-group ">
              <label class="form-label col-lg-2">Usuario</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtUsuario" id='txtUsuario' value='0'readonly >
              </div>
              <label class="form-label col-lg-2">Fecha Creacion</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtCreacion" id='txtCreacion' value='0'readonly >
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-4" >
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Regresar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalDepositoReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:ingresaDeposito()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Deposito a Reserva</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body modalReservas">
            <input type="hidden" name="txtIdReservaDep" id="txtIdReservaDep" value="">
            <input type="hidden" name="txtIdHuespedDep" id="txtIdHuespedDep" value="">
            <div class="form-group">
              <label class="control-label col-lg-2" a>Tipo Habitacion</label>
              <div class="col-lg-4 col-md-4">
                <input class="form-control padInput" type="text" name="txtTipoHab" id="txtTipoHab" readonly>
              </div>
              <label class="control-label col-lg-2">Numero</label>
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
                <label class="control-label col-lg-3" for="formadePago">Forma de Pago</label>
                <div class="col-lg-9 col-md-" >
                  <select name="formadePago" id="formadePago" required>
                    <option value="">Forma de Pago</option>
                    <?php 
                      $codigos = $hotel->getCodigosConsumos(3);
                      foreach ($codigos as $codigo) { ?>
                        <option value="<?=$codigo['id_cargo']?>"><?=$codigo['descripcion_cargo']?></option>
                         option 
                        <?php  
                      }

                      /* 
                      $formas = $hotel->getFormasPago();
                      foreach ($formas as $forma) { ?>
                        <option value="<?=$forma['id_pago']?>"><?=$forma['descripcion_pago']?></option>
                         option 
                        <?php  
                      }
                      */
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="txtValorDeposito" class="col-sm-3 control-label">Valor Deposito</label>
                <div class="col-sm-6">
                  <input class="form-control padInput" type="number" name="txtValorDeposito" id="txtValorDeposito" value="" min="0">
                </div>
              </div>
              <div class="form-group">
                <label for="txtDetalleDeposito" class="col-sm-3 control-label">Detalle del Deposito </label>
                <div class="col-sm-9">
                  <input class="form-control padInput" type="text" name="txtDetalleDeposito" id="txtDetalleDeposito" value='' placeholder="Informacion del Deposito ">
                </div>
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

<div class="modal fade bs-example-modal-lg" id="myModalAsignarCompania" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="row-fluid imprime_productos_mov" > 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 class="modal-title" id="myModalLabel">Asignar Compañia a la Estadia</h4>
      </div>
      <div id="mensage"></div>
      <form class="form-horizontal" id="formActualizaCia" action="javascript:actualizaCiaenCasa()" method="POST">
        <div class="modal-body">
          <div class="form-horizontal">
            <div class="form-group">  
              <label for="nombres" class="col-sm-3 control-label">Nit</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="txtNitCia" id="txtNitCia" placeholder="" value="" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="direccion" class="col-sm-3 control-label">Empresa </label>
              <div class="col-sm-8">
                <input type="hidden" name="txtIdHuespedCia" id="txtIdHuespedCia">
                <input type="text" class="form-control" id="txtNombreCia" name="txtNombreCia" value="" readonly>
              </div>
            </div>
          </div>
          <div id="nuevaCompania"></div>          
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-md-6 col-m d-offset-3" >
              <div class="col-md-6">
                <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Regresar</button>
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-block">Procesar</button>
              </div>                
            </div>
          </div>
        </div>
      </form>
    </div> 
  </div>
</div>


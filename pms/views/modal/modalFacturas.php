<div class="modal fade" id="myModalAnulaFactura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:anulaFactura()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
            <h3 class="modal-title" id="exampleModalLabel">Anular Factura</h3>
          </div>
          <div id="mensaje">
          </div>
          <div class="modal-body">
            <input type="hidden" name="reserva" id="reserva" value="">
            <input type="hidden" name="perfil" id="perfil" value="">
            <input type="hidden" name="idperfil" id="idperfil" value="">
            <input type="hidden" name="txtFacturaNro" id="txtFacturaNro" value="">
            <div class="form-group">
              <label for="noches" class="col-sm-2 control-label">Factura Nro</label>
              <div class="col-sm-2">
                <input type="number" class="form-control" name="factura" id="factura" readonly="">
              </div>
              <label for="llegada" class="col-sm-2 control-label">Fecha Factura</label>
              <div class="col-sm-4" style="padding-right: 20px">
                <input type="date" class="form-control" name="fechafac" id="fechafac" readonly="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Huesped</label>
              <div class="col-lg-8 col-md-8">
                <input class="form-control padInput" type="text" name="huespedAnu" id='huespedAnu' value='' readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="llegada" class="col-sm-2 control-label">Llegada</label>
              <div class="col-sm-3" style="padding-right: 20px">
                <input type="date" class="form-control" name="llegada" id="llegada" readonly="">
              </div>
              <label for="salida" class="col-sm-2 control-label">Salida</label>
              <div class="col-sm-3" style="padding-right: 20px">
                <input type="date" class="form-control" name="salida" id="salida" readonly="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2" for="codigoConsumo">Factura</label>
              <div class="col-sm-10">
                <object id="verFacturaModal" width="100%" height="250" data=""></object>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2" for="codigoConsumo">Motivo Anulacion</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="motivoAnula" id="motivoAnula" value="" required="">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-6 col-lg-offset-3">
                <div class="col-lg-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><I class="fa fa-reply"></I> Regresar</button>
                </div>
                <div class="col-lg-6">
                  <button class="btn btn-primary btn-block btnAnulaFac"><I class="fa fa-save"></I> Anular</button>
                </div>
                <!-- <div class="col-lg-6">
                  <button type="button" class="btn btn-primary btn-block" onclick="insertaImagen()"><I class="fa fa-save"></I> Anular XXX </button>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalAnulaFacturaHistorico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index:1500">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:anulaFacturaHistorico()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
            <h3 class="modal-title" id="exampleModalLabel">Anular Factura</h3>
          </div>
          <div id="mensaje">
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <input type="hidden" name="perfilHis" id="perfilHis" value="">
              <input type="hidden" name="idperfilHis" id="idperfilHis" value="">
              <input type="hidden" name="reservaHis" id="reservaHis" value="">
              <input type="hidden" name="txtFacturaNroHis" id="txtFacturaNroHis" value="">
              <div class="form-group">
                <label for="noches" class="col-sm-2 control-label">Factura Nro</label>
                <div class="col-sm-2">
                  <input type="number" class="form-control" name="facturaHis" id="facturaHis" readonly="">
                </div>
                <label for="llegada" class="col-sm-2 control-label">Fecha Factura</label>
                <div class="col-sm-3" style="padding-right: 20px">
                  <input type="date" class="form-control" name="fechafac" id="fechafac" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">Huesped</label>
                <div class="col-sm-7">
                  <input class="form-control padInput" type="text" name="huesped" id='huesped' value='' readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="llegada" class="col-sm-2 control-label">Llegada</label>
                <div class="col-sm-3" style="padding-right: 20px">
                  <input type="date" class="form-control" name="llegadaHis" id="llegadaHis" readonly="">
                </div>
                <label for="salida" class="col-sm-1 control-label">Salida</label>
                <div class="col-sm-3" style="padding-right: 20px">
                  <input type="date" class="form-control" name="salidaHis" id="salidaHis" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="codigoConsumo">Factura</label>
                <div class="col-sm-10">
                  <object id="verFacturaHistoricoModal" width="100%" height="250" data=""></object>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="codigoConsumo">Motivo Anulacion</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="motivoAnulaHis" id="motivoAnulaHis" value="" required="">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="col-md-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><I class="fa fa-reply"></I> Regresar</button>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-primary btn-block btnAnulaHis"><I class="fa fa-save"></I> Anular</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </form>
</div>

<div class="modal fade" id="myModalVerInformacionEstadia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="glyphicon glyphicon-off"></span>
            </button>
            <h3 class="modal-title" id="exampleModalLabel">Informacion Estadia</h3>
          </div>
          <div class="modal-body modalReservas"></div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalverFacturaReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 75%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span class="fa fa-power-off" aria-hidden="true"></span></button>
        <h4 class="modal-title" id="myModalLabel">Historico de Facturas Estadia</h4>
      </div>
      <div class="modal-body" style="font-size:12px;">
        <div id="mensajeEli"></div>
        <div id="verFacturasHistorico" class="container-fluid" style="padding:0"></div>
      </div>
      <div class="modal-footer">
        <div class="container-fluid">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalVerFactura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:anulaFactura()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
            <h3 class="modal-title" id="exampleModalLabel">Factura</h3>
          </div>
          <div id="mensaje">
          </div>
          <div class="modal-body">
            <input type="hidden" name="reserva" id="reserva" value="">
            <input type="hidden" name="txtFacturaNro" id="txtFacturaNro" value="">
            <div class="form-group">
              <object id="verFacturaModalCon" width="100%" height="450" data=""></object>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><I class="fa fa-reply"></I> Regresar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
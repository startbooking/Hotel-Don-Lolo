<?php
$cias = $hotel->getCompanias();
?> 

<div class="modal fade" id="myModalCargosConsumo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:ingresaConsumos()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content"> 
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Ingreso Consumos</h3>
          </div>
          <div id="mensaje"> 
          </div> 
          <div class="modal-body">
            <input type="hidden" name="reservaActual" id="reservaActual" value="">
            <input type="hidden" name="txtIdHuespedDep" id="idHuespedSal" value="">
            <input type="hidden" name="txtImptoTurismo" id="txtImptoTurismo" value="">
            <div class="form-group">
              <label class="control-label col-xs-2">Habitacion</label>
              <div class="col-xs-2">
                <input class="form-control padInput" type="text" name='txtNumeroHabCon' id='txtNumeroHabCon' readonly> 
              </div>
              <label class="control-label col-xs-2">Huesped</label>
              <div class="col-xs-6">
                <input class="form-control padInput" type="text" name="txtHuesped" id='txtHuesped' value='0' readonly>
              </div>
            </div>
            <div class="divs divDeposito">
              <div class="form-group">
                <label class="control-label col-xs-3" for="codigoConsumo">Codigo Consumo</label>
                <div class="col-lg-9 col-xs-9" >
                  <select name="codigoConsumo" id="codigoConsumo" required>
                    <option value="">Seleccione Concepto</option>
                    <?php
                      $codigos = $hotel->getCodigosConsumos(1);
                      foreach ($codigos as $codigo) { ?>
                        <option value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
                        <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="txtCantidad" class="col-sm-3 control-label">Cantidad</label>
                <div class="col-sm-2">
                  <input class="form-control padInput" type="number" name="txtCantidad" id="txtCantidad" value="1" min="1">
                </div>
                <label for="txtValorConsumo" class="col-sm-2 control-label">Valor Cargo</label>
                <div class="col-sm-5">
                  <input class="form-control padInput" type="number" name="txtValorConsumo" id="txtValorConsumo" value="" required>
                </div>
              </div>
              <div class="form-group">
                <label for="txtReferencia" class="col-sm-3 control-label">Referencia</label>
                <div class="col-sm-5">
                  <input class="form-control padInput" type="text" name="txtReferencia" id="txtReferencia" value="" min="1">
                </div>
                <label for="txtFolio" class="col-sm-2 control-label">Folio</label>
                <div class="col-sm-2">
                  <input class="form-control padInput" type="number" name="txtFolio" id="txtFolio" value="1" min="1" max="4" readonly="" disabled="">
                </div>
              </div>
              <div class="form-group">
                <label for="txtDetalleCargo" class="col-sm-3 control-label">Comentarios</label>
                <div class="col-sm-9">
                  <input class="form-control padInput" type="text" name="txtDetalleCargo" id="txtDetalleCargo" value='' placeholder="Informacion del Consumo ">
                </div>
              </div>
            </div>          
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-xs-6 col-xs-offset-3" >
                <div class="col-xs-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><I class="fa fa-reply"></I> Regresar</button>
                </div>
                <div class="col-xs-6">
                  <button class="btn btn-primary btn-block"><I class="fa fa-save"></I> Procesar</button>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
 
<div class="modal fade" id="myModalAjusteConsumo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:ingresaAjuste()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Ajustes Consumos</h3>
          </div>
          <div id="mensaje">
          </div>
          <div class="modal-body">
            <input type="hidden" name="txtIdReservaAju" id="txtIdReservaAju" value="">
            <input type="hidden" name="txtIdHuespedAju" id="txtIdHuespedAju" value="">
            <input type="hidden" name="txtImptoTurismo" id="txtImptoTuriAju" value="">
            <div class="form-group">
              <label class="control-label col-lg-2">Habit.</label>
              <div class="col-lg-2 col-xs-2">
                <input class="form-control padInput" type="text" name='txtNumeroHabAju' id='txtNumeroHabAju' readonly> 
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2">Apellidos</label>
              <div class="col-lg-4 col-xs-4">
                <input class="form-control padInput" type="text" name="txtApellidosAju" id='txtApellidosAju' value='0' readonly>
              </div>
              <label class="control-label col-lg-2">Nombres</label>
              <div class="col-lg-4 col-xs-4">
                <input class="form-control padInput" type="text" name="txtNombresAju" id='txtNombresAju' value='0' readonly>
              </div>
            </div>
            <div class="divs divDeposito">
              <div class="form-group">
                <label class="control-label col-lg-3" for="codigoConsumo">Codigo Consumo</label>
                <div class="col-lg-9 col-xs-" >
                  <select name="codigoAjuste" id="codigoAjuste" required>
                    <option value="">Seleccione el Ajuste</option>
                    <?php
                      $codigos = $hotel->getCodigosConsumos(4);
                      foreach ($codigos as $codigo) { ?>
                        <option value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
                        <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="txtCantidad" class="col-sm-3 control-label">Cantidad</label>
                <div class="col-sm-2">
                  <input class="form-control padInput" type="number" name="txtCantidadAju" id="txtCantidadAju" value="1" min="1" readonly disabled="">
                </div>
                <label for="txtValorConsumo" class="col-sm-2 control-label">Valor Cargo</label>
                <div class="col-sm-5">
                  <input class="form-control padInput" type="number" name="txtValorAjuste" id="txtValorAjuste" value="">
                </div>
              </div>
              <div class="form-group">
                <label for="txtReferencia" class="col-sm-3 control-label">Referencia</label>
                <div class="col-sm-5">
                  <input class="form-control padInput" type="text" name="txtReferenciaAju" id="txtReferenciaAju" value="" min="1">
                </div>
                <label for="txtFolio" class="col-sm-2 control-label">Folio</label>
                <div class="col-sm-2">
                  <input class="form-control padInput" type="number" name="txtFolioAju" id="txtFolioAju" value="1" min="1" max="4">
                </div>
              </div>
              <div class="form-group">
                <label for="txtDetalleCargo" class="col-sm-3 control-label">Comentarios</label>
                <div class="col-sm-9">
                  <input class="form-control padInput" type="text" name="txtDetalleAjuste" id="txtDetalleAjuste" value='' placeholder="Informacion del Ajuste " required="">
                </div>
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
                  <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Procesar</button>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
 
<div class="modal fade" id="myModalAbonosConsumos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="abonosReserva" class="form-horizontal" action="javascript:ingresaAbonos()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header"> #ae0505
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Abonos a Cuenta</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body">
            <input type="hidden" name="txtIdReservaAbo" id="txtIdReservaAbo" value="">
            <input type="hidden" name="idHuespedAbo" id="idHuespedAbo" value="">
            <input type="hidden" name="txtImptoTuriAbo" id="txtImptoTuriAbo" value="">
            <div class="form-group">
              <label class="control-label col-xs-2">Hab.</label>
              <div class="col-lg-2 col-xs-2">
                <input class="form-control padInput" type="text" name='txtNumeroHabAbo' id='txtNumeroHabAbo' readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-2">Huesped</label>
              <div class="col-lg-10 col-xs-10">
                <input class="form-control padInput" type="text" name="txtNombreCompleto" id='txtNombreCompleto' value='0' readonly>
              </div>
            </div>
            <div class="divs divDeposito">
              <div class="form-group">
                <label class="control-label col-xs-3" for="codigoConsumo">Codigo Abono</label>
                <div class="col-lg-9 col-xs-9" >
                  <select name="codigoAbono" id="codigoAbono" required>
                    <option value="">Seleccione Concepto</option>
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
                <label for="txtValorAbono" class="col-sm-3 control-label">Monto Abono</label>
                <div class="col-sm-5">
                  <input class="form-control padInput" type="number" name="txtValorAbono" id="txtValorAbono" value=0 min="1">
                </div>
              </div>
              <div class="form-group">
                <label for="txtReferenciaAbo" class="col-sm-3 control-label">Referencia</label>
                <div class="col-sm-5">
                  <input class="form-control padInput" type="text" name="txtReferenciaAbo" id="txtReferenciaAbo" value="" min="1">
                </div>
              </div>
              <div class="form-group">
                <label for="txtDetalleAbo" class="col-sm-3 control-label">Comentarios</label>
                <div class="col-sm-9">
                  <input class="form-control padInput" type="text" name="txtDetalleAbo" id="txtDetalleAbo" value='' placeholder="Informacion del Abono ">
                </div>
              </div>
            </div>          
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-xs-6 col-xs-offset-3" >
                <div class="col-xs-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                </div>
                <div class="col-xs-6">
                  <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Procesar</button>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div> 

<div class="modal fade" id="myModalEstadoCuenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:imprimeEstadoCuenta()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Estado de Cuenta</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body" style="font-size:11px;">
            <input type="hidden" name="txtIdReservaEst" id="txtIdReservaEst" value="">
            <input type="hidden" name="txtIdHuespedEst" id="txtIdHuespedEst" value="">
            <input type="hidden" name="txtImptoTurismo" id="txtImptoTuriEst" value="">
            <div class="form-group">
              <label class="control-label col-xs-2">Tipo Hab</label>
              <div class="col-lg-4 col-xs-4">
                <input style="font-size:11px;" class="form-control padInput" type="text" name='txtTipoHabEst' id='txtTipoHabEst' readonly>
              </div>
              <label class="control-label col-xs-2">Hab.</label>
              <div class="col-lg-2 col-xs-2">
                <input style="font-size:11px;" class="form-control padInput" type="text" name='txtNumeroHabEst' id='txtNumeroHabEst' readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-2">Huesped</label>
              <div class="col-lg-10 col-xs-10">
                <input style="font-size:11px;" class="form-control padInput" type="text" name="txtNombresEst" id='txtNombresEst' value='0' readonly>
              </div>
            </div>
            <div class="divs" id="divConsumos" >
              <object id="verEstadoCuenta" width="100%" height="350" data=""></object> 
            </div>          
          </div>
          <div class="modal-footer" style="text-align: center">
            <button style="width: 25%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          </div>
        </div>
      </div>
    </div> 
  </form>
</div> 
 
<div class="modal fade" id="myModalSalidaHuesped" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarPagosRoomSal" class="form-horizontal" action="javascript:salidaHuesped()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Salida Huesped</h3>
          </div> 
          <div id="mensajeSal"></div> 
          <div class="modal-body">                    
            <input type="hidden" name="txtIdReservaSal" id="txtIdReservaSal" value="">
            <input type="hidden" name="txtIdHuespedSal" id="txtIdHuespedSal" value="">
            <input type="hidden" name="txtImptoTuriSal" id="txtImptoTuriSal" value="">
            <input type="hidden" name="txtIdCiaSal" id="txtIdCiaSal" value="">
            <input type="hidden" name="txtIdCentroCiaSal" id="txtIdCentroCiaSal" value=""> 
            <input type="hidden" name="creditoCia" id="creditoCia" value="0">
            <input type="hidden" name="diasCreditoCia" id="diasCreditoCia" value="0">
            <input type="hidden" name="credito" id="credito" value="0">            
            <input type="hidden" name="perfilFactura" id="perfilFactura" value="0">
            <input type="hidden" name="retencionCia" id="retencionCia" value=''>
            <div class="form-group"> 
              <label style="margin-top: 3px;" for="llegada" class="col-sm-2 control-label">Facturar A </label>
              <div class="col-sm-6" style="padding:0;height: 30px">
                <div class="col-sm-6">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="habitacionOptionCon" for="inlineRadio1" id="inlineRadio1" value="1" onclick="apagaselecomp(this.value)" selected>
                    <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Huesped</label>
                  </div>                     
                </div>
                <div class="col-sm-6">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="habitacionOptionCon" for="inlineRadio2" id="inlineRadio2" value="2" onclick="apagaselecomp(this.value)">
                    <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio2" >Compañia</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group" id="selecomp">
              <label class="control-label col-xs-2">Compañia</label>
              <div class="col-lg-8 col-xs-8">
                <select name="txtIdCiaSal" id="txtIdCiaSal" readonly disabled>
                  <?php
                    foreach ($cias as $key => $value) { ?> 
                      <option value="<?php echo $value['id_compania']; ?>"><?php echo $value['empresa']; ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>            
            <div class="form-group" id="selecomp">
              <label class="control-label col-xs-2">Titular</label>
              <div class="col-lg-8 col-xs-8">
                <select class="form-control" name="titular" id="titular" style="padding:3px 12px;" onchange="cambiaTitular()" required>
                  <option value="">Seleccione El Titular de la Factura</option>         
                </select>
              </div>
            </div>
            <div class="form-group">
              <label style="font-size:12px;height: 25px !important" class="control-label col-lg-2 col-xs-2">Hab.</label>
              <div class="col-lg-2 col-xs-2">
                <input style="font-size:12px;height: 25px !important" class="form-control padInput" type="text" name='txtNumeroHabSal' id='txtNumeroHabSal' readonly>
              </div>
              <label style="font-size:12px;height: 25px !important" class="control-label col-lg-2 col-xs-2">Huesped</label>
              <div class="col-lg-4 col-xs-4">
                <input style="font-size:12px;height: 25px !important" class="form-control padInput" type="text" name="txtHuespedSal" id='txtHuespedSal' value='0' readonly>
              </div>
            </div>
            <div id="mensajeSalida" class="centro apaga">
              <div class="alert alert-warning mt-10 mb-0 pd-5">
                <i class="ion ion-ios-gear-outline fa-spin fa-3x" style="color:#ae0505"></i> 
                <h3 class="mt-10">Procesando Factura Informacion, NO interrumpir</h3>
              </div>
            </div>
            <div id="estadoCuenta"></div>
          </div>
          <div class="modal-footer">
            <div class="btn-group">              
              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
              <button type="submit" class="btn btn-primary btnSalida"><i class="fa fa-save"></i> Procesar </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>  

<div class="modal fade" id="myModalSaldoHuesped" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:ingresaAbonos()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document" id="">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Estado Cuenta</h3>
            <input type="hidden" name="txtIdReservaSaldo" id="txtIdReservaSaldo" value="">
            <input type="hidden" name="txtIdHuespedSaldo" id="txtIdHuespedSaldo" value="">
            <input type="hidden" name="txtImptoTuriSaldo" id="txtImptoTuriSaldo" value="">
          </div> 
          <div class="modal-body">
            <div id="saldoHuesped" style="margin :-20px 0 -30px 0;font-size: 12px"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalAnulaCargo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:anulaConsumos()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document" id="saldoHuesped">
        <div class="modal-content"> 
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Anular Cargo</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body">
            <input type="hidden" name="txtIdReservaAnu" id="txtIdReservaAnu" value="">
            <input type="hidden" name="txtIdHuespedAnu" id="txtIdHuespedAnu" value="">
            <input type="hidden" name="txtIdConsumoAnu" id="txtIdConsumoAnu" value="">
            <input type="hidden" name="txtImptoTuriAnu" id="txtImptoTuriAnu" value="">
            <div class="form-group">
              <label class="control-label col-lg-3 col-md-3">Descripcion</label>
              <div class="col-lg-7 col-xs-7">
                <input class="form-control padInput" type="text" name="txtDescripcionAnu" id='txtDescripcionAnu' value='0' readonly disabled="">
              </div>
            </div>
            <div id="divCargos" style="display:none">
              <div class="form-group">
                <label for="txtValorConsumo" class="col-sm-3 control-label">Valor Cargo</label>
                <div class="col-sm-3">
                  <input class="form-control padInput" style="text-align: right;" type="text" name="txtValorConsumoAnu" id="txtValorConsumoAnu" readonly disabled="">
                </div>
                <label for="txtValorImptoAnu" class="col-sm-1 control-label">Impuesto</label>
                <div class="col-sm-3">
                  <input class="form-control padInput" style="text-align: right;" type="text" name="txtValorImptoAnu" id="txtValorImptoAnu" readonly disabled="">
                </div>
              </div>
              <div class="form-group">
                <label for="txtValorTotalAnu" class="col-sm-3 control-label">Total Cargo</label>
                <div class="col-sm-3">
                  <input class="form-control padInput" style="text-align: right;" type="text" name="txtValorTotalAnu" id="txtValorTotalAnu" readonly disabled="">
                </div>
              </div>              
            </div>
            <div id="divPagos" >
              <div class="form-group">
                <label for="txtValorConsumo" class="col-sm-3 control-label">Valor Pago</label>
                <div class="col-sm-3">
                  <input class="form-control padInput" style="text-align: right;" type="text" name="txtPagoConsumoAnu" id="txtPagoConsumoAnu" readonly disabled="">
                </div>                
              </div>              
            </div>
            <div class="form-group">
              <label for="txtReferenciaAnu" class="col-sm-3 control-label">Referencia</label>
              <div class="col-sm-8">
                <input class="form-control padInput" type="text" name="txtReferenciaAnu" id="txtReferenciaAnu" readonly disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="txtDetalleCargoAnu" class="col-sm-3 control-label">Comentarios</label>
              <div class="col-sm-8">
                <input class="form-control padInput" type="text" name="txtDetalleCargoAnu" id="txtDetalleCargoAnu" value='' readonly disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="txtMotivoAnula" class="col-sm-3 control-label">Motivo Anulacion</label>
              <div class="col-sm-8">
                <input class="form-control padInput" type="text" name="txtMotivoAnula" id="txtMotivoAnula" value='' required="">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-xs-6 col-xs-offset-3" >
                <div class="col-lg-6 col-xs-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                </div>
                <div class="col-lg-6 col-xs-6">
                  <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Procesar</button>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalMoverCargo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:moverConsumos()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document" id="saldoHuesped">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Anular Cargo</h3>
          </div>
          <div id="mensajeAnu"></div>
          <div class="modal-body">
            <input type="hidden" name="txtIdReservaMov" id="txtIdReservaMov" value="">
            <input type="hidden" name="txtIdHuespedMov" id="txtIdHuespedMov" value="">
            <input type="hidden" name="txtIdConsumoMov" id="txtIdConsumoMov" value="">
            <input type="hidden" name="txtImptoTuriMov" id="txtImptoTuriMov" value="">
            <div class="form-group">
              <label class="control-label col-lg-3 col-xs-3">Descripcion</label>
              <div class="col-lg-7 col-xs-7">
                <input class="form-control padInput" type="text" name="txtDescripcionMov" id='txtDescripcionMov' value='0' readonly disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="txtValorConsumo" class="col-sm-3 control-label">Valor Cargo</label>
              <div class="col-sm-4">
                <input class="form-control padInput" type="text" name="txtValorConsumoMov" id="txtValorConsumoMov" readonly disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="txtValorImptoAnu" class="col-sm-3 control-label">Impuesto</label>
              <div class="col-sm-4">
                <input class="form-control padInput" type="text" name="txtValorImptoMov" id="txtValorImptoMov" readonly disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="txtReferenciaAnu" class="col-sm-3 control-label">Referencia</label>
              <div class="col-sm-8">
                <input class="form-control padInput" type="text" name="txtReferenciaMov" id="txtReferenciaMov" readonly disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="txtDetalleCargoAnu" class="col-sm-3 control-label">Comentarios</label>
              <div class="col-sm-8">
                <input class="form-control padInput" type="text" name="txtDetalleCargoMov" id="txtDetalleCargoMov" value='' readonly disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="txtFolio" class="col-sm-3 control-label">Folio</label>
              <div class="col-sm-2">
                <input class="form-control padInput" type="number" name="txtFolioMov" id="txtFolioMov" value="1" min="1" max="4">
              </div>
            </div> 
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-6 col-lg-offset-3 col-xs-6 col-xs-offset-3" >
                <div class="col-lg-6 col-xs-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                </div>
                <div class="col-lg-6 col-xs-6">
                  <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Procesar</button>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalTrasladarCargo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:trasladarConsumos()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document" id="saldoHuespedTras">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Anular Cargo</h3>
          </div>
          <div id="mensajeAnu"></div>
          <div class="modal-body">
            <input type="hidden" name="txtIdReservaTras" id="txtIdReservaTras" value="">
            <input type="hidden" name="txtIdHuespedTras" id="txtIdHuespedTras" value="">
            <input type="hidden" name="txtIdConsumoTras" id="txtIdConsumoTras" value="">
            <input type="hidden" name="txtImptoTuriTras" id="txtImptoTuriTras" value="">
            <div class="form-group">
              <label class="control-label col-xs-3">Descripcion</label>
              <div class="col-lg-7 col-xs-7">
                <input class="form-control padInput" type="text" name="txtDescripcionTras" id='txtDescripcionTras' value='0' readonly disabled="">
              </div>
            </div>
            <div class="form-group" id="divCargos" style="display:block">
              <label for="txtValorConsumo" class="col-sm-3 control-label">Valor Cargo</label>
              <div class="col-sm-3">
                <input class="form-control padInput" type="text" name="txtValorConsumoTras" id="txtValorConsumoTras" readonly disabled="">
              </div>
              <label for="txtValorImptoAnu" class="col-sm-1 control-label">Impto</label>
              <div class="col-sm-3">
                <input class="form-control padInput" type="text" name="txtValorImptoTras" id="txtValorImptoTras" readonly disabled="">
              </div>
            </div>
            <div class="form-group" id="divPagos" style="display:block">
              <label for="txtValorPagosTras" class="col-sm-3 control-label">Abonos </label>
              <div class="col-sm-4">
                <input class="form-control padInput" type="text" name="txtValorPagosTras" id="txtValorPagosTras" readonly disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="txtReferenciaAnu" class="col-sm-3 control-label">Referencia</label>
              <div class="col-sm-8">
                <input class="form-control padInput" type="text" name="txtReferenciaTras" id="txtReferenciaTras" readonly disabled="">
              </div>
            </div>              
            <div class="form-group">
              <label for="txtDetalleCargoAnu" class="col-sm-3 control-label">Comentarios</label>
              <div class="col-sm-8">
                <?php ?>
                <input class="form-control padInput" type="text" name="txtDetalleCargoTras" id="txtDetalleCargoTras" value='' readonly disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="txtFolio" class="col-sm-3 control-label">Habitacion</label>
              <div class="col-sm-5">
                <select name="roomChange" id="roomChange" required="">
                  <option value="">Seleccione la Nueva Habitacion</option>
                  <?php
                    $encasas = $hotel->getHuespedesenCasa(2, 'CA');
                    foreach ($encasas as $encasa) { ?>
                      <option value="<?php echo $encasa['num_reserva']; ?>"><?php echo $encasa['num_habitacion'].' '.$encasa['apellido1'].' '.$encasa['apellido2'].' '.$encasa['nombre1'].' '.$encasa['nombre2']; ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="txtFolio" class="col-sm-3 control-label">Motivo</label>
              <div class="col-sm-8">
                <input class="form-control padInput" type="text" name="txtMotivoTras" id="txtMotivoTras" required="">
              </div>
            </div> 
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-6 col-lg-offset-3 col-xs-6 col-xs-offset-3" >
                <div class="col-lg-6 col-xs-6">
                  <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                </div>
                <div class="col-lg-6 col-xs-6">
                  <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Procesar</button>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>  
</div>

<div class="modal fade" id="myModalCongelarCuenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarPagosRoom" class="form-horizontal" action="javascript:congelaHuesped()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document" style="font-size:12px">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Congelar Cuenta</h3>
          </div>
          <div id="mensajeSal"></div>
          <div class="modal-body">
            <input type="hidden" name="txtIdReservaCong" id="txtIdReservaCong" value="">
            <input type="hidden" name="txtIdHuespedCong" id="txtIdHuespedCong" value="">            
            <div class="idCia"></div>
            <div class="form-group">
              <label for="direccion" class="col-sm-2 control-label">Empresa </label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="txtEmpresaCong" name="txtEmpresaCong" value="" readonly>
                <input type="hidden" name="txtIdCiaCong" id="txtIdCiaCong" value="">
              </div>
              <label for="nombres" class="col-sm-1 control-label">Nit</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="txtNitCong" name ="txtNitCong" value="" readonly>
              </div>
            </div>           
            <div class="form-group">
              <label class="control-label col-xs-2">Huesped</label>
              <div class="col-lg-6 col-xs-6">
                <input class="form-control padInput" type="text" name="txtApellidosCong" id='txtApellidosCong' value='0' readonly>
              </div>
              <label class="control-label col-xs-1">Hab.</label>
              <div class="col-lg-2 col-xs-2">
                <input class="form-control padInput" type="text" name='txtNumeroHabCong' id='txtNumeroHabCong' readonly>
              </div>
            </div>
            <div class="form-group" style="margin-top:20px">
              <label class="control-label col-xs-2" style="color: #000;">Saldo Cuenta</label>
              <div class="col-lg-4 col-xs-4">
                <input class="form-control padInput" style="text-align:right;" type="text" name='valorSaldo' id='valorSaldo' readonly>
              </div>
            </div>
            <div id="estadoCuenta"></div>
          </div>
          <div class="modal-footer" style="text-align: center">
            <button type="button" style="width: 20%" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button style="width: 20%" class="btn btn-primary"><i class="fa fa-save"></i> Procesar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEstadoCuentaFolio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:imprimeEstadoCuenta()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Estado de Cuenta</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body">
            <div class="divs" id="divConsumos" >
              <object type="application/pdf" id="verEstadoCuentaFolio" width="100%" height="350" data=""></object> 
            </div>          
          </div>
          <div class="modal-footer" style="text-align: center">
            <button style="width: 25%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          </div>
        </div>
      </div>
    </div> 
  </form>
</div> 
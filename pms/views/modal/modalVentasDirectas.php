<?php
$cias = $hotel->getCompanias();
?> 

<div class="modal fade" id="myModalCargosConsumo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
  <form id="guardarDatosRooms" class="form-horizontal" action="javascript:consumoVentaDirecta()" method="POST" enctype="multipart/form-data">
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
            <input type="hidden" name="txtIdReservaDep" id="txtIdReservaCon" value="">
            <input type="hidden" name="txtIdHuespedDep" id="txtIdHuespedCon" value="">
            <input type="hidden" name="txtImptoTurismo" id="txtImptoTurismo" value="">
            <div class="form-group">
              <label class="control-label col-xs-2">Habit.</label>
              <div class="col-xs-2">
                <input class="form-control padInput" type="text" name='txtNumeroHabCon' id='txtNumeroHabCon' readonly> 
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-2">Apellidos</label>
              <div class="col-xs-4">
                <input class="form-control padInput" type="text" name="txtApellidosCon" id='txtApellidosCon' value='0' readonly>
              </div>
              <label class="control-label col-xs-2">Nombres</label>
              <div class="col-lg-4 col-xs-4">
                <input class="form-control padInput" type="text" name="txtNombresCon" id='txtNombresCon' value='0' readonly>
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
                  <input class="form-control padInput" type="number" name="txtValorConsumo" id="txtValorConsumo" value="">
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
              <div class="col-lg-6 col-lg-offset-3" >
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
            <input type="hidden" name="txtIdReservaSal"   id="txtIdReservaSal"   value="">
            <input type="hidden" name="txtIdHuespedSal"   id="txtIdHuespedSal"   value="">
            <input type="hidden" name="txtImptoTuriSal"   id="txtImptoTuriSal"   value="">
            <input type="hidden" name="txtIdCiaSal"       id="txtIdCiaSal"       value="">
            <input type="hidden" name="creditoCia"        id="creditoCia"        value="0">
            <input type="hidden" name="diasCreditoCia"    id="diasCreditoCia"    value="0">
            <input type="hidden" name="credito"           id="credito"           value="0">
            <div class="form-group">
              <label for="llegada" class="col-sm-2 control-label">Facturar A </label>
              <div class="col-sm-6" style="padding:0;height: 30px">
                <div class="col-sm-6">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="habitacionOptionCon" id="inlineRadio1" value="1" onclick="apagaselecomp(this.value)" checked="">
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Huesped</label>
                  </div>                     
                </div>
                <div class="col-sm-6">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="habitacionOptionCon" id="inlineRadio2" value="2" onclick="apagaselecomp(this.value)">
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2" >Compañia</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group" id="selecomp" style="display: none;">
              <label class="control-label col-xs-2">Compañia</label>
              <div class="col-lg-8 col-xs-8">
                <select name="txtIdCiaSal" id="txtIdCiaSal"  readonly disabled>
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
              <label style="font-size:12px;height: 25px !important" class="control-label col-lg-2">Hab.</label>
              <div class="col-lg-2 col-xs-2">
                <input style="font-size:12px;height: 25px !important" class="form-control padInput" type="text" name='txtNumeroHabSal' id='txtNumeroHabSal' readonly>
              </div>
            </div>
            <div class="form-group">
              <label style="font-size:12px;height: 25px !important" class="control-label col-lg-2">Apellidos</label>
              <div class="col-lg-4 col-xs-4">
                <input style="font-size:12px;height: 25px !important" class="form-control padInput" type="text" name="txtApellidosSal" id='txtApellidosSal' value='0' readonly>
              </div>
              <label style="font-size:12px;height: 25px !important" class="control-label col-lg-2">Nombres</label>
              <div class="col-lg-4 col-xs-4">
                <input style="font-size:12px;height: 25px !important" class="form-control padInput" type="text" name="txtNombresSal" id='txtNombresSal' value='0' readonly>
              </div>
            </div>
            <div id="estadoCuenta"></div>
          </div>
          <div class="modal-footer">
            <div class="btn-group">              
              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Procesar </button>
            </div>
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
              <label class="control-label col-lg-3">Descripcion</label>
              <div class="col-lg-7 col-xs-7">
                <input class="form-control padInput" type="text" name="txtDescripcionAnu" id='txtDescripcionAnu' value='0' readonly disabled="">
              </div>
            </div>
            <div id="divCargos" style="display:none">
              <div class="form-group">
                <label for="txtValorConsumo" class="col-sm-3 control-label">Valor Cargo</label>
                <div class="col-sm-3">
                  <input class="form-control padInput" type="text" name="txtValorConsumoAnu" id="txtValorConsumoAnu" readonly disabled="">
                </div>
                <label for="txtValorImptoAnu" class="col-sm-2 control-label">Impuesto</label>
                <div class="col-sm-3">
                  <input class="form-control padInput" type="text" name="txtValorImptoAnu" id="txtValorImptoAnu" readonly disabled="">
                </div>
              </div>
              <div class="form-group">
                <label for="txtValorTotalAnu" class="col-sm-3 control-label">Total Cargo</label>
                <div class="col-sm-4">
                  <input class="form-control padInput" type="text" name="txtValorTotalAnu" id="txtValorTotalAnu" readonly disabled="">
                </div>
              </div>              
            </div>
            <div id="divPagos" style="display:none">
              <div class="form-group">
                <label for="txtValorConsumo" class="col-sm-3 control-label">Valor Pago</label>
                <div class="col-sm-4">
                  <input class="form-control padInput" type="text" name="txtPagoConsumoAnu" id="txtPagoConsumoAnu" readonly disabled="">
                </div>
                <!--<label for="txtValorImptoAnu" class="col-sm-2 control-label">Impuesto</label>
                <div class="col-sm-3">
                  <input class="form-control padInput" type="text" name="txtValorImptoAnu" id="txtValorImptoAnu" readonly disabled="">
                </div>
              </div>
              <div class="form-group">
                <label for="txtValorTotalAnu" class="col-sm-3 control-label">Total Cargo</label>
                <div class="col-sm-4">
                  <input class="form-control padInput" type="text" name="txtValorTotalAnu" id="txtValorTotalAnu"readonly disabled="">
                </div> -->
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

<div class="modal fade" id="myModalSalidaCongeladaOld" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
  <form id="guardarPagosRoomSal" class="form-horizontal" action="javascript:salidaHuesped()" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="font-size:12px">
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
            <input type="hidden" name="perfilFactura" id="perfilFactura" value="1">
  
            <!-- Cambio Opcion Perfil en la factura Inicio // Agos-30 -2019 --->
            <div class="form-group">
              <label class="control-label col-md-2">Hab.</label>
              <div class="col-lg-2 col-md-2">
                <input style="font-size:12px;height: 25px !important" class="form-control padInput" type="text" name='txtNumeroHabSalCon' id='txtNumeroHabSalCon' readonly>
                <input type="hidden" name="txtIdReservaCon" id="txtIdReservaCon" value="">
                <input type="hidden" name="txtIdHuespedCon" id="txtIdHuespedCon" value="">
              </div>
            
              <label for="llegada" class="col-sm-2 control-label">Facturar A </label>
              <div class="col-sm-4" style="padding:0;height: 30px">
                <div class="col-sm-6">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="habitacionOptionCon" id="inlineRadio1" value="1" onclick="apagaselecomp(this.value)" disabled>
                    <label style="margin-top:-18px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Huesped</label>
                  </div>                     
                </div>
                <div class="col-sm-6">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="habitacionOptionCon" id="inlineRadio2" value="2" onclick="apagaselecomp(this.value)" checked required>
                    <label style="margin-top:-18px;margin-left:25px" class="form-check-label" for="inlineRadio2" >Compañia</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group" id="selecomp">
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
            <div class="form-group" id="seletitular">
              <label class="control-label col-md-2">Titular</label>
              <div class="col-lg-8 col-md-8">
                <select class="form-control" name="titular" id="titular" style="padding:3px 12px;" onchange="cambiaTitularCon()" readonly disabled>
                  <option value="">Seleccione El Titular de la Factura</option>         
                </select>
              </div>
            </div>
            <div id="estadoCuentaCon"></div>
          </div>
          <div class="modal-footer" style="text-align: center">
            <button style="width: 20%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button style="width: 20%" class="btn btn-primary"><i class="fa fa-save"></i> Procesar</button>
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
            <?php
              $retenciones = $hotel->getRetenciones();
?>            
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
            <input type="hidden" name="retenciones" id="retenciones" value='<?php echo json_encode($retenciones); ?>'>
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
              <label style="font-size:12px;height: 25px !important" class="control-label col-lg-2">Huesped</label>
              <div class="col-lg-4 col-xs-4">
                <input style="font-size:12px;height: 25px !important" class="form-control padInput" type="text" name="txtHuespedSal" id='txtHuespedSal' value='0' readonly>
              </div>
            </div>
            <div id="estadoCuenta"></div>
          </div>
          <div class="modal-footer">
            <div id="mensajeSalida" style="display:none">
              <div class="alert alert-danger">
                <i style="font-size:3em;margin-top:1px;color:#BBB0B0; " class="ion ion-ios-gear-outline fa-spin"></i> 
                <h3>Procesando Factura Informacion, NO interrumpir</h3>
              </div>
            </div>
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
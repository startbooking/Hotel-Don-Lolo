<div class="modal fade" id="myModalAdicionarPaquetes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosPaquete" class="form-horizontal" action="javascript:guardaPaquete()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Paquete</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Paquete </label>
            <div class="col-lg-10 col-md-10">
              <input type="text" class="form-control" id="descripcionAdi" name="descripcionAdi" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Frecuencia </label>
            <div class="col-lg-10 col-md-10">
              <div class="col-sm-6" style="padding:0;height: 15px">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="frecuencia" id="inlineRadio1" value="1" checked>
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Diaria</label>
                </div>                    
              </div>
              <div class="col-sm-6" style="padding:0;height: 15px"> 
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="frecuencia" id="inlineRadio2" value="2">
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">Estadia</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Tipo de Cargo </label>
            <div class="col-lg-10">
              <div class="col-sm-6" style="padding:0;height: 15px">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoCargo" id="inlineRadio1" value="1" checked>
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Por Persona</label>
                </div>                    
              </div>
              <div class="col-sm-6" style="padding:0;height: 15px"> 
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoCargo" id="inlineRadio2" value="2">
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">Por Habitacion</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Valor </label>
            <div class="col-lg-3 col-md-3">
              <input type="number" min="1" class="form-control" id="valorAdi" name="valorAdi" required>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Codigo Venta </label>
            <div class="col-lg-5 col-md-5">
              <?php
              $codigos = $admin->getCodigosVentas(1);
              ?>
              <select name="codigoPaq" id="codigoPaq" required="">
                <option value="">Seleccione el Codigo de Ventas</option>}
                option
                <?php
               foreach ($codigos as $codigo) { ?> 
                  <option value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
                  <?php
               }
              ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaPaquete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosPaquete" class="form-horizontal" action="javascript:eliminaPaquete()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Impuesto</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <input type="hidden" name="idPaquEli" id="idPaquEli">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Paquete </label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="descripcionEli" name="descripcionEli" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Frecuencia </label>
            <div class="col-lg-8 col-md-8">
              <div class="col-sm-6" style="padding:0;height: 15px">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="frecuenciaEli" id="inlineFrecu1Eli" value="1" disabled>
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineFrecu1Eli"   >Diaria</label>
                </div>                    
              </div>
              <div class="col-sm-6" style="padding:0;height: 15px"> 
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="frecuenciaEli" id="inlineFrecu2Eli" value="2" disabled>
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineFrecu2Eli" >Estadia</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Tipo de Cargo </label>
            <div class="col-lg-8 col-md-8">
              <div class="col-sm-6" style="padding:0;height: 15px">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoCargoEli" id="inlineRadio1Eli" value="1" disabled>
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1Eli" >Por Persona</label>
                </div>                    
              </div>
              <div class="col-sm-6" style="padding:0;height: 15px"> 
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoCargoEli" id="inlineRadio2Eli" value="2" disabled>
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2Eli">Por Habitacion</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Valor </label>
            <div class="col-lg-3 col-md-3">
              <input type="number" class="form-control" id="valorEli" name="valorEli" maxlength="4" disabled>
            </div>
          <!--
          </div>
          <div class="form-group">
          -->
            <label for="nombre" class="control-label col-lg-2 col-md-2">Codigo Venta </label>
            <div class="col-lg-5 col-md-5">
              <?php
              $codigos = $admin->getCodigosVentas(1);
              ?>
              <select name="codigoPaqEli" id="codigoPaqEli" disabled>
                <?php
               foreach ($codigos as $codigo) { ?> 
                  <option value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
                  <?php
               }
              ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Eliminar</button>
        </div>
      </div>
    </div>
  </form>
</div>


<div class="modal fade" id="myModalModificaPaquete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaPaquete" class="form-horizontal" action="javascript:actualizaPaquete()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Paquete</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeMod"></div>
          <input type="hidden" name="idPaquMod" id="idPaquMod">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Paquete </label>
            <div class="col-lg-10 col-md-10">
              <input type="text" class="form-control" id="descripcionMod" name="descripcionMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Frecuencia </label>
            <div class="col-lg-10 col-md-10">
              <div class="col-sm-6" style="padding:0;height: 15px">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="frecuenciaMod" id="inlineRadio1" value="1" checked>
                  <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Diaria</label>
                </div>                    
              </div>
              <div class="col-sm-6" style="padding:0;height: 15px"> 
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="frecuenciaMod" id="inlineRadio2" value="2">
                  <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio2">Estadia</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Tipo de Cargo </label>
            <div class="col-lg-10 col-md-10">
              <div class="col-sm-6" style="padding:0;height: 15px">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoCargoMod" id="inlineRadio1" value="1" checked>
                  <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Por Persona</label>
                </div>                    
              </div>
              <div class="col-sm-6" style="padding:0;height: 15px"> 
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoCargoMod" id="inlineRadio2" value="2">
                  <label style="margin-top:-20px;margin-left:25px" class="form-check-label" for="inlineRadio2">Por Habitacion</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Valor </label>
            <div class="col-lg-3 col-md-3">
              <input type="number" class="form-control" id="valorMod" name="valorMod" required>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Codigo Venta </label>
            <div class="col-lg-5 col-md-5">
              <?php
              $codigos = $admin->getCodigosVentas(1);
              ?>
              <select name="codigoPaqMod" id="codigoPaqMod" required="">
                <?php
               foreach ($codigos as $codigo) { ?> 
                  <option value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
                  <?php
               }
              ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
        </div>
      </div>
    </div>
  </form>
</div>
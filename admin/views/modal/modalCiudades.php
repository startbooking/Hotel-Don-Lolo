<div class="modal fade" id="myModalAdicionaCiudad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardaDatosCiudad" class="form-horizontal" action="javascript:guardaCiudad()"> 
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">
          <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
          Adiciona Ciudad</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Pais </label>
            <div class="col-lg-10 col-md-10">
            <select name="paices" id="paices"">
              <option value="">Seleccione el Pais</option>
                <?php
                $paices = $hotel->getPaices();
                foreach ($paices as $pais) { ?>
                  <option value="<?php echo $pais['id_pais']; ?>"><?php echo $pais['descripcion']; ?></option>
                <?php
                }
                ?>
              </select>
              <!-- <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required> -->
            </div>
          </div>
          <div class="form-group" style="margin-top:5px">
            <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top:15px">Ciudad</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="ciudad" name="ciudad" required>
            </div>
          </div>
          <div class="form-group" style="margin-top:5px">
            <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top:15px">Codigo Ciudad</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaBodega" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosBodega" class="form-horizontal" action="javascript:eliminaBodega()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Bodega</h4>
        </div>
        <div id="mensajeEli"></div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Bodega </label>
            <div class="col-lg-6 col-md-6">
              <input type="hidden" name="idBodegaEli" id="idBodegaEli">
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" disabled>
            </div>
          </div>
          <div class="form-group" style="margin-top:5px">
            <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top:15px">Tipo Bodega</label>
            <div class="col-sm-10 ondisplay">
              <div class="wrap">
                <div class="col-sm-4" style="padding:5;">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoBodegaEli" id="inlineRadioEli1" value="1" 
                    >
                    <label style="margin-top:-20px;margin-left:20px;font-size:10px;" class="form-check-label" for="inlineRadio1" >Principal</label>
                  </div>                    
                </div>
                <div class="col-sm-4" style="padding:5;"> 
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoBodegaEli" id="inlineRadioEli2" value="2"
                    >
                    <label style="margin-top:-20px;margin-left:20px;font-size:10px;" class="form-check-label" for="inlineRadio2">Auxiliar</label>
                  </div>
                </div>
                <div class="col-sm-4" style="padding:5;">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoBodegaEli" id="inlineRadioEli3" value="3" 
                    >
                    <label style="margin-top:-20px;margin-left:20px;font-size:10px;" class="form-check-label" for="inlineRadio3" >Punto de Venta</label>
                  </div>                    
                </div>
                <div class="col-sm-4" style="padding:5;">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoBodegaEli" id="inlineRadioEli4" value="4" 
                    >
                    <label style="margin-top:-20px;margin-left:20px;font-size:10px;" class="form-check-label" for="inlineRadio4" >Procesamiento</label>
                  </div>                    
                </div>
                <div class="col-sm-4" style="padding:5;">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoBodegaEli" id="inlineRadioEli5" value="5" 
                    >
                    <label style="margin-top:-20px;margin-left:20px;font-size:10px;" class="form-check-label" for="inlineRadio5" title="Bodega de Porcionamiento">Porcionamiento</label>
                  </div>                    
                </div>
                <div class="col-sm-4" style="padding:5;">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoBodegaEli" id="inlineRadioEli6" value="6" 
                    >
                    <label style="margin-top:-20px;margin-left:20px;font-size:10px;" class="form-check-label" for="inlineRadio6" >Externa</label>
                  </div>                    
                </div>
              </div>
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

<div class="modal fade" id="myModalModificaBodega" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaDatosBodega" class="form-horizontal" action="javascript:actualizaBodega()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Bodega</h4>
        </div>
        <div id="mensajeMod"></div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Bodega </label>
            <div class="col-lg-10 col-md-10">
              <input type="hidden" name="idBodegaMod" id="idBodegaMod">
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
          </div>
          <div class="form-group" style="margin-top:5px">
            <label for="inputEmail3" class="col-sm-2 control-label" style="margin-top:15px">Tipo Bodega</label>
            <div class="col-sm-10 ondisplay">
              <div class="wrap">
                <div class="col-sm-4" style="padding:5;">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoBodegaMod" id="inlineRadioMod1" value="1" 
                    >
                    <label style="margin-top:-20px;margin-left:20px;font-size:10px;" class="form-check-label" for="inlineRadioMod1" >Principal</label>
                  </div>                    
                </div>
                <div class="col-sm-4" style="padding:5;"> 
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoBodegaMod" id="inlineRadioMod2" value="2"
                    >
                    <label style="margin-top:-20px;margin-left:20px;font-size:10px;" class="form-check-label" for="inlineRadioMod2">Auxiliar</label>
                  </div>
                </div>
                <div class="col-sm-4" style="padding:5;">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoBodegaMod" id="inlineRadioMod3" value="3" 
                    >
                    <label style="margin-top:-20px;margin-left:20px;font-size:10px;" class="form-check-label" for="inlineRadioMod3" >Punto de Venta</label>
                  </div>                    
                </div>
                <div class="col-sm-4" style="padding:5;">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoBodegaMod" id="inlineRadioMod4" value="4" 
                    >
                    <label style="margin-top:-20px;margin-left:20px;font-size:10px;" class="form-check-label" for="inlineRadioMod4" >Procesamiento</label>
                  </div>                    
                </div>
                <div class="col-sm-4" style="padding:5;">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoBodegaMod" id="inlineRadioMod5" value="5" 
                    >
                    <label style="margin-top:-20px;margin-left:20px;font-size:10px;" class="form-check-label" for="inlineRadioMod5" title="Bodega de Porcionamiento">Porcionamiento</label>
                  </div>                    
                </div>
                <div class="col-sm-4" style="padding:5;">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="tipoBodegaMod" id="inlineRadioMod6" value="6" 
                    >
                    <label style="margin-top:-20px;margin-left:20px;font-size:10px;" class="form-check-label" for="inlineRadioMod6" >Externa</label>
                  </div>                    
                </div>
              </div>
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
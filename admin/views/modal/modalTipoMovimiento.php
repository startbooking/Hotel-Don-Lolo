<div class="modal fade" id="myModalAdicionarTipoMovimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

  <form id="formAdicionaTipo" class="form-horizontal" action="javascript:guardaTipoMovi()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Tipo de Movimiento</h4>
        </div>
        <div id="mensaje"></div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre" style="text-align:right" class=" col-lg-4 col-md-4">Descripcion  </label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" style="text-align:right" class="col-sm-4 ">Tipo de Movimiento</label>
            <div class="col-sm-6 ondisplay">
              <div class="wrap">
                <div class="col-sm-6" style="padding:0;height: 15px">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="moviOption" id="inlineRadio1" value="1" required>
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Entrada</label>
                  </div>                    
                </div>
                <div class="col-sm-6" style="padding:0;height: 15px"> 
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="moviOption" id="inlineRadio2" value="2" required>
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2" >Salida</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="modulos" class="control-label col-lg-4  col-md-4"></label>
            <div class="col-lg-8 col-md-8">
              <label style="text-align: left;padding:0" class="col-lg-4 col-md-4"><input type="checkbox" name="idCompraAdi" id="idCompraAdi"> Compra</label>
              <label style="text-align: left;padding:0" class="col-lg-4 col-md-4"><input type="checkbox" name="idAjusteAdi" id="idAjusteAdi"> Ajuste </label>
              <label style="text-align: left;padding:0" class="col-lg-4 col-md-4"><input type="checkbox" name="idTrasladoAdi" id="idTrasladoAdi"> Traslado</label>
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

<div class="modal fade" id="myModalEliminaTipoMovimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formEliminaTipo" class="form-horizontal" action="javascript:eliminaTipoMovi()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Tipo de Movimiento</h4>
        </div>
        <div id="mensajeEli"></div>
        <div class="modal-body">
          <input type="hidden" name="idTipoMovEli" id="idTipoMovEli">
          <div class="form-group">
            <label for="nombre" style="text-align:right" class=" col-lg-4 col-md-4">Descripcion  </label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" style="text-align:right" class="col-sm-4 ">Tipo de Movimiento</label>
            <div class="col-sm-6 ondisplay">
              <div class="wrap">
                <div class="col-sm-6" style="padding:0;height: 15px">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="moviOptionEli" id="inlineRadioEli1" value="1" disabled>
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Entrada</label>
                  </div>                    
                </div>
                <div class="col-sm-6" style="padding:0;height: 15px"> 
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="moviOptionEli" id="inlineRadioEli2" value="2" disabled>
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2" >Salida</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="modulos" class="control-label col-lg-4  col-md-4"></label>
            <div class="col-lg-8 col-md-8">
              <label style="text-align: left;padding:0" class="col-lg-4 col-md-4"><input type="checkbox" name="idCompraEli" id="idCompraEli" disabled> Compra</label>
              <label style="text-align: left;padding:0" class="col-lg-4 col-md-4"><input type="checkbox" name="idAjusteEli" id="idAjusteEli" disabled> Ajuste </label>
              <label style="text-align: left;padding:0" class="col-lg-4 col-md-4"><input type="checkbox" name="idTrasladoEli" id="idTrasladoEli" disabled> Traslado</label>
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


<div class="modal fade" id="myModalModificaTipoMovimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formEliminaTipo" class="form-horizontal" action="javascript:actualizaTipoMovi()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Tipo de Movimiento</h4>
        </div>
        <div id="mensajeMod"></div>
        <div class="modal-body">
          <input type="hidden" name="idTipoMovMod" id="idTipoMovMod">
          <div class="form-group">
            <label for="nombre" style="text-align:right" class=" col-lg-4 col-md-4">Descripcion  </label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" style="text-align:right" class="col-sm-4 ">Tipo de Movimiento</label>
            <div class="col-sm-6 ondisplay">
              <div class="wrap">
                <div class="col-sm-6" style="padding:0;height: 15px">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="moviOptionMod" id="inlineRadioMod1" value="1" required>
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Entrada</label>
                  </div>                    
                </div>
                <div class="col-sm-6" style="padding:0;height: 15px"> 
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="moviOptionMod" id="inlineRadioMod2" value="2" required>
                    <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2" >Salida</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="modulos" class="control-label col-lg-4  col-md-4"></label>
            <div class="col-lg-8 col-md-8">
              <label style="text-align: left;padding:0" class="col-lg-4 col-md-4"><input type="checkbox" name="idCompraAdi" id="idCompraMod"> Compra</label>
              <label style="text-align: left;padding:0" class="col-lg-4 col-md-4"><input type="checkbox" name="idAjusteAdi" id="idAjusteMod"> Ajuste </label>
              <label style="text-align: left;padding:0" class="col-lg-4 col-md-4"><input type="checkbox" name="idTrasladoAdi" id="idTrasladoMod"> Traslado</label>
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
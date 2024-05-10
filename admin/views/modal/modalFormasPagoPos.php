<div class="modal fade" id="myModalAdicionarFormaPagoPos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosFormaPagoPos" class="form-horizontal" action="javascript:guardaFormaPagoPos()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">
            <i style="font-size:18px;" class="fa fa-money"></i> Adicionar Forma de Pago</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Forma de Pago </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-4 col-md-4">PUC </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="pucAdi" name="pucAdi" required >
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-4 col-md-4">Descripcion </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="descripcionAdi" name="descripcionAdi" required >
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-4 col-md-4">PMS </label>
            <div class="col-lg-6 col-md-6">
              <input type="checkbox" id="pmsAdi" name="pmsAdi" >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaFormaPagoPos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosPagosPos" class="form-horizontal" action="javascript:eliminaFormaPagoPos()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Forma de Pago</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Forma de Pago </label>
            <div class="col-lg-6 col-md-6">
              <input type="hidden" id="idFormaPagoEli" name="idFormaPagoEli" required>
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-4 col-md-4">PUC </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="pucEli" name="pucEli" disabled >
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-4 col-md-4">Descripcion </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="descripcionEli" name="descripcionEli" disabled >
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-4 col-md-4">PMS </label>
            <div class="col-lg-6 col-md-6">
              <input type="checkbox" id="pmsEli" name="pmsEli" disabled >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Eliminar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalModificaFormaPagoPos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualizaDatosFormaPagoPos" class="form-horizontal" action="javascript:actualizaFormaPagoPos()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">
            <i style="font-size:18px;" class="fa fa-money"></i> Actualiza Forma de Pago</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Forma de Pago </label>
            <div class="col-lg-6 col-md-6">
              <input type="hidden" id="idFormaPagoMod" name="idFormaPagoMod" required>
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-4 col-md-4">PUC </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="pucMod" name="pucMod" required >
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-4 col-md-4">Descripcion </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="descripcionMod" name="descripcionMod" required >
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-4 col-md-4">PMS </label>
            <div class="col-lg-6 col-md-6">
              <input type="checkbox" id="pmsMod" name="pmsMod" >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


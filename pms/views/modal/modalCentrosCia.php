<div class="modal fade" id="myModalAdicionaCentroCia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosCentro" class="form-horizontal" action="javascript:guardaCentroCia()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Centro de Costo Compañias</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Centro de Costo </label>
            <div class="col-lg-9 col-md-9">
              <input type="hidden" id="idCiaAdi" name="idCiaAdi">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Responsable </label>
            <div class="col-lg-9 col-md-9">
              <input type="text" class="form-control" id="respoAdi" name="respoAdi" required>
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

<div class="modal fade" id="myModalEliminaCentroCia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosImpuesto" class="form-horizontal" action="javascript:eliminaCentroCia()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Centro de Costo</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Centro de Costo </label>
            <div class="col-lg-9 col-md-9">
              <input type="hidden" name="idCentroEli" id="idCentroEli">
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Responsable </label>
            <div class="col-lg-9 col-md-9">
              <input type="text" class="form-control" id="respoEli" name="respoEli" readonly>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Eliminar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalModificaCentroCia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaDatosCentro" class="form-horizontal" action="javascript:actualizaCentroCia()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Centro de Costo</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeMod"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Centro de Costo </label>
            <div class="col-lg-9 col-md-9">
              <input type="hidden" name="idCia" id="idCia">
              <input type="hidden" name="idCentroMod" id="idCentroMod">
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Responsable </label>
            <div class="col-lg-9 col-md-9">
              <input type="text" class="form-control" id="respoMod" name="respoMod" required>
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
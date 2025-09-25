<div class="modal fade" id="myModalResolucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formResoluciones" class="form-horizontal" action="javascript:guardaResolucion()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">
            <i style="font-size:18px;" class="fa fa-money"></i> Adicionar Resoluciones de Facturacion
          </h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Resolucion </label>
            <div class="col-lg-4 col-md-">
              <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
          </div>
          <div class="form-group">
            <label for="desde" class="control-label col-lg-2 col-md-2">Desde </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" step="1" min="1" class="form-control" id="desde" name="desde" value="1" required>
            </div>
            <label for="hasta" class="control-label col-lg-2 col-md-2">Hasta </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" step="1" min="1" class="form-control" id="hasta" name="hasta" value="1" required>
            </div>
          </div>
          <div class="form-group">
            <label for="prefijo" class="control-label col-lg-2 col-md-2">Prefijo </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="prefijo" name="prefijo" required>
            </div>
            <label for="fecha" class="control-label col-lg-2 col-md-2">Fecha Resolucion </label>
            <div class="col-lg-4 col-md-4">
              <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
          </div>
          <div class="form-group">
            <label for="tipo" class="control-label col-lg-2 col-md-2">Tipo Resolucion</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="tipo" id="tipo" required>
                <option value="">Seleccione el Tipo Resolucion</option>
                <option value=1>Autorizacion</option>
                <option value=2>Habilitacion</option>
                ?>
              </select>
            </div>
            <label for="vigencia" class="control-label col-lg-2 col-md-2">Vigencia </label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min="1" max="36" step="1" class="form-control" id="vigencia" name="vigencia" value="1" required>
            </div>
            <label for="vigencia" style="margin-left:0; padding-left:0;margin-top:3px" class="col-lg-1 col-md-1">Meses </label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalModifica" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formUpdResolucion" class="form-horizontal" action="javascript:actualizaResolucion()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">
            <i style="font-size:18px;" class="fa fa-money"></i> Modifica Resolucion de Facturacion
          </h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Resolucion </label>
            <div class="col-lg-4 col-md-">
              <input type="hidden" class="form-control" id="id" name="id">
              <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
          </div>
          <div class="form-group">
            <label for="desde" class="control-label col-lg-2 col-md-2">Desde </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" step="1" min="1" class="form-control" id="desde" name="desde" value="1" required>
            </div>
            <label for="hasta" class="control-label col-lg-2 col-md-2">Hasta </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" step="1" min="1" class="form-control" id="hasta" name="hasta" value="1" required>
            </div>
          </div>
          <div class="form-group">
            <label for="prefijo" class="control-label col-lg-2 col-md-2">Prefijo </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="prefijo" name="prefijo" required>
            </div>
            <label for="fecha" class="control-label col-lg-2 col-md-2">Fecha Resolucion </label>
            <div class="col-lg-4 col-md-4">
              <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
          </div>
          <div class="form-group">
            <label for="tipo" class="control-label col-lg-2 col-md-2">Tipo Resolucion</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="tipo" id="tipo" required>
                <option value="">Seleccione el Tipo Resolucion</option>
                <option value=1>Autorizacion</option>
                <option value=2>Habilitacion</option>
                ?>
              </select>
            </div>
            <label for="vigencia" class="control-label col-lg-2 col-md-2">Vigencia </label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min="1" max="36" step="1" class="form-control" id="vigencia" name="vigencia" value="1" required>
            </div>
            <label for="vigencia" style="margin-left:0; padding-left:0;margin-top:3px" class="col-lg-1 col-md-1">Meses </label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="modal fade" id="myModalAdicionarFamilia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosDepto" class="form-horizontal" action="javascript:guardaFamilia()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Familia Almacenamiento</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Familia </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaFamilia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosImpuesto" class="form-horizontal" action="javascript:eliminaFamilia()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Familia Inventarios</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Familia </label>
            <div class="col-lg-6 col-md-6">
              <input type="hidden" name="idFamiliaEli" id="idFamiliaEli">
              <input type="text" class="form-control" id="descripcionEli" name="nombreEli" disabled>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-ban"></i> Eliminar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>


<div class="modal fade" id="myModalModificaFamilia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaDatosImpuesto" class="form-horizontal" action="javascript:actualizaFamilia()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Familia Inventarios</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Familia </label>
            <div class="col-lg-6 col-md-6">
              <input type="hidden" name="idFamiliaMod" id="idFamiliaMod">
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
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
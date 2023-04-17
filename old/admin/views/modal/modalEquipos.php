<div class="modal fade" id="myModalAdicionarEquipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosDepto" class="form-horizontal" action="javascript:guardaEquipo()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Equipo</h4>
        </div>
        <div id="mensaje"></div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">IP Equipo </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="equipoAdi" name="equipoAdi" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="descripcionAdi" name="descripcionAdi" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Datos</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaEquipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosImpuesto" class="form-horizontal" action="javascript:eliminaEquipo()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Equipo</h4>
        </div>
        <div id="mensajeEli"></div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">IP Equipo  </label>
            <div class="col-lg-6 col-md-6">
              <input type="hidden" name="idEquipoEli" id="idEquipoEli">
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="descripcionEli" name="descripcionEli" required>
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


<div class="modal fade" id="myModalModificaEquipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaDatosImpuesto" class="form-horizontal" action="javascript:actualizaEquipo()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica IP Equipo</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div id="mensajeMod"></div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">IP Equipo </label>
            <div class="col-lg-6 col-md-6">
              <input type="hidden" name="idEquipoMod" id="idEquipoMod">
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
          </div>
          <div class="form-group">
          <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion </label>
          <div class="col-lg-6 col-md-6">
            <input type="text" class="form-control" id="descripcionMod" name="descripcionMod" required>
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
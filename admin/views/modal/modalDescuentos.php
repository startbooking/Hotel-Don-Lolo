<div class="modal fade" id="myModalAdicionarDescuento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosDescuento" class="form-horizontal" action="javascript:guardaDescuento()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Descuentos</h4>
        </div>
        <div id="mensajeAdi"></div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion</label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Ambiente</label>
            <div class="col-lg-6 col-md-6">
              <select name="nombreAmbi" id="nombreAmbi" required="">
                <option value="">Seleccione el Ambiente</option>
                <?php 
                foreach ($ambientes as $ambiente) { ?>
                  <option value="<?=$ambiente['id_ambiente']?>"><?=$ambiente['nombre']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">% Descuento </label>
            <div class="col-lg-3 col-md-3">
              <input type="number" class="form-control" id="porcentajeAdi" step="1" min="1" max='100' name="porcentajeAdi" step="any" required >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"> </i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Guardar </button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalModificaDescuento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualizaDatosDescuento" class="form-horizontal" action="javascript:actualizaDescuento()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Descuentos</h4>
        </div>
        <div id="mensajeMod"></div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="idDescuentoMod" id="idDescuentoMod">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion</label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Ambiente</label>
            <div class="col-lg-6 col-md-6">
              <select name="nombreAmbiMod" id="nombreAmbiMod" required="">
                <option value="">Seleccione el Ambiente</option>
                <?php 
                foreach ($ambientes as $ambiente) { ?>
                  <option value="<?=$ambiente['id_ambiente']?>"><?=$ambiente['nombre']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">% Descuento </label>
            <div class="col-lg-3 col-md-3">
              <input type="number" class="form-control" id="porcentajeMod" step="1" min="1" max='100' name="porcentajeMod" step="any" required >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"> </i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Guardar </button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaDescuento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosDescuento" class="form-horizontal" action="javascript:eliminaDescuento()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Descuentos</h4>
        </div>
        <div id="mensajeEli"></div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="idDescuentoEli" id="idDescuentoEli">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion</label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Ambiente</label>
            <div class="col-lg-6 col-md-6">
              <select name="nombreAmbiEli" id="nombreAmbiEli" disabled="">
                <?php 
                foreach ($ambientes as $ambiente) { ?>
                  <option value="<?=$ambiente['id_ambiente']?>"><?=$ambiente['nombre']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">% Descuento </label>
            <div class="col-lg-3 col-md-3">
              <input type="number" class="form-control" id="porcentajeEli" step="1" min="1" max='100' name="porcentajeEli" step="any" disabled >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"> </i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"> </i> Eliminar </button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalAdicionarTipoPlato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosAgrupacion" class="form-horizontal" action="javascript:guardaTipoPlato()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Tipo de Plato</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Tipo de Plato</label>
            <div class="col-lg-7 col-md-7">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Ambiente</label>
            <div class="col-lg-7 col-md-7">
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
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Datos</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaTipoPlato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosAgrupacion" class="form-horizontal" action="javascript:eliminaTipoPlato()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Tipo de Plato</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Tipo de Plato </label>
            <div class="col-lg-6 col-md-6">
              <input type="hidden" name="idAgrupEli" id="idAgrupEli">
              <input type="text" class="form-control" id="descripcionEli" name="descripcionEli" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Ambiente</label>
            <div class="col-lg-6 col-md-6">
              <select name="nombreAmbiEli" id="nombreAmbiEli" disabled="">
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
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-trash-o"></i> Eliminar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalModificaTipoPlato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaDatosAgrupacion" class="form-horizontal" action="javascript:actualizaTipoPlato()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Tipo de plato</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeMod"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Tipo de Plato </label>
            <div class="col-lg-7 col-md-7">
              <input type="hidden" name="idAgrpMod" id="idAgrpMod">
              <input type="text" class="form-control" id="descripcionMod" name="descripcionMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Ambiente</label>
            <div class="col-lg-7 col-md-7">
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
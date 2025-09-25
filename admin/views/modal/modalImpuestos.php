<div class="modal fade" id="myModalAdicionarImpto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosImpuesto" class="form-horizontal" action="javascript:guardaImpuestos()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Impuesto</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Impuesto </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
            <label for="porcentaje" class="control-label col-lg-2 col-md-2">% </label>
            <div class="col-lg-3 col-md-3">
              <input type="number" class="form-control" id="porcentajeAdi" step="0.10" min="0" max='100' name="porcentajeAdi" step="any" required >
            </div>
          </div>
          <div class="form-group">
            <!-- <label for="tipo" class="control-label col-lg-2 col-md-2">Tipo</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="tipoAdi" id="tipoAdi" required>
                <option value="">Seleccione el Tipo de Impuesto</option>
                <option value=1>Impuesto</option>
                <option value=2>Retenciones</option>
              </select>
            </div> -->
            <label for="imptoDian" class="control-label col-lg-2 col-md-2">Impto DIAN</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="imptoDian" id="imptoDian" required>
                <option value="">Seleccione el Tipo de Impuesto</option>
                <?php
                  foreach ($imptosDian as $impto) { ?>
                  <option value="<?php echo $impto['id']; ?>"><?php echo $impto['name']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucAdi" name="pucAdi" required >
            </div>
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="descripcionAdi" name="descripcionAdi" required >
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

<div class="modal fade" id="myModalEliminaImpto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosImpuesto" class="form-horizontal" action="javascript:eliminaImpuesto()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Impuesto</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Impuesto </label>
            <div class="col-lg-4 col-md-4">
              <input type="hidden" name="idImptoEliImp" id="idImptoEliImp">
              <input type="text" class="form-control" id="nombreEliImp" name="nombreEliImp" disabled>
            </div>
            <label for="porcentaje" class="control-label col-lg-2 col-md-2">% </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" class="form-control" id="porcentajeEliImp" min="0" max='100' name="porcentajeEliImp" step="any" disabled >
            </div>
          </div>
          <div class="form-group">
            <!-- <label for="tipo" class="control-label col-lg-2 col-md-2">Tipo</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="tipoEliImp" id="tipoEliImp" disabled>
                <option value="">Seleccione el Tipo de Impuesto</option>
                <option value=1>Impuesto</option>
                <option value=2>Retenciones</option>
                ?>
              </select>
            </div> -->
            <label for="imptoDian" class="control-label col-lg-2 col-md-2">Impto DIAN</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="imptoDianEli" id="imptoDianEli" disabled>
                <?php
                  foreach ($imptosDian as $impto) { ?>
                  <option value="<?php echo $impto['id']; ?>"
                  ><?php echo $impto['name']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucEliImp" name="pucEliImp" disabled >
            </div>
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="descripcionEliImp" name="descripcionEliImp" disabled >
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


<div class="modal fade" id="myModalModificaImpto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaDatosImpuesto" class="form-horizontal" action="javascript:actualizaImpuestos()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Impuesto</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeMod"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Impuesto </label>
            <div class="col-lg-4 col-md-4">
              <input type="hidden" name="idImptoModImp" id="idImptoModImp">
              <input type="text" class="form-control" id="nombreModImp" name="nombreModImp" required>
            </div>
            <label for="porcentaje" class="control-label col-lg-2 col-md-2">% </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" class="form-control" id="porcentajeModImp" min="0" max='100' name="porcentajeModImp" step="any" required >
            </div>
          </div>
          <div class="form-group">
            <!-- <label for="tipo" class="control-label col-lg-2 col-md-2">Tipo</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="tipoModImp" id="tipoModImp" required>
                <option value=1>Impuesto</option>
                <option value=2>Retenciones</option>
                ?>
              </select>
            </div> -->
            <label for="imptoDian" class="control-label col-lg-2 col-md-2">Impto DIAN</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="imptoDianUpd" id="imptoDianUpd" required>
                <?php
                  foreach ($imptosDian as $impto) { ?>
                  <option value="<?php echo $impto['id']; ?>"
                  ><?php echo $impto['name']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucModImp" name="pucModImp" required >
            </div>
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="descripcionModImp" name="descripcionModImp" required >
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
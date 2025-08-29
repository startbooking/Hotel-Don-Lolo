<div class="modal fade" id="myModalAdicionaRetencion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosRetencion" class="form-horizontal" action="javascript:guardaRetencion()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Retencion</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Retencion </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
            <label for="porcentaje" class="control-label col-lg-2 col-md-2">% </label>
            <div class="col-lg-3 col-md-3">
              <input type="number" class="form-control" id="porcentaje" step="0.10" min="0" max='100' name="porcentaje" step="any" required >
            </div>
          </div>
          <div class="form-group">
            <label for="baseRete" class="control-label col-lg-2 col-md-2">Base Retencion</label>
            <div class="col-lg-4 col-md-4">
              <input type="number" class="form-control" id="baseRete" step="1" min="0" name="baseRete" step="any" required >
            </div>
            <label for="tipoRete" class="control-label col-lg-2 col-md-2">Tipo Retencion</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="tipoRete" id="tipoRete" required>
                <option value="">Selecione el tipo de retencion</option>
                <option value="1">ReteFuente</option>
                <option value="2">ReteIVA</option>
                <option value="3">ReteICA</option>
              </select>
            </div>
          </div>
          <div class="form-group">
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
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucAdi" name="pucAdi" required >
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

<div class="modal fade" id="myModalModificaRetencion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaDatosRetencion" class="form-horizontal" action="javascript:actualizaRetencion()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Retencion</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeMod"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Retencion </label>
            <div class="col-lg-4 col-md-4">
              <input type="hidden" name="idImptoModImp" id="idImptoModImp">
              <input type="text" class="form-control" id="nombreModImp" name="nombreModImp" required>
            </div>
            <label for="porcentaje" class="control-label col-lg-2 col-md-2">% </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" class="form-control" id="porcentajeModImp" step="0.10" min="0" max='100' name="porcentajeModImp" step="any" required >
            </div>
          </div>
          <div class="form-group">
            <label for="baseReteUpd" class="control-label col-lg-2 col-md-2">Base Retencion</label>
            <div class="col-lg-4 col-md-4">
              <input type="number" class="form-control" id="baseReteUpd" step="1" min="0" name="baseReteUpd" step="any" required >
            </div>
            <label for="tipoReteUpd" class="control-label col-lg-2 col-md-2">Tipo Retencion</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="tipoReteUpd" id="tipoReteUpd" required>
                <option value="">Selecione el tipo de retencion</option>
                <option value="1">ReteFuente</option>
                <option value="2">ReteIVA</option>
                <option value="3">ReteICA</option>
              </select>
            </div>
          </div>
          <div class="form-group">
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
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucModImp" name="pucModImp" required >
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
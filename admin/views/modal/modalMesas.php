<div class="modal fade" id="myModalAdicionarMesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosMesa" class="form-horizontal" action="javascript:guardaMesa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Mesa</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group" style="margin-top:5px">
            <label for="inputEmail3" class="col-sm-2 control-label">Ambiente</label>
            <div class="col-sm-8">
              <select class="form-control" name="ambienteAdi" id="ambienteAdi">
                <option value="">Seleccione el Ambiente</option>
                <?php
                foreach ($ambientes as $key => $value) { ?>
                  <option value="<?= $value['id_ambiente'] ?>"><?= $value['nombre'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Numero Mesa </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="mesaAdi" name="mesaAdi" required>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Personas </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min="1" max="10" class="form-control" id="paxAdi" name="paxAdi" required>
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

<div class="modal fade" id="myModalModificaMesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="updateDatosMesa" class="form-horizontal" action="javascript:updateMesa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modificar Mesa</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group" style="margin-top:5px">
            <input type="hidden" id="idUpd" name="idUpd">
            <label for="inputEmail3" class="col-sm-2 control-label">Ambiente</label>
            <div class="col-sm-8">
              <select class="form-control" name="ambienteUpd" id="ambienteUpd">
                <option value="">Seleccione el Ambiente</option>
                <?php
                foreach ($ambientes as $key => $value) { ?>
                  <option value="<?= $value['id_ambiente'] ?>"><?= $value['nombre'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Numero Mesa </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="mesaUpd" name="mesaUpd" required>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Personas </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min="1" max="10" class="form-control" id="paxUpd" name="paxUpd" required>
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

<div class="modal fade" id="myModalEliminaMesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="deleteDatosMesa" class="form-horizontal" action="javascript:deleteMesa()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Mesa</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group" style="margin-top:5px">
            <label for="inputEmail3" class="col-sm-2 control-label">Ambiente</label>
            <div class="col-sm-10">
              <input type="hidden" id="idEli" name="idEli">
              <select class="form-control" name="ambienteEli" id="ambienteEli" readonly>
                <option value="">Seleccione el Ambiente</option>
                <?php
                foreach ($ambientes as $key => $value) { ?>
                  <option value="<?= $value['id_ambiente'] ?>"><?= $value['nombre'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Numero Mesa </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="mesaEli" name="mesaEli" readonly>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Personas </label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min="1" max="10" class="form-control" id="paxEli" name="paxEli" readonly>
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
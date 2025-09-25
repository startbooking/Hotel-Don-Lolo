<div class="modal fade" id="myModalAdicionaCentroCia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosCentro" class="form-horizontal" action="javascript:guardaCentro()">
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
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Responsable </label>
            <div class="col-lg-9 col-md-9">
              <input type="text" class="form-control" id="costoAdi" name="costoAdi" required>
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

<div class="modal fade" id="myModalEliminaCentro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosImpuesto" class="form-horizontal" action="javascript:eliminaCentro()">
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
            <div class="col-lg-6 col-md-6">
              <input type="hidden" name="idCentroEli" id="idCentroEli">
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Departamento </label>
            <div class="col-lg-6 col-md-6">
              <?php 
              $deptos = $admin->getDeptosAreas();
              ?>
              <select class="form-control" name="deptoEli" id="deptoEli" required=""  >
                <option value="">Seleccione el Departamento</option>
                <?php 
                  foreach ($deptos as $depto) { ?>
                    <option value="<?=$depto['id_depto']?>"><?=$depto['nombre_depto']?></option>}
                    <?php 
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">PUC Costo </label>
            <div class="col-lg-3 col-md-3">
              <input type="text" class="form-control" id="costoEli" name="costoEli" required>
            </div>
            <label for="nombre" class="control-label col-lg-3 col-md-3">PUC Gasto </label>
            <div class="col-lg-3 col-md-3">
              <input type="text" class="form-control" id="gastoEli" name="gastoEli" required>
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

<div class="modal fade" id="myModalModificaCentro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaDatosCentro" class="form-horizontal" action="javascript:actualizaCentro()">
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
            <div class="col-lg-6 col-md-6">
              <input type="hidden" name="idCentroMod" id="idCentroMod">
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">Departamento </label>
            <div class="col-lg-6 col-md-6">
              <?php 
              $deptos = $admin->getDeptosAreas();
              ?>
              <select class="form-control" name="deptoMod" id="deptoMod" required=""  >
                <option value="">Seleccione el Departamento</option>
                <?php 
                  foreach ($deptos as $depto) { ?>
                    <option value="<?=$depto['id_depto']?>"><?=$depto['nombre_depto']?></option>}
                    <?php 
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-3 col-md-3">PUC Costo </label>
            <div class="col-lg-3 col-md-3">
              <input type="text" class="form-control" id="costoMod" name="costoMod" required>
            </div>
            <label for="nombre" class="control-label col-lg-3 col-md-3">PUC Gasto </label>
            <div class="col-lg-3 col-md-3">
              <input type="text" class="form-control" id="gastoMod" name="gastoMod" required>
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
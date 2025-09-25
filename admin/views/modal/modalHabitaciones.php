<div class="modal fade" id="myModalAdicionarHabitacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosHabitacion" class="form-horizontal" action="javascript:guardaHabitacion()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Habitacion</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Numero Habitacion </label>
            <div class="col-lg-2 col-md-2">
              <input type="text" class="form-control" id="CodigoAdi" name="CodigoAdi" maxlength="4" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Tipo Habitacion  </label>
            <div class="col-lg-6 col-md-6">
              <?php 
              $tiposHab = $admin->getTipoHabitacionAct();
              ?>
              <select name="tipoHabiAdi" id="tipoHabiAdi" required="">
                <option value="">Seleccione el Tipo de Habitacion</option>}
                option
                <?php 
                foreach ($tiposHab as $tipohab) { ?>
                  <option value="<?=$tipohab['id']?>"><?=$tipohab['descripcion_habitacion']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Sector  </label>
            <div class="col-lg-6 col-md-6">
              <?php 
              $sectores = $admin->getSectorHabitacion();
              ?>
              <select name="sectorHabiAdi" id="sectorHabiAdi" required="">
                <?php 
                foreach ($sectores as $sector) { ?>
                  <option value="<?=$sector['id_sector']?>"><?=$sector['descripcion_sector']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Camas </label>
            <div class="col-lg-2 col-md-2">
              <input type="number" class="form-control" id="camasAdi" name="camasAdi" min="1" required>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Huespedes </label>
            <div class="col-lg-2 col-md-2">
              <input type="number" class="form-control" id="huespedesAdi" name="huespedesAdi" min="1" required>
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

<div class="modal fade" id="myModalEliminaHabitacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosTipoHabi" class="form-horizontal" action="javascript:eliminaHabitacion()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Habitacion</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <input type="hidden" name="idHabiEli" id="idHabiEli">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Numero Habitacion </label>
            <div class="col-lg-2 col-md-2">
              <input type="text" class="form-control" id="CodigoEli" name="CodigoEli" maxlength="4" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Tipo Habitacion  </label>
            <div class="col-lg-6 col-md-6">
              <?php 
              $tiposHab = $admin->getTipoHabitacionAct();
              ?>
              <select name="tipoHabiEli" id="tipoHabiEli" disabled="">
                <?php 
                foreach ($tiposHab as $tipohab) { ?>
                  <option value="<?=$tipohab['id']?>"><?=$tipohab['descripcion_habitacion']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Sector  </label>
            <div class="col-lg-6 col-md-6">
              <?php 
              $sectores = $admin->getSectorHabitacion();
              ?>
              <select name="sectorHabiEli" id="sectorHabiEli" disabled="">
                <?php 
                foreach ($sectores as $sector) { ?>
                  <option value="<?=$sector['id_sector']?>"><?=$sector['descripcion_sector']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Camas </label>
            <div class="col-lg-2 col-md-2">
              <input type="number" class="form-control" id="camasEli" name="camasEli" min="1" disabled>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Huespedes </label>
            <div class="col-lg-2 col-md-2">
              <input type="number" class="form-control" id="huespedesEli" name="huespedesEli" min="1" disabled>
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


<div class="modal fade" id="myModalModificaHabitacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaDatosHabi" class="form-horizontal" action="javascript:actualizaHabitacion()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Tipo de Habtacion</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeMod"></div>
          <input type="hidden" name="idHabiMod" id="idHabiMod">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Numero Habitacion </label>
            <div class="col-lg-2 col-md-2">
              <input type="text" class="form-control" id="CodigoMod" name="CodigoMod" maxlength="4" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Tipo Habitacion  </label>
            <div class="col-lg-6 col-md-6">
              <?php 
              $tiposHab = $admin->getTipoHabitacionAct();
              ?>
              <select name="tipoHabiMod" id="tipoHabiMod" required="">
                <?php 
                foreach ($tiposHab as $tipohab) { ?>
                  <option value="<?=$tipohab['id']?>"><?=$tipohab['descripcion_habitacion']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Sector  </label>
            <div class="col-lg-6 col-md-6">
              <?php 
              $sectores = $admin->getSectorHabitacion();
              ?>
              <select name="sectorHabiMod" id="sectorHabiMod" required="">
                <?php 
                foreach ($sectores as $sector) { ?>
                  <option value="<?=$sector['id_sector']?>"><?=$sector['descripcion_sector']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Camas </label>
            <div class="col-lg-2 col-md-2">
              <input type="number" class="form-control" id="camasMod" name="camasMod" min="1" required>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Huespedes </label>
            <div class="col-lg-2 col-md-2">
              <input type="number" class="form-control" id="huespedesMod" name="huespedesMod" min="1" required>
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
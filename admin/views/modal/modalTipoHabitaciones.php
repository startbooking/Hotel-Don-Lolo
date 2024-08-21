<div class="modal fade" id="myModalAdicionarTipoHabitacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosTipoHabi" class="form-horizontal" action="javascript:guardaTipoHabi()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Tipo de Habitacion</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body"> 
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Abreviatura </label>
            <div class="col-lg-2 col-md-2">
              <input type="text" class="form-control" id="CodigoAdi" name="CodigoAdi" maxlength="4" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion  </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Sector Hotel  </label>
            <div class="col-lg-6 col-md-6">
              <?php
                $sectores = $admin->getSectorHabitacion(1);
              ?>
              <select name="sectorAdi" id="sectorAdi" required="">
                <option value="">Seleccione el Sector del Hotle </option>
                <?php foreach ($sectores as $sector) { ?>
                <option value="<?php echo $sector['id_sector']; ?>"><?php echo $sector['descripcion_sector']; ?></option>
                  
                <?php } ?>
              </select>
            </div>
          </div> 
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Codigo de Venta  </label>
            <div class="col-lg-6 col-md-6">
              <?php
                $codigoVtas = $admin->getCodigosVentas(1);
              ?>
              <select name="CodTipoHabiAdi" id="CodTipoHabiAdi" required="">
                <option value="">Seleccione el Codigo de Ventas </option>
                <?php foreach ($codigoVtas as $codigo) { ?>
                <option value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
                  
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Codigo de Venta  Excento</label>
            <div class="col-lg-6 col-md-6">
              <?php
                $codigoVtas = $admin->getCodigosVentas(1);
              ?>
              <select name="CodTipoHabiAdiExce" id="CodTipoHabiAdiExce" required="">
                <option value="">Seleccione el Codigo de Ventas </option>
                <?php foreach ($codigoVtas as $codigo) { ?>
                <option value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
                  
                <?php } ?>
              </select>
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

<div class="modal fade" id="myModalEliminaTipoHabitacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosTipoHabi" class="form-horizontal" action="javascript:eliminaTipoHabi()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Impuesto</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <input type="hidden" name="idTipoHabiEli" id="idTipoHabiEli">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Abreviatura </label>
            <div class="col-lg-2 col-md-2">
              <input type="text" class="form-control" id="CodigoEli" name="CodigoEli" maxlength="4" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion  </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" disabled>
            </div>
          </div>
          <!--
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Tipo  </label>
            <div class="col-lg-6 col-md-6">
              <select name="TipoHabiEli" id="TipoHabiEli" disabled="">
                <option value="1">Habitacion</option>
                <option value="2">Dormitorio</option>
                <option value="3">Motor Home</option>
                <option value="4">Camping</option>
                <option value="5">Cuenta Maestra</option>
              </select>
            </div>
          </div>
          -->
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Codigo de Venta  </label>
            <div class="col-lg-6 col-md-6">
              <?php
                $codigoVtas = $admin->getCodigosVentas(1);
              ?>
              <select name="CodTipoHabiEli" id="CodTipoHabiEli" disabled="">
                <?php foreach ($codigoVtas as $codigo) { ?>
                <option value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
                  
                <?php } ?>
              </select>
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

<div class="modal fade" id="myModalModificaTipoHabitacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaDatosTipoHabi" class="form-horizontal" action="javascript:actualizaTipoHabi()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Tipo de Habtacion</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeMod"></div>
          <input type="hidden" name="idTipoHabiMod" id="idTipoHabiMod">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Abreviatura </label>
            <div class="col-lg-2 col-md-2">
              <input type="text" class="form-control" id="CodigoMod" name="CodigoMod" maxlength="4" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Descripcion  </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Sector Hotel  </label>
            <div class="col-lg-6 col-md-6">
              <?php
                $sectores = $admin->getSectorHabitacion(1);
              ?>
              <select name="sectorMod" id="sectorMod" required="">
                <option value="">Seleccione el Sector del Hotle </option>
                <?php foreach ($sectores as $sector) { ?>
                <option value="<?php echo $sector['id_sector']; ?>"><?php echo $sector['descripcion_sector']; ?></option>
                  
                <?php } ?>
              </select>
            </div>
          </div>                    
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Codigo de Venta  </label>
            <div class="col-lg-6 col-md-6">
              <?php
                $codigoVtas = $admin->getCodigosVentas(1);
              ?>
              <select name="CodTipoHabiMod" id="CodTipoHabiMod" required="">
                <option value="">Seleccione el Codigo de Ventas </option>
                <?php foreach ($codigoVtas as $codigo) { ?>
                <option value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
                  
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Codigo de Venta  Excento</label>
            <div class="col-lg-6 col-md-6">
              <?php
                $codigoVtas = $admin->getCodigosVentas(1);
              ?>
              <select name="CodTipoHabiModExce" id="CodTipoHabiModExce" required="">
                <option value="">Seleccione el Codigo de Ventas </option>
                <?php foreach ($codigoVtas as $codigo) { ?>
                <option value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
                  
                <?php } ?>
              </select>
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
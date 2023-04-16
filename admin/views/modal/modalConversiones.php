<div class="modal fade" id="myModalAdicionarConversion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosConversion" class="form-horizontal" action="javascript:guardaConversion()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Conversion</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="unidadUnid" class="control-label col-lg-4 col-md-4">Unidad </label>
            <?php $unidades = $admin->getUnidadesMedida();?>
            <div class="col-lg-6 col-md-6">
              <select name="unidadUnid" id="unidadUnid">
                <?php 
                foreach ($unidades as $unidad) { ?>
                  <option value="<?=$unidad['id_unidad']?>"><?=$unidad['descripcion_unidad']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="unidadConv" class="control-label col-lg-4 col-md-4">Conversion </label>
            <?php $unidades = $admin->getUnidadesMedida();?>
            <div class="col-lg-6 col-md-6">
            <select name="unidadConv" id="unidadConv">
              <?php 
              foreach ($unidades as $unidad) { ?>
                <option value="<?=$unidad['id_unidad']?>"><?=$unidad['descripcion_unidad']?></option>
                <?php 
              }
              ?>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label for="valorConv" class="control-label col-lg-4 col-md-4">Conversion </label>
            <div class="col-lg-6 col-md-6">
              <input type="number" class="form-control" id="valorConv" name="valorConv" required min=1>
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

<div class="modal fade" id="myModalEliminaConversion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosConversion" class="form-horizontal" action="javascript:eliminaConversion()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Conversion</h4>
          <div class="col-lg-6 col-md-6">
          </div>        
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <label for="unidadUnid" class="control-label col-lg-4 col-md-4">Unidad </label>
            <input type="hidden" name="idConvEli" id="idConvEli">
            <?php $unidades = $admin->getUnidadesMedida();?>
            <div class="col-lg-6 col-md-6">
              <select name="unidadUnid" id="unidadUnid" disabled="">
                <?php 
                foreach ($unidades as $unidad) { ?>
                  <option value="<?=$unidad['id_unidad']?>"><?=$unidad['descripcion_unidad']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="unidadConv" class="control-label col-lg-4 col-md-4">Conversion </label>
            <?php $unidades = $admin->getUnidadesMedida();?>
            <div class="col-lg-6 col-md-6">
            <select name="unidadConv" id="unidadConv" disabled="">
              <?php 
              foreach ($unidades as $unidad) { ?>
                <option value="<?=$unidad['id_unidad']?>"><?=$unidad['descripcion_unidad']?></option>
                <?php 
              }
              ?>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label for="valorConv" class="control-label col-lg-4 col-md-4">Conversion </label>
            <div class="col-lg-6 col-md-6">
              <input type="number" class="form-control" id="valorConv" name="valorConv" disabled="" min=1>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Regresar</button>
          <button type="submit" class="btn btn-primary">Eliminar</button>
        </div>
      </div>
    </div>
  </form>
</div>


<div class="modal fade" id="myModalModificaConversion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaDatosConversion" class="form-horizontal" action="javascript:actualizaConversion()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Conversion</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="unidadUnid" class="control-label col-lg-4 col-md-4">Unidad </label>
            <?php $unidades = $admin->getUnidadesMedida();?>
            <div class="col-lg-6 col-md-6">
              <select name="unidadUnidMod" id="unidadUnidMod">
                <?php 
                foreach ($unidades as $unidad) { ?>
                  <option value="<?=$unidad['id_unidad']?>"><?=$unidad['descripcion_unidad']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="unidadConv" class="control-label col-lg-4 col-md-4">Conversion </label>
            <input type="hidden" name="idConvMod" id="idConvMod">

            <?php $unidades = $admin->getUnidadesMedida();?>
            <div class="col-lg-6 col-md-6">
              <select name="unidadConvMod" id="unidadConvMod">
                <?php 
                foreach ($unidades as $unidad) { ?>
                  <option value="<?=$unidad['id_unidad']?>"><?=$unidad['descripcion_unidad']?></option>
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="valorConv" class="control-label col-lg-4 col-md-4">Conversion </label>
            <div class="col-lg-6 col-md-6">
              <input type="number" class="form-control" id="valorConvMod" name="valorConvMod" required min=1>
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
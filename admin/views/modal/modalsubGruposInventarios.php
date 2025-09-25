<div class="modal fade" id="myModalAdicionarSubGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosDepto" class="form-horizontal" action="javascript:guardaSubgrupo()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Subgrupo de Almacenamiento</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Familia </label>
            <div class="col-lg-6 col-md-6">
              <select name="familiaGrp" id="familiaGrp" required onblur='traeGrupoInventarios(this.value,1)'>
                <option value="">Seleccione la Familia</option>                
                <?php 
                $familias = $admin->getFamiliasInventarios();
                foreach ($familias as $familia) { ?>
                  <option value="<?=$familia['id_familia']?>"><?=$familia['descripcion_familia']?></option>                
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Grupo </label>
            <div class="col-lg-6 col-md-6">
              <select name="nombreGrupo" id="nombreGrupo" required="">
                <option value="">Seleccione el Grupo</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Subgrupo </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreSubG" name="nombreSubG" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalModificaSubGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualizaDatosSubgrupo" class="form-horizontal" action="javascript:actualizaSubgrupo()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modificar Subgrupo de Almacenamiento</h4>
        </div>
        <div id="mensajeMod"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <input type="hidden" name="idSubGrupoMod" id="idSubGrupoMod" value="">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Familia </label>
            <div class="col-lg-6 col-md-6">
              <select name="familiaSubGrpMod" id="familiaSubGrpMod" required onblur='traeGrupoInventarios(this.value,2)'>
                <?php 
                $familias = $admin->getFamiliasInventarios();
                foreach ($familias as $familia) { ?>
                  <option value="<?=$familia['id_familia']?>"><?=$familia['descripcion_familia']?></option>                
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Grupo </label>
            <div class="col-lg-6 col-md-6">
              <select name="grupoSubGrupoMod" id="grupoSubGrupoMod" required="">
                <?php 
                  $grupos  = $admin->getGruposInventarios();
                  foreach ($grupos as $key => $value): ?>
                  <option value="<?=$value['id_grupo']?>"><?=$value['descripcion_grupo']?></option>}
                <?php 
                endforeach 
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Subgrupo </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="descripSubGrupoMod" name="descripSubGrupoMod" required>
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


<div class="modal fade" id="myModalEliminaSubgrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosSubgrupo" class="form-horizontal" action="javascript:eliminaSubgrupo()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Elimina Subgrupo de Almacenamiento</h4>
        </div>
        <div id="mensajeMod"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <input type="hidden" name="idSubGrupoEli" id="idSubGrupoEli" value="">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Familia </label>
            <div class="col-lg-6 col-md-6">
              <select name="familiaSubGrpEli" id="familiaSubGrpEli" disabled onblur='traeGrupoInventarios(this.value,2)'>
                <?php 
                $familias = $admin->getFamiliasInventarios();
                foreach ($familias as $familia) { ?>
                  <option value="<?=$familia['id_familia']?>"><?=$familia['descripcion_familia']?></option>                
                  <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Grupo </label>
            <div class="col-lg-6 col-md-6">
              <select name="grupoSubGrupoEli" id="grupoSubGrupoEli" disabled="">
                <?php 
                  $grupos  = $admin->getGruposInventarios();
                  foreach ($grupos as $key => $value): ?>
                  <option value="<?=$value['id_grupo']?>"><?=$value['descripcion_grupo']?></option>}
                <?php 
                endforeach 
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Subgrupo </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="descripSubGrupoEli" name="descripSubGrupoEli" disabled>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Eliminar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

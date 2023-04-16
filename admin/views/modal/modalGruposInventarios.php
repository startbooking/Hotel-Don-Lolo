<div class="modal fade" id="myModalAdicionarGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosGrupo" class="form-horizontal" action="javascript:guardaGrupo()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adicionar Grupo Inventarios</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Familia </label>
            <div class="col-lg-6 col-md-6">
              <select name="familiaGrp" id="familiaGrp" required>
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
              <input type="text" class="form-control" id="nombreGrp" name="nombreGrp" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" ></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save" ></i> Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminaDatosImpuesto" class="form-horizontal" action="javascript:eliminaGrupo()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar Grupo de Inventarios</h4>
        </div>
        <div id="mensajeEli"></div>
        <div class="modal-body" id="deleteGrupo">
          <input type="hidden" name="idGrupoEli" id="idGrupoEli">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Familia </label>
            <div class="col-lg-6 col-md-6">
              <select name="familiaGrpEli" id="familiaGrpEli" disabled>
                <?php 
                  $familias = $admin->getFamiliasInventarios();
                  foreach ($familias as $familia) { ?>
                    <option value="<?=$familia['id_familia']?>" 
                      ><?=$familia['descripcion_familia']?></option>                
                    <?php 
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Grupo </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="grupoEli" name="grupoEli" disabled value="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-ban"></i> Eliminar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

 
<div class="modal fade" id="myModalModificaGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="modificaDatosGrupo" class="form-horizontal" action="javascript:actualizaGrupo()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modifica Departamento</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body" id="updateGrupo">
          <input type="hidden" name="idGrupoMod" id="idGrupoMod">
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Familia </label>
            <div class="col-lg-6 col-md-6">
              <select name="familiaGrpMod" id="familiaGrpMod" required>
                <?php 
                  $familias = $admin->getFamiliasInventarios();
                  foreach ($familias as $familia) { ?>
                    <option value="<?=$familia['id_familia']?>" 
                      ><?=$familia['descripcion_familia']?></option>                
                    <?php 
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-4 col-md-4">Grupo </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="grupoMod" name="grupoMod" required value="">
            </div>
          </div>
          <div id="mensajeEli"></div>
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
<div class="modal fade" id="myModalAdicionarCodigoVentas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosCodigosVentas" class="form-horizontal" action="javascript:guardaCodigoVentas()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">
            <i style="font-size:18px;" class="fa fa-money"></i> Adicionar Codigo de Ventas</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div> 
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
          </div> 
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Impuesto</label>
            <?php 
              $imptos = $admin->getCodigosVentas(2); 
            ?>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="ImptosAdi" id="ImptosAdi" required="">
                <option value="">Seleccione el Impuesto</option>
                <?php 
                foreach ($imptos as $impto) { ?> 
                <option value="<?=$impto['id_cargo']?>"><?=$impto['descripcion_cargo']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Grupo</label>
            <?php 
              $grupos = $admin->getGruposVentas(); 
            ?>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="grupoAdi" id="grupoAdi" required="">
                <option value="">Seleccione el Grupo</option>
                <?php 
                foreach ($grupos as $grupo) { ?> 
                <option value="<?=$grupo['id']?>"><?=$grupo['descripcion']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">            
            <label for="nombre" class="control-label col-lg-2 col-md-2">Centro de Costo</label>
            <?php 
              $centros = $admin->getCentrosCosto(); 

            ?>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" id="centroAdi" name="centroAdi">
                <option value="">Seleccione el Centro de Costo</option>
              </select>  
            </div>            
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucAdi" name="pucAdi" required >
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion Contabilidad</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="descripcionAdi" name="descripcionAdi" required >
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

<div class="modal fade" id="myModalModificaCodigoVentas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualizaDatosCodigosVentas" class="form-horizontal" action="javascript:actualizaCodigoVentas()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">
            <i style="font-size:18px;" class="fa fa-money"></i> Adicionar Codigo de Ventas</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-8 col-md-8">
              <input type="hidden" id="idCodigoMod" name="idCodigoMod" required>
              <input type="text" class="form-control" id="nombreMod" name="nombreMod" required>
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Impuesto</label>
            <?php 
              $imptos = $admin->getCodigosVentas(2); 
            ?>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="imptosMod" id="imptosMod" required="">
                <option value="">Seleccione el Impuesto</option>
                <?php 
                foreach ($imptos as $impto) { ?> 
                <option value="<?=$impto['id_cargo']?>"><?=$impto['descripcion_cargo']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Grupo</label>
            <?php 
              $grupos = $admin->getGruposVentas(); 
            ?>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="grupoMod" id="grupoMod" required="">
                <option value="">Seleccione el Grupo</option>
                <?php 
                foreach ($grupos as $grupo) { ?> 
                <option value="<?=$grupo['id']?>"><?=$grupo['descripcion']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">            
            <label for="nombre" class="control-label col-lg-2 col-md-2">Centro de Costo</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="centroMod" name="centroMod" required >
            </div>
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucMod" name="pucMod" required >
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion Contable</label>
            <div class="col-lg-8 col-md-8">
              <input type="text" class="form-control" id="descripcionMod" name="descripcionMod" required >
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

<div class="modal fade" id="myModalEliminaCodigoVentas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualizaDatosCodigosVentas" class="form-horizontal" action="javascript:eliminaCodigoVentas()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-off"></span></span></button>
          <h4 class="modal-title" id="exampleModalLabel">
            <i style="font-size:18px;" class="fa fa-money"></i> Adicionar Codigo de Ventas</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-6 col-md-6">
              <input type="hidden" id="idCodigoEli" name="idCodigoEli" >
              <input type="text" class="form-control" id="nombreEli" name="nombreEli" disabled="">
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Impuesto</label>
            <?php 
              $imptos = $admin->getCodigosVentas(2); 
            ?>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="imptosEli" id="imptosEli" disabled="" >
                <option value="">Seleccione el Impuesto</option>
                <?php 
                foreach ($imptos as $impto) { ?> 
                <option value="<?=$impto['id_cargo']?>"><?=$impto['descripcion_cargo']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Grupo</label>
            <?php 
              $grupos = $admin->getGruposVentas(); 
            ?>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="grupoEli" id="grupoEli" disabled="">
                <option value="">Seleccione el Grupo</option>
                <?php 
                foreach ($grupos as $grupo) { ?> 
                <option value="<?=$grupo['id']?>"><?=$grupo['descripcion']?></option>
                <?php 
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucEli" name="pucEli" disabled="">
            </div>
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="descripcionEli" name="descripcionEli" disabled="">
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


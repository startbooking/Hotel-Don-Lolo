<?php 
  // $imptos   = $admin->getCodigosVentas(2); 
  $unidades = $inven->getUnidadesMedida();
  $centros  = $admin->getCentrosCosto();
  $imptos   = $user->getTipoImpuestos(1);

?>
<div class="modal fade" id="myModalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarProductos" class="form-horizontal" action="javascript:guardaProductos()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="material-symbols-outlined">power_settings_new</span></button>
          <h4 class="modal-title" id="exampleModalLabel">
          <span class="material-symbols-outlined">add_chart</span> Compras / Servicios</h4>
        </div>
        <div class="modal-body">
          <div id="mensaje" class="alert alert-warning oculto centraTitulo"></div>

          <div class="form-group row">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Descripcion </label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
            </div>
          </div> 
          <div class="form-group row">
            <label for="puc" class="control-label col-lg-2 col-md-2">Codigo</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="codigoAdi" name="codigoAdi" required >
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Impuesto</label>
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
          </div>          
          <div class="form-group row">            
            <label for="puc" class="control-label col-lg-2 col-md-2">Unidad</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="unidad" id="unidad" required>
                <option value="">Seleccione la Unidad</option>
                <?php
                  foreach ($unidades as $unidad) { ?>
                    <option value="<?php echo $unidad['id_unidad']; ?>"><?php echo $unidad['descripcion_unidad']; ?></option>
                    <?php
                  }
                ?>
              </select>
            </div>
            <label for="puc" class="control-label col-lg-2 col-md-2">Precio</label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min="1" class="form-control" id="precioAdi" name="precioAdi" required >
            </div>
          </div>
          <div class="form-group">            
            <label for="puc" class="control-label col-lg-2 col-md-2">PUC </label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="pucAdi" name="pucAdi" required >
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Centro Costo</label>
            <div class="col-lg-4 col-md-4">  
              <select class="form-control" id="centroAdi" name="centroAdi" required>
                <option value="">Seleccione el Centro de Costo</option>
                <?php
                  foreach ($centros as $unidad) { ?>
                    <option value="<?php echo $unidad['id_centrocosto']; ?>"><?php echo $unidad['descripcion_centro']; ?></option>
                    <?php
                  }
                ?>                
              </select> 
            </div>            
          </div>
          <div class="form-group">
            <label for="puc" class="control-label col-lg-2 col-md-2">Descripcion Contabilidad</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="descripcionAdi" name="descripcionAdi" required >
            </div>
            <label for="puc" class="control-label col-lg-2 col-md-2">Codigo Dian</label>
            <div class="col-lg-2 col-md-2">
              <input type="text" min="1" class="form-control" id="codigoDian" name="codigoDian" required >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="material-symbols-outlined">undo</span> Regresar</button>
            <button type="submit" class="btn btn-primary derechaAbs"><span class="material-symbols-outlined">save</span> Guardar</button>
          </div>
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


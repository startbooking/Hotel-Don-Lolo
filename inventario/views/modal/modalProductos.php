<?php
  $unidades = $inven->getUnidadesMedida();
  ?>

<div class="modal fade" id="myModalAdicionarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="dataRegistrarProducto" class="form-horizontal" action="javascript:guardaProducto()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="exampleModalLabel"> <i class="fa fa-plus-square" aria-hidden="true"></i> Adiciona Producto</h4>
        </div>   
        <div class="modal-body">
          <div id="datos_ajax"></div>
          <div class="form-group">
            <label for="producto" class="control-label col-lg-2 col-md-2">Producto</label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="producto" name="producto" required >
            </div>
          </div>
          <div class="form-group">
            <label for="familia" class="control-label col-lg-2 col-md-2">Familia</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="familia" id="familia" required >
                <option value="">Seleccione la Familia del Producto</option>
                <?php
                  $familias = $admin->getFamiliasInventarios();
  foreach ($familias as $familia) { ?>
                    <option value="<?php echo $familia['id_familia']; ?>"><?php echo $familia['descripcion_familia']; ?></option>
                    <?php
  }
  ?>
              </select>
            </div>
              <label for="seccion" class="control-label col-lg-2 col-md-2">Grupo</label>
              <div class="col-lg-4 col-md-4">
                <select class="form-control" name="grupos" id="grupos" required>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="seccion" class="control-label col-lg-2 col-md-2">Subgrupo</label>
              <div class="col-lg-4 col-md-4">
                <select class="form-control" name="subgrupo" id="subgrupo" requierd>
                </select>
              </div>
              <label for="seccion" class="control-label col-lg-2 col-md-2">Unidad</label>
              <div class="col-lg-4 col-md-4">
                <select class="form-control" name="compra" id="compra" required>
                  <option>Seleccione la unidad de Compra</option>
                  <?php
      foreach ($unidades as $unidad) { ?>
                    <option value="<?php echo $unidad['id_unidad']; ?>"><?php echo $unidad['descripcion_unidad']; ?></option>
                    <?php
      }
  ?>
                </select>
              </div>
            </div>
            <div class="form-group" id="compra">
              <label for="seccion" class="control-label col-lg-2 col-md-2">Almacenamiento</label>
              <div class="col-lg-4 col-md-4">
                <select class="form-control" name="almacena" id="almacena" required>
                  <option>Seleccione la unidad de Almacenamiento</option>
                  <?php
    foreach ($unidades as $unidad) { ?>
                    <option value="<?php echo $unidad['id_unidad']; ?>"><?php echo $unidad['descripcion_unidad']; ?></option>
                    <?php
    }
  ?>
                </select>
              </div>
              <label for="seccion" class="control-label col-lg-2 col-md-2">Procesamiento</label>
              <div class="col-lg-4 col-md-4">
                <select class="form-control" name="procesa" id="procesa" required>
                  <option>Seleccione la unidad de Procesamiento</option>
                  <?php
    foreach ($unidades as $unidad) { ?>
                    <option value="<?php echo $unidad['id_unidad']; ?>"><?php echo $unidad['descripcion_unidad']; ?></option>
                    <?php
    }
  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="costo" class="control-label col-lg-2  col-md-2">Precio Costo</label>
              <div class="col-lg-4 col-md-4">
                <input type="number" class="form-control" id="costo" step="0.01" name="costo" min='0' value='0'> 
              </div>
              <label for="promedio" class="control-label col-lg-2  col-md-2">Precio Promedio</label>
              <div class="col-lg-4 col-md-4">
                <input type="number" class="form-control" id="promedio" step="0.01" name="promedio" min='0' value='0'> 
              </div>
            </div>
            <div class="form-group">
              <label for="costo" class="control-label col-lg-2  col-md-2">Stock Minimo</label>
              <div class="col-lg-4 col-md-4">
                <input type="number" class="form-control" id="minimo" name="minimo" required min='0' > 
              </div>
              <label for="promedio" class="control-label col-lg-2  col-md-2">Stock maximo</label>
              <div class="col-lg-4 col-md-4">
                <input type="number" class="form-control" id="maximo" name="maximo" required min='0' > 
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-2  col-md-2" for="exampleTextarea">Ubicacion</label>
              <div class="col-lg-10 col-md-10">
              <input class="form-control"type="text" id="ubicacion" name="ubicacion">
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar </button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </div>
      <!-- <div class="panel panel-success">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
          <div class="modal-content">
          </div>
        </div>
        <div class="panel-footer">
          <div class="row" style="padding-right:20px">
          </div>
        </div>
      </div> -->
    </div>
  </form>
</div>

<div class="modal fade" id="myModalModificaProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="dataActualizaProducto" class="form-horizontal" action="javascript:actualizaProducto()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Modificar Producto</h4>
        </div>
        <div class="modal-body" id='updProducto'>
          <div id="datos_ajax"></div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalEliminaProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="dataActualizaProducto" class="form-horizontal" action="javascript:eliminaProducto()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h3 class="modal-title tituloPagina" id="exampleModalLabel">Elimina Producto</h3>
        </div>
        <div class="modal-body">
          <input type="hidden" id="idproducto" name="idproducto">
          <h3 class="text-center text-muted" style="margin:0px">Estas seguro?</h3>
          <p class="lead text-muted text-center" 
              style="display: block;margin:10px">Esta acción eliminará de forma permanente los Datos del Producto.
            <h3 class="tituloPagina" align="center">Desea continuar?</h3>    
          </p>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Eliminar </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
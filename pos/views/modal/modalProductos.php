<?php
$tipos = $pos->getTipoPlatos($idamb);
$imptos = $pos->getImpuestos();
?>

<div class="modal fade" id="modalAdicionaProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosProducto" class="form-horizontal" action="javascript:guardarProducto()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="exampleModalLabel"><span class="fa fa-cube"></span> Adicionar Producto</h4>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="idamb" id="idamb" value="<?php echo $idamb; ?>">
            <label for="producto" class="control-label col-lg-2 col-md-2">Producto</label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="producto" name="producto" required>
            </div>
          </div>
          <div class="form-group">
            <label for="producto" class="control-label col-lg-2 col-md-2">Codigo</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
            <label for="unidadMed" class="control-label col-lg-2 col-md-2">Unidad Med. </label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="unidadMed" id="unidadMed" required="">
                <option value="">Seleccione la Unidad de Medida</option>
                <?php 
                  $unidades = $admin->unidades_medida(); 
                  foreach ($unidades as $unidad) { ?> 
                    <option value="<?=$unidad['id']?>"><?=strtoupper($unidad['name'])?></option>
                  <?php 
                }
                ?>
              </select> 
            </div>
          </div>
          <div class="form-group">
            <label for="seccion" class="control-label col-lg-2 col-md-2">Tipo de Plato</label>
            <div class="col-lg-4 col-md-4">
              <select name="seccion" id="seccion" required>
                <option value="">Seleccione el Tipo de Plato</option>
                <?php
                foreach ($tipos as $tipo) { ?>
                  <option value="<?php echo $tipo['id_seccion']; ?>"><?php echo $tipo['nombre_seccion']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <label for="costo0" class="control-label col-lg-2  col-md-2">Precio Venta</label>
            <div class="col-lg-4 col-md-4">
              <input type="number" min='0' class="form-control" id="costo" name="venta" required maxlength="12">
            </div>
          </div>
          <div class="form-group">
            <label for="impto" class="control-label col-lg-2  col-md-2">Impuesto</label>
            <div class="col-lg-4 col-md-4">
              <select name="impto" id="impto" required>
                <option value="">Seleccione el Impuesto</option>
                <?php
                  foreach ($imptos as $impto) { ?>
                    <option value="<?php echo $impto['id_cargo']; ?>"><?php echo $impto['descripcion_cargo']; ?></option>
                  <?php
                  }
                ?>
              </select>
            </div>
            <label for="tipo" class="control-label col-lg-2  col-md-2">Tipo</label>
            <div class="col-lg-4 col-md-4" style="font-size:12px">
              <label class="radio-inline">
                <input onclick="activaSelecReceta(0)" type="radio" name="tipo" id="tipo" value="0"> Servicio
              </label>
              <label class="radio-inline">
                <input onclick="activaSelecReceta(1)" type="radio" name="tipo" id="tipo" value="1"> Producto
              </label>
              <label class="radio-inline">
                <input onclick="activaSelecReceta(2)" type="radio" name="tipo" id="tipo" value="2"> Receta
              </label>
            </div>
          </div>
          <div class="form-group" id="receta" name="receta" style="display:none">
            <label id="labelReceta" class="control-label col-lg-2  col-md-2"></label>
            <div class="col-lg-4 col-md-4">
              <select name="idrecetaAdi" id="idrecetaAdi" value="0">
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Datos</button>
          <div class="btn-group">
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="dataUpdateProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualidarDatosProducto" class="form-horizontal" action="javascript:actualizaProducto()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="exampleModalLabel"> Modificar Producto</h4>
        </div>
        <div class="modal-body" id="traeProducto">
          <div id="datos_ajax"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar datos</button>
          <div class="btn-group">
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="dataDeleteProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminarDatosProducto" action="javascript:eliminaProducto()">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h2 class="modal-title" id="exampleModalLabel"> Modificar Producto</h2>
        </div>
        <div class="modal-body">
          <input type="hidden" id="idproducto" name="idproducto">
          <h3 class="text-center text-muted" style="color:#880505;font-weight:bold">Estas seguro?</h3>
          <p class="lead text-muted text-center"
            style="display: block;margin:10px">Esta acción eliminará de forma permanente los Datos del Producto.
          <h4 align="center">Desea continuar?</h4>
          </p>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-trash-o"></i> Eliminar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="dataRecetaProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualidarDatosProducto" class="form-horizontal" action="javascript:actualizaProducto()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <input type="hidden" name="idReceta" id="idReceta">
          <input type="hidden" name="nomReceta" id="nomReceta">
          <h3 style="color:brown" class="modal-title tituloPagina" id="exampleModalLabel"> Receta Estandar</h3>
        </div>
        <div class="modal-body" id="traeReceta">
          <div id="datos_ajax"></div>
        </div>
        <div class="modal-footer">
          <div class="btn-group" id='btnRecetas'>
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar datos</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="modalAdicionaProductoReceta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosProducto" class="form-horizontal" action="javascript:guardarMateriaPrima()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off"></span></button>
          <h3 class="modal-title tituloPagina" id="exampleModalLabel"><span class="fa fa-cube"></span> Adicionar Materia Prima</h3>
          <h3 style="margin:10px" id="exampleModalLabel">Adicionar Materia Prima</h3>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div class="form-group">
            <label for="productoRec" class="control-label col-lg-2 col-md-2">Producto</label>
            <div class="col-lg-4 col-md-4">
              <select id="productoRec" name="productoRec" onblur='datosProducto(this.value)'>
              </select>
            </div>
            <label for="medidaRec" class="control-label col-lg-2 col-md-2">Medida</label>
            <div class="col-lg-4 col-md-4">
              <input type="hidden" id='idMedida' name='idMedida'>
              <input type="text" class="form-control" id="medidaRec" name="medidaRec" disabled readonly="">
            </div>
          </div>
          <div class="form-group">
            <label for="seccion" class="control-label col-lg-2 col-md-2">Cantidad</label>
            <div class="col-lg-2 col-md-2">
              <input type="text" name="cantidadRec" id="cantidadRec" min="1" onblur='actualizaPrecio()'>
            </div>
            <label for="impto" class="control-label col-lg-2  col-md-2">Valor Unitario</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min='0' class="form-control" id="valorUni" name="valorUni" required maxlength="12" disabled readonly="">
            </div>
            <label for="impto" class="control-label col-lg-2  col-md-2">Valor Total</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min='0' class="form-control" id="valorTot" name="valorTot" required maxlength="12" disabled readonly="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="saleMat()"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Datos</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="dataDeleteProductoReceta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminarDatosProducto" action="javascript:eliminaProductoReceta()">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h2 class="modal-title" id="exampleModalLabel"> Elimina Producto Receta</h2>
        </div>
        <div class="modal-body">
          <input type="hidden" id="idProductoRec" name="idProductoRec">
          <h3 class="text-center text-muted" style="color:#880505;font-weight:bold">Estas seguro?</h3>
          <p class="lead text-muted text-center"
            style="display: block;margin:10px">Esta acción eliminará de forma permanente los Datos del Producto.
          <h4 align="center">Desea continuar?</h4>
          </p>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-trash-o"></i> Eliminar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
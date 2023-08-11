<?php
$tipos = $pos->getTipoPlatos($idamb);
$imptos = $pos->getImpuestos();
?>

<div class="modal fade" id="modalAdicionaReceta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosReceta" class="form-horizontal" action="javascript:guardarReceta()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off"></span></button>
          <h3 style="margin:0;" class="modal-title w3ls_head"><span class="fa fa-cube"></span> Adicionar Recetas</h3>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body"> 
          <div class="form-group">
            <label for="receta" class="control-label col-lg-2 col-md-2">Receta</label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="receta" name="receta" required >
            </div>
            <label for="porcion" class="control-label col-lg-2 col-md-2">Porciones</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min='1' class="form-control" id="porcion" name="porcion" required >
            </div>
          </div>
          <div class="form-group">
            <label for="tipoReceta" class="control-label col-lg-2 col-md-2">Tipo de Receta</label>
            <div class="col-lg-3 col-md-3">
              <select name="tipoReceta" id="tipoReceta" required>
                <option value="">Seleccione el Tipo de Receta</option>
                <?php
                foreach ($tipos as $tipo) { ?>
                  <option value="<?php echo $tipo['id_seccion']; ?>"><?php echo $tipo['nombre_seccion']; ?></option>
                  <?php
                }
?>
              </select>
            </div>
            <label for="impto" class="control-label col-lg-2  col-md-2">Impuesto</label>
            <div class="col-lg-3 col-md-3">
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
            <label class="control-label col-md-2"><input  type="checkbox" name="subreceta" value="0"> Sub Receta</label>
          </div>
          <div class="form-group">
            <label for="vlrVenta" class="control-label col-lg-2  col-md-2">Precio Venta</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min='0' class="form-control" id="vlrVenta" name="vlrVenta" required maxlength="12"> 
            </div>
            <label for="vlrVenta" class="control-label col-lg-2  col-md-2">% Margen Error</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min='0' class="form-control" id="margen" name="margen" required maxlength="12"> 
            </div>
            <label for="costo0" class="control-label col-lg-2  col-md-2">Tiempo Coccion</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" min='1' class="form-control" id="tiempo" name="tiempo" required maxlength="12"> 
            </div>

          </div>
          <div class="form-group">
            <label for="preparacion" class="control-label col-lg-2  col-md-2">Preparacion</label>
            <div class="col-lg-10 col-md-10">
              <textarea id="preparacion" name="preparacion" id="" cols="30" rows="3"></textarea>
            </div>            
          </div>
          <div class="form-group">
            <label for="montaje" class="control-label col-lg-2  col-md-2">Montaje</label>
            <div class="col-lg-10 col-md-10">
              <textarea id="montaje" name="montaje" id="" cols="30" rows="3"></textarea>
            </div>            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button>
          <!-- <div class="btn-group">
          </div> -->
        </div>
      </div>
    </div>
  </form>
</div>
 
<div class="modal fade" id="dataUpdateReceta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualidarDatosReceta" class="form-horizontal" action="javascript:actualizaReceta()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h3 style="margin:0;" class="modal-title w3ls_head"> Modificar Producto </h3>
        </div>
        <div class="modal-body" id="traeReceta">
          <div id="datos_ajax"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
        </div>
      </div>
    </div>
  </form>
</div>
  
<div class="modal fade" id="dataDeleteReceta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminarDatosProducto" action="javascript:eliminaReceta()">
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
              style="display: block;margin:10px">Esta acción eliminará de forma permanente los Datos de la Receta.
            <h4 style="text-align:center;">Desea continuar?</h4>    
          </p>
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-trash-o"></i> Eliminar</button>
          <!-- <div class="btn-group">
          </div> -->
        </div>
      </div> 
    </div>
  </form>
</div>
 
<div class="modal fade" id="dataRecetaProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"> 
  <form id="actualidarDatosProducto" class="form-horizontal" action="">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="idReceta" id="idReceta">
          <input type="hidden" name="nomReceta" id="nomReceta">
          <h3 style="color:brown" class="modal-title tituloPagina" id="exampleModalLabel"> Receta Estandar</h3>
        </div>
        <div class="modal-body" id="traeReceta" style="padding:0;">
          <div class="container-fluid">
            <div class="panel panel-success" style="padding-bottom: 0;margin-bottom:0px;">
              <div class="panel-heading"> 
                <div class="row producto" style="display: flex;">
                  <div class="col-lg-6">
                    <h3 style="margin:0;" class="w3ls_head"> Materia Prima Receta Estandar </h3>
                  </div>
                  <div class="col-lg-6">
                    <button 
                      data-toggle="modal"  
                      type="button" class="btn btn-info pull-right" 
                      onclick="modalSubReceta()"
                      id= "btnSubReceta"
                      title="Sub Recetas - Receta Estandar"
                      ><i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar SubReceta
                    </button>
                    <button 
                      type="button" 
                      class="btn btn-success pull-right" 
                      onclick='adicionaMateriaPrima()'
                      title="Materia Prima Receta Estandar"
                      ><i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar Producto
                    </button>
                  </div>
                </div>
              </div>
              <div class="panel-body" style="padding:0px;max-height: 350px;overflow: auto;">
                <table id="materiaPrima" class="table table-bordered table-hover ">
                  <thead >
                    <tr class="warning">
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Unidad de Medida</th>
                      <th>Valor Unitario</th>
                      <th>Valor Total</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="panel-footer">
                <div class="row" style="height: 25px;">
                  <div class="col-lg-6 pull-right">
                    <table id="valorReceta">
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group" id='btnRecetas'>
            <button onclick="saleMP()" type="button" class="btn btn-warning pull-right"><i class="fa fa-reply"></i> Regresar</button>
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
              <input type="text" class="form-control" id="medidaRec" name="medidaRec" readonly="">
            </div>
          </div>
          <div class="form-group">
            <label for="seccion" class="control-label col-lg-2 col-md-2">Cantidad</label> 
            <div class="col-lg-2 col-md-2">
              <input type="text" name="cantidadRec" id="cantidadRec" min="1" onblur='actualizaPrecio()'>
            </div>
            <label for="impto" class="control-label col-lg-2  col-md-2">Valor Unitario</label>
            <div class="col-lg-2 col-md-2">
              <input type="text" min='0' class="form-control" id="valorUni" name="valorUni" required maxlength="12" disabled readonly=""> 
            </div>
            <label for="impto" class="control-label col-lg-2  col-md-2">Valor Total</label>
            <div class="col-lg-2 col-md-2">
              <input type="text" min='0' class="form-control" id="valorTot" name="valorTot" required maxlength="12" disabled readonly=""> 
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="saleMat()"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Datos</button>
          <!-- <div class="btn-group">
          </div> -->
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

<div class="modal fade" id="myModalFotoReceta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="form-horizontal" id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document"> 
        <div class="modal-content">
          <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-off"></span>
            </button> 
            <h3 class="modal-title" id="exampleModalLabel">Foto Receta Estandar</h3>
          </div>
          <div id="imprimeDeposito"></div>
          <div class="modal-body modalReservas">
            <form method="POST" name="formFotoReceta" id="formFotoReceta" style='padding:0' enctype="multipart/form-data" action='javascript:subirFoto()'>
              <div class="divs divDeposito">
                <div class="form-group">
                  <div class="container-fluid">
                    <img id="imgPreview" name="imgPreview" class="img-thumbnail" style="width:100%;margin-top:0;">
                  </div>
                </div>
                <div class="form-group">
                  <input type="hidden" name="idRecetaFoto" id="idRecetaFoto">
                  <input type="hidden" name="nombreReceta" id="nombreReceta">
                  <label for="idRecetaFoto" class="col-sm-3 control-label">Foto Receta</label>
                  <div class="col-sm-9">
                    <input type="file" name="images[]" id="imgSelect" onchange="verFoto(event)" class='form-control' accept='.jpg,.png'style="min-height: 35px" required="">
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="form-group" style="margin-top:10px;">
                  <button class="btn btn-primary pull-right"><i class="fa fa-save" aria-hidden="true"></i> Procesar</button>
                  <button type="button" class="btn btn-warning pull-right" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modalAdicionaSubReceta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarSubReceta" class="form-horizontal" action="javascript:guardaSubReceta()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off"></span></button>
          <h3 class="modal-title tituloPagina" id="exampleModalLabel"><span class="fa fa-cube"></span> Adicionar Materia Prima</h3>
          <h3 style="margin:10px" id="exampleModalLabel">Adicionar SubReceta</h3>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body" style="max-height: 400px;overflow: auto;"> 
        <table id="subRecetas" class="table table-bordered table-hover ">
          <thead >
            <tr class="warning">
              <th>SubReceta</th>
              <th>Valor</th>
              <th>Selecciona</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="saleMat()"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Datos</button>
        </div>
      </div>
    </div>
  </form>
</div>
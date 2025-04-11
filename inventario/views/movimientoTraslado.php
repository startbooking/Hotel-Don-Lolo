<?php
$hoy = date('Y-m-d');
?>

<div class="content-wrapper">
  <section class="content">
    <form id="salidaMovimientos" class="form-horizontal" style="padding :0">
      <div class="panel panel-success">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_INV ?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="salidas">
          <input type="hidden" name="Movimiento" id="Movimiento" value="3">
          <input type="hidden" name="numeroTraslado" id="numeroTraslado">
          <input type="hidden" name="numeroEntrada" id="numeroEntrada">
          <input type="hidden" name="numeroSalida" id="numeroSalida">
          <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Nuevo Traslado de Inventarios </h3>
        </div>
        <div class="panel-body">
          <div class='row'>
            <div class='col-md-6'>
              <h5 class="titulo">Datos del Traslado </h5>
              <div class='row-fluid'>
                <div class='form-group'>
                  <label class='control-label col-sm-4'>Movimiento Salida</label>
                  <div class='col-sm-8'>
                    <select class="form-control" name="tipoMovSale" id="tipoMovSale" class="form-control" onblur='asignaLocalStorage(this.name, this.value)' value="">
                      <option value="">Movimiento</option>
                      <?php
                      $tipomovis = $inven->tipoMovimientoTraslado(2);
                      foreach ($tipomovis as $tipomovi) { ?>
                        <option name="<?= $tipomovi['id_tipomovi'] ?>" value="<?= $tipomovi['id_tipomovi'] ?>"><?= $tipomovi['descripcion_tipo'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-4">Almacen</label>
                  <div class='col-sm-8'>
                    <select class="form-control" name="almacenTras" id="almacenTras" onblur='asignaLocalStorage(this.name, this.value)'>
                      <option value="">Seleccione el Almacen</option>
                      <?php
                      $bodegas = $inven->getBodegas();
                      foreach ($bodegas as $bodega) { ?>
                        <option name="<?= $bodega['id_bodega'] ?>" value="<?= $bodega['id_bodega'] ?>"><?= $bodega['descripcion_bodega'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-4'>Movimiento Entrada</label>
                  <div class='col-sm-8'>
                    <select class="form-control" name="tipoMovEntr" id="tipoMovEntr" class="form-control" onblur='asignaLocalStorage(this.name, this.value)' value="">
                      <option value="">Movimiento</option>
                      <?php
                      $tipomovis = $inven->tipoMovimientoTraslado(1);
                      foreach ($tipomovis as $tipomovi) { ?>
                        <option name="<?= $tipomovi['id_tipomovi'] ?>" value="<?= $tipomovi['id_tipomovi'] ?>"><?= $tipomovi['descripcion_tipo'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-4'>Destino Traslado</label>
                  <div class='col-sm-8'>
                    <select class="form-control" name="destinoTras" id="destinoTras" onblur='asignaLocalStorage(this.name, this.value)'>
                      <option value="">Seleccione el Destino</option>
                      <?php
                      $bodegas = $inven->getBodegas();
                      foreach ($bodegas as $bodega) { ?>
                        <option name="<?= $bodega['id_bodega'] ?>" value="<?= $bodega['id_bodega'] ?>"><?= $bodega['descripcion_bodega'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-4'> Fecha</label>
                  <div class='col-sm-4' style="padding-right: 0">
                    <input type="date" style="line-height: 15px;" class="form-control" id="fechaTras" name="fechaTras" value="<?= $hoy ?>" max="<?= $hoy ?>" autocomplete="off" required onblur='asignaLocalStorage(this.name, this.value)'>
                  </div>
                </div>
              </div>
            </div>
            <div class='col-md-6'>
              <h5 class="titulo">Articulo</h5>
              <div class='row-fluid'>
                <div class="form-group">
                  <label class='control-label col-sm-2'>Producto</label>
                  <input type="hidden" id='codigo'>
                  <input type="hidden" id='descripcion'>
                  <input type="hidden" id='unitario'>
                  <input type="hidden" id='subtotal'>
                  <input type="hidden" id='impto'>
                  <input type="hidden" id='total'>
                  <input type="hidden" id='unidadcom'>
                  <input type="hidden" id='unidadalm'>
                  <input type="hidden" id='desunidad'>
                  <input type="hidden" id='codimpto'>
                  <input type="hidden" id='desimpto'>

                  <div class="col-sm-6">
                    <select name="producto" id="producto" class="form-control" onblur='buscaProductoSalida(this.value)' required="">
                      <option value="">Producto</option>
                      <?php
                      $productos = $inven->getProductos();
                      foreach ($productos as $producto) { ?>
                        <option value="<?= $producto['id_producto']; ?>"><?= $producto['nombre_producto'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-2'>Unidad</label>
                  <div class="col-sm-6">
                    <select name="unidad" id="unidad" class="form-control" readonly disabled>
                      <option value=" ">Unidad de Almacenamiento</option>
                      <?php
                      $unidades = $admin->getUnidadesMedida();
                      foreach ($unidades as $unidad) { ?>
                        <option id="unidades" name="unidades" value="<?= $unidad['id_unidad'] ?>"><?= $unidad['descripcion_unidad'] ?></option>

                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-2'> Cantidad:</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control pull-right" id="cantidad" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" onblur="activa_botones_mov();" required="">
                  </div>
                  <label class='control-label col-sm-2'> Valor </label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="costo" name="costo" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" required="">
                  </div>
                </div>
                <div class='btn-group btn-block' style="margin-top:8px">
                  <div class="container-fluid">
                    <div class="btn-group">

                    </div>
                    <div class="col-sm-6">
                      <button class='btn btn-primary btn-block' type='button' onclick='agregaListaTraslado();' id='btn-add-article' disabled><i class='fa fa-download'></i> Agregar</button>
                    </div>
                    <!-- <div class="col-sm-6">
                      <button class='btn btn-danger btn-block' type='button' onclick='cancelaTraslado();' id='btn-cancel-article' disabled><i class='fa fa-times'></i> Cancelar</button>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row-fluid" style="margin-bottom:5px;padding-top:20px;">
            <div class='box box-success'></div>
            <div class='row-fluid'>
              <table id='tablaArticulos' class='table table-bordered'>
                <thead>
                  <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Unidad</th>
                    <th>Cantidad</th>
                    <th>Valor Unit</th>
                    <th>Valor Total</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
            <input type='hidden' id='num_salida2' value='0'>
          </div>
        </div>
        <div class="panel-footer" role="document">
          <div class="row">
            <div class='col-lg-8'>
              <div class='input-group'>
                <span class='input-group-addon bg-blue'> Total Movimiento:</span>
                <input type="text" class="form-control pull-right" id="net" value='' style="font-size:16px; text-align:right; font-weight: bold;" disabled>
                <span class='input-group-addon bg-blue'> Articulos:</span>
                <input type="text" class="form-control pull-right" id="arts" value='' style="font-size:16px; text-align:right; font-weight: bold;" disabled>
              </div>
            </div>
            <div class='col-lg-4'>
              <div class='btn-group pull-right'>
                <button class='btn btn-warning' type='button' onclick='cancelaTraslado();' id='btn-cancela'><i class='fa fa-times'></i> Cancelar Traslado</button>
                <button class='btn btn-primary' type='button' onclick='procesaTraslado();' id='btn-procesa' disabled><i class='fa fa-external-link'></i> Procesar Traslado</button>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="panel-footer">
          <div class="row">
            <div class='col-lg-8'>
              <div class='input-group'>
                <span class='input-group-addon bg-blue'> Total Movimiento:</span>
                <input type="text" class="form-control pull-right" id="net" value='' style="font-size:16px; text-align:right; font-weight: bold;" disabled>
                <span class='input-group-addon bg-blue'> Impuesto</span>
                <input type="text" class="form-control pull-right" id="imp" value='' style="font-size:16px; text-align:right; font-weight: bold;" disabled>
                <span class='input-group-addon bg-blue'> Articulos:</span>
                <input type="text" class="form-control pull-right" id="arts" value='' style="font-size:16px; text-align:right; font-weight: bold;" disabled>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="btn-group pull-right">
                <button class='btn btn-warning' type='button' onclick='cancelaEntrada();' id='btn-cancela'><i class='fa fa-times'></i> Cancelar Entrada</button>
                <button class='btn btn-primary' type='button' onclick='procesaEntrada(1);' id='btn-procesa' disabled><i class='fa fa-external-link'></i> Procesar entrada</button>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </form>
  </section>
</div>
<?php
$hoy = date('Y-m-d');
?>

<div class="content-wrapper">
  <section class="content">
    <form id="EntradaMovimientos" class="form-horizontal" style="padding :0">
      <div class="panel panel-success">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_INV ?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="ajustes">
          <input type="hidden" name="claseMovimientoAju" id="claseMovimientoAju" value="4">
          <input type="hidden" name="tipoMovimientoAju" id="tipoMovimientoAju">
          <input type="hidden" name="numeroMovimiento" id="numeroMovimiento">
          <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Nuevo Ajuste de Inventarios </h3>
        </div>
        <div class="panel-body" role="document">
          <div class='row'>
            <div class='col-md-6'>
              <h5 class="titulo">Datos del Ajuste </h5>
              <div class='row-fluid'>
                <div class="form-group">
                  <label class="control-label col-lg-3">Almacen</label>
                  <div class='col-sm-9'>
                    <select class="form-control" name="almacenAju" id="almacenAju" onblur='asignaLocalStorage(this.name, this.value)'>
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
                  <label class='control-label col-lg-3'>Movimiento</label>
                  <div class='col-sm-9'>
                    <select class="form-control" name="movimientoAju" id="movimientoAju" class="form-control" onblur='buscaTipoMovimiento()' value="">
                      <option value="">Movimiento</option>
                      <?php
                      $tipomovis = $inven->tipoMovimientoAjustes(1);
                      foreach ($tipomovis as $tipomovi) { ?>
                        <option name="<?= $tipomovi['id_tipomovi'] ?>" value="<?= $tipomovi['id_tipomovi'] ?>"><?= $tipomovi['descripcion_tipo'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-lg-3'> Fecha</label>
                  <div class='col-sm-6'>
                    <input type="date" style="line-height: 15px;" class="form-control" id="fechaAju" name="fechaAju" value="<?= $hoy ?>" max="<?= $hoy ?>" autocomplete="off" required onblur='asignaLocalStorage(this.name, this.value)'>
                  </div>
                </div>
              </div>
            </div>
            <div class='col-md-6'>
              <h5 class="titulo">Articulo</h5>
              <div class='row-fluid'>
                <div class="form-group">
                  <label class='control-label col-sm-3'>Producto</label>
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
                  <label class='control-label col-sm-3'>Unidad</label>
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
                  <label class='control-label col-sm-3'> Cantidad:</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control pull-right" id="cantidad" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" onblur="activa_botones_mov();" required="">
                  </div>
                  <label class='control-label col-sm-3'> Valor </label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="costo" name="costo" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" required="">
                  </div>
                </div>
                <div class='btn-group btn-block' style="margin-top:8px">
                  <div class="container-fluid">
                    <div class="btn-group pull-right">
                      <button class='btn btn-primary' type='button' onclick='agregaListaAjuste();' id='btn-add-article' disabled><i class='fa fa-download'></i> Agregar</button>
                      <button class='btn btn-danger' type='button' onclick='cancelaAdd();' id='btn-cancel-article' disabled><i class='fa fa-times'></i> Cancelar</button>
                    </div>
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
                <tbody>

                </tbody>
              </table>
            </div>
            <input type='hidden' id='num_entrada2' value='0'>
          </div>
        </div>
        <div class="panel-footer">
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
              <div class="btn-group pull-right">
                <button class='btn btn-warning' type='button' onclick='cancelaAjuste();' id='btn-cancela'><i class='fa fa-times'></i> Cancelar Ajuste</button>
                <button class='btn btn-primary' type='button' onclick='procesaAjuste(4);' id='btn-procesa' disabled><i class='fa fa-external-link'></i> Procesar Ajuste</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
</div>
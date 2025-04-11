<?php
$hoy = date('Y-m-d');
?>

<div class="content-wrapper">
  <section class="content">
    <form id="EntradaMovimientos" class="form-horizontal" style="padding :0">
      <div class="panel panel-success">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_INV ?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="entradas">
          <input type="hidden" name="Movimiento" id="Movimiento" value="1">
          <input type="hidden" name="numeroMovimiento" id="numeroMovimiento">
          <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Importar Archivo XML </h3>
        </div>
        <div class="panel-body" role="document">
          <div class='row'>
            <div class='col-md-6'>
              <h5 class="titulo">Datos de la Entrada </h5>
              <div class="row-fluid">
                <div class="form-group">
                  <label class="control-label col-lg-3">Archivo XML</label>
                  <div class='col-sm-9'>
                    <input type="file" style="line-height: 15px;" class="form-control" id="archivoxml" name="archivoxml" accept=".xml" onblur="abreXML()">
                  </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-lg-3'>Movimiento</label>
                  <div class='col-sm-9'>
                    <select class="form-control" name="tipoMov" id="tipoMov" class="form-control" onblur='asignaLocalStorage(this.name, this.value)' value="">
                      <option value="">Movimiento</option>
                      <?php
                      $tipomovis = $inven->tipoMovimiento(1);
                      foreach ($tipomovis as $tipomovi) { ?>
                        <option name="<?= $tipomovi['id_tipomovi'] ?>" value="<?= $tipomovi['id_tipomovi'] ?>"><?= $tipomovi['descripcion_tipo'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-lg-3'>Proveedor</label>
                  <div class='col-sm-9'>
                    <select class="form-control" name="proveedor" id="proveedor" class="form-control" onblur='asignaLocalStorage(this.name, this.value)'>
                      <option value="">Proveedor</option>
                      <?php
                      $proveeds = $inven->getProveedores();
                      foreach ($proveeds as $proveed) { ?>
                        <option name="<?= $proveed['id_compania'] ?>" value="<?= $proveed['id_compania'] ?>"><?= $proveed['empresa'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-lg-3'> Fecha</label>
                  <div class='col-sm-4'>
                    <input type="date" style="line-height: 15px;" class="form-control" id="fecha" name="fecha" value="<?= $hoy ?>" max="<?= $hoy ?>" autocomplete="off" required onblur='asignaLocalStorage(this.name, this.value)'>
                  </div>

                  <label class='control-label col-lg-2'>Documento </label>
                  <div class='col-sm-3'>
                    <input type="text" class="form-control" id="factura" name="factura" required="" onblur='asignaLocalStorage(this.name, this.value)'>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class='col-md-6'>
              <h5 class="titulo">Articulo</h5>
              <div class='row-fluid'>
                <div class="form-group">
                  <label class='control-label col-lg-3'>Producto</label>
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

                  <div class="col-lg-9">
                    <select name="producto" id="producto" class="form-control" onblur='buscaProducto(this.value)' required="">
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
                <div class="form-group">
                  <input type="hidden" id='porcentajeImpto' name='porcentajeImpto'>
                  <label class='control-label col-lg-3'>Impuesto</label>
                  <div class="col-lg-6">
                    <select name="impuesto" id="impuesto" class="form-control" onblur="buscaImpto(this.value)" required="">
                      <?php
                      $imptos = $admin->getCodigosVentas(2);
                      foreach ($imptos as $impto) { ?>
                        <option name="<?= $impto['porcentaje_impto'] ?>" value="<?= $impto['id_cargo'] ?>"><?= $impto['descripcion_cargo'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="checkbox col-lg-3">
                    <label style="margin-top:-5px">
                      <input type="checkbox" id='incluido' name='incluido'> Incluido
                    </label>
                  </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-lg-3'>Unidad</label>
                  <div class="col-lg-6">
                    <select name="unidad" id="unidad" class="form-control">
                      <option value=" ">Unidad de Compra</option>
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
                  <label class='control-label col-lg-3'> Cantidad:</label>
                  <div class="col-lg-3">
                    <input type="number" class="form-control pull-right" id="cantidad" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" onchange="activa_botones_mov();" required="">
                  </div>
                  <label class='control-label col-lg-3'> Valor </label>
                  <div class="col-lg-3">
                    <input type="number" class="form-control" id="costo" name="costo" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" required="">
                  </div>
                </div>
                <div class="row-fluid">
                  <div class='btn-group pull-right' style="margin-top:8px">
                    <button class='btn btn-primary' type='button' onclick='agregaLista();' id='btn-add-article' disabled><i class='fa fa-download'></i> Agregar</button>
                    <button class='btn btn-danger' type='button' onclick='cancelaAdd();' id='btn-cancel-article' disabled><i class='fa fa-times'></i> Cancelar</button>
                  </div>
                </div>
              </div>
            </div> -->
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
                    <th>SubTotal</th>
                    <th>Tipo Impto</th>
                    <th>Impuesto</th>
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
        </div>
      </div>
    </form>
  </section>
</div>
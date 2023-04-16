<?php 
  $hoy = date('Y-m-d');
 ?>

<div class="content-wrapper"> 
  <section class="content">
    <form id="salidaMovimientos" class="form-horizontal" style="padding :0">
      <div class="panel panel-success">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_INV?>">                
          <input type="hidden" name="ubicacion" id="ubicacion" value="pedidos">
          <input type="hidden" name="Movimiento" id="Movimiento" value="2">
          <input type="hidden" name="numeroMovimiento" id="numeroMovimiento">
          <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Nuevo Pedido </h3>
        </div>
        <div class="panel-body">
          <div class='row'>
            <div class='col-md-6'>
              <h5 class="titulo">Datos del Pedido </h5>
              <div class='row-fluid'>
                <div class="form-group">
                  <label class="control-label col-sm-4">Almacen</label>
                  <div class='col-sm-8'>
                    <select class="form-control" name="almacenPed" id="almacenPed" onblur='asignaLocalStorage(this.name, this.value)' required>
                      <option value="">Seleccione el Almacen</option>
                      <?php 
                        $bodegas = $inven->getBodegas();
                        foreach ($bodegas as $bodega) { ?> 
                          <option name="<?=$bodega['id_bodega']?>" value="<?=$bodega['id_bodega']?>"><?=$bodega['descripcion_bodega']?></option>
                          <?php 
                        }
                      ?>
                    </select>
                  </div>
                </div>     
                <div class="form-group">
                  <label class="control-label col-sm-4">Proveedor</label>
                  <div class='col-sm-8'>
                    <select class="form-control" name="proveedorPed" id="proveedorPed" onblur='asignaLocalStorage(this.name, this.value)' required>
                      <option value="">Seleccione el Proveedor</option>
                      <?php 
                        $proveedores = $inven->getProveedores();
                        foreach ($proveedores as $proveedor) { ?> 
                          <option name="<?=$proveedor['id_compania']?>" value="<?=$proveedor['id_compania']?>"><?=$proveedor['empresa']?></option>
                          <?php 
                        }
                      ?>
                    </select>
                  </div>
                </div>                        
                <div class='form-group'>
                  <label class='control-label col-sm-4'> Fecha</label>
                  <div class='col-sm-6'>
                    <input type="date" style="line-height: 15px;" class="form-control" id="fechaPed" name="fechaPed" max="<?=$hoy?>" value="<?=$hoy?>" autocomplete="off" required onblur='asignaLocalStorage(this.name, this.value)'>
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

                  <div class="col-sm-9">
                    <select name="producto" id="producto" class="form-control" onblur='buscaProductoPed(this.value)' required="">
                      <option value="">Producto</option>
                      <?php 
                        $productos = $inven->getProductos(); 
                        foreach ($productos as $producto) { ?> 
                          <option value="<?=$producto['id_producto'];?>"><?=$producto['nombre_producto']?></option>
                          <?php 
                        }
                      ?>
                    </select>                        
                  </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-3'>Unidad</label>
                  <div class="col-sm-6">
                    <select name="unidad" id="unidad" class="form-control">
                      <option value=" ">Unidad de Compra</option>
                      <?php 
                        $unidades = $admin->getUnidadesMedida();
                        foreach ($unidades as $unidad) { ?> 
                          <option id="unidades" name="unidades" value="<?=$unidad['id_unidad']?>"><?=$unidad['descripcion_unidad']?></option>

                          <?php 
                        }
                        ?>
                    </select>
                  </div>
                </div>
                <div class='form-group'>
                  <label class='control-label col-sm-3'> Cantidad:</label>
                  <div class="col-sm-3">
                    <input type="text" 
                    class="form-control pull-right" id="cantidad"
                    data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" onblur="activa_botones_mov();" required="">
                  </div>
                  <label class='control-label col-sm-3'> Valor </label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="costo" name="costo" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" required="" 
                     >    
                  </div>
                </div>
                <div class="row-fluid" style="margin-top:15px">
                  <div class='btn-group pull-right' >
                    <button class='btn btn-primary' type='button' onclick='agregaListaPed();' id='btn-add-article' disabled><i class='fa fa-download'></i> Agregar</button>
                    <button class='btn btn-danger' type='button' onclick='cancelaAdd();' id='btn-cancel-article' disabled><i class='fa fa-times'></i> Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row-fluid" style="margin-bottom:5px;padding-top:20px;">                
            <div class='box box-success'>
              <div class='box-body table-responsice no-padding'>
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
            </div>
            <input type='hidden' id='num_salida2' value='0'>
          </div>
        </div>

        <div class="panel-footer">
          <div class="modal-footer">
            <div class="row-fluid">
              <div class='col-lg-6'>
                <div class='input-group pull-right'>
                  <span class='input-group-addon bg-blue'> Total Movimiento:</span>
                  <input type="text" 
                    class="form-control pull-right" 
                    id="net" 
                    value=''
                    style="font-size:16px; text-align:right; font-weight: bold;" disabled>
                </div>
              </div>
              <div class='col-lg-6'>
                <div class="btn-group pull-roght">
                  <button class='btn btn-warning btn-md' type='button' onclick='cancelaPed();' id='btn-cancela'><i class='fa fa-times'></i> Cancelar Pedido</button>
                  <button class='btn btn-primary btn-md' type='button' onclick='procesaPed();' id='btn-procesa' disabled><i class='fa fa-external-link'></i> Guardar Pedido</button>
                </div>
              </div>
            </div>       
          </div>
        </div>
      </div>
    </form>
  </section>
</div>




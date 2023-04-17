<?php 
  $hoy = date('Y-m-d');
 ?>

<div class="content-wrapper"> 
  <section class="content">
    <form id="salidaMovimientos" class="form-horizontal" style="padding:0px;">
      <div class="panel panel-success">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_INV?>">                
          <input type="hidden" name="ubicacion" id="ubicacion" value="requisicionesi">
          <input type="hidden" name="Movimiento" id="Movimiento" value="2">
          <input type="hidden" name="numeroMovimiento" id="numeroMovimiento">
          <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Nueva Requisicion </h3>
        </div>  
        <div class="panel-body" role="document">
          <div class='row'>
            <div class='col-md-6'>
              <h5 class="titulo">Datos de la Requisicion </h5>
              <div class='row-fluid'>
                <div class='form-group'>
                  <label class='control-label col-sm-3' >Centro de Costo</label>
                  <div class='col-sm-9'>
                    <select class="form-control" name="centroCostoReq" id="centroCostoReq" class="form-control" onblur='asignaLocalStorage(this.name, this.value)'>
                      <option value="">CENTRO DE COSTOS</option>
                      <?php 
                        $centros = $inven->getCentroCosto();
                        foreach ($centros as $centro) { ?> 
                          <option name="<?=$centro['id_centrocosto']?>" value="<?=$centro['id_centrocosto']?>"><?=$centro['descripcion_centro']?></option>
                          <?php 
                        }
                      ?>
                    </select>                          
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3">Almacen</label>
                  <div class='col-sm-9'>
                    <select class="form-control" name="almacenReq" id="almacenReq" onblur='asignaLocalStorage(this.name, this.value)'>
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
                <div class='form-group'>
                  <label class='control-label col-sm-3'> Fecha</label>
                  <div class='col-sm-6'>
                    <input type="date" style="line-height: 15px;" class="form-control" id="fechaReq" name="fechaReq" max="<?=$hoy?>" value="<?=$hoy?>" autocomplete="off" required onblur='asignaLocalStorage(this.name, this.value)'>
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
                    <select name="producto" id="producto" class="form-control" onblur='buscaProductoReq(this.value)'>
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
                    <select name="unidad" id="unidad" class="form-control" readonly disabled>
                      <option value=" ">Unidad de Almacenamiento</option>
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
                    data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" onblur="activa_botones_mov();" >
                  </div>
                  <label class='control-label col-sm-3'> Valor </label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="costo" name="costo" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">    
                  </div>
                </div>
                <div class='btn-group pull-right' style="margin-top:8px">
                  <button class='btn btn-primary' type='button' onclick='agregaListaReq();' id='btn-add-article' disabled><i class='fa fa-download'></i> Agregar</button>
                  <button class='btn btn-danger' type='button' onclick='cancelaReq();' id='btn-cancel-article' disabled><i class='fa fa-times'></i> Cancelar</button>
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
          </div>
          <input type='hidden' id='num_salida2' value='0'>
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class='col-lg-6'>
              <div class='input-group'>
                <span class='input-group-addon bg-blue'> Total Movimiento:</span>
                <input type="text" 
                  class="form-control pull-right" 
                  id="net" 
                  value=''
                  style="font-size:16px; text-align:right; font-weight: bold;" disabled>
              </div>
            </div>
            <div class='col-lg-6'>
              <div class="btn-group pull-right">                
                <button class='btn btn-warning' type='button' onclick='cancelaReq();' id='btn-cancela'><i class='fa fa-times'></i> Cancelar Requisicion</button>
                <button class='btn btn-primary' type='button' onclick='procesaReq();' id='btn-procesa' disabled><i class='fa fa-external-link'></i> Guardar Requisicion</button>
              </div>
            </div>
          </div>       
        </div>
      </div>
    </form>
  </section>
</div>




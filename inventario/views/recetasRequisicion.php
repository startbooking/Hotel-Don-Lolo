<?php
$hoy = date('Y-m-d');
?>

<div class="content-wrapper"> 
  <section class="content">
    <form id="salidaMovimientos" class="form-horizontal" style="padding :0">
      <div class="panel panel-success">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_INV; ?>">                
          <input type="hidden" name="ubicacion" id="ubicacion" value="requisiciones">
          <input type="hidden" name="Movimiento" id="Movimiento" value="2">
          <input type="hidden" name="numeroMovimiento" id="numeroMovimiento">
          <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Nueva Requisicion Recetas</h3>
        </div>
        <div class="row-fluid" role="document">
          <div class="panel-body">
            <div class='row'>
              <div class='col-md-6 col-xs-12'>
                <h5 class="titulo">Datos de la Requisicion </h5>
                <div class='row-fluid'>
                  <div class='form-group'>
                    <label class='control-label col-sm-3' >Centro de Costo</label>
                    <div class='col-sm-9'>
                      <select class="form-control" name="centroCostoRecReq" id="centroCostoRecReq" class="form-control" onblur='asignaLocalStorage(this.name, this.value)'>
                        <option value=" ">Centro de Costo</option>
                        <?php
                         $centros = $inven->getCentroCosto();
foreach ($centros as $centro) { ?> 
                            <option name="<?php echo $centro['id_centrocosto']; ?>" value="<?php echo $centro['id_centrocosto']; ?>"><?php echo $centro['descripcion_centro']; ?></option>
                            <?php
}
?>
                      </select>                          
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3">Almacen</label>
                    <div class='col-sm-9'>
                      <select class="form-control" name="almacenRecReq" id="almacenRecReq" onblur='asignaLocalStorage(this.name, this.value)'>
                        <option value=" ">Seleccione el Almacen</option>
                        <?php
  $bodegas = $inven->getBodegas();
foreach ($bodegas as $bodega) { ?> 
                            <option name="<?php echo $bodega['id_bodega']; ?>" value="<?php echo $bodega['id_bodega']; ?>"><?php echo $bodega['descripcion_bodega']; ?></option>
                            <?php
}
?>
                      </select>
                    </div>
                  </div>                        
                  <div class='form-group'>
                    <label class='control-label col-sm-3'> Fecha</label>
                    <div class='col-sm-6'>
                      <input type="date" style="line-height: 15px;" class="form-control" id="fechaRecReq" name="fechaRecReq" max="<?php echo $hoy; ?>" value="<?php echo $hoy; ?>" autocomplete="off" required onblur='asignaLocalStorage(this.name, this.value)'>
                    </div>
                  </div>
                </div>
              </div>
              <div class='col-md-6'>
                <h5 class="titulo">Articulo</h5>
                <div class='row-fluid'>
                  <div class="form-group">
                    <label class='control-label col-sm-3'>Receta</label>
                    <input type="hidden" id='codigo'> 
                    <input type="hidden" id='descripcion'> 
                    <input type="hidden" id='unitario'> 
                    <input type="hidden" id='subtotal'> 
                    <input type="hidden" id='impto'> 
                    <input type="hidden" id='total'> 
                    <input type="hidden" id='desunidad'> 
                    <input type="hidden" id='codimpto'> 
                    <input type="hidden" id='desimpto'> 

                    <div class="col-sm-9">
                      <select name="producto" id="producto" class="form-control" onblur='buscaRecetaReq(this.value)' required="">
                        <option value="">Receta Estandar</option>
                        <?php
  $productos = $inven->getRecetas();
foreach ($productos as $producto) { ?> 
                            <option value="<?php echo $producto['id_receta']; ?>"><?php echo $producto['nombre_receta']; ?></option>
                            <?php
}
?>
                      </select>                        
                    </div>
                  </div>
                  <div class='form-group'>
                    <label class='control-label col-sm-3'> Porciones:</label>
                    <div class="col-sm-3">
                      <input type="text" 
                      class="form-control pull-right" id="porciones" name="porciones"
                      data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" readonly="">
                    </div>
                    <label class='control-label col-sm-3'> Valor Receta </label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="costo" name="costo" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" required="" 
                       >    
                    </div>
                  </div>
                  <div class='form-group'>
                    <label class='control-label col-sm-3'> Cantidad:</label>
                    <div class="col-sm-3">
                      <input type="text" 
                      class="form-control pull-right" id="cantidad"
                      data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" onblur="activa_botones_mov();" required="">
                    </div>
                  </div>
                  <div class="container-fluid" style="margin-top:8px;">
                    <div class="btn-group pull-right">
                      <button class='btn btn-primary' type='button' onclick='agregaListaRecReq();' id='btn-add-article' disabled><i class='fa fa-download'></i> Agregar</button>
                      <button class='btn btn-danger' type='button' onclick='cancelaRecReq();' id='btn-cancel-article' disabled><i class='fa fa-times'></i> Cancelar</button>                          
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row-fluid" style="margin-bottom:5px;padding-top:15px;">                
              <div class='box box-success'></div>
              <div class='row-fluid'>
                <table id='tablaArticulos' class='table table-bordered'>
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Receta</th>
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
              <div class='col-md-6 col-xs-12'>
                <div class='input-group' >
                  <span class='input-group-addon bg-blue'> Total Movimiento:</span>
                  <input type="text" 
                    class="form-control pull-right" 
                    id="net" 
                    value=''
                    style="font-size:16px; text-align:right; font-weight: bold;" disabled>
                </div>
              </div>
              <div class='col-md-6 col-xs-12'>
                <button class='btn btn-warning' type='button' onclick='cancelaRecReq();' id='btn-cancela'><i class='fa fa-times'></i> Cancelar Requisicion</button>
                <button class='btn btn-primary' type='button' onclick='procesaRecReq();' id='btn-procesa' disabled><i class='fa fa-external-link'></i> Guardar Requisicion</button>
                <!-- <div class="btn group pull-right">
                </div> -->
              </div>
            </div>       
          </div>
        </div>
      </div>
    </form>
  </section>
</div>




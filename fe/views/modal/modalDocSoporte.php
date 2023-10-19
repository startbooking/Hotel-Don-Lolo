<?php 
$productos   = $user->getCodigosVentas(4);
$retenciones = $user->getTipoImpuestos(2);
$imptos   = $user->getTipoImpuestos(1);
$unidades = $inven->getUnidadesMedida();
  
?>

<div class="modal fade" id="myModalAdicionaItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="dataRegistraItem" class="form-horizontal" action="javascript:guardaProveedor()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="material-symbols-outlined">power_settings_new</span>  
          </button>
          <h4 class="modal-title" id="exampleModalLabel"><span class="material-symbols-outlined">library_add</span> Compras / Servicios </h4>
        </div>
        <div class="modal-body">
          <div id="mensaje" class="alert alert-warning oculto centraTitulo"></div>
          <div class="form-group row">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Compra / Servicio</label>
            <div class="col-md-6">
              <select class="form-control" name="itemcompra" id="itemcompra" onblur="infoProducto(this.value)" required>
                <option value="">Seleccione la Compra / Servicio</option>
                <?php
                  foreach ($productos as $producto) { ?>
                    <option value="<?php echo $producto['id_cargo']; ?>"><?php echo $producto['descripcion_cargo']; ?></option>
                    <?php
                  }
                ?> 
              </select>
            </div>
            <label for="nombre" class="control-label col-lg-1 col-md-1">Unidad</label>
            <div class="col-md-3">
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
          </div>
          <div class="form-group row">                             
            <label class="control-label col-lg-2 col-md-2">Valor Unitario</label>
            <div class="col-md-2">
              <input type="number" min="1" class="form-control" id="precio" name="precio" required value="0" min="1">
            </div>
            <label for="nombre" class="control-label col-lg-2 col-md-2">Cantidad</label>
            <div class="col-md-2">
              <input type="number" min="1" class="form-control" id="cantidad" name="cantidad" required value="0" min="1" onblur="calculaTotal()">
            </div>
            <label class="control-label col-lg-2 col-md-2">Valor Unitario</label>
            <div class="col-md-2">
              <input type="number" min="1" class="form-control" id="total" name="total" required value="0" min="1">
            </div>
          </div>
          <div class="form-group row">
            <label for="nombre" class="control-label col-lg-2 col-md-2">Impuesto</label>
            <div class="col-lg-4 col-md-4">
              <select class="form-control" name="imptos" id="imptos" required="">
                <option value="">Seleccione el Impuesto</option>
                <?php 
                foreach ($imptos as $impto) { ?> 
                <option value="<?=$impto['id_cargo']?>"><?=$impto['descripcion_cargo']?></option>
                <?php 
                }
                ?>
              </select>
            </div>                             
            <label class="control-label col-lg-2 col-md-2">Retencion</label>
            <div class="col-md-4">
              <select class="form-control" name="retencion" id="retencion">
                <option value="">Seleccione la Retencion a Aplicar</option>
                <?php
                  foreach ($retenciones as $producto) { ?>
                    <option value="<?php echo $producto['id_cargo']; ?>"><?php echo $producto['descripcion_cargo']; ?></option>
                    <?php
                  }
                ?>
              </select>                
            </div>							
          </div>
          <div class="form-group row">
            <a href="#myModalProductos" 
            data-edita="0"
            data-documento='1'
            data-toggle="modal" 
            class="linkItem control-label col-lg-6 col-md-6">Adicionar Nuevo Compra / Servicio </a>            
          </div>
          <!-- <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Nuevo Ítem</h4>
          </div>
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">					
              </div>                
            </div>
          </div> -->
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



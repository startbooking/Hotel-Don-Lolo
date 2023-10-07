<div class="modal fade" id="myModalAdicionaItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="dataRegistrarProveedor" class="form-horizontal" action="javascript:guardaProveedor()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="material-symbols-outlined">power_settings_new</span>  
          </button>
          <h4 class="modal-title" id="exampleModalLabel"><span class="material-symbols-outlined">library_add</span> Agregar Item / Producto</h4>
        </div>
        <div class="modal-body">
          <div class="card-body">
            <div id="datos_ajax"></div>
            <div class="form-group row">
              <label for="nombre" class="control-label col-lg-1 col-md-1">Item</label>
              <div class="col-md-4">
                <select class="form-control" name="" id="">
                  <option value=""></option>
                </select>
              </div>						
              <label for="nombre" class="control-label col-lg-2 col-md-2">Cantidad</label>
              <div class="col-md-2">
                <input type="number" min="1" class="form-control" id="cantidad" name="cantidad" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="nombre" class="control-label col-lg-1 col-md-1">Unidad</label>
              <div class="col-md-2">
                <select class="form-control" name="" id="">
                  <option value=""></option>
                </select>
              </div>                    
              <label class="control-label col-lg-2 col-md-2">Valor Unitario</label>
              <div class="col-md-2">
                <input type="number" min="1" class="form-control" id="precio" name="precio" required>
              </div>
              <label class="control-label col-lg-2 col-md-2">Retencion</label>
              <div class="col-md-3">
                <select class="form-control" name="" id="">
                  <option value=""></option>
                </select>                
              </div>							
            </div>
            <div class="form-group row">
              <a href="#myModalAdicionarCodigoVentas" data-toggle="modal" class="control-label col-lg-3 col-md-3">Adicionar Nuevo Item</a>
              <!-- <a 
                data-toggle="modal" 
                style="display:inline-flex;" type="" class="" href="#myModalAdicionarCodigoVentas"
                >
                <span class="material-symbols-outlined">add_box</span> Nuevo Item / Producto </a> -->
              <!-- <a href=""><span class="material-symbols-outlined">library_add</span> Agregar Item</a> -->
              <!-- 
              <a class="nav-link" data-toggle="modal" data-target="#myModalAdicionaItem"><span class="material-symbols-outlined">library_add</span> Agregar Item</a>  
                <a href="" type="button" class="" data-dismiss="modal" aria-label="Close">
                <span class="material-symbols-outlined">add_chart</span> Nuevo Item / Producto
              </a> -->
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
          <div class="card-footer">
            <div class="row">
              <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="material-symbols-outlined">undo</span> Regresar</button>
              <button type="submit" class="btn btn-primary derechaAbs"><span class="material-symbols-outlined">save</span> Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

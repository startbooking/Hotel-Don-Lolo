<div class="content" >
  <div class="col-lg-6 col-xs-12 base">
    <form id="guardarBaseCaja" class="form-horizontal" action="javascript:guardaBase()">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="modal-title" id="exampleModalLabel">
            <span class="fa fa-money"></span> Base de Caja
          </h3>
        </div>
        <div class="panel-body">
        <div class="form-group">
          <label for="receta" class="control-label col-lg-4 col-md-4 col-xs-4">Fecha</label>
          <div class="col-lg-8 col-md-8 col-xs-8">
            <input type="date" id="fecha" value="" disabled>
          </div>
        </div>

        <div class="form-group">
            <label for="receta" class="control-label col-lg-4 col-md-4 col-xs-4">Base Caja</label>
            <div class="col-lg-8 col-md-8 col-xs-8">
              <input type="hidden" id="proveedor"  value="">
              <input type="hidden" id="naturaleza" value="1">
              <input type="hidden" id="documento"  value="">
              <input type="number" class="form-control" id="base" min="1" name="base" required >
            </div>
          </div>
          <div class="form-group">
            <label for="receta" class="control-label col-lg-4 col-md-4 col-xs-4">Concepto</label>
            <div class="col-lg-8 col-md-8 col-xs-8">
              <input type="text" class="form-control" id="concepto" name="concepto" required placeholder="Concepto " required>
            </div>
          </div>
        </div>
        <div class="panel-footer">
          <div class="container-fluid">
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-warning" onclick="javascript:enviaInicio()"><i class="fa fa-reply"></i> Regresar</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
            </div> 
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<?php
  $hoy = date('Y-m-d');
  ?> 

<div class="col-lg-6 col-xs-12 base">
  <form id="guardarBaseCaja" class="form-horizontal" action="javascript:guardaCompras()">
    <input type="hidden" id="naturaleza" value="2">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="modal-title" id="exampleModalLabel"> 
          <span class="glyphicon glyphicon-inbox"></span> Compras X Caja
        </h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label class="control-label col-lg-2 col-xs-4"for="">Fecha</label>
          <div class="col-lg-4 col-md-4 col-xs-8">
            <input style="line-height:15px;" max="<?php echo $hoy; ?>" type="date" value="" class="form-control" id="fecha" name="fecha" required >
          </div>
        <!-- </div>
        <div class="form-group"> -->
          <label class="control-label col-lg-2 col-xs-4"for="">Documento</label>
          <div class="col-lg-4 col-md-4 col-xs-8">
            <input type="text" class="form-control" id="documento" name="documento" required >
          </div>
        </div>
        <div class="form-group">
          <label for="receta" class="control-label col-lg-2 col-md-4 col-xs-4">Proveedor</label>
          <div class="col-lg-10 col-md-10 col-xs-8">
            <input type="text" class="form-control" id="proveedor" name="proveedor" required >
          </div>
        </div>
        <div class="form-group">
          <label for="receta" class="control-label col-lg-2 col-md-2 col-xs-4">Concepto</label>
          <div class="col-lg-10 col-md-10 col-xs-8">
            <input type="text" class="form-control" id="concepto" name="concepto" required placeholder="Concepto " required>
          </div>
        </div>
        <div class="form-group">
          <label for="receta" class="control-label col-lg-2 col-md-2 col-xs-4">Valor</label>
          <div class="col-lg-4 col-md-4 col-xs-8">
            <input type="number" class="form-control" id="base" name="base" required >
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <div class="container-fluid">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" onclick="javascript:enviaInicio()"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

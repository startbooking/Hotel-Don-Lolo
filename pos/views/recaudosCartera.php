<?php
  require_once '../../res/php/app_topPos.php';
  $hoy = date('Y-m-d');
  $clientes = $pos->getClientes();
  $formasdepagos = $pos->getFormasPago();

  ?>

<div class="col-lg-6 col-xs-12 base">
  <form id="guardarBaseCaja" class="form-horizontal" action="javascript:guardaCartera()">
    <input type="hidden" id="naturaleza" value="1">
    <div class="panel panel-success">
      <div class="panel-heading">
        <input type="hidden" id="facturasSele">
        <h3 class="modal-title"><span class="glyphicon glyphicon-briefcase"></span> Recaudos Cartera</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label class="control-label col-lg-3"for="">Fecha</label>
          <div class="col-lg-4 col-md-4">
            <input style="line-height:15px;" max:<?php echo $hoy; ?> type="date" value="" class="form-control" id="fecha" name="fecha" required >
          </div>
        </div>
        <div class="form-group">
          <label for="proveedor" class="control-label col-lg-3 col-md-3 col-xs-12">Cliente</label>
          <div class="col-lg-7 col-md-7 col-xs-10">
            <select name="proveedor" id="proveedor">
              <option value="">Seleccione el Cliente</option>
              <?php
                foreach ($clientes as $cliente) { ?>
                <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['apellido1'].' '.$cliente['apellido2'].' '.$cliente['nombre1'].' '.$cliente['nombre2']; ?></option>
              <?php
                }
  ?>

            </select>
          </div>
          <div class="col-lg-1 col-xs-2">
            <a
              data-toggle="modal"
              style="float: right;"
              type="button"
              class="btn btn-success btnFactura"
              onclick="javascript:traeFacturasCliente()"
            >
            <i class="fa fa-bars" aria-hidden="true"></i></a>
          </div>
        </div>
        <div class="form-group" >
          <label class="col-lg-3 col-md-3 control-label" style="padding-top:0">Forma de Pago</label>
          <div class="col-lg-8 col-md-8">
            <select name='formapago' id='formapago' required >
              <option value="">Seleccione la Forma de Pago</option>
              <?php
    foreach ($formasdepagos as $pago) {
        ?>
                  <option name="<?php echo $pago['id_pago']; ?>" value="<?php echo $pago['id_pago']; ?>"><?php echo $pago['descripcion']; ?></option>
                  <?php
    }
  ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="receta" class="control-label col-lg-3 col-md-3">Concepto</label>
          <div class="col-lg-9 col-md-9">
            <input type="text" class="form-control" id="concepto" name="concepto" required placeholder="Concepto " required>
          </div>
        </div>
        <div class="form-group">
          <label for="receta" class="control-label col-lg-3 col-md-3">Valor</label>
          <div class="col-lg-4 col-md-4">
            <input type="number" class="form-control" id="base" name="base" required readonly>
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


<div class="modal fade" id="modalFacturasCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"> 
  <form id="facturasCliente" class="form-horizontal" action="seleccionaFacturas">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off"></span></button>
          <h3 style="color:brown" class="modal-title tituloPagina" id="exampleModalLabel"> Factura Cliente</h3>
        </div>
        <div class="modal-body" name="traeFacturas" id="traeFacturas" style="padding:0;">
        </div>
        <div class="modal-footer">
          <div class="row-fluid pull-right">
            <div class="btn-group">
              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
              <button onclick="saleFacturasCartera()" type="button" class="btn btn-info"><i class="fa fa-floppy-o"></i> Confirmar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div> 




<div class="content-wrapper" id="recaudosCartera">
  <section class="content" style="position: relative;">
    <div class="col-lg-9 col-xs-12 base" style="position: absolute;top: 10%;left: 0;right:0;bottom:0;margin:auto;">
      <form id="guardarBaseCaja" class="form-horizontal" action="javascript:guardaCartera()">
        <input type="hidden" id="naturaleza" value="1">
        <div class="panel panel-success">
          <div class="panel-heading">
            <input type="hidden" id="facturasSele">
            <h3 class="modal-title"><span class="glyphicon glyphicon-briefcase"></span> Recaudos Cartera</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <label class="col-lg-3"for="">Fecha</label>
              <div class="col-lg-4 col-md-4">
                <input style="line-height:15px;" max:<?php echo FECHA_PMS; ?> type="date" value="<?php echo FECHA_PMS; ?>" class="form-control" id="fecha" name="fecha" required >
              </div>
            </div>
            <div class="form-group">
              <label for="cliente" class="col-lg-3 col-md-3 col-xs-12">Cliente</label>
              <div class="col-lg-8 col-md-8 col-xs-10">
                <select name="cliente" id="cliente" onblur="javascript:traeFacturasCliente()">
                  <option value="">Seleccione el Cliente</option>
                  <?php
                    foreach ($clientes as $cliente) { ?>
                    <option value="<?php echo $cliente['id_compania']; ?>"><?php echo substr($cliente['empresa'],0,60); ?></option>
                    <?php
                    }
                  ?>

                </select>
              </div>
              <!-- <div class="col-lg-1 col-xs-2">
                <a
                data-toggle="modal"
                style="float: right;"
                type="button"
                class="btn btn-success btnFactura"
                onclick="javascript:traeFacturasCliente()"
                >
                <i class="fa fa-bars" aria-hidden="true"></i></a>
              </div> -->
            </div>
            <div class="form-group ph-15" name="traeFacturas" id="traeFacturas" style="max-height: 250px;overflow: auto;">
              <table name="datosClienteCartera" id="dataClientes" class="table table-responsive">
                <thead>
                  <tr class="warning" style="font-weight:bold;text-align: center">
                    <td>Pagar</td>
                    <td>Factura</td>
                    <td>Fecha</td>
                    <td>Total</td>
                    <td style="width:20px"></td>
                    <td class="tl">ReteFuente</td>
                    <td style="width:20px"></td>
                    <td class="tl">ReteICA</td>
                    <td style="width:20px"></td>
                    <td class="tl">ReteIVA</td>
                    <td style="width:20px"></td>
                    <td class="tl">Comision</td>
                  </tr>
                </thead> 
                <tbody>
                </tbody>
              </table>
            </div>
            <div class="form-group" >
              <label class="col-lg-3 col-md-3" style="padding-top:0">Forma de Pago</label>
              <div class="col-lg-8 col-md-8">
                <select name='formapago' id='formapago' required >
                  <option value="">Seleccione la Forma de Pago</option>
                  <?php
                    foreach ($fpagos as $pago) {
                      ?>
                      <option name="<?php echo $pago['id_cargo']; ?>" value="<?php echo $pago['id_cargo']; ?>"><?php echo $pago['descripcion_cargo']; ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="receta" class="col-lg-3 col-md-3">Concepto</label>
              <div class="col-lg-9 col-md-9">
                <input type="text" class="form-control" id="concepto" name="concepto" required placeholder="Concepto " required>
              </div>
            </div>
            <div class="form-group">
              <label for="receta" class="col-lg-3 col-md-3">Valor</label>
              <div class="col-lg-4 col-md-4">
                <input type="number" class="form-control tr" id="totalpago" name="base" min="0" required readonly>
              </div>
            </div>
          </div>
          <div class="panel-footer">
            <div class="container-fluid">
              <div class="btn-group" style="text-align:center;">
                <button type="button" class="btn btn-warning" onclick="javascript:enviaInicio()"><i class="fa fa-reply"></i> Regresar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>


<div class="modal fade" id="modalFacturasCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"> 
  <form id="facturasCliente" class="form-horizontal" action="seleccionaFacturas">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off"></span></button>
          <h3 style="color:brown" class="modal-title tituloPagina" id="exampleModalLabel"> Factura Cliente</h3>
        </div>
        <div class="modal-body" name="traeFacturas" id="traeFacturas" style="padding:0;overflow:auto;height:350px;">
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



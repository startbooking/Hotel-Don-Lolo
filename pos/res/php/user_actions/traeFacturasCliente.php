<?php

require '../../../../res/php/app_topPos.php';

$idcliente = $_POST['idcliente'];
$idambi = $_POST['idambi'];
$facturas = $pos->getFacturasCliente($idcliente, $idambi);

$regis = count($facturas); ?>
<?php
if ($regis == 0) { ?>
  <div class="container-fluid">
    <h4 class="bg-red-gradient" style="padding:10px;text-align:center;font-size:25px;">Sin Facturas Generadas Para Este Cliente <span style="font-size:16px;font-weight: 600;font-family: 'ubuntu'"></span></h4>
  </div>
<?php
} else { ?>
  <div class="container-fluid">
    <div class="table-responsive" style="max-height:355px;">
      <table name="datosClienteCartera" id="example1" class="table table-bordered">
        <thead>
          <tr class="warning" style="font-weight: bold;text-align: center">
            <td>Factura</td>
            <td>Fecha</td>
            <td>Total</td>
            <td class="rowAsigna">Pagar</td>
          </tr>
        </thead> 
        <tbody>
          <?php
          foreach ($facturas as $factura) { ?>
            <tr style='font-size:12px'>
              <td name="nrofactura" id="nrofactura"><?php echo $factura['factura']; ?></td>
              <td name="fecha" id="fecha"><?php echo $factura['fecha']; ?></td>
              <td class="t-right" name="valor" id="valor"><?php echo number_format($factura['valor_total'], 2); ?></td>
              <td class="rowAsigna"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()">
              </td>
            </tr>
          <?php
          }
    ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="container-fluid">
    <div class="form-group">
      <label for="" class="control-label col-lg-9">Total Facturas</label>
      <div class="col-lg-3">
        <input type="hidden" id="nrofacturas">
        <input style="text-align:right;" type="text" class="form-control" name="valorFacturasSelec" id="valorFacturasSelec" readonly>
      </div>
    </div>
  </div>
<?php
}
?>
<?php

require '../../../res/php/app_topHotel.php';
$idcliente = $_POST['idcliente'];
$facturas = $hotel->getFacturasCompanias($idcliente);

echo print_r($facturas);

$regis = count($facturas); ?>
<?php
if ($regis == 0) { ?>
  <div class="container-fluid">
    <h4 class="bg-red-gradient" style="padding:10px;text-align:center;font-size:25px;">Sin Facturas Generadas Para Este Cliente <span style="font-size:16px;font-weight: 600;font-family: 'ubuntu'"></span></h4>
  </div>
  <?php
} else {
  foreach ($facturas as $factura) { ?>
    <tr style='font-size:12px'>
      <td name="nrofactura" id="nrofactura"><?php echo $factura['factura_numero']; ?></td>
      <td name="fecha" id="fecha"><?php echo $factura['fecha_factura']; ?></td>
      <td class="t-right" name="valor" id="valor"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()"></td>
      <td class="t-right" name="valor" id="valor"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()"> <?php echo number_format($factura['retefuente'], 2); ?></td>
      <td class="t-right" name="valor" id="valor"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()"></td>
      <td class="t-right" name="valor" id="valor"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()"> <?php echo number_format($factura['reteica'], 2); ?></td>
      <td class="t-right" name="valor" id="valor"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()"></td>
      <td class="t-right" name="valor" id="valor"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()"> <?php echo number_format($factura['reteiva'], 2); ?></td>
      <td class="t-right" name="valor" id="valor"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()"></td>
      <td class="t-right" name="valor" id="valor"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()"> <?php echo number_format($factura['comision'], 2); ?></td>
      <td class="t-right" name="valor" id="valor"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()"> <?php echo number_format($factura['comision'], 2); ?></td>
      <td class="rowAsigna" style="text-align:center;"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()">
      </td>
    </tr>
<?php
  }
}
?>
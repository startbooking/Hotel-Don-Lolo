<?php

require '../../../res/php/app_topHotel.php';
$idcliente = $_POST['idcliente'];
$facturas = $hotel->getFacturasCompanias($idcliente);

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
      <td class="rowAsigna b-d tc"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()">
      </td>
      <td name="nrofactura" id="nrofactura"><?php echo $factura['factura_numero']; ?></td>
      <td name="fecha" id="fecha"><?php echo $factura['fecha_factura']; ?></td>
      <td class="t-right" name="valorcta" id="valorcta"><?php echo number_format($factura['pagos_cargos'], 2); ?></td>
      <td class="t-right b-i" name="asignaret" id="asignaret">
        <input name="fuente" id="fuente" type="checkbox" onclick="asignaRetencion(this)">
      </td>
      <td class="t-right">
        <input class="tr" name="valorret" id="valorret" type="text" value="<?php echo number_format(0, 2); ?>">
      </td>
      <td class="t-right b-i" name="asignaica" id="asignaica">
        <input name="ica" id="ica" type="checkbox" onclick="asignaReteICA(this)"></td>
      <td class="t-right">
        <input name="valorica" id="valorica" class="tr" type="text" value="<?php echo number_format(0, 2); ?>">
      </td>
      <td class="t-right b-i" name="asignaiva" id="asignaiva">
        <input name="iva" id="iva" type="checkbox" onclick="asignaReteIVA(this)">
      </td>
      <td class="t-right">
        <input class="tr" type="text" name="valoriva" id="valoriva" value="<?php echo number_format(0, 2); ?>">
      </td>
      <td class="t-right">
        <input class="tr" type="text" name="valorcom" id="valorcom" onblur="sumaFacturas()" value="<?php echo number_format(0, 2); ?>">
      </td>
    </tr>
<?php
  }
}
?>
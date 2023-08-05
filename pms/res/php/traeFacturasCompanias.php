<?php


require '../../../res/php/app_topHotel.php';

$id = $_POST['id'];

$facturas = $hotel->getFacturasCompanias($id);

if (!$facturas) { ?>
  <div class="container-fluid">
    <h4 class="bg-red-gradient" style="padding:10px;text-align:center;font-size:25px;">Sin Facturas Generadas Para Esta Compañia <span style="font-size:16px;font-weight: 600;font-family: 'ubuntu'"></span></h4>
  </div>
<?php
} else { ?> 
    <div class="table-responsive" style="max-height:355px;overflow:auto">
      <table 
        name="datosClienteCartera" 
        id="example1" 
        class="table table-bordered">
        <thead>
          <tr class="warning" style="font-weight: bold;text-align: center">
            <td>Factura</td>
            <td>Huesped</td>
            <td>Fecha</td>
            <td>Total</td>
            <td class="rowAsigna">Pagar</td>
          </tr>
        </thead> 
        <tbody>
          <?php
          $totalFac = 0;
          foreach ($facturas as $factura) { 
            $totalFac = $totalFac + $factura['pagos_cargos'];
            ?>
            <tr style='font-size:12px'>
              <td name="nrofactura" id="nrofactura"><?php echo $factura['factura_numero']; ?></td>
              <td name="fecha" id="fecha"><?php echo $factura['nombre_completo']; ?></td>
              <td name="fecha" id="fecha"><?php echo $factura['fecha_factura']; ?></td>
              <td class="derecha" name="valor" id="valor"><?php echo number_format($factura['pagos_cargos'], 2); ?></td>
              <td class="rowAsigna centro"><input name="asigna" id="asigna" type="checkbox" onclick="sumaFacturas()">
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>        
      </table>
    </div>
    <div class="table-responsive">
      <table 
        class="table table-bordered pull-rigth" 
        style="font-size:2rem;margin-bottom:0px;">
        <thead>
          <tr>
            <td class="derecha">Total Facturas</td>
            <td class="derecha"><?php echo number_format($totalFac,2)?></td>
          </tr>
        </thead>
      </table>
    </div>
  </div>
<?php
}
?>
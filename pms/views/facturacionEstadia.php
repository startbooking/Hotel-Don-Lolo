<?php
$resolucion = $hotel->getResolucion(1);
$numFact = $hotel->getNumeroFactura();
$desde = $resolucion[0]['desde'];
$hasta = $resolucion[0]['hasta'];
$fecha = $resolucion[0]['fecha'];
$vigen = $resolucion[0]['vigencia'];
$fechaVigencia =   date("Y-m-d", strtotime($fecha . "+ " . $resolucion[0]['vigencia'] . " month"));
 
?>

<div class="content-wrapper" id="pantallaFacturacion">
  <section class="content" id="listado">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="cuentadepositos" id="cuentadepositos" value="<?= CTA_DEPOSITO ?>">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_PMS ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="facturacionEstadia">
            <input type="hidden" name="folioActivo" id="folioActivo" value="1">
            <input type="hidden" name="ingreso" id="ingreso" value="1">
            <h3 class="w3ls_head tituloPagina"> <i class="fa fa-money icon" style="font-size:36px;color:black"></i> Facturacion Huespedes</h3>
          </div>
          <div class="col-lg-6">
            <?php
            if (FECHA_PMS > $fechaVigencia || $numFact > $hasta) { ?>
              <div class="alert alert-danger centro mb-0" style="color: #000 !important;">
                <h4>Precaucion</h4>
                <h5>Resolucion de Facturacion a Vencido </h5>
                <h5>Fecha Vencimiento Facturacion <?= $fechaVigencia ?> Rango Facturacion Desde <?= $desde ?> Hasta <?= $hasta ?></h5>
              </div>
              <input type="hidden" name="vigencia" id="vigencia" value="1">
            <?php
            } else { ?>
              <input type="hidden" name="vigencia" id="vigencia" value="0">
            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <div class="panel-body" id="paginaFacturacion">
        <div id="imprimeRegistroHotelero"></div>
      </div>
    </div>
  </section>
</div>
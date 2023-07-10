<?php
require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$turismo = $_POST['turismo'];
$reserva = $_POST['reserva'];
$folio = $_POST['folio']; 
$nrohab = $_POST['nrohab']; 

$consumos = $hotel->getConsumosReservaFolio($reserva, $folio);
$totImptos = $hotel->getIvaReservaFolio($reserva, $folio);

if (count($totImptos) == 0) {
    $baseImpto = 0;
    $totImpto = 0;
} else {
    $baseImpto = $totImptos[0]['baseImpto'];
    $totImpto = $totImptos[0]['imptos'];
} 

if (count($consumos) == 0) {
    $consumos[0]['cargos'] = 0;
    $consumos[0]['imptos'] = 0;
    $consumos[0]['pagos'] = 0;
}
$consumo = $consumos[0]['cargos'];
$impto = $consumos[0]['imptos'];
$abono = $consumos[0]['pagos'];
$baseRetenciones = $consumo;
$reteiva = 0;
$reteica = 0;
$retefuente = 0;
$porceiva = 0;
$porceica = 0;
$porcefuente = 0;
$totalFolio = ($consumo + $impto) - ($abono - $reteiva - $reteica - $retefuente);
?>

<div class="container-fluid" style="padding:15px;background-color:#dff0d8;border-radius: 10px;">
  <div class="form-group">
    <label style="font-size:12px;height: 25px !important" for="consumo" class="col-sm-2 control-label">Consumos</label>
    <div class="col-sm-3">
      <input type="hidden" id="totalIva"        name="totalIva"        value='<?php echo $totImpto; ?>'>
      <input type="hidden" id="totalBaseIva"    name="totalBaseIva"       value='<?php echo $baseImpto; ?>'>
      <input type="hidden" id="totalConsumo"    name="totalConsumo"    value='<?php echo $consumo; ?>'>
      <input type="hidden" id="totalImpuesto"   name="totalImpuesto"   value='<?php echo $impto; ?>'>
      <input type="hidden" id="totalAbono"      name="totalAbono"      value='<?php echo $abono; ?>'>
      <input type="hidden" id="totalReteiva"    name="totalReteiva"    value='<?php echo $reteiva; ?>'>
      <input type="hidden" id="totalReteica"    name="totalReteica"    value='<?php echo $reteica; ?>'>
      <input type="hidden" id="totalRetefuente" name="totalRetefuente" value='<?php echo $retefuente; ?>'>
      <input type="hidden" id="porceReteiva"    name="porceReteiva"    value='<?php echo $reteiva; ?>'>
      <input type="hidden" id="porceReteica"    name="porceReteica"    value='<?php echo $reteica; ?>'>
      <input type="hidden" id="porceRetefuente" name="porceRetefuente" value='<?php echo $retefuente; ?>'>
      <input type="hidden" id="baseRetenciones" name="baseRetenciones" value='<?php echo $consumo; ?>'>

      <input type="hidden" id="SaldoFolioActual" name="SaldoFolioActual" value="<?php echo $totalFolio; ?>">
      <input style="font-size:12px;height: 25px !important;text-align: right;" type="text" class="form-control" id="consumo" value="<?php echo number_format($consumo, 2); ?>" readonly>
    </div>
    <label style="font-size:12px;height: 25px !important" for="impto" class="col-sm-1 control-label">Impuesto</label>
    <div class="col-sm-3">
      <input style="font-size:12px;height: 25px !important;text-align: right;" type="text" class="form-control" id="impto" placeholder="" value="<?php echo number_format($impto, 2); ?>" readonly>
    </div>
  </div>
  <div class="form-group retencion">
    <label style="font-size:12px;height: 25px !important" for="reteiva" class="col-sm-2 control-label">ReteIva</label>
    <div class="col-sm-3">
      <input style="font-size:12px;height: 25px !important; text-align:right;" type="text" class="form-control" id="reteiva" placeholder="" value="<?php echo number_format($reteiva, 2); ?>" readonly>
    </div>
    <label style="font-size:12px;height: 25px !important" for="reteica" class="col-sm-1 control-label">ReteIca</label>
    <div class="col-sm-3">
      <input style="font-size:12px;height: 25px !important; text-align:right;" type="text" class="form-control" id="reteica" placeholder="" value="<?php echo number_format($reteica, 2); ?>" readonly>
    </div>
    <label style="font-size:12px;height: 25px !important" for="retefuente" class="col-sm-1 control-label">ReteFuente</label>
    <div class="col-sm-2">
      <input style="font-size:12px;height: 25px !important; text-align:right;" type="text" class="form-control" id="retefuente" placeholder="" value="<?php echo number_format($retefuente, 2); ?>" readonly>
    </div>
  </div>          
  <div class="form-group">
    <label style="font-size:12px;height: 25px !important" for="abono" class="col-sm-2 control-label">Abonos</label>
    <div class="col-sm-3">
      <input style="font-size:12px;height: 25px !important; text-align:right;" type="text" class="form-control" id="abono" placeholder="" value="<?php echo number_format($abono, 2); ?>" readonly>
    </div>
    <label style="font-size:12px;height: 25px !important" for="total" class="col-sm-1 control-label">Total Folio</label>
    <div class="col-sm-3">
      <input style="font-size:12px;height: 25px !important; text-align:right;" type="text" class="form-control" id="total" placeholder="" value="<?php echo number_format($totalFolio, 2); ?>" readonly>
    </div>
  </div>
</div>
<div class="divs divDeposito">
  <div class="form-group">
    <label class="control-label col-md-2" for="codigoConsumo">Forma de Pago</label>
    <div class="col-lg-4 col-md-4" >
      <select name="codigoPago" id="codigoPago" required>
        <option value="">Seleccione Forma de Pago</option>
        <?php
       $codigos = $hotel->getCodigosConsumos(3);
foreach ($codigos as $codigo) { ?>
          <option style="font-size:12px" value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
          <?php
}
?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="txtValorAbono" class="col-sm-2 control-label">Valor a Pagar</label>
    <div class="col-sm-4">
      <input style="font-size:12px" class="form-control padInput" type="number" name="txtValorPago" id="txtValorPago" value="<?php echo $totalFolio; ?>" max="<?php echo $totalFolio; ?>" readonly>
    </div>
    <label for="txtReferenciaAbo" class="col-sm-2 control-label">Referencia</label>
    <div class="col-sm-4">
      <input style="font-size:12px;height: 25px !important"  class="form-control padInput" type="text" name="txtReferenciaPag" id="txtReferenciaPag" value="" min="1">
    </div>
  </div>
  <div class="form-group">
    <label for="txtDetalleAbo" class="col-sm-2 control-label">Comentarios</label>
    <div class="col-sm-4">
      <input style="font-size:12px;height: 25px !important"  class="form-control padInput" type="text" name="txtDetallePag" id="txtDetallePag" value='' placeholder="Informacion del Pago ">
    </div>
    <label for="txtDetalleAbo" class="col-sm-2 control-label">Correo Alterno</label>
    <div class="col-sm-4">
      <input style="font-size:12px;height: 25px !important"  class="form-control padInput" type="mail" name="txtCorreoPag" id="txtCorreoPag" value='' placeholder="Correo Envio Factura ">
    </div>
  </div>
</div>          

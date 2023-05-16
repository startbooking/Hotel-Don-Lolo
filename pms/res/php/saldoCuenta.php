<?php
require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$turismo = $_POST['turismo'];
$reserva = $_POST['reserva'];
$folio = $_POST['folio'];
$nrohab = $_POST['nrohab'];

$consumos = $hotel->getConsumosReservaFolio($reserva, $folio);

if (count($consumos) == 0) {
    $consumos[0]['cargos'] = 0;
    $consumos[0]['imptos'] = 0;
    $consumos[0]['pagos'] = 0;
}
$consumo = $consumos[0]['cargos'];
$impto = $consumos[0]['imptos'];
$abono = $consumos[0]['pagos'];
$totalFolio = ($consumo + $impto) - $abono;
?>

<div class="container-fluid" style="padding:15px;background-color:#dff0d8;border-radius: 10px;">
  <div class="form-group">
    <label style="font-size:12px;height: 25px !important" for="consumo" class="col-sm-2 control-label">Consumos</label>
    <div class="col-sm-4">
      <input type="hidden" id="SaldoFolioActual" name="SaldoFolioActual" value="<?php echo $totalFolio; ?>">
      <input style="font-size:12px;height: 25px !important" type="text" style="text-align: right;" class="form-control" id="consumo" value="<?php echo number_format($consumo, 2); ?>" readonly>
    </div>
    <label style="font-size:12px;height: 25px !important" for="impto" class="col-sm-2 control-label">Impuesto</label>
    <div class="col-sm-4">
      <input style="font-size:12px;height: 25px !important" type="text" style="text-align: right;" class="form-control" id="impto" placeholder="" value="<?php echo number_format($impto, 2); ?>" readonly>
    </div>
  </div>          
  <div class="form-group">
    <label style="font-size:12px;height: 25px !important" for="abono" class="col-sm-2 control-label">Abonos</label>
    <div class="col-sm-4">
      <input style="font-size:12px;height: 25px !important" type="text" style="text-align: right;" class="form-control" id="abono" placeholder="" value="<?php echo number_format($abono, 2); ?>" readonly>
    </div>
    <label style="font-size:12px;height: 25px !important" for="total" class="col-sm-2 control-label">Total Folio</label>
    <div class="col-sm-4">
      <input style="font-size:12px;height: 25px !important" type="text" style="text-align: right;" class="form-control" id="total" placeholder="" value="<?php echo number_format($totalFolio, 2); ?>" readonly>
    </div>
  </div>
</div>
<div class="divs divDeposito">
  <div class="form-group">
    <label class="control-label col-md-2" for="codigoConsumo">Forma de Pago</label>
    <div class="col-lg-4 col-md-4" >
      <select name="codigoPago" id="codigoPago" required onblur="traePerfilVenta(this.value)">
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
  <!-- </div>
  <div class="form-group">  -->
    <label for="txtReferenciaAbo" class="col-sm-2 control-label">Referencia</label>
    <div class="col-sm-4">
      <input style="font-size:12px;height: 25px !important"  class="form-control padInput" type="text" name="txtReferenciaPag" id="txtReferenciaPag" value="" min="1">
    </div>
  </div>
  <div class="form-group">
    <label for="txtDetalleAbo" class="col-sm-2 control-label">Comentarios</label>
    <div class="col-sm-6">
      <input style="font-size:12px;height: 25px !important"  class="form-control padInput" type="text" name="txtDetallePag" id="txtDetallePag" value='' placeholder="Informacion del Pago ">
    </div>
  </div>
</div>          

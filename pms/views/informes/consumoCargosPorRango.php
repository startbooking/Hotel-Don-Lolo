<?php
$dia = strtotime('-1 day', strtotime(FECHA_PMS));
$ayer = date('Y-m-d', $dia);
$inicial = date('Y-m-01', $dia);


?>
<div class="content-wrapper">
  <section class="content centrar">
    <div class="container">
      <div class="panel panel-success">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-9">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_PMS ?>">
              <input type="hidden" name="ubicacion" id="ubicacion" value="informeConsumosRango">
              <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Historico Cargos de Consumos</h3>
            </div>
            <div class="col-md-3">
              <button class="btn btn-success" type="buttom" onclick='consumosPorFecha()'><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
              <button class="btn btn-info" onclick="exportTableToExcel('example1')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
            </div>
          </div>
        </div>
        <div class="panel-body ">
          <div class="form-horizontal">
            <div class="form-group pd-10">
              <label class="control-label col-md-2">Desde Fecha</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control" type="date" min="1" name="desdeFecha" id='desdeFecha' value='<?= $inicial ?>' max="<?= $ayer ?>">
              </div>
              <label class="control-label col-md-1">Hasta Fecha</label>
              <div class="col-lg- col-md-2">
                <input class="form-control" type="date" min="1" name="hastaFecha" id='hastaFecha' value='<?= $ayer ?>' max="<?= $ayer ?>">
              </div>
              <label class="control-label col-md-1">Codigo </label>
              <div class="col-lg-3 col-md-3">
                <select name="desdeFormaPago" id="desdeFormaPago" class="form-control" style="padding:4px 12px">
                  <option value=""></option>
                  <?php
                  $formas = $hotel->getCodigosConsumos(1);
                  foreach ($formas as $forma) { ?>
                    <option value="<?= $forma['id_cargo'] ?>"><?= $forma['descripcion_cargo'] ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group" id="imprimeInforme">
            </div>
          </div>
        </div>
        <div class="panel-footer"></div>
      </div>

    </div>
  </section>
</div>

<?php
include_once 'views/modal/modalInformesRecibosCaja.php';
?>
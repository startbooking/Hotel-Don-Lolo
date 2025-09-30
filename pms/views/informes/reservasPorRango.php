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
            <div class="col-lg-9 col-md-9">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_PMS ?>">
              <input type="hidden" name="ubicacion" id="ubicacion" value="informeFacturasRango">
              <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Historico de Reservas</h3>
            </div>
            <div class="col-lg-3 col-md-6">
              <button class="btn btn-success" type="buttom" onclick='reservasPorFecha()'><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
              <button class="btn btn-info" onclick="exportTableToExcel('tablaReserva')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <div class="form-horizontal" style="padding: 10px 0px" >
            <div class="form-group">
              <label class="control-label col-md-2">Desde Fecha</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control" type="date" min="1" name="desdeFecha" id='desdeFecha' value='<?= $inicial ?>' max="<?= $ayer ?>">
              </div>
              <label class="control-label col-md-2">Hasta Fecha</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control" type="date" min="1" name="hastaFecha" id='hastaFecha' value='<?= $ayer ?>' max="<?= $ayer ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2">Huesped</label>
              <div class="col-lg-6 col-md-6">
                <input class="form-control" type="text" name="desdeHuesped" id='desdeHuesped' value=''>
              </div>
              <label class="control-label col-md-2">Habitacion</label>
              <div class="col-lg-2 col-md-2">
                <input class="form-control" type="text" name="nroHab" id='nroHab' value=''>
              </div>
            </div>
          </div>
          <div class="row-fluid"  id="imprimeInforme"></div>
        </div>
        <div class="panel-footer">
        </div>
      </div>

    </div>
  </section>
</div>

<?php
include_once 'views/modal/modalInformesfacturas.php';
?>
<?php
$tipomovi = $inven->getMovimientoCierre();
if ($tipomovi == 0) {
  $movi = $inven->movimientoCierre();
}
$periodo = $inven->mesCerrar();

?>

<section class="content-wrapper" style="height: 780px;">
  <div class="content" style="margin-bottom: 50px">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-9">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_POS; ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="cierreMes">
            <input type="hidden" name="pagina" id="pagina" value="cierreMes">
            <input type="hidden" name="periodoOLd" id="periodoOld" value="<?php echo $periodo[0]['mes']; ?>">
            <input type="hidden" name="contador" id="contador">
            <h3 class="w3ls_head tituloPagina">
              <i class="fa-solid fa-download fa-2x" style="color:#000"></i>
              Cierre Periodo
            </h3>
          </div>
        </div>
      </div>
      <div id="loader">

      </div>
      <form id="formCierreDiario" class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div class="panel-body">
          <div class="form -group">
            <div class="form-group">
              <label style="margin-top:8px;text-align: center" for="fechaAuditoria" class="control-label">
                <h3 id="fechaAuditoria" style="font-weight: 700;margin-top: 0;font-size:20px;color:brown;text-align: center"> Periodo a Cerrar
                  </h3>
                  <h2 class="badge btn btn-success" style="font-size:18px;text-align: center"> Mes: <?php echo str_pad($periodo[0]['mes'], 2, '0', STR_PAD_LEFT); ?> 
                  <?php echo nombreMes($periodo[0]['mes']); ?> - Año: 
                  <?php echo ($periodo[0]['anio']); ?>
                </h2>
                </label>
                <h2 id="tituloProcesa" class="oculto centro"> <i style="color:#BBB0B0; " class="ion ion-ios-gear-outline fa-spin fa-2x"></i> Procesando Informacion, No Interrumpa</h2>
            </div>
          </div>
          <div class="container-fluid" id='procesosCierre' style="display:none">
            <div class="table-responsive">
            </div>
          </div>
          <div id="aviso"></div>
          <div id="verInforme"></div>
        </div>
        <div class="panel-footer" style="text-align: center">
          <a href="home" style="width: 20%" type="button" class="btn btn-warning"><i class="fa fa-home"></i> Regresar</a>
          <button style="width: 20%" 
          type="button" id="botonCierre" class="btn btn-primary" data-mes="<?php echo ($periodo[0]['mes'])?>" data-anio="<?php echo ($periodo[0]['anio'])?>" onclick="cierreMes(<?php echo ($periodo[0]['mes'])?>,<?php echo ($periodo[0]['anio'])?>)"><i class="fa fa-arrow-circle-right"></i> Procesar</button>
        </div>
      </form>
    </div>
  </div>
</section>
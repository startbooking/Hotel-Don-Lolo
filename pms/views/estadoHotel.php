<?php 

  $paxs       = $hotel->getTotalHuespedeseCasa(CTA_MASTER);
  $llegan     = $hotel->getTotalHuespedeseLlegando();
  $salen      = $hotel->getTotalHuespedeseSaliendo();
  $rooms      = $hotel->habitacionesDisponibles(CTA_MASTER);

  $rooms     = count($hotel->cantidadHabitaciones(1));
  $dormi     = count($hotel->cantidadHabitaciones(2));
  $motor     = count($hotel->cantidadHabitaciones(3));
  $campi     = count($hotel->cantidadHabitaciones(4));
  $pm        = count($hotel->cantidadHabitaciones(5));
  $cabana    = count($hotel->cantidadHabitaciones(6));

  /* $canford     = $hotel->getHabitacionsBloqueadas('FO');
  $canfser     = $hotel->getHabitacionsBloqueadas('FS'); */
  $canMmto     = $hotel->habitacionesMmto();
  $cancamas    = $hotel->getCamasDisponibles();
  $salidadia   = $hotel->getSalidasHabitacionesDia(FECHA_PMS);
  $salidaspm   = $hotel->getSalidaspmDia(FECHA_PMS);
  $salen       = $hotel->getTotalHuespedeseSaliendo();
  $llegadasdia = $hotel->getLlegadasHabitacionesDia(FECHA_PMS);
  $llegadaspm  = $hotel->getLlegadaspmDia(FECHA_PMS);
  $llegan      = $hotel->getTotalHuespedeseLlegando();
  $huespedes   = $hotel->getHuespedesenCasaCierre(CTA_MASTER);
  $usodia      = $hotel->habitacionesUsoDia(FECHA_PMS);

  $llegadasdia = $llegadasdia - $llegadaspm;
  $salidadia   = $salidadia - $salidaspm;

  $habdisp  = $rooms-$canMmto ;
  $vacantes = $habdisp - $paxs[0]['habi'];

?>


<div class="content-wrapper" >
  <div class="container-fluid moduloCentrar">
    <div class="col-lg-9">
      <div class="panel panel-success">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="home">
          <h3 class="tituloPagina">
          <i class="fa-solid fa-city"></i>
          Estado Hotel</h3>
        </div>
        <div class="panel-body">
          <div class="container-fluid">
          <h4 class="alert-success" style="font-family: ubuntu;padding:15px 0;text-align: center;text-transform: uppercase;margin-bottom: 40px">Estado Habitaciones</h4>
            <div class="form-group">
              <label for="nit" class="col-sm-4 control-label">Total Habitaciones</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$rooms?>">
              </div>
              <label for="nit" class="col-sm-4 control-label">Habitaciones Mantenimiento</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="habMmto" id="habMmto" readonly="" value="<?=$canMmto?>">
              </div>
            </div>
            <div class="form-group">
              <label for="nit" class="col-sm-4 control-label">Habitaciones Diponibles</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$habdisp?>">
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <h4 class="alert-success" style="font-family: ubuntu;padding:15px 0;text-align: center;text-transform: uppercase;margin:40px">Ocupacion Hoy</h4>
            <div class="container-fluid">
              <label style="text-align: center" class="col-sm-4 control-label"></label>
              <label style="text-align: center" class="col-sm-2 control-label">TOT</label>
              <label style="text-align: center" class="col-sm-2 control-label">HOM</label>
              <label style="text-align: center" class="col-sm-2 control-label">MUJ</label>
              <label style="text-align: center" class="col-sm-2 control-label">NIN</label>
            </div>
            <div class="container-fluid">
              <label for="nit" class="col-sm-4 control-label">Habitaciones Ocupadas</label>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$paxs[0]['habi']?>">
              </div>
            </div>
            <div class="container-fluid">
              <label for="nit" class="col-sm-4 control-label">Habitaciones Vacantes</label>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$vacantes?>">
              </div>
            </div>
            <div class="container-fluid">
              <label for="nit" class="col-sm-4 control-label">Huespedes en Casa</label>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$paxs[0]['hom']+$paxs[0]['muj']+$paxs[0]['nin']?>">
              </div>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$paxs[0]['hom']?>">
              </div>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$paxs[0]['muj']?>">
              </div>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$paxs[0]['nin']?>">
              </div>
            </div>
            <div class="container-fluid">
              <label for="nit" class="col-sm-4 control-label">Salidas Del Dia</label>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$salen[0]['habi']?>">
              </div>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$salen[0]['hom']?>">
              </div>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$salen[0]['muj']?>">
              </div>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$salen[0]['nin']?>">
              </div>
            </div>
            <div class="container-fluid">
              <label for="nit" class="col-sm-4 control-label">Llegadas del Dia</label>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$llegan[0]['habi']?>">
              </div>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$llegan[0]['hom']?>">
              </div>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$llegan[0]['muj']?>">
              </div>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$llegan[0]['nin']?>">
              </div>
            </div>
            <div class="container-fluid">
              <label for="nit" class="col-sm-4 control-label">Total Ocupadas Hoy</label>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$paxs[0]['habi']-$salen[0]['habi']+$llegan[0]['habi']?>">
              </div>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$paxs[0]['hom']-$salen[0]['hom']+$llegan[0]['hom']?>">
              </div>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$paxs[0]['muj']-$salen[0]['muj']+$llegan[0]['muj']?>">
              </div>
              <div class="col-sm-2" style="padding:5px">
                <input type="text" class="form-control" name="habiDisp" id="nihabiDispt" readonly="" value="<?=$paxs[0]['nin']-$salen[0]['nin']+$llegan[0]['nin']?>">
              </div>
            </div>
          </div>      
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
?>
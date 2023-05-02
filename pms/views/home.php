<?php
  $encasa = $hotel->getTotalHuespedeseCasa(1);
  $llegan = $hotel->getTotalHuespedeseLlegando();
  $salen = $hotel->getTotalHuespedeseSaliendo();
  $reservas = $hotel->getReservasActivas(1, 'ES');
  $congeladas = $hotel->getReservasActivas(2, 'CO');
  $maestras = $hotel->getCuentasMaestras();
  $cargos = $hotel->sumCargosdelDia(FECHA_PMS);
  $abonos = $hotel->sumAbonosdelDia(FECHA_PMS);
  $deposito = $hotel->sumDepositosdelDia(FECHA_PMS);
  $pagos = $hotel->sumPagosdelDia(FECHA_PMS);
  $rooms = $hotel->habitacionesDisponibles(CTA_MASTER);
  $cmaster = $hotel->getTotalCuentasMaestras();
  ?>


<div class="content-wrapper" >
  <section class="container-fluid" style="margin-bottom: 5px;">
    <div class="container-fluid">
      <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
      <input type="hidden" name="ubicacion" id="ubicacion" value="home">
      <h1 style="font-size:34px;">
      Panel de Control <br>
      <span><?php echo NAME_HOTEL; ?></span>
      <!--
      <img style="margin-top:-40px;width: 80px" class="img-thumbnail" src="<?php echo BASE_WEB; ?>img/<?php echo LOGO; ?>" alt=""> 
      -->
      </h1>
    </div>
  </section>
  <section class="container-fluid" style="margin-bottom: 5px">
    <div class="container-fluid moduloCentrar">
      <div class="col-lg-4 col-md-6 col-xs-12">
        <div>
          <a class="small-box bg-aqua" href="llegadasDelDia">
            <div class="inner">
              <div class="container-fluid" style="padding:0">
                <div class="inner col-sm-8 col-xs-4">
                  <h3 style="margin:0"><?php echo $llegan[0]['habi']; ?></h3>
                  <p style="margin-bottom: 0">Llegadas en el Dia</p>
                </div>
                <div class="inner col-sm-2 col-xs-4">
                  <h3 style="margin:0" align="center"><?php echo $llegan[0]['hom'] + $llegan[0]['muj']; ?></h3>
                  <p>Adultos</p>                    
                </div>
                <div class="inner col-sm-2 col-xs-4">
                  <h3 style="margin:0;text-align:center;">
                    <?php
                        if ($llegan[0]['nin'] == '') {
                            echo 0;
                        } else {
                            echo $llegan[0]['nin'];
                        }
  ?>
                    </h3>
                  <p>Niños</p>
                </div>
              </div>
            </div>
            <div class="icon">
              <i class="ion-person-add"></i>
            </div>
            <span  class="small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></span>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-xs-12">
        <div>
          <a  class="small-box bg-green" href="encasa">
            <div class="inner">
              <div class="container-fluid" style="padding:0">
                <div class="row-fluid">
                  <div class="inner col-sm-8 col-xs-4">
                    <h3 style="margin:0"><?php echo $encasa[0]['habi']; ?></h3>
                    <p style="margin-bottom: 0">Habitaciones Ocupadas</p>
                  </div>
                  <div class="inner col-sm-2 col-xs-4">
                    <h3 style="margin:0" align="center"><?php echo $encasa[0]['hom'] + $encasa[0]['muj']; ?></h3>
                    <p>Adultos</p>                    
                  </div>
                  <div class="inner col-sm-2 col-xs-4">
                    <h3 style="margin:0" align="center">
                      <?php
    if ($encasa[0]['nin'] == '') {
        echo 0;
    } else {
        echo $encasa[0]['nin'];
    }
  ?>                      
                      </h3>
                    <p>Niños</p>
                  </div>
                </div>
                <!--
                <div class="row-fluid">
                  <div class="inner col-sm-8">
                    <h3 style="margin:0"><?php echo $cmaster; ?></h3>
                    <p style="margin-bottom: 0">Cuentas Maestas</p>
                  </div>
                </div>
              -->
              </div>
            </div>
            <div class="icon">
              <i class="ion ion-home"></i>
            </div>
            <span  class="small-box-footer">Ver Huespedes en Casa <i class="fa fa-arrow-circle-right"></i></span>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-xs-12">
        <div >
          <a class="small-box bg-yellow" href="salidasDelDia" >
            <div class="inner">
              <div class="container-fluid" style="padding:0">
                <div class="inner col-sm-8 col-xs-4">
                  <h3 style="margin:0"><?php echo $salen[0]['habi']; ?></h3>
                  <p style="margin-bottom: 0">Salidas del Dia</p>                    
                </div>
                <div class="inner col-sm-2 col-xs-4">
                  <h3 style="margin:0" align="center"><?php echo $salen[0]['hom'] + $salen[0]['muj']; ?></h3>
                  <p>Adultos</p>                    
                </div>
                <div class="inner col-sm-2 col-xs-4">
                  <h3 style="margin:0" align="center">
                    <?php
if ($salen[0]['nin'] == '') {
    echo 0;
} else {
    echo $salen[0]['nin'];
}
  ?>
                    </h3>
                  <p>Niños</p>
                </div>
              </div>
            </div>
            <div class="icon">
              <i class="ion ion-android-plane"></i>
            </div>
            <span class="small-box-footer">Ver Salidas del Dia <i class="fa fa-arrow-circle-right"></i></span>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-xs-12">
        <div>
          <a class="small-box bg-blue-gradient" href="reservasActivas">
            <div class="inner">
              <h3><?php echo $reservas; ?></h3>
              <p>Reservas Activas</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-calendar"></i>
            </div>
            <span class="small-box-footer">Ver Reservas <i class="fa fa-arrow-circle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-xs-12">
        <div>
          <a href="cuentasCongeladas" class="small-box bg-light-blue-gradient">
            <div class="inner">
              <h3><?php echo $congeladas; ?></h3>
              <p>Cuentas Congeladas</p>
            </div>
            <div class="icon">
              <i style="margin-top:30px"  class="fa fa-snowflake-o icon"></i>
            </div>
            <span class="small-box-footer">ver Cuentas Congeladas <i class="fa fa-arrow-circle-right"></i>            
            </span>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-xs-12">
        <div>
          <a href="encasa" class="small-box bg-red-gradient">
            <div class="inner">
              <h3><?php echo $maestras; ?></h3>
              <p>Cuentas Maestras Activas</p>
            </div>
            <div class="icon">
              <i style="margin-top:30px"  class="fa fa-snowflake-o icon"></i>
            </div>
            <span class="small-box-footer">ver Cuentas Maestras <i class="fa fa-arrow-circle-right"></i>            
            </span>
          </a>
        </div>
      </div>
      <!--
      -->
    </div>
  </section>
  <section class="container-fluid">
    <div class="container-fluid">
      <div class="col-md-6 col-xs-12">          
        <h2 style="padding:10px;font-size:25px">Accesos Directos <i class="fa fa-external-link" aria-hidden="true"></i>

        </h2>
      </div>
    </div>
    <div class="container-fluid">
      <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="info-box">
          <a 
            data-toggle="modal" 
            href="#myModalAdicionaReserva">
            <span class="info-box-icon bg-aqua"><i class="fa fa-calendar-plus-o"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Nueva Reserva</span>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="info-box">
          <a 
            data-toggle="modal" 
            href="#myModalAdicionaPerfil">
            <span class="info-box-icon bg-red"><i class="fa fa-user-plus"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Nuevo Huesped</span>
            </div>
          </a>
        </div>
      </div>
      <div class="clearfix visible-sm-block"></div>
      <div class="col-md-3 col-sm-6 col-xs-6">
        <div class="info-box">
          <a href="ingresoConsumos">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Consumos</span>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-6">        
        <div class="info-box">
          <a href="forecast">
            <span class="info-box-icon bg-yellow"><i class="fa fa-area-chart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Forecast</span>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
    include_once 'views/modal/modalHome.php';
  // include_once 'views/modal/modalReservas.php';
  // include_once 'views/modal/modalHuespedes.php';
  ?>
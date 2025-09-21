<section class="container-fluid" style="margin-top:0px;margin-bottom: 5px;">
  <div class="container-fluid">
    <input type="hidden" name="ubicacion" id="ubicacion" value="home">
    <div class="col-xs-8">
      <h1 class="fontModule">
        <?php echo $ambienteSeleccionado[0]['nombre']; ?><br>
        <small>Panel de Control </small>
      </h1>
    </div>
    <div class="col-xs-4">
      <img class="img-thumbnail logoAmbiente" src="../img/<?php echo $ambienteSeleccionado[0]['logo']; ?>" alt="">
    </div>
  </div>
</section>
<section class="container-fluid" style="margin-top:0px;margin-bottom: 5px;">
  <?php $prefijo = $ambienteSeleccionado[0]['prefijo']; ?>
  <div class="container-fluid  moduloCentrar">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <a onclick="muestraTouch()" class="small-box-footer">
        <div class="small-box bg-green-gradient" style="cursor:pointer;">
          <div class="inner">
            <h3 class="sombraBlanca">Ingresar Venta</h3>
            <p>Crea una Nueva Cuenta</p> 
          </div>
          <div class="icon">
            <i class="ion ion-cash"></i>
          </div>
          <small class="small-box-footer" style="font-size:12px">Ingresar<i class="fa fa-arrow-circle-right"></i></small>
        </div>
      </a>
    </div>
  </div>class="
  <div class="container-fluid">
    <h3 style="text-align:center;margin-bottom:30px;" class="tituloEscritorio">Informes y Estadisticas</h3>
    <div class="row moduloCentrar">
      <div class="col-md-4 col-xs-12">
        <a onclick="cuentasActivas()" class="small-box-footer">
          <div class="small-box bg-yellow" style="cursor:pointer;">
            <div class="inner">
              <?php
              echo '<h3> '.number_format($comandaPos, 0, ',', '.').'</h3>';
        ?>
              <p>Cuentas Activas</p>
            </div>
            <div class="icon">
              <i class="ion ion-archive"></i>
            </div>
            <small class="small-box-footer" style="font-size:12px">Detalles<i class="fa fa-arrow-circle-right"></i></small>

          </div>
        </a> 
      </div>
      <div class="col-md-4 col-xs-12">
        <a onclick="facturasDia()" class="small-box-footer">
          <div class="small-box bg-aqua" style="cursor:pointer;">
            <div class="inner">
              <?php
        echo '<h3> '.number_format($facturasPos, 0, ',', '.').'</h3>';
        ?>
                <p>Facturas Generadas </p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-cart-outline"></i>
            </div>
            <small class="small-box-footer" style="font-size:12px">Detalles<i class="fa fa-arrow-circle-right"></i></small>
          </div>
        </a> 
      </div>
      <div class="col-md-4 col-xs-12">
        <a onclick="verComandasAnuladas()" class="small-box-footer">
        <div class="small-box bg-red" style="cursor: pointer;">
          <div class="inner">
            <?php
            echo '<h3> '.number_format($comandaAnuladaPos, 0, ',', '.').'</h3>';
        ?>
            <p>Cuentas Anuladas</p>
          </div>
          <div class="icon">
            <i class="ion ion-archive"></i>
          </div>
            <small class="small-box-footer">
            Ingresar <i class="fa fa-arrow-circle-right"></i>
            </small>
        </div>
        </a> 
      </div>
    </div>
  </div>
</section>

<?php
$ambSel = $_POST['ambSel'];
$tipoUsr = $_POST['tipo'];

require '../../../../res/php/app_topPos.php';

$ambienteSeleccionado = $pos->getAmbienteSeleccionado($ambSel);
$comandaPos = $pos->countComandasPos($ambSel, 'A');
$comandaAnuladaPos = $pos->countComandasPos($ambSel, 'X');
$facturasPos = $pos->countFacturasPos($ambSel);

?>
<section class="container-fluid pd0">
  <section class="container-fluid pd0" style="margin-top:0px;margin-bottom: 5px;">
    <div class="container-fluid pd0">
      <input type="hidden" name="ubicacion" id="ubicacion" value="home">
      <div class="col-xs-9">
        <h1 class="fontModule">
          <?php echo $ambienteSeleccionado['nombre']; ?><br>
          <small>Panel de Control </small>
        </h1>
      </div>
      <div class="col-xs-3">
        <img class="img-thumbnail logoAmbiente" src="../img/<?php echo $ambienteSeleccionado['logo']; ?>"" alt="">
      </div>
    </div>
    <?php
    $prefijo = $ambienteSeleccionado['prefijo'];
    $archivo = "../../../views/plano-$prefijo.php";
    if ($ambienteSeleccionado['plano'] != 0) {
      if (!file_exists($archivo)) { ?>
        <div class=" alert alert-danger">
          <h1 style="text-align: center">Atencion <br><small style="color:#FFF"> Este Punto de venta no tiene plano configurado</small></h1>
        </div>
        <?php
      } else {
        include_once $archivo;
      }
    } else {
      ?>
      <div class="container-fluid moduloCentrar">
        <?php
        if ($tipoUsr <= 4) { ?>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pd0">
            <a style="cursor:pointer;" onclick="muestraTouch()" class="small-box-footer">
              <div class="small-box bg-green-gradient">
                <div class="inner">
                  <h3>Ingresar Venta</h3>
                  <p>Crea una Nueva Cuenta</p>
                </div>
                <div class="icon">
                  <i class="ion ion-cash"></i>
                </div>
                <small class="small-box-footer" style="font-size:12px">Ingresar<i class="fa fa-arrow-circle-right"></i></small>
              </div>
            </a>
          </div>
        <?php
        }
        ?>
      </div>
      <div class="container-fluid">
        <h3 style="text-align:center" class="tituloEscritorio">Informes y Estadisticas</h3>
        <div class="row moduloCentrar">
          <div class="col-md-4 col-xs-12">
            <a onclick="cuentasActivas()" class="small-box-footer">
              <div class="small-box bg-yellow" style="cursor:pointer;">
                <div class="inner">
                  <?php
                  echo '<h3> ' . number_format($comandaPos, 0, ',', '.') . '</h3>';
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
                  echo '<h3> ' . number_format($facturasPos, 0, ',', '.') . '</h3>';
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
                  echo '<h3> ' . number_format($comandaAnuladaPos, 0, ',', '.') . '</h3>';
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
    <?php
    }
  ?>
  </section>
</section>
<?php
$fechapms = $hotel->getDatePms();
$tipohabis = $hotel->getTipoHabitacion();
$rooms    = $hotel->getHabitaciones(CTA_MASTER);
$fechaini = $hotel->getPrimerDia(CTA_MASTER);
$fechafin = $hotel->getUltimoDia(CTA_MASTER);
$fecha1   = strtotime($fechaini);
$fecha2   = strtotime($fechafin);
$resta    = $fecha2 - $fecha1;
$dias     = ($resta / (24 * 60 * 60)) + 1;
if ($dias < 30) {
  $dias = 30;
}
 
?>
<div class="content-wrapper">
  <section class="content" style="margin-bottom: 10px !important">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6 col-xs-12">
            <input type="hidden" name="edita" id="edita" value="0">
            <input type="hidden" name="editaRes" id="editaRes" value="0">
            <input type="hidden" name="creaReser" id="creaReser" value="1">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_PMS ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="forecast">
            <h3 class="w3ls_head tituloPagina" style="padding:0;"> <i style="color:black;" class="fa fa-calendar ga-2x" aria-hidden="true"></i> Forecast Hotel</h3>
          </div>
          <div class="col-lg-6 col-xs-12">
            <div class="wrap">
              <div class="store-wrapper">
                <div class="category_list pull-right">
                  <a href="#" class="category_item btn btn-default" category="all">Todo</a>
                  <?php
                  foreach ($tipohabis as $tipohabi) {
                  ?>
                    <a href="#" class="category_item btn btn-default" category="<?= $tipohabi['codigo']; ?>" title="<?= $tipohabi['descripcion_habitacion'] ?>">
                      <?= $tipohabi['codigo']; ?>
                    </a>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body" style="padding:0;">
        <div class="row-fluid products-list" style="overflow:auto;">
          <?php
          $anchop = $dias * 44;
          ?>
          <div class="col-sm-11 col-sm-offset-1" style="width: 1400px;padding:2px;height: 26px;">
            <?php
            for ($i = 0; $i <= $dias; $i++) {
              $fecha      = strtotime('+' . $i . 'day', strtotime($fechaini)); ?>
              <div class="col-sm-1 btn btn-warning btn-sm" style="width: 40px;border-radius: 0px;padding:1px" title="<?= date('Y-m-d', $fecha) ?>">
                <?= date('d', $fecha); ?>
              </div>
            <?php
            }
            ?>
          </div>
          <div class="col-sm-1" style="padding-left:2px;padding-right: 0">
            <?php
            foreach ($rooms as $room) { ?>
              <button style="width: 100%;padding:1px;margin-bottom: 1px;border-radius: 0" class="btn btn-success product-item" type="button" title="<?= $room['descripcion_habitacion'] ?>" category="<?= $room['tipo_hab'] ?>">
                <?= $room['tipo_hab'] . ' ' . $room['numero_hab'] ?>
              </button>
            <?php
            }
            ?>
          </div>
          <div class="col-sm-11" style="padding-left:2px">
            <?php
            foreach ($rooms as $room) {
              $numero = $room['numero_hab'];
            ?>
              <div class="row product-item" category="<?= $room['tipo_hab']; ?>" style="width: 1400px;margin-left:0px;">
                <?php
                for ($i = 0; $i <= $dias; $i++) {
                  $fecha      = strtotime('+' . $i . 'day', strtotime($fechaini));
                  $fechabusca = date('Y-m-d', $fecha);
                  $estadias   = $hotel->buscaEstadia($fechabusca, $numero);

                  $mmtoHab = $hotel->buscaMmto($fechabusca, $numero);

                  if (count($mmtoHab) !== 0) {
                    $desdemmto = $mmtoHab[0]['desde_fecha'];
                    $hastammto = $mmtoHab[0]['hasta_fecha'];
                    $diasMto = (strtotime($hastammto) - strtotime($desdemmto)) / 86400;

                    $ancho = (40 * $diasMto) - 2;

                    $izq = 42 * $i;
                    $altoh = 21;
                    $alto = 1;
                ?>
                    <div class="col-sm-1 mmto">
                      <a type="button" style="padding:2px 12px;margin-bottom: 1px;height: <?= $altoh ?>px;width:<?= $ancho ?>px;margin-top:<?= $alto ?>px;margin-left:20px;z-index:20;display: block;border: 1px solid #000A;position:absolute;border-radius: 0;font-size:10px;color:#000;overflow: hidden;font-weight: 600" class="info btn btn-default reserva" title="" draggable="true" onclick="muestraReserva(this)">
                        <div>
                          <span style="position: fixed;left: 500px; top: 52px;">Habitacion en Mantenimiento<br><br>
                            <p>
                              Observaciones <?= substr($mmtoHab[0]['observaciones'], 0, 22) ?><br>
                            </p>
                            Desde <?= $mmtoHab[0]['desde_fecha'] ?><br>Hasta Fecha <?= $mmtoHab[0]['hasta_fecha'] ?>
                          </span>
                        </div>
                        Habitacion en Mantenimiento
                      </a>
                      <?php
                      $alto = $alto + 10;
                      ?>
                    </div>
                  <?php
                  } else
                    if (count($estadias) == 0) {
                    $izq = 42 * $i
                  ?>
                    <div class="col-sm-1 libre"></div>
                  <?php
                  } else {
                    $izq  = 42 * $i;
                    $alto = -1;
                  ?>
                    <div class="col-sm-1 ocupada">
                      <?php
                      if (count($estadias) > 1) {
                        $mas   = 1;
                        $altoh = 11;
                      } else {
                        $mas   = 0;
                        $altoh = 23;
                      }
                      foreach ($estadias as $estadia) {
                        if ($estadia['estado'] == 'CA') {
                          $color = 'btn-warning';
                        } else {
                          if ($mas == 1) {
                            $color = 'btn-danger';
                          } else {
                            $color = 'btn-info';
                          }
                        }
                        $desde = $estadia['fecha_llegada'];
                        $hasta = $estadia['fecha_salida'];
                        $diasEs = (strtotime($hasta) - strtotime($desde)) / 86400;
                        $ancho = (40 * $diasEs) - 2;
                        if ($estadia['estado'] <> "SA" && $estadia['estado'] <> "CX") { ?>
                          <?php
                          if ($estadia['estado'] == "ES") {
                          ?>
                            <nav class="navbar <?= $color ?> reserva" style="height: <?= $altoh ?>px;width:<?= $ancho ?>px;margin-top:<?= $alto ?>px;padding: 0 1px;">
                              <ul class="nav navbar-nav" style="width: 100%;overflow: hidden;">
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle menuForecast info btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-list"></i>
                                    <span style="position: fixed;left: 500px; top: 52px;">Huesped <?php echo substr($estadia['nombre_completo'], 0, 28) ?><br>Habitacion <?= $estadia['num_habitacion'] ?><br>Adultos <?= $estadia['can_hombres'] + $estadia['can_mujeres'] ?> Niños <?= $estadia['can_ninos'] ?> <br>Fecha Llegada <?= $estadia['fecha_llegada'] ?><br>Fecha Salida <?= $estadia['fecha_salida'] ?><br>Tarifa <?= number_format($estadia['valor_diario'], 2) ?></span>
                                    <?php
                                    echo $estadia['apellido1'];
                                    ?>
                                  </a>
                                  <ul class="dropdown-menu submenu" style="float:left;margin-left:-180px;top:40px;">
                                    <li>
                                      <a data-toggle="modal" data-target="#myModalAcompanantesReserva" data-id="<?php echo $estadia['num_reserva']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>">
                                        <i class="fa fa-users" aria-hidden="true"></i>Acompañantes Reserva
                                      </a>
                                    </li>
                                    <li id="cambiaHuesped">
                                      <a data-toggle="modal" data-target="#myModalReasignarHuesped" data-reserva="<?php echo $estadia['num_reserva']; ?>">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i>Reasignar Huesped
                                      </a>
                                    </li>
                                    <li>
                                      <a data-toggle="modal" data-target="#myModalModificaReserva" data-id="<?php echo $estadia['num_reserva']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>">
                                        <i class="fa fa-pencil-square" aria-hidden="true"></i>Modificar Reserva
                                      </a>
                                    </li>
                                    <li>
                                      <a data-toggle="modal" data-target="#myModalCancelaReserva" data-id="<?php echo $estadia['num_reserva']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>">
                                        <i class="fa fa-times" aria-hidden="true"></i>Cancelar Reserva</a>
                                    </li>
                                    <li>
                                      <a data-toggle="modal" onclick="confirmarReserva(<?= $estadia['num_reserva'] ?>)">
                                        <i class="fa fa-book" aria-hidden="true"></i>Confirmar Reserva
                                      </a>
                                    </li>
                                    <li>
                                      <a data-toggle="modal" onclick="imprimirRegistro(<?php echo $estadia['num_reserva']; ?>,<?php echo $estadia['causar_impuesto']; ?>)">
                                        <i class="fa fa-book" aria-hidden="true"></i>Imprimir Registro Hotelero
                                      </a>
                                    </li>
                                    <li>
                                      <a data-toggle="modal" data-id="<?php echo $estadia['id_huesped']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" href="#myModalModificaPerfilHuesped">
                                        <i class="fa fa-user-md"></i>Perfil Huesped
                                      </a>
                                    </li>
                                    <li>
                                      <a data-toggle="modal" data-target="#myModalDepositoReserva" data-id="<?php echo $estadia['num_reserva']; ?>" data-idhuesped="<?php echo $estadia['id_huesped']; ?>" data-tipohab="<?php echo descripcionTipoHabitacion($estadia['tipo_habitacion']); ?>" data-nrohab="<?php echo $estadia['num_habitacion']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" data-llegada="<?php echo $estadia['fecha_llegada']; ?>" data-salida="<?php echo $estadia['fecha_salida']; ?>" data-noches="<?php echo $estadia['dias_reservados']; ?>" data-hombres="<?php echo $estadia['can_hombres']; ?>" data-mujeres="<?php echo $estadia['can_mujeres']; ?>" data-ninos="<?php echo $estadia['can_ninos']; ?>" data-orden="<?php echo $estadia['orden_reserva']; ?>" data-tarifa="<?php echo $hotel->getNombreTarifa($estadia['tarifa']) ?>" data-valor="<?php echo $estadia['valor_reserva']; ?>" data-observaciones="<?php echo $estadia['observaciones']; ?>">
                                        <i class="fa-solid fa-money-bill"></i>
                                        Deposito a Reserva
                                      </a>
                                    </li>
                                    <li>
                                      <a data-toggle="modal" data-idres="<?php echo $estadia['num_reserva']; ?>" data-idcia="<?php echo $estadia['id_compania']; ?>" data-idcen="<?php echo $estadia['idCentroCia']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" href="#myModalAsignarCompania">
                                        <i class="fa fa-window-restore" aria-hidden="true"></i>
                                        Asignar Compañia</a>
                                    </li>
                                    <?php
                                    if ($estadia['id_compania'] != 0) { ?>
                                      <li>
                                        <a data-toggle="modal" data-id="<?php echo $estadia['id_compania']; ?>" data-empresa="<?php echo $nombrecia; ?>" href="#myModalModificaPerfilCia">
                                          <i class="fa fa-book" aria-hidden="true"></i>
                                          Datos Compañia</a>
                                      </li>
                                    <?php
                                    }
                                    ?>
                                    <li>
                                      <a data-toggle="modal" data-id="<?php echo $estadia['num_reserva']; ?>" data-nrohab="<?php echo $estadia['num_habitacion']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" data-llegada="<?php echo $estadia['fecha_llegada']; ?>" data-salida="<?php echo $estadia['fecha_salida']; ?>" data-noches="<?php echo $estadia['dias_reservados']; ?>" href="#myModalAdicionaObservaciones">
                                        <i class="fa-regular fa-comments"></i>
                                        Adicionar Observaciones</a>
                                    </li>
                                  </ul>
                                </li>
                              </ul>
                              <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;margin-top:-2px">
                              </div> -->
                            </nav>
                          <?php
                          } elseif ($estadia['estado'] == "CA") { ?>
                            <nav class="navbar <?= $color ?> reserva" style="height: <?= $altoh ?>px;width:<?= $ancho ?>px;margin-top:<?= $alto ?>px;">
                              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;margin-top:-2px">
                                <ul class="nav navbar-nav">
                                  <li class="dropdown submenu" style="width: 100%">
                                    <a href="#" class="dropdown-toggle menuForecast info btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa-solid fa-list"></i>
                                      <span style="position: fixed;left: 500px; top: 52px;">Huesped <?php echo substr($estadia['nombre_completo'], 0, 28) ?><br>Habitacion <?= $estadia['num_habitacion'] ?><br>Adultos <?= $estadia['can_hombres'] + $estadia['can_mujeres'] ?> Niños <?= $estadia['can_ninos'] ?> <br>Fecha Llegada <?= $estadia['fecha_llegada'] ?><br>Fecha Salida <?= $estadia['fecha_salida'] ?><br>Tarifa <?= number_format($estadia['valor_diario'], 2) ?></span>
                                      <?php
                                      echo $estadia['apellido1'];
                                      ?>

                                    </a>
                                    <ul class="dropdown-menu" style="float:left;margin-left:-180px;top:40px;">
                                      <li>
                                        <a data-toggle="modal" data-target="#myModalAcompanantesReserva" data-id="<?php echo $estadia['num_reserva']; ?>" data-tipohab="<?php echo descripcionTipoHabitacion($estadia['tipo_habitacion']); ?>" data-nrohab="<?php echo $estadia['num_habitacion']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" data-impto="<?php echo $estadia['causar_impuesto']; ?>" data-llegada="<?php echo $estadia['fecha_llegada']; ?>" data-salida="<?php echo $estadia['fecha_salida']; ?>" data-noches="<?php echo $estadia['dias_reservados']; ?>" data-hombres="<?php echo $estadia['can_hombres']; ?>" data-mujeres="<?php echo $estadia['can_mujeres']; ?>" data-ninos="<?php echo $estadia['can_ninos']; ?>" data-tipo="<?php echo $estadia['tipo_reserva']; ?>" data-tarifa="<?php echo $hotel->getNombreTarifa($estadia['tarifa']); ?>" data-idtarifa="<?php echo $estadia['tarifa']; ?>" data-valor="<?php echo $estadia['valor_diario']; ?>" data-observaciones="<?php echo $estadia['observaciones']; ?>">
                                          <i class="fa fa-users" aria-hidden="true"></i>Acompañantes Reserva
                                        </a>
                                      </li>
                                      <li>
                                        <a data-toggle="modal" data-id="<?php echo $estadia['num_reserva']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" data-impto="<?php echo $estadia['causar_impuesto']; ?>" onclick="imprimirRegistro(<?php echo $estadia['num_reserva']; ?>,<?php echo $estadia['causar_impuesto']; ?>)">
                                          <i class="fa fa-book" aria-hidden="true"></i>
                                          Imprimir Registro Hotelero</a>
                                      </li>
                                      <?php
                                      if (TRA == 1) { ?>
                                        <li>
                                          <a data-toggle="modal" data-id="<?php echo $estadia['num_reserva']; ?>" onclick="enviaTRA(<?php echo $estadia['num_reserva']; ?>,'<?php echo FECHA_PMS; ?>')">
                                            <i class="fa-regular fa-paper-plane"></i>
                                            Envio Tarjeta Registro</a>
                                        </li>
                                      <?php
                                      }
                                      ?>
                                      <li>
                                        <a data-toggle="modal" data-target="#myModalModificaEstadia" data-id="<?php echo $estadia['num_reserva']; ?>" data-tipohab="<?php echo descripcionTipoHabitacion($estadia['tipo_habitacion']); ?>" data-nrohab="<?php echo $estadia['num_habitacion']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" data-impto="<?php echo $estadia['causar_impuesto']; ?>" data-llegada="<?php echo $estadia['fecha_llegada']; ?>" data-salida="<?php echo $estadia['fecha_salida']; ?>" data-noches="<?php echo $estadia['dias_reservados']; ?>" data-hombres="<?php echo $estadia['can_hombres']; ?>" data-mujeres="<?php echo $estadia['can_mujeres']; ?>" data-tarifa="<?php echo $hotel->getNombreTarifa($estadia['tarifa']); ?>" data-idtarifa="<?php echo $estadia['tarifa']; ?>" data-ninos="<?php echo $estadia['can_ninos']; ?>" data-valor="<?php echo $estadia['valor_diario']; ?>" data-observaciones="<?php echo $estadia['observaciones']; ?>">
                                          <i class="fa fa-pencil-square" aria-hidden="true"></i>Modificar Estadia</a>
                                      </li>
                                      <?php
                                      if ($estadia['fecha_llegada'] == FECHA_PMS) { ?>
                                        <li>
                                          <a data-toggle="modal" data-target="#myModalAnulaIngreso" data-id="<?php echo $estadia['num_reserva']; ?>" data-tipohab="<?php echo descripcionTipoHabitacion($estadia['tipo_habitacion']); ?>" data-nrohab="<?php echo $estadia['num_habitacion']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" data-impto="<?php echo $estadia['causar_impuesto']; ?>" data-llegada="<?php echo $estadia['fecha_llegada']; ?>" data-salida="<?php echo $estadia['fecha_salida']; ?>" data-noches="<?php echo $estadia['dias_reservados']; ?>" data-hombres="<?php echo $estadia['can_hombres']; ?>" data-mujeres="<?php echo $estadia['can_mujeres']; ?>" data-ninos="<?php echo $estadia['can_ninos']; ?>" data-tarifa="<?php echo $hotel->getNombreTarifa($estadia['tarifa']); ?>" data-idtarifa="<?php echo $estadia['tarifa']; ?>" data-valor="<?php echo $estadia['valor_diario']; ?>" data-observaciones="<?php echo $estadia['observaciones']; ?>">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            Anular Ingreso</a>
                                        </li>
                                      <?php
                                      }
                                      if ($estadia['num_habitacion'] != CTA_DEPOSITO) { ?>
                                        <li>
                                          <a data-toggle="modal" data-id="<?php echo $estadia['num_reserva']; ?>" data-tipohab="<?php echo descripcionTipoHabitacion($estadia['tipo_habitacion']); ?>" data-nrohab="<?php echo $estadia['num_habitacion']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" data-llegada="<?php echo $estadia['fecha_llegada']; ?>" data-salida="<?php echo $estadia['fecha_salida']; ?>" data-impto="<?php echo $estadia['causar_impuesto']; ?>" href="#myModalCambiaHabitacion">
                                            <i class="fa fa-clone" aria-hidden="true"></i>
                                            Cambiar Habitacion</a>
                                        </li>
                                        <li>
                                          <a data-toggle="modal" data-id="<?php echo $estadia['num_reserva']; ?>" data-tipohab="<?php echo descripcionTipoHabitacion($estadia['tipo_habitacion']); ?>" data-nrohab="<?php echo $estadia['num_habitacion']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" data-tarifa="<?php echo $estadia['tarifa']; ?>" data-impto="<?php echo $estadia['causar_impuesto']; ?>" href="#myModalCambiaTarifa">
                                            <i class="fa fa-window-restore" aria-hidden="true"></i>
                                            Cambiar Tarifa</a>
                                        </li>
                                      <?php
                                      }
                                      ?>
                                      <li>
                                        <a data-toggle="modal" data-id="<?php echo $estadia['id_huesped']; ?>" data-apellido1="<?php echo $estadia['apellido1']; ?>" data-apellido2="<?php echo $estadia['apellido2']; ?>" data-nombre1="<?php echo $estadia['nombre1']; ?>" data-nombre2="<?php echo $estadia['nombre2']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" data-impto="<?php echo $estadia['causar_impuesto']; ?>" href="#myModalInformacionHuesped">
                                          <i class="fa fa-user-md" aria-hidden="true"></i>
                                          Perfil Huesped</a>
                                      </li>
                                      <li>
                                        <a data-toggle="modal" data-id="<?php echo $estadia['id_huesped']; ?>" data-idres="<?php echo $estadia['num_reserva']; ?>" data-idcia="<?php echo $estadia['id_compania']; ?>" data-tipohab="<?php echo descripcionTipoHabitacion($estadia['tipo_habitacion']); ?>" data-nrohab="<?php echo $estadia['num_habitacion']; ?>" data-idcen="<?php echo $estadia['idCentroCia']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" data-impto="<?php echo $estadia['causar_impuesto']; ?>" data-nombrecia="<?php echo $nombrecia; ?>" data-nitcia="<?php echo $nitcia; ?>" href="#myModalAsignarCompania">
                                          <i class="fa fa-window-restore" aria-hidden="true"></i>
                                          Asignar Compañia</a>
                                      </li>
                                      <?php
                                      if ($estadia['id_compania'] != 0) { ?>
                                        <li>
                                          <a data-toggle="modal" data-id="<?php echo $estadia['num_reserva']; ?>" data-idhue="<?php echo $estadia['id_huesped']; ?>" data-idcia="<?php echo $estadia['id_compania']; ?>" data-idcen="<?php echo $estadia['idCentroCia']; ?>" data-nombre="<?php echo $estadia['nombre_completo']; ?>" data-impto="<?php echo $estadia['causar_impuesto']; ?>" href="#myModalInformacionCompania">
                                            <i class="fa fa-industry" aria-hidden="true"></i>
                                            Datos Compañia</a>
                                        </li>
                                      <?php
                                      }
                                      if ($estadia['fecha_llegada'] == FECHA_PMS && $tipo == 1) { ?>
                                        <li id="cambiaHuesped">
                                          <a data-toggle="modal" data-target="#myModalReasignarHuesped" data-reserva="<?php echo $estadia['num_reserva']; ?>" data-tipohab="<?php echo descripcionTipoHabitacion($estadia['tipo_habitacion']); ?>" data-nrohab="<?php echo $estadia['num_habitacion']; ?>" data-apellido1="<?php echo $estadia['apellido1']; ?>" data-apellido2="<?php echo $estadia['apellido2']; ?>" data-nombre1="<?php echo $estadia['nombre1']; ?>" data-nombre2="<?php echo $estadia['nombre2']; ?>" data-llegada="<?php echo $estadia['fecha_llegada']; ?>" data-salida="<?php echo $estadia['fecha_salida']; ?>" data-noches="<?php echo $estadia['dias_reservados']; ?>" data-hombres="<?php echo $estadia['can_hombres']; ?>" data-mujeres="<?php echo $estadia['can_mujeres']; ?>" data-ninos="<?php echo $estadia['can_ninos']; ?>" data-tipo="<?php echo $estadia['tipo_reserva']; ?>" data-tarifa="<?php echo $hotel->getNombreTarifa($estadia['tarifa']); ?>" data-valor="<?php echo $estadia['valor_diario']; ?>" data-observaciones="<?php echo $estadia['observaciones']; ?>">
                                            <i class="fa fa-user-plus" aria-hidden="true"></i>Reasignar Huesped
                                          </a>
                                        </li>
                                      <?php
                                      }
                                      ?>
                                      <li>
                                        <a data-toggle="modal" data-id="<?php echo $estadia['num_reserva']; ?>" data-cia="<?php echo $estadia['id_compania']; ?>" data-tipohab="<?php echo descripcionTipoHabitacion($estadia['tipo_habitacion']); ?>" data-nrohab="<?php echo $estadia['num_habitacion']; ?>" data-apellido1="<?php echo $estadia['apellido1']; ?>" data-apellido2="<?php echo $estadia['apellido2']; ?>" data-nombre1="<?php echo $estadia['nombre1']; ?>" data-nombre2="<?php echo $estadia['nombre2']; ?>" data-nombrecia="<?php echo $nombrecia; ?>" data-llegada="<?php echo $estadia['fecha_llegada']; ?>" data-salida="<?php echo $estadia['fecha_salida']; ?>" data-noches="<?php echo $estadia['dias_reservados']; ?>" data-nitcia="<?php echo $nitcia; ?>" data-observa="<?php echo $estadia['observaciones']; ?>" href="#myModalAdicionaObservaciones">
                                          <i class="fa-regular fa-comments"></i>
                                          Adicionar Observaciones</a>
                                      </li>
                                    </ul>
                                  </li>
                                </ul>
                              </div>
                            </nav>
                      <?php
                          }
                          $alto = $alto + 10;
                        }
                      }
                      ?>
                    </div>
                <?php
                  }
                }
                ?>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  let ancho = screen.width;
  let alto = screen.height;
  forecast = document.querySelector('.products-list');
  forecast.style.height = (alto - 268) + 'px';
</script>
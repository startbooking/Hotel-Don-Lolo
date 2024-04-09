<?php

require_once '../../res/php/app_topHotel.php';

$reserva = $_POST['reserva'];

if(!isset($reserva)){ ?>
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="0;URL=../../index.php" />
    <?php
}

$datosReserva = $hotel->getReservasDatos($reserva);

$oFecha = strtotime(FECHA_PMS);
$dia = date('d',$oFecha);

$datosCompania = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);
$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);

$credito = 0;
$dias = 0;
$reteiva = 0;
$reteica = 0;
$retefuen = 0;
$sinbase = 0;
if (count($datosCompania) !== 0) {
  $credito  = $datosCompania[0]['credito'];
  $dias     = $datosCompania[0]['dia_corte_credito'];    
  $reteiva  =  $datosCompania[0]['reteiva']; 
  $reteica  =  $datosCompania[0]['reteica']; 
  $retefuen = $datosCompania[0]['retefuente'];
  $sinbase  =  $datosCompania[0]['sinBaseRete']; 
}

$saldofolio1 = $hotel->saldoFolio($reserva, 1);
$saldofolio2 = $hotel->saldoFolio($reserva, 2);
$saldofolio3 = $hotel->saldoFolio($reserva, 3);
$saldofolio4 = $hotel->saldoFolio($reserva, 4);

$pagofolio1 = $hotel->pagosFolio($reserva, 1);
$pagofolio2 = $hotel->pagosFolio($reserva, 2);
$pagofolio3 = $hotel->pagosFolio($reserva, 3);
$pagofolio4 = $hotel->pagosFolio($reserva, 4);

$saldoCuenta = $saldofolio1 + $saldofolio2 + $saldofolio3 + $saldofolio4;
$pagoCuenta = $pagofolio1 + $pagofolio2 + $pagofolio3 + $pagofolio4;

?>

  <div class="container-fluid" style="padding:0px;margin-bottom: 50px">
    <form class="form-horizontal pd-10" id="formHuespedes" action="" method="POST">
      <h3 style="text-align: center;margin-bottom: 25px" class="w3ls_head tituloPagina">Estado Cuenta Huesped</h3>
      <div class="panel panel-success panelFolio">
        <div class="panel-heading">
          <div class="panel-title"> 
            <input type="hidden" name="facturador" id="facturador" value="<?=FACTURADOR?>">
            <input type="hidden" name="ingreso" id="ingreso" value="2">
            <input type="hidden" name="folioActivo" id="folioActivo" value="0">
            <input type="hidden" name="reservaActual" id="reservaActual" value="<?php echo $reserva; ?>">
            <input type="hidden" name="saldoActual" id="saldoActual" value="<?php echo $saldoCuenta; ?>">
            <input type="hidden" name="cuentaCongelada" id="cuentaCongelada" value="0">
            <input type="hidden" name="totalPagos" id="totalPagos" value="<?php echo $pagoCuenta; ?>">
            <input type="hidden" name="nrofolio1" id="nrofolio1" value="<?php echo $saldofolio1 - $pagofolio1; ?>">
            <input type="hidden" name="nrofolio2" id="nrofolio2" value="<?php echo $saldofolio2 - $pagofolio2; ?>">
            <input type="hidden" name="nrofolio3" id="nrofolio3" value="<?php echo $saldofolio3 - $pagofolio3; ?>">
            <input type="hidden" name="nrofolio4" id="nrofolio4" value="<?php echo $saldofolio4 - $pagofolio4; ?>">
            <input type="hidden" name="idHuespedSal" id="idHuespedSal" value="<?php echo $datosReserva[0]['id_huesped']; ?>">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">              
            <input type="hidden" name="ubicacion" id="ubicacion" value="facturacionHuesped">
          </div>
          <div class="container-fluid ">
            <div class="form-group">
              <label for="nrohabitacion" class="col-sm-1 control-label">Habitacion</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="nrohabitacion" placeholder="" value="<?php echo $datosReserva[0]['num_habitacion']; ?>" readonly>
              </div>
              <label for="apellidos" class="col-sm-1 control-label">Huesped </label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="apellidos" placeholder="" value="<?php echo $datosReserva[0]['nombre_completo']; ?>" readonly>
              </div>
              <label for="nombres" class="col-sm-2 control-label">Identificacion</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" id="nombres" placeholder="" value="<?php echo $datosReserva[0]['identificacion']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="llegada" class="col-sm-1 control-label">Llegada</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="llegada" id="llegada" readonly="" value="<?php echo $datosReserva[0]['fecha_llegada']; ?>"> 
              </div>
              <label for="noches" class="col-sm-1 control-label">Noches</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="noches" id="noches" readonly="" value='<?php echo $datosReserva[0]['dias_reservados']; ?>'>
              </div>
              <label for="salida" class="col-sm-1 control-label">Salida</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="salida" id="salida" readonly="" value="<?php echo $datosReserva[0]['fecha_salida']; ?>">
              </div>
              <label for="tarifa" class="col-sm-1 control-label">Tarifa</label>
              <div class="col-sm-2">
                <input type="text" class="form-control derecha" name="tarifa" id="tarifa" readonly="" value="<?php echo number_format($datosReserva[0]['valor_diario'], 2); ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="hombres" class="col-sm-1 control-label">Hombres</label>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="hombres" id="hombres" required="" value="<?php echo $datosReserva[0]['can_hombres']; ?>" readonly>
              </div>
              <label for="mujeres" class="col-sm-1 control-label">Mujeres</label>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="mujeres" id="mujeres" required="" value='<?php echo $datosReserva[0]['can_mujeres']; ?>' readonly>
              </div>
              <label for="ninos" class="col-sm-1 control-label">Niños</label>
              <div class="col-sm-1">
                <input type="text" class="form-control" name="ninos" id="ninos" required="" value="<?php echo $datosReserva[0]['can_ninos']; ?>" readonly >
              </div>
              <label for="ninos" class="col-sm-1 control-label">Nro Orden</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="ninos" id="ninos" required="" value="<?php echo $datosReserva[0]['orden_reserva']; ?>" readonly >
              </div>
              <label for="inputEmail3" class="col-sm-1 control-label">Decreto 297</label>
              <div class="col-sm-2">
                <div class="col-sm-6" style="padding:0;height: 15px" >
                  <div class="form-check form-check-inline">
                    <input style="margin-top:0px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio1" value="1" disabled=""
                    <?php
                    if ($datosReserva[0]['causar_impuesto'] == 1) { ?>
                        checked
                      <?php
                    }?>
                    >
                    <label style="margin-top:-30px;margin-left:25px" class="form-check-label" for="inlineRadio1" >NO</label>
                  </div>                    
                </div>
                <div class="col-sm-6" style="padding:0;height: 15px"> 
                  <div class="form-check form-check-inline">
                    <input style="margin-top:0px" class="form-check-input" type="radio" name="imptoOption" id="inlineRadio2" value="2" disabled=""
                    <?php
                      if ($datosReserva[0]['causar_impuesto'] == 2) { ?>
                        checked
                        <?php
                      }
                    ?>
                    >
                    <label style="margin-top:-30px;margin-left:25px" class="form-check-label" for="inlineRadio2">SI</label>
                  </div>
                </div>
              </div>
            </div>
            <?php
            if ($datosReserva[0]['id_compania'] != 0) { ?>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-1 control-label">Empresa</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="empresa" id="empresa" value="<?php echo $datosCompania[0]['empresa']; ?>" disabled="">
                </div>
                <label for="inputEmail3" class="col-sm-1 control-label">Nit</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="nit" id="nit" value="<?php echo $datosCompania[0]['nit'].'-'.$datosCompania[0]['dv']; ?>" disabled="">
                </div>
              </div>
              <?php
              }
            ?>
          </div> 
        </div> 
        <div class="panel-body">
          <div id="imprimeRegistroHotelero"></div>
          <div class="container-fluid pd0">
            <h2>Folios Consumos</h2>
            <div id="mensajeCargo"></div>
            <ul class="nav nav-tabs nav-justified">
              <li class="active folios" id="folios1">
                <a style="cursor:pointer;" data-toggle="tab" onclick="activaFolio(<?php echo $reserva; ?>,1)">Folio 1
                  <?php
                    if ($saldofolio1 != 0) { ?>
                      <span class="fa-stack fa-xs" title="Reserva con Depositos" style="margin-left:0px;cursor:pointer;">
                        <i style="font-size:20px;color: #085908" class="fa fa-circle fa-stack-2x"></i>
                        <i style="font-size:10px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
                      </span>
                      <?php
                    }
                  ?>
                </a>
              </li>
              <li class="folios" id="folios2">
                <a style="cursor:pointer;" data-toggle="tab" onclick="activaFolio(<?php echo $reserva; ?>,2)">Folio 2 
                  <?php
                    if ($saldofolio2 != 0) { ?>
                      <span class="fa-stack fa-xs" title="Reserva con Depositos" style="margin-left:0px;cursor:pointer;">
                        <i style="font-size:20px;color: #085908" class="fa fa-circle fa-stack-2x"></i>
                        <i style="font-size:10px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
                      </span>
                      <?php
                    }
                  ?>
                </a>
              </li>
              <li class="folios" id="folios3">
                <a style="cursor:pointer;" data-toggle="tab" onclick="activaFolio(<?php echo $reserva; ?>,3)">Folio 3
                  <?php
                    if ($saldofolio3 != 0) { ?>
                      <span class="fa-stack fa-xs" title="Reserva con Depositos" style="margin-left:0px;cursor:pointer;">
                        <i style="font-size:20px;color: #085908" class="fa fa-circle fa-stack-2x"></i>
                        <i style="font-size:10px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
                      </span>
                      <?php
                    }
                  ?>
                </a>
              </li>
              <li class="folios" id="folios4">
                <a style="cursor:pointer;" data-toggle="tab" onclick="activaFolio(<?php echo $reserva; ?>,4)">Folio 4
                  <?php
                    if ($saldofolio4 != 0) { ?>
                    <span class="fa-stack fa-xs" title="Reserva con Depositos" style="margin-left:0px;cursor:pointer;">
                      <i style="font-size:20px;color: #085908" class="fa fa-circle fa-stack-2x"></i>
                      <i style="font-size:10px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
                    </span>
                    <?php
                    }
                  ?>
                </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="folio" id="folio1" class="tab-pane fade in active">
                <div class="saldoFolioRoom1" style="font-size:12px"></div>
              </div>
              <div class="folio" id="folio2" class="tab-pane fade">
                <div class="saldoFolioRoom2" style="font-size:12px"></div>
              </div>
              <div class="folio" id="folio3" class="tab-pane fade">
                <div class="saldoFolioRoom3" style="font-size:12px"></div>
              </div>
              <div class="folio" id="folio4" class="tab-pane fade">
                <div class="saldoFolioRoom4" style="font-size:12px"></div>
              </div>
            </div>
          </div>          
        </div>
        <div class="panel-footer" style="background-color:lightgoldenrodyellow">
          <div class="container-fluid" id='saldoReserva'></div>
          <div class="container-fluid" style='padding: 0px'>
            <div class="container-fluid centro">
              <?php
                if ($credito == 1 && $dia >= $dias) {
                    $ancho = 12; ?>
                  <a 
                    style          ="width: <?php echo $ancho; ?>%" 
                    type           ="button" 
                    class          ="btn btn-warning" 
                    data-toggle    ="modal" 
                    data-target    ="#myModalCongelarCuenta"
                    data-id        ="<?php echo $datosReserva[0]['num_reserva']; ?>" 
                    data-idhues    ="<?php echo $datosReserva[0]['id_huesped']; ?>" 
                    data-idcia     ="<?php echo $datosReserva[0]['id_compania']; ?>" 
                    data-idcentro  ="<?php echo $datosReserva[0]['idCentroCia']; ?>" 
                    data-nrohab    ="<?php echo $datosReserva[0]['num_habitacion']; ?>" 
                    data-apellido1 ="<?php echo $datosReserva[0]['apellido1']; ?>" 
                    data-apellido2 ="<?php echo $datosReserva[0]['apellido2']; ?>" 
                    data-nombre    ="<?php echo $datosReserva[0]['nombre_completo']; ?>" 
                    data-nombre1   ="<?php echo $datosReserva[0]['nombre1']; ?>" 
                    data-nombre2   ="<?php echo $datosReserva[0]['nombre2']; ?>" 
                    data-impto     ="<?php echo $datosReserva[0]['causar_impuesto']; ?>" 
                    data-llegada   ="<?php echo $datosReserva[0]['fecha_llegada']; ?>" 
                    data-salida    ="<?php echo $datosReserva[0]['fecha_salida']; ?>" 
                    ><i class="fa fa-snowflake-o"></i> Congelar Cuenta</a>
                  <?php
                } else {
                    $ancho = 13;
                }
              ?>
              <a style="width: <?php echo $ancho; ?>%"
                type           ="button" 
                class          ="btn btn-success" 
                data-toggle    ="modal" 
                data-target    ="#myModalSalidaHuesped" 
                data-id        ="<?php echo $datosReserva[0]['num_reserva']; ?>" 
                data-idhues    ="<?php echo $datosReserva[0]['id_huesped']; ?>" 
                data-idcia     ="<?php echo $datosReserva[0]['id_compania']; ?>" 
                data-idcentro  ="<?php echo $datosReserva[0]['idCentroCia']; ?>" 
                data-nrohab    ="<?php echo $datosReserva[0]['num_habitacion']; ?>" 
                data-nombre    ="<?php echo $datosReserva[0]['nombre_completo']; ?>" 
                data-impto     ="<?php echo $datosReserva[0]['causar_impuesto']; ?>" 
                data-llegada   ="<?php echo $datosReserva[0]['fecha_llegada']; ?>" 
                data-salida    ="<?php echo $datosReserva[0]['fecha_salida']; ?>" 
                data-valor     ="<?php echo $datosReserva[0]['valor_diario']; ?>" 
                ><i class="fa fa-sign-out"></i> Salida Huesped</a>
              <a  style="width: <?php echo $ancho; ?>%"
                type           ="button" class="btn btn-info" data-toggle="modal" 
                data-id        ="<?php echo $datosReserva[0]['num_reserva']; ?>" 
                data-nombre    ="<?php echo $datosReserva[0]['nombre_completo']; ?>" 
                data-impto     ="<?php echo $datosReserva[0]['causar_impuesto']; ?>" 
                data-nrohab    ="<?php echo $datosReserva[0]['num_habitacion']; ?>" 
                data-idhuesped ="<?php echo $datosReserva[0]['id_huesped']; ?>" 
                href           ="#myModalCargosConsumo"
                ><i class      ="fa fa-plus-square"></i> Ingreso Consumos 
              </a>
              <a  style="width: <?php echo $ancho; ?>%"
                type           ="button" class="btn btn-danger"  data-toggle="modal" 
                data-target    = "#myModalAbonosConsumos"
                data-id        ="<?php echo $datosReserva[0]['num_reserva']; ?>" 
                data-idhuesped ="<?php echo $datosReserva[0]['id_huesped']; ?>" 
                data-nrohab    ="<?php echo $datosReserva[0]['num_habitacion']; ?>" 
                data-nombre    ="<?php echo $datosReserva[0]['nombre_completo']; ?>" 
                data-impto     ="<?php echo $datosReserva[0]['causar_impuesto']; ?>" 
                ><i class      ="fa fa-money "></i> Abonos a Cuenta
              </a>
              <a  style="width: <?php echo $ancho; ?>%"
                type           ="button" class="btn btn-primary"  data-toggle="modal" 
                data-target    = "#myModalEstadoCuentaFolio"
                data-reserva   ="<?php echo $datosReserva[0]['num_reserva']; ?>" 
                data-nombre    ="<?php echo $datosReserva[0]['nombre_completo']; ?>" 
                data-idhuesped ="<?php echo $datosReserva[0]['id_huesped']; ?>" 
                ><i class      ="fa fa-money "></i> Estado de Cuenta
              </a>
              <a  style="width: <?php echo $ancho; ?>%"
                type="button" class="btn btn-warning"
                href="facturacionEstadia"
                ><i class="fa fa-home"></i> Inicio
              </a>
            </div>            
          </div>     
        </div>
      </div>
    </form>
  </div>

Donlolo2024#$
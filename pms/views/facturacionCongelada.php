<?php

$datosReserva = $hotel->getReservasDatos($reserva);

$dia = substr(FECHA_PMS, 8, 2);

$datosHuesped = $hotel->getbuscaDatosHuesped($datosReserva[0]['id_huesped']);
$datosCompania = $hotel->getSeleccionaCompania($datosReserva[0]['id_compania']);
// $datosAgencia   = $hotel->getSeleccionaAgencia($datosReserva[0]['id_agencia']);
$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);
// $centros        = $hotel->getBuscaCentroCia($datosReserva[0]['idCentroCia']);

if (count($datosCompania) == 0) {
    $credito = 0;
    $dias = 0;
} else {
    $credito = $datosCompania[0]['credito'];
    $dias = $datosCompania[0]['dia_corte_credito'];
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

    <div class="content-wrapper"> 
      <section class="content" style="height: 780px;" id="listado">
        <div class="container-fluid" style="padding-top:10px 15px;margin-top:20px;margin-bottom: 50px">
          <form class="form-horizontal" id="formHuespedes" action="" method="POST">
            <div class="panel panel-success panelFolio">
              <div class="panel-heading"> 
                <div class="panel-title">
                  <input type="hidden" name="folioActivo" id="folioActivo" value="0">
                  <input type="hidden" name="reservaActual" id="reservaActual" value="<?php echo $reserva; ?>">
                  <input type="hidden" name="saldoActual" id="saldoActual" value="<?php echo $saldoCuenta; ?>">
                  <input type="hidden" name="totalPagos" id="totalPagos" value="<?php echo $pagoCuenta; ?>">
                  <input type="hidden" name="nrofolio1" id="nrofolio1" value="<?php echo $saldofolio1; ?>">
                  <input type="hidden" name="nrofolio2" id="nrofolio2" value="<?php echo $saldofolio2; ?>">
                  <input type="hidden" name="nrofolio3" id="nrofolio3" value="<?php echo $saldofolio3; ?>">
                  <input type="hidden" name="nrofolio4" id="nrofolio4" value="<?php echo $saldofolio4; ?>">
                  <input type="hidden" name="idHuespedSal" id="idHuespedSal" value="<?php echo $datosReserva[0]['id_huesped']; ?>">
                  <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">              
                  <input type="hidden" name="ubicacion" id="ubicacion" value="facturacionCongelada">
                  <h3 class="w3ls_head tituloPagina">Estado Cuenta Huesped</h3>
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
                      <input type="text" class="form-control" name="tarifa" id="tarifa" readonly="" value="<?php echo number_format($datosReserva[0]['valor_diario'], 2); ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="hombres" class="col-sm-1 control-label">Hombres</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="hombres" id="hombres" required="" value="<?php echo $datosReserva[0]['can_hombres']; ?>" readonly>
                    </div>
                    <label for="mujeres" class="col-sm-1 control-label">Mujeres</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="mujeres" id="mujeres" required="" value='<?php echo $datosReserva[0]['can_mujeres']; ?>' readonly>
                    </div>
                    <label for="ninos" class="col-sm-1 control-label">Niños</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="ninos" id="ninos" required="" value="<?php echo $datosReserva[0]['can_ninos']; ?>" readonly >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-1 control-label">Empresa</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="empresa" id="empresa" value="<?php echo $datosCompania[0]['empresa']; ?>" disabled="">
                    </div>
                    <label for="inputEmail3" class="col-sm-1 control-label">Nit</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="nit" id="nit" value="<?php echo $datosCompania[0]['nit'].'-'.$datosCompania[0]['dv']; ?>" disabled="">
                    </div>
<!--                     <?php
                   if ($datosReserva[0]['idCentroCia'] != 0) { ?>
                        <label for="inputEmail3" class="col-sm-1 control-label">Centro de Costo</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" name="centroCia" id="centroCia" value="<?php echo $centros[0]['descripcion_centro']; ?>" disabled="">
                        </div>
                      <?php
                   } ?>
 -->
                  </div>
                </div> 
              </div>
              <div class="panel-body">
                <div class="container-fluid">
                  <h2>Folios Consumos</h2>
                  <div id="mensajeCargo"></div>
                  <ul class="nav nav-tabs nav-justified">
                    <li class="active" id="folios1">
                      <a style="cursor:pointer;" data-toggle="tab" onclick="activaCongelado(<?php echo $reserva; ?>,1)">Folio 1
                      <?php
                     if ($saldofolio1 != 0) { ?>
                        <span class="badge badge-danger fa fa-usd botonSaldo"> </span> 
                        <?php
                     }
?>
                      </a>
                    </li>
                    <li id="folios2">
                      <a style="cursor:pointer;" data-toggle="tab" onclick="activaCongelado(<?php echo $reserva; ?>,2)" >Folio 2 
                        <?php
  if ($saldofolio2 != 0) { ?>
                          <span class="badge badge-danger fa fa-usd botonSaldo"> </span> 
                          <?php
  }
?>
                      </a>
                    </li>
                    <li id="folios3" disabled>
                      <a style="cursor:pointer;" data-toggle="tab" onclick="activaCongelado(<?php echo $reserva; ?>,3)" disabled>Folio 3
                        <?php
if ($saldofolio3 != 0) { ?>
                          <span class="badge badge-danger fa fa-usd botonSaldo"> </span> 
                          <?php
}
?>
                      </a>
                    </li>
                    <li id="folios4" disabled>
                      <a style="cursor:pointer;" data-toggle="tab" onclick="activaCongelado(<?php echo $reserva; ?>,4)" disabled>Folio 4
                        <?php
if ($saldofolio4 != 0) { ?>
                          <span class="badge badge-danger fa fa-usd botonSaldo"> </span> 
                          <?php
}
?>
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div id="folio1" class="tab-pane fade in active">
                      <div class="saldoFolioRoom1" style="font-size:12px">
                      </div>
                    </div>
                    <div id="folio2" class="tab-pane fade">
                      <div class="saldoFolioRoom2" style="font-size:12px"></div>
                    </div>
                    <div id="folio3" class="tab-pane fade">
                      <div class="saldoFolioRoom3" style="font-size:12px"></div>
                    </div>
                    <div id="folio4" class="tab-pane fade">
                      <div class="saldoFolioRoom4" style="font-size:12px"></div>
                    </div>
                  </div>
                </div>          
              </div>
              <div class="panel-footer" style="background-color:lightgoldenrodyellow;text-align: center">
                <a style="width: 20%" type="button" class="btn btn-warning" href="home"><i class="fa fa-reply"></i> Regresar</a>
                <a 
                  style         ="width: 20%"
                  type          ="button"  
                  class         ="btn btn-success" 
                  data-toggle   ="modal" 
                  data-target   ="#myModalSalidaCongelada"
                  data-id       ="<?php echo $datosReserva[0]['num_reserva']; ?>" 
                  data-idhues   ="<?php echo $datosReserva[0]['id_huesped']; ?>" 
                  data-idcia    ="<?php echo $datosReserva[0]['id_compania']; ?>" 
                  data-idcentro ="<?php echo $datosReserva[0]['idCentroCia']; ?>" 
                  data-nrohab   ="<?php echo $datosReserva[0]['num_habitacion']; ?>" 
                  data-nombre   ="<?php echo $datosReserva[0]['nombre_completo']; ?>" 
                  data-impto    ="<?php echo $datosReserva[0]['causar_impuesto']; ?>" 
                  data-llegada  ="<?php echo $datosReserva[0]['fecha_llegada']; ?>" 
                  data-salida   ="<?php echo $datosReserva[0]['fecha_salida']; ?>" 
                  data-tarifa   ="<?php echo descripcionTarifa($datosReserva[0]['tarifa']); ?>" 
                  data-valor    ="<?php echo $datosReserva[0]['valor_diario']; ?>" 
                  ><i class     ="fa fa-save"></i>
                  Salida Huesped
                </a>
                <a  
                  style          ="width: 20%"
                  type           ="button" class="btn btn-info" data-toggle="modal" 
                  data-id        ="<?php echo $datosReserva[0]['num_reserva']; ?>" 
                  data-apellido1 ="<?php echo $datosReserva[0]['apellido1']; ?>" 
                  data-apellido2 ="<?php echo $datosReserva[0]['apellido2']; ?>" 
                  data-nombre1   ="<?php echo $datosReserva[0]['nombre1']; ?>" 
                  data-nombre2   ="<?php echo $datosReserva[0]['nombre2']; ?>" 
                  data-impto     ="<?php echo $datosReserva[0]['causar_impuesto']; ?>" 
                  data-nrohab    ="<?php echo $datosReserva[0]['num_habitacion']; ?>" 
                  data-idhuesped ="<?php echo $datosReserva[0]['id_huesped']; ?>" 
                  href           ="#myModalCargosConsumo"
                  ><i class="fa fa-plus-square"></i> Ingreso Consumos 
                </a>
              </div>
            </div>
          </form>
        </div>
      </section>
    </div>

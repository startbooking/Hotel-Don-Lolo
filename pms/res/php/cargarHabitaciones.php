<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$reserva = $_POST['cargar'];
$tipo = $_POST['cargo'];
$folio = 1; 
$canti = 1;
$usuario = $_POST['usuario'];
$idusuario = $_POST['usuario_id'];
$fecha = FECHA_PMS;
$refer = FECHA_PMS;
$detalle = 'Cargo Noche del '.FECHA_PMS;
$regis = 0;

if ($tipo == 1) {
    $cargoshab = $hotel->getCargoUnaHabitacion($reserva);
} else {
    $cargoshab = $hotel->getCargoTodasHabitaciones(CTA_MASTER);
}

$sinSalir = $hotel->getSalidasSinRealizar(CTA_MASTER, FECHA_PMS);

$regis = count($sinSalir);
if ($regis >= 1 && $tipo == 2) { ?>
  <div class="container-fluid">
    <div class="alert alert-warning" style="padding:0;padding-top:5px;">
      <h4 style="font-weight: 600;text-align :center;">Actualize las Salidas Antes de Realizar el Cargo de las Habitaciones</h4></div>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered">
          <thead>
            <tr class="warning" style="font-weight: bold">
              <td>Nro Hab.</td>
              <td>Huesped</td>
              <td>Salida</td>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($sinSalir as $sinSalida) { ?>
              <tr style='font-size:12px'>
                <td><?php echo $sinSalida['num_habitacion']; ?></td>
                <td><?php echo $sinSalida['apellido1'].' '.$sinSalida['apellido2'].' '.$sinSalida['nombre1'].' '.$sinSalida['nombre2']; ?></td>
                <td><?php echo $sinSalida['fecha_salida']; ?></td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>			
    </div> 
  <?php
} else {
  foreach ($cargoshab as $cargohab) {
    if ($cargohab['cargo_habitacion'] == 0) {
      $codigo = $hotel->buscaCodigoTipoHabitacion($cargohab['tipo_habitacion']);
      $codigoVenta = $hotel->buscaTextoCodigoVenta($codigo);
      $paquetes = $hotel->traePaquetesHabitacion($cargohab['tarifa']);
      $valor = $cargohab['valor_diario'];
      $totalcargo = $valor * $canti;
      $iva = $codigoVenta[0]['id_impto'];
      $textocodigo = $codigoVenta[0]['descripcion_cargo'];
      $codigocar = $codigoVenta[0]['id_cargo'];
      $turismo = $cargohab['causar_impuesto'];
      $baseimpto = 0;
      if ($iva == 0) {
        $impuesto = 0;
      } else {
        $porcentaje = $hotel->getPorcentajeIvaCargo($iva);
        $porcImpto = $porcentaje[0]['porcentaje_impto'];
        $imptoTuri = $porcentaje[0]['decreto_turismo'];

        if (IVA_INCLUIDO == 1) {
          $nuevototal = round($totalcargo / ((100 + $porcImpto) / 100), 0);
          if ($turismo == 2 && $imptoTuri == 1) {
            $impuesto = 0;
          } else {
            $impuesto = $totalcargo - $nuevototal;
          }
          $totalcargo = $nuevototal;
        } else {
          if ($turismo == 2 && $imptoTuri == 1) {
            $impuesto = 0;
          } else {
            $impuesto = round($totalcargo * ($porcImpto / 100), 0);
          }
        }
      }

      if ($impuesto != 0) {
        $baseimpto = $totalcargo;
      }

      $valor1 = $impuesto + $totalcargo;
      $numero = $cargohab['num_reserva'];
      $room = $cargohab['num_habitacion'];
      $idhues = $cargohab['id_huesped'];
      $paxHue = $cargohab['can_hombres'] + $cargohab['can_mujeres'] + $cargohab['can_ninos'];

      if ($totalcargo != 0) {
        $cargos = $hotel->insertCargosConsumos($codigocar, $textocodigo, $valor1, $canti, $refer, $folio, $detalle, $numero, $idhues, $usuario, $idusuario, $fecha, $room, $totalcargo, $impuesto, $baseimpto, $iva);
      }

      if ($paquetes) {
        $codigocar = $paquetes[0]['codigo_vta'];
        $textocodigo = $paquetes[0]['descripcion_cargo'];
        $valor = $paquetes[0]['valor'];
        $totalcargo = $valor * $paxHue;
        $detSegu = 'Seguro Noche del '.FECHA_PMS;
        $iva = $paquetes[0]['id_impto'];

        if ($iva == 0) {
          $impuesto = 0;
        } else {
          $porcentaje = $hotel->getPorcentajeIvaCargo($iva);
          $porcImpto = $paquetes[0]['porcentaje_impto'];
          $imptoTuri = $paquetes[0]['decreto_turismo'];

          if (IVA_INCLUIDO == 1) {
            $nuevototal = round($totalcargo / ((100 + $porcImpto) / 100), 0);
            if ($turismo == 2 && $imptoTuri == 1) {
              $impuesto = 0;
            } else {
              $impuesto = $totalcargo - $nuevototal;
            }
            $totalcargo = $nuevototal;
          } else {
            if ($turismo == 2 && $imptoTuri == 1) {
              $impuesto = 0;
            } else {
              $impuesto = round($totalcargo * ($porcImpto / 100), 0);
            }
          }
        }

        if ($impuesto != 0) {
          $baseimpto = $totalcargo;
        }

        $valor1 = $impuesto + $totalcargo;

        $cargos = $hotel->insertCargosConsumos($codigocar, $textocodigo, $valor1, $paxHue, $refer, $folio, $detSegu, $numero, $idhues, $usuario, $idusuario, $fecha, $room, $totalcargo, $impuesto, $baseimpto, $iva);
      }

    $uRC = $hotel->updateRoomChange($numero);
    }
  }
    echo '1';
}

?>

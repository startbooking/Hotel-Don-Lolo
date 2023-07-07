

<?php
  require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$room = $_POST['roomAdi'];
$nroroom = $_POST['roomNroAdi'];
$desde = $_POST['desdeFechaAdi'];
$hasta = $_POST['hastaFechaAdi'];
$motivo = $_POST['motivoAdi'];
$inventario = 1;
$presup = 0;
$tipo = $_POST['tipoMmtoOption'];
$observa = strtoupper($_POST['observacionesAdi']);
$usuario = $_POST['usuario'];

if ($inventario == 1) {
    $estadoHab = 'FO';
} else {
    $estadoHab = 'FS';
}

if ($observa != '') {
    $observa = $observa.' Usuario '.$usuario.'  Fecha Ingreso '.date('Y-m-d H:i:s');
}

$habi = $hotel->getNumeroHab($room);

$buscaRe = $hotel->buscaReservaHab($habi, $desde, $hasta);

if (count($buscaRe) == 0) {
    $numero = $hotel->getNumeroMantenimiento(); // Numero Actual de La Reserva
    $nuevonumero = $hotel->updateNumeroMantenimiento($numero + 1); // Actualiza

    $adicional = $hotel->adicionaMantenimiento($room, $desde, $hasta, $motivo, $inventario, $estadoHab, $observa, $presup, $numero, $tipo, $usuario);

    if ($adicional != 0) {
        $actualizaHab = $hotel->actualizaMmtoHabitacion($nroroom, 1);
        include_once '../../imprimir/imprimeMantenimiento.php';
    } else {
        $actualizaHab = 0;
    }
} else { ?>
		<div class="container-fluid">
      <div class="table-responsive"> 
      	<div class="alert alert-danger"><h4 align="center">Asigne Nueva Habitacion las Reservas Asociadas</h4></div>
	      <table id="example1" class="table modalTable table-bordered">
	        <thead>
	          <tr class="warning">
	            <td>Habitacion</td>
	            <td>Huesped</td>
	            <td>Fecha Llegada</td>
	            <td>Fecha Salida</td>
	          </tr>
	        </thead>
	        <tbody>
	          <?php
          foreach ($buscaRe as $busca) { ?>
	            <tr style='font-size:12px'>
	              <td><?php echo $busca['num_habitacion']; ?></td>
	              <td>
	              	<?php
                      $nombres = $hotel->getNombreHuesped($busca['id_huesped']);
              echo $nombres[0]['nombre_completo'];
              ?>              	
	              </td>
	              <td><?php echo $busca['fecha_llegada']; ?></td>
	              <td><?php echo $busca['fecha_salida']; ?></td>
	            </tr>
	            <?php
          }
    ?>
	        </tbody>
	      </table>
	    </div>
		</div> 
		<?php
}
?>
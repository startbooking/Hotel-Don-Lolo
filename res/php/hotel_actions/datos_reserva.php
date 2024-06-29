<?php
require '../config.php';
require '../app_top.php';

$tipo      = $_POST['tipohab'];
$hotel     = $_POST['hotel'];
$cant      = $_POST['cantida'];
$fechain   = $_POST['fechain'];
$fechaout  = $_POST['fechaout'];
$adultos   = $_POST['adultos'];
$ninos     = $_POST['ninos'];
$noches    = $_POST['noches'];
$tarifa    = $_POST['tarifa'];
$valesta   = $_POST['valesta'];
$valtotal  = $cant * $valesta;

$formatter = new IntlDateFormatter('es_CO', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
$mfechain  = $formatter->format(strtotime($fechain . ' 12:00'));
$mfechaout = $formatter->format(strtotime($fechaout . ' 12:00'));

/* $mfechain  = strftime("%d de %B %Y", strtotime($fechain));
$mfechaout = strftime("%d de %B %Y", strtotime($fechaout)); */
$imptoinc  = $user->getTaxHotel($hotel);
$room      = $user->getTypeRoom($hotel, $tipo);
?>

<div class="row databooking">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4 style="font-weight: 700" align="center">Datos de la Reserva</h4>
		</div>
		<div class="panel-body" style="padding:5px">

			<h4 align="center"><?php echo $user->getHotelName($hotel) ?></h4>
			<h4 align="center"><?= $room[0]['room_name'] ?></h4>
			<input type="hidden" id="nombhabi" value="<?= $room[0]['room_name'] ?>">
			<input type="hidden" id="tipohabi" value="<?= $room[0]['id_room'] ?>">
			<input type="hidden" id="valestadia" value="<?= $valesta ?>">
			<input type="hidden" id="valortotal" value="<?= $valtotal ?>">
			<input type="hidden" id="tarifa" value="<?= $tarifa ?>">
			<input type="hidden" id="canthabi" value="<?= $cant ?>">

			<div class="row">
				<div class="col-lg-6 col-md-6 col-xs-12" style='padding:0;'>
					<img class="thumbnail" src="<?php echo BASE_IMAGES ?>rooms/sm-<?= $room[0]['image'] ?>" alt="" style="width: 100%">
				</div>
				<div class="col-lg-6 col-md-6 col-xs-12" style='padding:0'>
					<div class="row " style="display: flex;flex-wrap: wrap;justify-content: center;">
						<?php
						$facilidades = $user->getFacilityRoom($room[0]['id_room']);
						foreach ($facilidades as $facilidad) : ?>
							<div class="col-lg-2 col-md-2 col-xs-2 divFacility">
								<img class="img-thumbnail" src="<?php echo BASE_IMAGES ?>facility/<?= $facilidad['image'] ?>" alt="<?= $facilidad['description'] ?>" title="<?= $facilidad['description'] ?>" style="width: 100%">
							</div>
						<?php endforeach;
						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="row" style='padding:5px'>
					<button class="btn btn-info btn-block" type="">Cant. Habitaciones <span class="badge badge-danger" style="color:brown"><?= number_format($cant, 0) ?></span></button>
				</div>
				<table style="width: 90%;margin:15px">
					<tbody>
						<tr>
							<td style="font-size:0.7em;">Fecha Llegada</td>
							<td style="font-size:0.7em;font-weight: bold" align="right"><?= $mfechain ?></td>
						</tr>
						<tr>
							<td style="font-size:0.7em;">Fecha Salida</td>
							<td style="font-size:0.7em;font-weight: bold" align="right"><?= $mfechaout ?></td>
						</tr>
						<tr>
							<td style="font-size:0.7em;">Huespedes</td>
							<td style="font-size:0.7em;font-weight: bold" align="right"><?= $adultos + $ninos ?></td>
						</tr>
						<tr>
							<td style="font-size:0.7em;">Noches</td>
							<td style="font-size:0.7em;font-weight: bold" align="right"><?= $noches ?></td>
						</tr>
						<tr>
							<td style="font-size:0.7em;">Valor Estadia X Habitacion</td>
							<td align="right" style="font-size:1.0em;font-weight: 600"><?= number_format($valesta, 2) ?><br>
							</td>
						</tr>
						<tr>
							<td style="font-size:0.7em;">Habitaciones Reservadas</td>
							<td align="right" style="font-size:1.0em;font-weight: 600"><?= number_format($cant, 0) ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="panel-footer" style="background: #F2C4C4">
				<h4 style="font-weight: 800" align="center">Valor Total Estadia</h4>
				<h4 align="center"><?= number_format($valtotal, 2) ?> <br><small style="font-size:0.8em;color:#000">
						<?php
						if ($imptoinc == 1) { ?>
							(Impuestos Incluidos)
						<?php
						} else { ?>
							(Impuestos No Incluidos)
						<?php
						}
						?>
					</small></h4>
				<tr>
					<td align="right" style="font-size:1.0em;font-weight: 800">

					</td>
				</tr>
			</div>
		</div>
	</div>

</div>
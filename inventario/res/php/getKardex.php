<?php

require '../../../res/php/app_topInventario.php';

$bodega = $_POST['bodega'];
$nomBod = $admin->getNombreBodega($bodega);
$kardexs = $inven->getTraeKardex($bodega);
?>

<div class="container-fluid pd0">
	<div class="panel panel-success">
		<div class="panel-heading">
			<div class="row">
				<div class="col-lg-10">
					<h3 class="sombraBlanca" style="margin:0px;text-align:center;font-weight:700">Kardex <?php echo $nomBod; ?></h3>
				</div>
				<div class="col-lg-2 pd10">
            <button class="btn btn-info" onclick="exportarJSONaExcel(<?php echo htmlspecialchars(json_encode($kardexs));?>, 'kardexInventario')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar Movimientos</button>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<table id="example1" class="table table-hover table-bordered table-condensed">
				<thead>
					<tr class="warning">
						<th>Producto</th>
						<th>Unidad</th>
						<th>Entradas</th>
						<th>Salidas</th>
						<th>Saldo</th>
						<th>Promedio</th>
						<th>Valor Total</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$valorInventario = 0;
					foreach ($kardexs as $kardex) {
					?>
						<tr>
							<td><?php echo $kardex['nombre_producto']; ?></td>
							<td><?php echo $kardex['descripcion_unidad']; ?></td>
							<td class="derecha"><?php echo number_format($kardex['entradas'], 2); ?></td>
							<td class="derecha"><?php echo number_format($kardex['salidas'], 2); ?></td>
							<td class="derecha"><?php echo number_format($kardex['saldo'], 2); ?></td>
							<td class="derecha"><?php
																	if ($kardex['promedio'] == '') {
																		echo number_format(0, 2);
																	} else {
																		echo number_format($kardex['promedio'], 2);
																	}
																	?>
							</td>
							<td class="derecha"><?php echo number_format($kardex['promedio'] * $kardex['saldo'], 2); ?></td>
							<td class="centro">
								<button
									type="button"
									class="btn btn-info btn-xs"
									data-toggle="modal"
									data-target="#modalConsultaKardex"
									data-id="<?php echo $kardex['id_producto']; ?>"
									data-bodega="<?php echo $bodega; ?>"
									data-nombre="<?php echo $kardex['nombre_producto']; ?>"
									onclick="muestraProductoKardex()"
									title="Muestra Movimientos de Inventario">
									<i class='glyphicon glyphicon-edit'></i>
								</button>
								<!-- <div class="btn-group">
								</div> -->
							</td>
						</tr>
					<?php
						$valorInventario += $kardex['promedio'] * $kardex['saldo'];
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<table>
				<thead>
					<tr style="font-size:26px;">
						<td>Valor Inventario</td>
						<td style="text-align:right;"><?php echo number_format($valorInventario, 2); ?></td>
					</tr>
				</thead>
			</table>
		</div>

	</div>
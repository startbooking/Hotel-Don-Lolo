<div class="content-wrapper" id="pantallaHuespedes"> 
	<section class="content">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-xs-12">
						<input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_ADM; ?>">
						<input type="hidden" name="ubicacion" id="ubicacion" value="clientes()">
						<h3 class="w3ls_head tituloPagina">
							<i class="fa-solid fa-money-check-dollar"></i>
							<!-- 
							<i class="fa-solid fa-money-bill-1-wave"></i>
								<i style="color:black;font-size:36px;" class="fa fa-address-book-o"> 
									</i>
								-->
						 Estado Cartera Compañias
						</h3>
					</div>
					<div class="col-lg-6 col-md-6 col-xs-12">
						<button class="btn btn-info btnTitle pull-right" onclick="exportTableToExcel('tablaCartera')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="datos_ajax_delete"></div>
				<div class="container-fluid">
					<table id="example1" class="table table-bordered">
						<thead>
							<tr class="warning">
								<th>Nit.</th>
								<th>Empresa</th>
								<th>Direccion</th>
								<th>Saldo </th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($clientes as $cliente) { ?>
								<tr style='font-size:12px'>
									<td><?php echo $cliente['nit']; ?>-<?php echo $cliente['dv']; ?></td>
									<td><?php echo $cliente['empresa']; ?></td>
									<td><?php echo $cliente['direccion']; ?></td>
									<td class="t-right"><?php echo number_format($cliente['total'], 2); ?></td>
									<td class="centro">
										<button 
											type="button" }
											class="btn btn-success btn-xs" 
											data-toggle="modal" 
											data-target="#dataEstadoCartera" 
											data-id="<?php echo $cliente['id_compania']; ?>" 
											data-nit="<?php echo $cliente['nit']; ?>" 
											data-compania="<?php echo $cliente['empresa']; ?>" 
											title="Lista Estado Cartera">
											<i class='fa fa-briefcase'></i>
										</button>
									</td>
								</tr>
							<?php
							} ?>
						</tbody>
					</table>
				</div>
				<div class="container-fluid" style="display:none">
					<table id="tablaCartera" class="table table-bordered">
						<thead>
							<tr class="warning">
								<th>Nit.</th>
								<th>Empresa</th>
								<th>Direccion</th>
								<th>Saldo </th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($clientes as $cliente) { ?>
								<tr style='font-size:12px'>
									<td><?php echo $cliente['nit']; ?>-<?php echo $cliente['dv']; ?></td>
									<td><?php echo $cliente['empresa']; ?></td>
									<td><?php echo $cliente['direccion']; ?></td>
									<td class="t-right"><?php echo number_format($cliente['total'], 2); ?></td>
								</tr>
							<?php
							} ?>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</section>
<?php
include 'modal/modalCarteraClientes.php';
?>

</div>
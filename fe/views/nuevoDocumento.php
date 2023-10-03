<div class="content-wrapper"> 
	<section class="content">
		<div class="container outer-section" >        
			<form class="form-horizontal" role="form" id="datos_presupuesto" method="post">
				<div id="print-area">
					<div class="row pad-top font-big">
						<div class="col-lg-4 col-md-4 col-sm-4">
							<a href="https://obedalvarado.pw/" target="_blank">  <img src="assets/img/logo.png" alt="Logo sistemas web" /></a>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4">
							<strong>E-mail : </strong> <?php echo $rw['email'];?>
							<br />
							<strong>Teléfono :</strong> <?php echo $rw['telefono'];?> <br />
							<strong>Sitio web :</strong> <?php echo $rw['web'];?>                    
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4">
							<strong><?php echo $rw['nombre_comercial'];?>  </strong>
							<br />
							Dirección : <?php echo $rw['direccion'];?> 
						</div>
					</div>
					<div class="row ">
						<hr />
						<div class="col-lg-6 col-md-6 col-sm-6">
							<h2>Detalles del proveedor :</h2>
							<select class="proveedor form-control" name="proveedor" id="proveedor" required>
								<option value="">Selecciona el proveedor</option>
							</select>
							<span id="direccion"></span>
							<h4><strong>E-mail: </strong><span id="email"></span></h4>
							<h4><strong>Teléfono: </strong><span id="telefono"></span></h4>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<h2>Detalles de la orden de compra :</h2>
							<div class="row">
								<div class="col-lg-6">
									<h4><strong>Orden #: </strong><?php echo $numero;?></h4>
								</div>
								<div class="col-lg-6">
									<h4><strong>Fecha: </strong> <?php echo date("d/m/Y");?></h4>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<label>Condiciones de pago</label>
									<input type="text" name="condiciones" id="condiciones" class="form-control">
								</div>						
								<div class="col-lg-6">
									<label>Método de envío</label>
									<input type="text" name="envio" id="envio" class="form-control">
								</div>						
							</div>
						</div>
					</div>
					<div class="row">
						<hr />
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="table-responsive">
								<table class="table table-striped  table-hover">
									<thead>
										<tr style="background-color:#c0392b;color:white;">
										<th class='text-center'>Item</th>
										<th class='text-center'>Cantidad</th>
										<th class='text-center'>Unidad</th>
										<th>Descripción</th>
										<th class='text-right'>Costo unitario</th>
										<th class='text-right'>Total</th>
										<th class='text-right'></th>
									</tr>
									</thead>
									<tbody class='items'>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row"> <hr /></div>
					<div class="row pad-bottom  pull-right">		
						<div class="col-lg-12 col-md-12 col-sm-12">
							<button type="submit" class="btn btn-success ">Guardar orden de compra</button>
						</div>
				</div>
			</form>
		</div>
		<form class="form-horizontal" name="guardar_item" id="guardar_item">
			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Nuevo Ítem</h4>
						</div>
						<div class="modal-body">					
							<div class="row">
								<div class="col-md-12">
									<label>Descripción del producto</label>
									<textarea class="form-control" id="descripcion" name="descripcion"  required></textarea>
									<input type="hidden" class="form-control" id="action" name="action"  value="ajax">
								</div>						
							</div>
							<div class="row">
								<div class="col-md-4">
									<label>Cantidad</label>
									<input type="text" class="form-control" id="cantidad" name="cantidad" required>
								</div>
								<div class="col-md-4">
									<label>Unidad</label>
									<input type="text" class="form-control" id="unidad" name="unidad" required>
								</div>
								
								<div class="col-md-4">
									<label>Costo unitario</label>
									<input type="text" class="form-control" id="precio" name="precio" required>
								</div>						
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-info" >Guardar</button>						
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
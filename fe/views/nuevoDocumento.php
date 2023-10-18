<?php
	$hoy = date('Y-m-d');
	$hora = date('H:i:s');
	$pagos = $user->getFormasPago();

?>

<div class="content-wrapper" id="documentoSoporte"> 
	<h3 class="txtBl centro" style="">
	<span class="material-symbols-outlined">receipt_long</span> Documento Soporte</h3>
	<section class="content">
		<div class="container outer-section" >        
			<form class="row-fluid" role="form" id="datosDocSoporte" method="post">
				<div id="print-area">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="panel panel-success">
              <div class="panel-heading">
								<div class="container-fluid ">
									<div id="mensaje" class="alert alert-warning oculto centraTitulo"></div>
									<div class="form-group row">
										<label for="nombre" class="control-label col-lg-2 col-md-2">Nro Documento </label>
										<div class="col-lg-2 col-md-2">
											<input type="text" class="form-control" id="documento" name="documento"  onblur="asignaLocalStorage(this.name, this.value)">
										</div>
										<label for="nombre" class="control-label col-lg-2 col-md-2">Tipo Operacion </label>
										<div class="col-lg-3 col-md-3">
											<select class="proveedor form-control" name="tipoOperacion" id="tipoOperacion" onblur="asignaLocalStorage(this.name, this.value)">
												<option value="">Tipo de Operacion</option>
												<option value="1">Individual</option>
												<option value="2">Acumulada</option>
											</select>
										</div>
									</div>
									<hr />
									<div class="form-group row">
										<label for="nombre" class="form-label col-lg-2 col-md-2">Proveedor </label>
										<div class="col-lg-4 col-md-4">
											<select class="proveedor form-control" name="proveedor" id="proveedor"  onblur="asignaLocalStorage(this.name, this.value)">
												<option value="">Selecciona el Proveedor</option>
												<?php 
													foreach ($proveedores as $proveedor) { ?>
														<option value="<?=$proveedor['id_compania'];?>"><?= $proveedor['empresa'];?> </option>
														<?php 
													}
												?>
											</select>
										</div>
										<label for="nombre" class="control-label col-lg-1 col-md-1">Fecha </label>
										<div class="col-lg-2 col-md-2">
											<input type="date" class="form-control" id="fecha" name="fecha"  onblur="asignaLocalStorage(this.name, this.value)">
										</div>										
										<label for="nombre" class="control-label col-lg-1 col-md-1">Plazo </label>
										<div class="col-lg-2 col-md-2">
											<input type="number" min="0" class="form-control" id="plazo" name="plazo"  onchange="sumaFecha()" onblur="asignaLocalStorage(this.name, this.value)" value="0">
										</div>
									</div>
									<div class="form-group row">	
										<label for="nombre" class="control-label col-lg-2 col-md-2">Vencimiento </label>
										<div class="col-lg-2 col-md-2">
											<input type="date" class="form-control" id="vence" name="vence"  value="<?=$hoy?>" onblur="asignaLocalStorage(this.name, this.value)">
										</div>														
										<label for="nombre" class="control-label col-lg-2 col-md-2">Forma de pago </label>
										<div class="col-lg-4 col-md-4">
											<select 
												class="formaPago form-control" name="formaPago" id="formaPago"  onblur="asignaLocalStorage(this.name, this.value)">
												<option value="">Selecciona Forma de Pago</option>
												<?php 
													foreach ($pagos as $pago) { ?>
														<option value="<?=$pago['id_cargo'];?>"><?= $pago['descripcion_cargo'];?> </option>
														<?php 
													}
												?>
											</select>
										</div>
										<button 
											type="button" 
											class="btn btn-info" 
											data-edita="0"
											data-toggle="modal" 
											data-target="#myModalAdicionaItem">										
											<span class="material-symbols-outlined">library_add</span> Agregar Item</button>										
									</div>									
									<div class="form-group row">	
										<label for="nombre" class="control-label col-lg-2 col-md-2">Comentarios </label>
										<div class="col-lg-6 col-md-6">
											<input type="text" class="form-control" id="comentarios" name="comentarios"  value="" onblur="asignaLocalStorage(this.name, this.value)">
										</div>																								
									</div>
								</div>
              </div>
              <div class="panel-body">
                <table id="dataDocSoporte" class="table table-bordered">
                  <thead>
                  <tr>
										<th class='centro'>Descripción / Item</th>
										<th class='centro'>Unidad</th>
										<th class='centro'>Costo unitario</th>
										<th class='centro'>Cantidad</th>
										<th class='centro'>Total</th>
										<th class='centro'>Accion</th>                    
                  </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-lg-6"></div>
									<div class="col-lg-6">
										<table id="" class="table table-bordered">
											<tfoot>
												<tr>
													<th>Total Compra / Servicio</th>
													<th><input type="text" min="1" class="form-control derecha" id="totalDocumento" name="totalDocumento" disabled></th>
													<th></th>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="container-fluid derecha">
										<button type="submit" class="btn btn-warning cancela"><span class="material-symbols-outlined">undo</span> Cancelar </button>
										<button type="submit" class="btn btn-success guarda"><span class="material-symbols-outlined">save</span> Guardar Documento</button>
									</div>
								</div>								
							</div>							
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>

<?php 
include_once 'views/modal/modalDocSoporte.php'; 
include_once 'views/modal/modalProductos.php'; 
?> 

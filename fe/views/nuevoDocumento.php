<div class="content-wrapper"> 
	<h4 class="centro">Documento Soporte</h4>
	<section class="content">
		<div class="container outer-section" >        
			<form class="row-fluid" role="form" id="datosDocSoporte" method="post">
				<div id="print-area">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="card">
              <div class="card-header">
								<div class="container-fluid ">
									<div class="form-group row">
										<label for="nombre" class="control-label col-lg-2 col-md-2">Nro Documento </label>
										<div class="col-lg-2 col-md-2">
													<input type="text" class="form-control" id="nombreAdi" name="nombreAdi" required>
										</div>
										<label for="nombre" class="control-label col-lg-2 col-md-2">Tipo Operacion </label>
										<div class="col-lg-2 col-md-2">
											<select class="proveedor form-control" name="tipoOperacion" id="tipoOperacion">
												<option value="1">Individual</option>
												<option value="2">Acumulada</option>
											</select>
										</div>
									</div>
									<hr />
									<div class="form-group row">
										<label for="nombre" class="control-label col-lg-2 col-md-2">Proveedor </label>
										<div class="col-lg-4 col-md-4">
											<select class="proveedor form-control" name="proveedor" id="proveedor" required>
												<option value="">Selecciona el Proveedor</option>
											</select>
										</div>
										<label for="nombre" class="control-label col-lg-1 col-md-1">Fecha </label>
										<div class="col-lg-2 col-md-2">
											<input type="date" class="form-control" id="nombreAdi" name="nombreAdi" required>
										</div>
										<label for="nombre" class="control-label col-lg-1 col-md-1">Plazo </label>
										<div class="col-lg-2 col-md-2">
											<input type="number" min="0" class="form-control" id="nombreAdi" name="nombreAdi" required>
										</div>
									</div>
									<div class="form-group row">	
										<label for="nombre" class="control-label col-lg-2 col-md-2">Vencimiento </label>
										<div class="col-lg-2 col-md-2">
											<input type="date" class="form-control" id="nombreAdi" name="nombreAdi" required>
										</div>														
										<label for="nombre" class="control-label col-lg-2 col-md-2">Forma de pago </label>
										<div class="col-lg-4">
											<select 
												class="formaPago form-control" name="formaPago" id="formaPago" required>
												<option value="">Selecciona Forma de Pago</option>
											</select>
										</div>										
										<button type="button" class="btn btn-info btn-sm derechaAbs" data-toggle="modal" data-target="#myModalAdicionaItem"><span class="glyphicon glyphicon-plus"></span> <span class="material-symbols-outlined">library_add</span> Agregar Item</button>
									</div>									
								</div>
              </div>
              <div class="card-body">
                <table id="dataDocSoporte" class="table table-bordered table-hover">
                  <thead>
                  <tr>
										<th class='text-center'>Item</th>
										<th>Descripción / Item</th>
										<th class='text-center'>Unidad</th>
										<th class='text-right'>Costo unitario</th>
										<th class='text-center'>Cantidad</th>
										<th class='text-right'>Total</th>
										<th class='text-right'>Accion</th>                    
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot> -->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
							<!-- <div class="table-responsive">
								<table class="table table-hover">
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
							</div> -->
						</div>
					</div>
				</div>
				<!-- <div class="row"> <hr /></div> -->
        <div class="row pad-bottom  pull-right">		
          <div class="col-lg-12 col-md-12 col-sm-12">
            <button style="display:flex" type="submit" class="btn btn-success "><span class="material-symbols-outlined">save</span> Guardar Documento</button>
          </div>
				</div>
			</form>
		</div>
		<!-- Modal -->
		<form class="form-horizontal" name="guardar_item" id="example1_wrapper">
			<!-- <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Nuevo Ítem</h4>
				</div>
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body">					
							<div class="row">
								<div class="col-md-12">
									<label>Descripción del producto</label>
									<select name="" id="">
										<option value=""></option>
									</select>
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
			</div> -->
		</form>
	</section>
</div>


<?php 
include_once 'views/modal/modalDocSoporte.php'; 
include_once 'views/modal/modalCodigosVentas.php'; 
?> 


<!-- 
<script>
  $(function () {
    $("#dataDocSoporte2").DataTable({
      "responsive": true, 
			"lengthChange": false, 
			"autoWidth": false,
		});
		$('#dataDocSoporte').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script> -->
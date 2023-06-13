			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="" aria-hidden="true"></span></button>
					<h4 class="modal-title" id="myModalLabel">Buscar Productos</h4> 
				  </div>
				  <div class="modal-body">
					<form class="form-horizontal">
					  <div class="form-group">
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="q" placeholder="Buscar productos" onkeyup="loadProductosMov(1)">
						</div>
						<div class="col-lg-3">
							<button type="button" class="btn btn-info btn-block" onclick="loadProductosMov(1)">
								<span class='glyphicon glyphicon-search'></span> Buscar
							</button>
						</div>
					  </div>
					</form>
					<div id="loader" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="outer_div" ></div><!-- Datos ajax Final -->
				  </div>
				  <div class="modal-footer">
				  <div class="col-lg-4 col-lg-offset-4">
						<button type="button" class="btn btn-success btn-block" data-dismiss="modal">Cerrar</button>
				  </div>

					
				  </div>
				</div>
			  </div>
			</div>

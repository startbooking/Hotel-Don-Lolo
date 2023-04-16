		<div class="modal fade bs-example-modal-lg" id="ModalDetalleMovimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
			  	<div class="row-fluid imprime_productos_mov" >
			  	<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
						<h4 class="modal-title" id="myModalLabel">Detalle del Movimiento</h4>
						<input type="hidden" name="almacen" id="almacen">
						<input type="hidden" name="numero" id="numero">
			  	</div>
        	<div id="datos_ajax_register"></div>
			  	<div class="modal-body">
						<div id="cargador" style="position: relative;	text-align: center;top: 5px;width: 100%;display:none;"></div><!-- Carga gif animado -->
						<div class="outer_div1" ></div><!-- Datos ajax Final -->
				  </div>
			  	</div>
			  	<div class="modal-footer">
			  	<div class="row-fluid">
			  	<div class="col-lg-3 col-lg-offset-3">
						<button type="button" class="btn btn-info btn-block" onclick='imprimir(".imprime_productos_mov")'>Imprimir</button>
			  	</div>
			  	<div class="col-lg-3">
						<button type="button" class="btn btn-success btn-block" data-dismiss="modal">Cerrar</button>
			  	</div>
			  	</div>
			  	</div>
				</div> 
		  </div>
		</div>
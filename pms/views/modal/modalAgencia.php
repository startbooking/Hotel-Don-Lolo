<div class="modal fade bs-example-modal-lg" id="myModalAdicionaAgencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
	  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
				<h4 class="modal-title" id="myModalLabel">Adicionar Compañia</h4>
	  	</div>
	  	<div class="modal-body">
        <div class="panel panel-success" id='pantallaNuevaCompania'>
          <form class="form-horizontal" id="formAgencia" action="javascript:guardaAgencia()" method="POST">
            <div class="panel-body">
              <div class="divs divHuesped">
                <div class="form-group">
                  <label for="nit" class="col-sm-2 control-label">Nit</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="nit" id="nit" placeholder="Nit" onblur="buscaAgenciaActiva(this.value)" required="">
                  </div>
                  <label for="dv" class="col-sm-1 control-label">Digito</label>
                  <div class="col-sm-1">
                    <input type="text" class="form-control" name="dv" id="dv" placeholder="Dv" required="" onfocus="calcularDigitoVerificacion()" readonly="">
                  </div>
                  <label for="tipodoc" class="col-sm-2 control-label">Tipo Documento</label>
                  <div class="col-sm-3">
                    <select name="tipodoc" required>
                      <option value="">Seleccione el Tipo de Documeto</option>
                      <?php 
                        $tipodocs = $hotel->getTipoDocumento(); ?>
                        <?php foreach ($tipodocs as $tipodoc): ?>
                          <option value="<?=$tipodoc['id_doc']?>"><?=$tipodoc['descripcion_documento']?></option>}
                        <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="agencia" class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="agencia" id="agencia" placeholder="Nombre Agencia" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="direccion" class="col-sm-2 control-label">Direccion </label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" required>
                  </div>
                  <label for="ciudad" class="col-sm-2 control-label">Ciudad</label>
                  <div class="col-sm-4">
                    <select name="ciudad" id="ciudad" required="">
                      <option value="">Seleccione la Ciudad</option>
                    <?php 
                      $ciudades = $hotel->getCiudades();
                      foreach ($ciudades as $ciudad) { ?>
                        <option value="<?=$ciudad['id_ciudad']?>"><?=$ciudad['municipio'].' '.$ciudad['depto']?></option>
                        <?php 
                      }
                     ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">                  
                  <label for="telefono" class="col-sm-2 control-label">Telefono</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono">
                  </div>
                  <label for="celular" class="col-sm-2 control-label">Celular</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="celular" id="celular" placeholder="Nro celular">
                  </div>
                </div>
                <div class="form-group">
                  <label for="web" class="col-sm-2 control-label">Pagina Web </label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="web" id="web" placeholder="" value="">
                  </div>
                  <label for="correo" class="col-sm-2 control-label">Correo </label>
                  <div class="col-sm-4">
                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo Electronico" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tarifa" class="col-sm-2 control-label">Tarifa </label>
                  <div class="col-sm-4">
                    <select name="tarifa" id="tarifa" required="">
                    <?php 
                      $tarifas = $hotel->getTarifasHuespedes(); ?>
                      <?php foreach ($tarifas as $tarifa): ?>
                        <option value="<?=$tarifa['id_tarifa']?>"><?=$tarifa['descripcion_tarifa']?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <label for="formapago" class="col-sm-2 control-label">Forma de Pago </label>
                  <div class="col-sm-4">
                    <select name="formapago" id="formapago" required="">
                    <option value="">Seleccione La Forma de Pago</option>
                      <?php 
                        $codigos = $hotel->getCodigosConsumos(3);
                        foreach ($codigos as $codigo) { ?>
                          <option value="<?=$codigo['id_cargo']?>"><?=$codigo['descripcion_cargo']?></option>
                           option 
                          <?php  
                        }
                         ?>
                    </select>
                  </div>
                </div>                           
                <div class="form-group">
                  <label for="potencial" class="col-sm-2 control-label">Potencial </label>
                  <div class="col-sm-2">
                    <input type="number" class="form-control" name="potencial" id="potencial" placeholder="" required min='0'>
                  </div>
                  <label for="comision" class="col-sm-2 control-label">% Comision </label>
                  <div class="col-sm-2">
                    <input type="number" class="form-control" name="comision" id="comision" placeholder="" required min='0'>
                  </div>
                </div>                           
                <div class="divs divCredito">
                  <div class="form-group">
                    <label for="creditOption" class="col-sm-2 control-label">Credito </label>
                    <div class="col-sm-2">
                      <div class="col-sm-6">
                        <div class="form-check form-check-inline">
                          <input style="margin-top:5px" class="form-check-input" type="radio" name="creditOption" id="inlineRadio1" value="1" onclick="cambiaEstadoCredito(this.value)">
                          <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Si</label>
                        </div>                    
                      </div>
                      <div class="col-sm-6"> 
                        <div class="form-check form-check-inline">
                          <input style="margin-top:5px" class="form-check-input" type="radio" name="creditOption" id="inlineRadio2" value="2" checked onclick="cambiaEstadoCredito(this.value)">
                          <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">No</label>
                        </div>
                      </div>                  
                    </div>
                  </div>
                  <div class="form-group" id='estadocredito'>
                    <label for="montocredito" class="col-sm-2 control-label">Monto Credito </label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="montocredito" id="montocredito" placeholder="0" value="0">
                    </div>
                    <label for="diascredito" class="col-sm-2 control-label">Dias Credito </label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="diascredito" id="diascredito" placeholder="0" value="0">
                    </div>                  
                    <label for="diacorte" class="col-sm-2 control-label">Dia de Corte </label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="diacorte" id="diacorte" placeholder="0" value="0">
                    </div>                  
                  </div>
                </div>
              </div>
            </div>
            <div class="panel-footer">
              <div class="btn-group" style="width: 30%;margin-left:35%">
								<button style="width: 50%" type="button" class="btn btn-warning" data-dismiss="modal">Regresar</button>
                <button style="width: 50%" class="btn btn-success" align="right">Guardar</button>
              </div>     
            </div>
          </form>
        </div>
		  </div>
	  	<div class="modal-footer">
	  	</div>
		</div> 
  </div>
</div>


<div class="modal fade bs-example-modal-lg" id="myModalModificaPerfilCia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
	  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
				<h4 class="modal-title" id="myModalLabel">Modifica Perfil Compañia</h4>
	  	</div>
	  	<div class="modal-body">
				<div id="datosCia" style="position: relative;	text-align: center;top: 5px;width: 100%;"></div>
		  </div>
	  	<div class="modal-footer">
	  	</div>
		</div> 
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalContactosCia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
	  	<div class="modal-header">
	  		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
				<h4 class="modal-title" id="myModalLabel">Contactos Compañia</h4>
				<button type="button" class="btn btn-info pull-right"><i class=" fa fa-plus"></i> Adicionar Contacto</button>				
	  	</div>
    	<div id="datos_ajax_register"></div>
	  	<div class="modal-body">
				<div id="contactosCia"></div>
		  </div>
	  	<div class="modal-footer">
				<button style="width: 25%;right:inherit" type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
	  	</div>
		</div> 
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalHuespedesCia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
	  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
					<h3 class="modal-title" id="myModalLabel">Huespedes Compañia</h4>
	  	</div>
	  	<div class="modal-body">
				<div id="huespedesCia" style="position: relative;	text-align: center;top: 5px;width: 100%;"></div>
		  </div>
	  	<div class="modal-footer">
				<button style="width: 25%;right:inherit" type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
	  	</div>
		</div> 
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalReservasEsperadasCia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
	  	<div class="row-fluid imprime_productos_mov" >
	  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
				<h4 class="modal-title" id="myModalLabel">Reservas Actuales</h4>
				<input type="hidden" name="txtIdReservasCiaEsp" id="txtIdReservasCiaEsp">
	  	</div>
    	<div id="datos_ajax_register"></div>
	  	<div class="modal-body">
				<div id="reservasEsperadas" style="position: relative;	text-align: center;top: 5px;width: 100%;"></div>
		  </div>
	  	</div>
	  	<div class="modal-footer">
				<button style="width: 25%;right:inherit" type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
	  	</div>
		</div> 
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalHistoricoReservasCia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
	  	<div class="row-fluid imprime_productos_mov" >
	  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
				<h3 class="modal-title" id="myModalLabel">Historico Reservas</h3>
				<input type="hidden" name="txtIdReservasCiaHis" id="txtIdReservasCiaHis">
	  	</div>
    	<div id="datos_ajax_register"></div>
	  	<div class="modal-body">
				<div id="historicoReserva" style="position: relative;	text-align: center;top: 5px;width: 100%;"></div>
		  </div>
	  	</div>
	  	<div class="modal-footer">
				<button style="width: 25%;right:inherit" type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
	  	</div>
		</div> 
  </div>
</div>


<div class="modal fade bs-example-modal-lg" id="myModalHistoricoFacturasCia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
	  	<div class="row-fluid imprime_productos_mov" >
	  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
				<h3 class="modal-title" id="myModalLabel">Historico Reservas</h3>
				<input type="hidden" name="txtIdReservasCiaHis" id="txtIdReservasCiaHis">
	  	</div>
    	<div id="datos_ajax_register"></div>
	  	<div class="modal-body">
				<div id="historicoFacturas" style="position: relative;	text-align: center;top: 5px;width: 100%;"></div>
		  </div>
	  	</div>
	  	<div class="modal-footer">
				<button style="width: 25%;right:inherit" type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
	  	</div>
		</div> 
  </div>
</div>

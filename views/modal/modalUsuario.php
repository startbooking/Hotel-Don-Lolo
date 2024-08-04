<div class="modal fade" id="myModalCambiarClave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog modal-md"> 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="exampleModalLabel"><i style="font-size:24px" class="fa fa-user-circle-o" aria-hidden="true"></i> </h4>
      </div>
			<form id="loginform" class="form-horizontal" action="javascript:cambiaClave();" role="form" method="POST" autocomplete="off">
      	<div class="modal-body">
      		<div id="error"></div>
					<input type="hidden" id="idUserPass" name="idUserPass" value ="" />
					<input type="hidden" id="userPass" name="userPass" value ="" />
					<div class="form-group" style="margin-bottom: 5px">
						<label for="password" class="col-md-4 control-label">Clave Actual</label>
						<div class="col-md-6">
							<input type="password" class="form-control" id="claveactual" placeholder="Contraseña Actual" required>
						</div>
					</div> 
					<div class="form-group" style="margin-bottom: 5px">
						<label for="password" class="col-md-4 control-label">Nueva Clave</label>
						<div class="col-md-6">
							<input type="password" class="form-control" id="clave1" name="clave1" placeholder="Nueva Contraseña" required>
						</div>
					</div>
					<div class="form-group" style="margin-bottom: 5px">
						<label for="con_password" class="col-md-4 control-label">Confirmar Clave</label>
						<div class="col-md-6">
							<input type="password" class="form-control" id="clave2" name="clave2" placeholder="Confirmar Nueva Contraseña" required onblur="duplicadoClave()">
						</div>
					</div>
      	</div>
				<div style="margin-top:20px" class="modal-footer">
					<div class="btn-group">
	    		  <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i>	Regresar</button>
	      		<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>	Confirmar</button>													
					</div>
				</div>   
			</form>
    </div>
	</div>  
</div>

<div class="modal fade" id="myModalSoporteTecnico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h2 class="modal-title" id="exampleModalLabel"><i style="font-size:24px" class="fa fa-cogs " aria-hidden="true"></i> Solicitud Soporte Tecnico </h2>
      </div>
      <form role="form" method="POST" class="form-horizontal" name="contactform" id="contactForm1" action='javascript:solicitudSoporte();'>
      	<div class="modal-body">
      		<div id="mensajeSoporte"></div>
      		<div class="row-fluid">
	          <div class="form-group">
	            <label for="nombres" class="control-label col-lg-2 col-md-2">Nombres </label>
	            <div class="col-lg-10 col-md-10">
	              <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres y Apellidos" required="" >
	            </div>
	          </div>
	          <div class="form-group">
	            <label for="nombres" class="control-label col-lg-2 col-md-2">E-mail</label>
	            <div class="col-lg-4 col-md-4">
	              <input type="text" class="form-control" id="email" name="email" placeholder="Correo Electronico" required="" >
	            </div>
	            <label class="col-md-2 col-sm-2 control-label" for="phone" accesskey="P"> Telefono</label>
	            <div class="col-md-4 col-sm-4">
	              <input name="phone" type="text" id="phone" value="" class="form-control" required="" placeholder="Telefono">
	            </div>
	          </div>
	          <div class="form-group">
	            <label class="col-lg-2 col-sm-2 control-label" for="subject" accesskey="S"> Asunto</label>
	            <div class="col-md-10 col-sm-10">
	              <input name="asunto" type="text" id="asunto" value="" class="form-control" required="" placeholder="Asunto Mensaje">
	            </div>
	          </div>
	          <div class="form-group" >
	            <label class="col-lg-2 col-sm-2 control-label" for="comments" accesskey="C"> Su Mensaje</label>
	            <div class="col-md-10 col-sm-10">
	              <textarea name="comments" rows="6" id="comments" class="form-control" required="" placeholder="Ingrese Su Mensaje"></textarea>
	            </div>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	      	<div class="btn-group">
	    		  <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i>	Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o" aria-hidden="true"></i> Enviar Mensaje</button>
					</div>
	      </div>
      </form>              
    </div>
  </div>
</div>
<div class="content-wrapper"> 
  <section class="content centrar" style="height: 780px;">
    <div class="col-md-10" style="margin-bottom: 50px">
      <div class="panel panel-success">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-9"> 
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
              <input type="hidden" name="ubicacion" id="ubicacion" value="cierreDiario">
              <input type="hidden" name="pagina" id="pagina" value="cierreDiario">
              <input type="hidden" name="pasos" id="pasos">
              <input type="hidden" name="contador" id="contador">
              <input type="hidden" name="registro" id="registro">
              <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Auditoria Nocturna</h3>
            </div>
          </div>
        </div>  
        <div class="container-fluid centrar" style="padding-top:20px">
          <div class="col-lg-8 mensaje"></div>
        </div>
        <form id="formCierreDiario" class="form-horizontal" action="javascript:validaCierreDiario()" method="POST" enctype="multipart/form-data">
          <div class="panel-body">
            <div class="form -group">
              <div class="form-group">
                <label style="margin-top:8px" for="fechaAuditoria" class="col-sm-5 control-label">Fecha Auditoria </label>
                <div class="col-sm-6">
                  <h3 id="fechaAuditoria" style="font-weight: 700;margin-top: 0;font-size:30px;color:brown"><?php echo FECHA_PMS; ?></h3>
                </div>
              </div>
            </div>
            <div id="aviso"></div>
            <div id="verInforme"></div>            
          </div>
          <div class="panel-footer" style="text-align: center">
            <a style="width: 25%" type="button" class="btn btn-warning" href="home"><i class="fa fa-home"></i> Regresar</a >
            <a href="#" style="width: 25%" id="botonCierre" class="btn btn-primary" data-toggle="modal" data-target="#myModalValidaAuditor" style="font-family: 'Source Sans Pro'"> <i class="fa fa-sign-in" aria-hidden="true"></i> Procesar</a>
          </div>  
        </form> 
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="myModalValidaAuditor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding-bottom: 0px">
          <button type="button" class="close ion ion-power" data-dismiss="modal" aria-label="Close"></button>
            <div class="form-top-left">
              <h3>Validacion de Usuario</h3> 
              <h4>Introduzca su nombre de usuario y contraseña para Realizar el <span style="font-weight: bold">Cierre Diario del Sistema</span></h4>
            </div> 
            <div class="form-top-right">
              <i class="fa fa-lock"></i>
            </div>
        </div> 
        <form class="form-signin" role="form" id="login-form" name="login-form" action="javascript:validaCierreDiario();" method="post">
        <div class="modal-body">
          <div id="error" name="error"></div>
          <div class="form-bottom bg-aqua">
            <div class="form-group">
            <label class="sr-only" for="form-username">Usuario</label>
              <input type="text" name="login" id="login"  placeholder="Usuario" class="form-username form-control" required="">
            </div>
            <div class="form-group">
              <label class="sr-only" for="form-password">Password</label>
              <input type="password" id="pass" name="pass" placeholder="Password" class="form-password form-control" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer" style="text-align: center">
          <button style="width: 45%" type="button" class="btn btn-warning" data-dismiss="modal"><span class="glyphicon glyphicon-log-out" ></span> Cancelar</button>
          <button style="width: 45%" type="submit" class="btn btn-success" name="btn-login" id="btn-login"> <span class="glyphicon glyphicon-log-in"></span> Procesar</button>
        </div>
        </form>
      </div>
    </div>
  </div>


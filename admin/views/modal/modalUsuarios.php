<div class="modal fade" id="myModalAdicionarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formAdicionaUsuario" class="form-horizontal" action="javascript:adicionaUsuario()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="exampleModalLabel"><i style="font-size:24px" class="fa fa-user-circle-o" aria-hidden="true"></i> Adicionar Usuario</h4>
        </div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <input type="hidden" class="form-control" id="id" name="id">
          <div class="container-fluid">
            <div class="form-group">
              <label for="codigo" class="control-label col-lg-2 col-md-2">Usuario</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="usuario" name="usuario" required="" onblur="usuarioRepetido(this.value)" placeholder="Usuario">
              </div>
              <label for="codigo" class="control-label col-lg-2 col-md-2">Contraseña</label>
              <div class="col-lg-4 col-md-4">
                <input type="password" class="form-control" id="clave" name="clave" required="">
              </div>
            </div>
            <div class="form-group">
              <label for="apellidos" class="control-label col-lg-2 col-md-2">Apellidos</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="apellidos" name="apellidos" required >
              </div>
              <label for="apellido" class="control-label col-lg-2 col-md-2">Nombres</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="nombres" name="nombres" required >
              </div>
            </div>
            <div class="form-group">
              <label for="identificacion" class="control-label col-lg-2 col-md-2">Ident.</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="identificacion" name="identificacion" required >
              </div>
              <label for="correo" class="control-label col-lg-2 col-md-2">Correo</label>
              <div class="col-lg-4 col-md-4">
                <input type="email" class="form-control" id="correo" name="correo" required >
              </div>
            </div>
            <div class="form-group">  
              <label for="telefono" class="control-label col-lg-2 col-md-2">Telefono</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="telefono" name="telefono">
              </div>
              <label for="celular" class="control-label col-lg-2 col-md-2">Celular</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="celular" name="celular">
              </div>
            </div>
            <div class="form-group">
              <label for="tipo" class="control-label col-lg-2 col-md-2">Tipo de Usuario</label>
              <div class="col-lg-4 col-md-4">
                <select name="tipo" id="tipo" required>
                  <option>Seleccione el Tipo Usuario</option>
                  <option value="1">Administrador</option>
                  <option value="2">Auditor</option>
                  <option value="3">Cajero</option>
                  <option value="4">Digitador</option>
                  <option value="5">Usuario Consulta</option>
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="modulos" class="control-label col-lg-2 col-md-2">Modulos</label>
              <div class="col-lg-10 col-md-10">
                <label style="text-align: left;padding:0" class="control-label col-lg-3 col-md-3">POS <input type="checkbox" name="idPos" id="idPos"></label>
                <label style="text-align: left;padding:0" class="control-label col-lg-3 col-md-3">PMS <input type="checkbox" name="idPMS" id="idPMS"></label>
                <label style="text-align: left;padding:0" class="control-label col-lg-3 col-md-3">Inventarios <input type="checkbox" name="idInv" id="idInv"></label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="width: 25%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button style="width: 25%" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Adicionar</button>
        </div>
      </div>
    </div>
  </form>
</div>
 
<div class="modal fade" id="myModalAsignaClave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formAdicionaUsuario" class="form-horizontal" action="javascript:asignaClave()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h3 class="modal-title" id="exampleModalLabel">Asignar Contraseña</h3>
        </div>
        <div class="modal-body">
          <div id="mensajeEli"></div>
          <input type="hidden" class="form-control" id="idUserPsw" name="idUserPsw">
          <div class="container-fluid">
            <div class="form-group">
              <label for="codigo" class="control-label col-lg-4 col-md-4">Usuario</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="usuarioPsw" name="usuarioPsw" readonly disabled="">
              </div>
            </div> 
            <div class="form-group">
              <label for="clave1Asi" class="control-label col-lg-4 col-md-4">Contraseña</label>
              <div class="col-lg-6 col-md-6">
                <input type="password" class="form-control" id="clave1Asi" name="clave1Asi" required >
              </div>
            </div>
            <div class="form-group">
              <label for="clave2Asi" class="control-label col-lg-4 col-md-4">Confirme Contraseña</label>
              <div class="col-lg-6 col-md-6">
                <input type="password" class="form-control" id="clave2Asi" name="clave2Asi" required onblur="duplicadoClave()">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="width: 25%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button style="width: 25%" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalActualizaUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formModificaUsuario" class="form-horizontal" action="javascript:actualizaUsuario()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="exampleModalLabel"><i style="font-size:24px" class="fa fa-user-circle-o" aria-hidden="true"></i> Adicionar Usuario</h4>
        </div>
        <div class="modal-body">
          <div id="mensajeMod"></div>
          <input type="hidden" class="form-control" id="id" name="id">
          <div class="container-fluid">
            <div class="form-group">
              <label for="codigo" class="control-label col-lg-2 col-md-2">Usuario</label>
              <div class="col-lg-4 col-md-4">
                <input type="hidden" class="form-control" id="estadoUsuarioMod" name="estadoUsuarioMod">
                <input type="hidden" class="form-control" id="idUsuarioMod" name="idUsuarioMod">
                <input type="text" class="form-control" id="usuarioMod" name="usuarioMod" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="apellidos" class="control-label col-lg-2 col-md-2">Apellidos</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="apellidosMod" name="apellidosMod" required >
              </div>
              <label for="apellido" class="control-label col-lg-2 col-md-2">Nombres</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="nombresMod" name="nombresMod" required >
              </div>
            </div>
            <div class="form-group">
              <label for="identificacion" class="control-label col-lg-2 col-md-2">Ident.</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="identificacionMod" name="identificacionMod" required >
              </div>
              <label for="correo" class="control-label col-lg-2 col-md-2">Correo</label>
              <div class="col-lg-4 col-md-4">
                <input type="email" class="form-control" id="correoMod" name="correoMod" required >
              </div>
            </div>
            <div class="form-group">  
              <label for="telefono" class="control-label col-lg-2 col-md-2">Telefono</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="telefonoMod" name="telefonoMod">
              </div>
              <label for="celular" class="control-label col-lg-2 col-md-2">Celular</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="celularMod" name="celularMod">
              </div>
            </div>
            <div class="form-group">
              <label for="tipo" class="control-label col-lg-2 col-md-2">Tipo de Usuario</label>
              <div class="col-lg-4 col-md-4">
                <select name="tipoMod" id="tipoMod" required>
                  <option>Seleccione el Tipo Usuario</option>
                  <option value="1">Administrador</option>
                  <option value="2">Auditor</option>
                  <option value="3">Cajero</option>
                  <option value="4">Digitador</option>
                  <option value="5">Usuario Consulta</option>
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="modulos" class="control-label col-lg-2 col-md-2">Modulos</label>
              <div class="col-lg-10 col-md-10">
                <label style="text-align: left;padding:0" class="control-label col-lg-3 col-md-3"
                >POS <input type="checkbox" name="idPosUpd" id="idPosUpd"></label>
                <label style="text-align: left;padding:0" class="control-label col-lg-3 col-md-3"
                >PMS <input type="checkbox" name="idPMSUpd" id="idPMSUpd"></label>
                <label style="text-align: left;padding:0" class="control-label col-lg-3 col-md-3"
                >Inventarios <input type="checkbox" name="idInvUpd" id="idInvUpd"></label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="width: 25%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button style="width: 25%" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalBloquearUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formAdicionaUsuario" class="form-horizontal" action="javascript:bloqueaUsuario()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h3 class="modal-title" id="exampleModalLabel">Bloquear Usuario</h3>
        </div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <input type="hidden" class="form-control" id="idUserBloq" name="idUserBloq">
          <input type="hidden" class="form-control" id="estadoBloq" name="estadoBloq">
          <div class="container-fluid">
            <div class="form-group">
              <label for="usuarioBloq" class="control-label col-lg-2 col-md-2">Usuario</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="usuarioBloq" name="usuarioBloq" readonly disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="apellidosBloq" class="control-label col-lg-2 col-md-2">Apellidos</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="apellidosBloq" name="apellidosBloq" required readonly disabled="">
              </div>
              <label for="nombresBloq" class="control-label col-lg-2 col-md-2">Nombres</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="nombresBloq" name="nombresBloq" required readonly disabled="" ">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="width: 25%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button style="width: 25%" type="submit" class="btn btn-primary"><i class="fa fa-ban"></i> Bloquear</button>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalReabrirUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="formAdicionaUsuario" class="form-horizontal" action="javascript:reabrirUsuario()">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h3 class="modal-title" id="exampleModalLabel">Reabrir Cajero</h3>
        </div>
        <div class="modal-body">
          <div id="mensaje"></div>
          <input type="hidden" class="form-control" id="idUserRea" name="idUserRea">
          <input type="hidden" class="form-control" id="estadoRea" name="estadoRea">
          <div class="container-fluid">
            <div class="form-group">
              <label for="usuarioBloq" class="control-label col-lg-2 col-md-2">Usuario</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="usuarioRea" name="usuarioRea" readonly disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="apellidosBloq" class="control-label col-lg-2 col-md-2">Apellidos</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="apellidosRea" name="apellidosRea" required readonly disabled="">
              </div>
              <label for="nombresBloq" class="control-label col-lg-2 col-md-2">Nombres</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" class="form-control" id="nombresRea" name="nombresRea" required readonly disabled="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="width: 25%" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
          <button style="width: 25%" type="submit" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i> Reabrir</button>
        </div>
      </div>
    </div>
  </form>
</div>


<div class="modal fade" id="modalAdicionaCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="guardarDatosCliente" class="form-horizontal" action="javascript:guardaCliente()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off"></span></button>
          <h3 class="modal-title w3ls_head" id="exampleModalLabel"><i class="fa fa-user-plus"></i> Adicionar Clientes</h3>
          <input type="hidden" name="idusr" id="idusr">
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" class="form-control" id="id" name="id">
            <label for="apellidos" class="control-label col-lg-2 col-md-2">1er Apellido</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="apellido1" name="apellido1" required>
            </div>
            <label for="apellidos" class="control-label col-lg-2 col-md-2">2o Apellido</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="apellido2" name="apellido2">
            </div>
          </div>
          <div class="form-group">
            <label for="nombres" class="control-label col-lg-2 col-md-2">1er Nombre</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="nombre1" name="nombre1" required>
            </div>
            <label for="nombres" class="control-label col-lg-2 col-md-2">2o Nombre</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="nombre2" name="nombre2">
            </div>
          </div>
          <div class="form-group">
            <label for="identificacion" class="control-label col-lg-2 col-md-2">Identificacion</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="identificacion" name="identificacion" required maxlength="12" onblur="validaIden(this.value)">
            </div>
            <label for="inputEmail3" class="col-sm-2 control-label">Tipo Documento</label>
            <div class="col-sm-4">
              <select name="tipodoc" id="tipodoc" required="">
                <option value="">Seleccione el Tipo de Documento</option>
                <?php
                $tipodocs = $pos->getTipoDocumento();
                foreach ($tipodocs as $tipodoc) { ?>
                  <option value="<?php echo $tipodoc['id_doc']; ?>"><?php echo $tipodoc['descripcion_documento']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="direccion" class="control-label col-lg-2 col-md-2">Direccion</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="direccion" name="direccion" maxlength="80">
            </div>
            <label for="telefono" class="control-label col-lg-2 col-md-2">Telefono</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="telefono" name="telefono" maxlength="12">
            </div>
          </div>
          <div class="form-group">
            <label for="celular" class="control-label col-lg-2 col-md-2">Celular</label>
            <div class="col-lg-4 col-md-4">
              <input type="text" class="form-control" id="celular" name="celular" required maxlength="12">
            </div>
            <label for="correo" class="control-label col-lg-2 col-md-2">Correo</label>
            <div class="col-lg-4 col-md-4">
              <input type="email" class="form-control" id="correo" name="correo" required maxlength="80" onblur="validateEmail(this.value)">
            </div>
          </div>
          <div class="form-group">
            <label for="empleado" class="control-label col-lg-2 col-md-2"></label>
            <div class="col-lg-4 col-md-4" style="padding-left:0px;">
              <label class="col-lg-6 col-md-6">
                <input style="margin-right: 10px;" type="checkbox" name="empleado" id="empleado" value="1">Empleado</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Datos</button>
          <div class="btn-group">
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="dataUpdateCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="actualidarDatosCliente" class="form-horizontal" action="javascript:actualizaCliente()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h3 class="modal-title w3ls_head" id="exampleModalLabel"><i class="fa fa-user-plus"></i> Modificar Cliente</h3>
          <input type="hidden" name="idusrupd" id="idusrupd">
        </div>
        <div class="modal-body">
          <div id="datosCliente"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar datos</button>
          <div class="btn-group">
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="dataDeleteCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="eliminarDatosCliente" action="javascript:eliminaCliente()">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off"></span></button>
          <h3 class="modal-title" id="exampleModalLabel"> Modificar Producto</h3>
          <input type="hidden" name="idusrdel" id="idusrdel">
        </div>
        <div class="modal-body">
          <div class="alert alert-warning" id="mensaje"></div>
          <div id="pregunta">
            <h3 class="text-center text-muted" style="color:#880505;font-weight:bold">Estas seguro?</h3>
            <p class="lead text-muted text-center" style="display: block;margin:10px">Esta acción eliminará de forma permanente los Datos del Cliente.
              <h4 style="text-align:center">Desea continuar?</h4>
            </div>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-trash-o"></i> Eliminar</button>
          <div class="btn-group">
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="dataEstadoCartera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="carteraCliente" action="">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-off"></span></button>
          <h3 class="modal-title" id="exampleModalLabel"> Estado Cartera Cliente</h3>
          <input type="hidden" name="idusrdel" id="idusrdel">
          <button class="btn btn-info btnTitle" onclick="exportTableToExcel('datosClienteCartera')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
        </div>
        <div class="modal-body" id="datosClienteCartera">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
        </div>
      </div>
    </div>
  </form>
</div>
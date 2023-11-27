<div class="modal fade bs-example-modal-lg" id="myModalAcompanantesReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document"> 
    <div class="modal-content">  
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 class="modal-title" id="myModalLabel">Acompañantes en la Reserva X</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idreservaAco" name="idreservaAco">
        <input type="hidden" id="idhuespedAco" name="idhuespedAco">
        <div id="mensajeEliAco"></div>
        <div id="acompanantes"></div>
        <div class="container-fluid">
          <input type="hidden" name="numeroReserva" id="numeroReserva">
          <button class="btn btn-primary pull-right" type="button" 
            data-toggle="modal" 
            data-target="#myModalAdicionaAcompanante"  
            title="Adicionar Acompañante Reserva">
            <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
          </button>
        </div>
      </div>
      <div class="modal-footer">
        <a href="reservasActivas" class="btn btn-warning btnSaleAco"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</a>
      </div>
    </div> 
  </div>
</div>


<div class="modal fade" id="myModalAdicionaAcompanante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span>
        </button>
        <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-user-plus"></i> Adiciona Perfil del Huesped</h4>
        <input type="hidden" name="creaReser" id="creaReser" value="0">
        <input type="hidden" name="editaPer" id="editaPer" value="0">
        <input type="hidden" name="paginaviene" id="paginaviene" value="">
        <div class="container-fluid"></div>
      </div>
      <form id="acompananteReserva" class="form-horizontal" style="padding :0px;" action="javascript:guardaAcompanante()">        
        <div class="modal-body">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Huesped</label>
            <div class="form-group has-success has-feedback col-sm-6">
              <div class="input-group" style="padding-left:15px;">
                <input type="text" class="form-control" id="buscarAcoHuesped" aria-describedby="inputGroupSuccess4Status" style="background:#FFF">
                <span class="input-group-addon" style="padding:1px;border:none">
                  <a data-toggle="modal" href="#myModalBuscaAcompanaHuesped">
                    <i style="padding:5px 10px" class="fa fa-search" aria-hidden="true"></i>
                  </a>
                </span>
              </div>
            </div> 
            <div class="col-sm-4" style="padding-right: 0;text-align:right">
              <a class="btn btn-success" data-toggle="modal" data-reserva='1' href="#myModalAdicionaPerfilAcompanante">
                <i class="fa fa-user-plus" aria-hidden="true"></i> Adicionar Huesped
              </a>
            </div>
          </div>
        </div>  
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button class="btn btn-success" style="text-align:right;"><i class="fa fa-save"></i> Actualizar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalAdicionaPerfilAcompanante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span>
        </button>
        <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-user-plus"></i> Adiciona Perfil del Huesped</h4>
        <input type="hidden" name="creaReser" id="creaReser" value="0">
        <input type="hidden" name="editaPer" id="editaPer" value="0">
        <input type="hidden" name="acompana" id="acompana" value="1">
        <input type="hidden" name="paginaviene" id="paginaviene" value="">
        <div class="container-fluid"></div>
      </div>
      <form id="perfilAcompananteReserva" class="form-horizontal" style="padding :0px;" action="javascript:guardaAcompanante()">        
        <div class="modal-body">
          <div class="alert alert-warning oculto centro" id="alerta"></div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
            <div class="col-sm-3">
              <input type="hidden" name="idReservaAdiAco" id="idReservaAdiAco">
              <input type="hidden" name="nuevoPax" id="nuevoPax">
              <input type="hidden" name="idHuesAdi" id="idHuesAdi">
              <input type="text" class="form-control" name="identificaAdiAco" id="identificaAdiAco" placeholder="Identificacion" onblur="buscaHuespedAcompanante(this.value)" >
            </div>
            <label for="inputEmail3" class="col-sm-2 control-label">Tipo </label>
            <div class="col-sm-3">
              <select name="tipodoc" id="tipodoc" required="">
                <option value="">Seleccione el Tipo de Documento</option>
                <?php
                $tipodocs = $hotel->getTipoDocumento();
                foreach ($tipodocs as $tipodoc) { ?>
                  <option value="<?php echo $tipodoc['id_doc']; ?>"><?php echo $tipodoc['descripcion_documento']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="paisExp" class="col-sm-2 control-label">Expedicion </label>
            <div class="col-sm-3">
              <select name="paisExp" id="paisExp" required="" onblur="ciudadesExpedicion(this.value,'')">
                <option value="">Lugar de Expedicion</option>
                <?php
                foreach ($paices as $pais) { ?>
                  <option value="<?php echo $pais['id_pais']; ?>"><?php echo $pais['descripcion']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <label for="ciudadExpAco" class="col-sm-2 control-label">Ciudad </label>
            <div class="col-sm-3">
              <select name="ciudadExpAco" id="ciudadExpAco" required="">
                <option value="">Ciudad de Expedicion</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="apellidos" class="col-sm-2 control-label">1er Apellidos</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="apellido1" id="apellido1" placeholder="Primer Apellido" required>
            </div>
            <label for="apellidos" class="col-sm-2 control-label">2o Apellidos</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="apellido2" id="apellido2" placeholder="Segundo Apellido">
            </div>
          </div>
          <div class="form-group">
            <label for="nombre1" class="col-sm-2 control-label">1er Nombre</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="nombre1" id="nombre1" placeholder="Primer Nombre" required>
            </div>
            <label for="nombre2" class="col-sm-2 control-label">2o Nombre</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="nombre2" id="nombre2" placeholder="Segundo Nombre">
            </div>
            <div class="col-sm-2" style="padding:0">
              <div class="col-sm-6" style="padding:0;height: 15px">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="sexOption" id="inlineRadio1" value="1" checked>
                  <label style="margin-top:-21px;margin-left:25px" class="form-check-label" for="inlineRadio1">Masc</label>
                </div>
              </div>
              <div class="col-sm-6" style="padding:0;height: 15px">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="sexOption" id="inlineRadio2" value="2">
                  <label style="margin-top:-21px;margin-left:25px" class="form-check-label" for="inlineRadio2">Fem.</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="direccion" class="col-sm-2 control-label">Direccion </label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" pattern="[A-Za-z0-9 ]+">
            </div>
          </div>
          <div class="form-group">
            <label for="paices" class="col-sm-2 control-label">Nacionalidad </label>
            <div class="col-sm-4">
              <select name="paices" id="paices" onblur="getCiudadesPais(this.value,'')" required="">
                <option value="">Seleccione la Nacionalidad</option>
                <?php
                foreach ($paices as $pais) { ?>
                  <option value="<?php echo $pais['id_pais']; ?>"><?php echo $pais['descripcion']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div id="ciudadesPais">
              <label class="col-lg-2 col-md-2 control-label" style="padding-top:0">Ciudad</label>
              <div class="col-sm-4">
                <select name="ciudadHue" id='ciudadHue'>
                  <option value="Selecione la Ciudad del Huesped"></option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="telefono" class="col-sm-2 control-label">Telefono</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" required="" minlength="10" maxlength="18" pattern="[0-9]+">
            </div>
            <label for="celular" class="col-sm-2 control-label">Celular</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="celular" id="celular" placeholder="Nro celular" minlength="10" maxlength="18" pattern="[0-9]+">
            </div>
          </div>
          <div class="form-group">
            <label for="correo" class="col-sm-2 control-label">Correo </label>
            <div class="col-sm-4">
              <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo Electronico" required>
            </div>
            <label for="fechanace" class="col-sm-2 control-label">Fecha Nacimiento </label>
            <div class="col-sm-4">
              <input type="date" class="form-control" name="fechanace" id="fechanace" placeholder="" value="<?php echo $hoy; ?>" max="<?php echo $hoy; ?>" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="fechanace" class="col-sm-2 control-label">Tipo Persona </label>
            <div class="col-sm-4">
              <select name="tipoAdquiriente" id="tipoAdquiriente" required>
                <option value="">Seleccione el Tipo Persona</option>
                <?php
                $tipoAdquiere = $hotel->getTipoAdquiriente();
                foreach ($tipoAdquiere as $tipoAdqui) { ?>
                  <option value="<?php echo $tipoAdqui['id']; ?>"><?php echo $tipoAdqui['descripcionAdquiriente']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <label for="correo" class="col-sm-2 control-label">Tipo Regimen </label>
            <div class="col-sm-4">
              <select name="tipoResponsabilidad" id="tipoResponsabilidad" required>
                <option value="">Seleccione Tipo de Regimen</option>
                <?php
                $tipoRespo = $hotel->getTipoResponsabilidad();
                foreach ($tipoRespo as $tipoRes) { ?>
                  <option value="<?php echo $tipoRes['id']; ?>"><?php echo $tipoRes['descripcion']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="correo" class="col-sm-2 control-label">Tipo Obligacion </label>
            <div class="col-sm-4">
              <select name="responsabilidadTribu" id="responsabilidadTribu" required>
                <option value="">Seleccione Tipo Obligacion</option>
                <?php
                $tipoTribus = $hotel->getResponsabilidadTributaria();
                foreach ($tipoTribus as $tipoTribu) { ?>
                  <option value="<?php echo $tipoTribu['id']; ?>"><?php echo $tipoTribu['descripcionResponsabilidad']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <label for="profesion" class="col-sm-2 control-label">Profesion </label>
            <div class="col-sm-4">
              <select name="profesion" id="profesion">
                <option value="">Seleccione la Profesion</option>
                <?php
                $motivos = $hotel->getMotivoGrupo('PRO');
                foreach ($motivos as $motivo) { ?>
                  <option value="<?php echo $motivo['id_grupo']; ?>"><?php echo $motivo['descripcion_grupo']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="empresa" class="col-sm-2 control-label">Empresa </label>
            <div class="col-sm-6">
              <select name="empresaAdi" id="empresaAdi" required="">
                <option value="">Seleccione La Empresa</option>
                <option value="0">SIN COMPAÑIA</option>
                <?php
                $companias = $hotel->getCompanias();
                foreach ($companias as $compañia) { ?>
                  <option value="<?= $compañia['id_compania'] ?>"><?= $compañia['empresa'] ?></option>
                <?php
                } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button class="btn btn-success" style="text-align:right;"><i class="fa fa-save"></i> Procesar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalAcompanantesHistoricoReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document"> 
    <div class="modal-content"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 class="modal-title" id="myModalLabel">Acompañantes en la Reserva</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idreservaAco" name="idreservaAco">
        <div id="mensajeEliAco"></div>
        <div id="acompanantesHist"></div>
        <div class="container">
          <input type="hidden" name="numeroReserva" id="numeroReserva">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
      </div>
    </div> 
  </div>
</div>


<div class="modal fade" id="myModalBuscaAcompanaHuesped" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form id="guardarDatosRooms" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div id="dataRegisterRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="glyphicon glyphicon-off"></span>
            </button>
            <h3 class="modal-title" id="exampleModalLabel">Huesped Encontrados</h3>
          </div>
          <div id="datos_ajax_register"></div>
          <div class="modal-body" id="huespedesAcompaEncontrados">
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-4">
                <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
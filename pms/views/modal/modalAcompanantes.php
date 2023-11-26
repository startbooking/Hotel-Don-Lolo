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
  <div class="modal-dialog modal-lg" role="document">
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
      <!-- <form class="form-horizontal" id="acompananteReserva" action="javascript:guardaHuesped(this)" method="POST"> -->
      <form id="acompananteReserva" class="form-horizontal" style="padding :0px;" action="javascript:guardaAcompanante()">
        
        <div class="modal-body">
          <div class="alert alert-warning oculto centro" id="alerta"></div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
            <div class="col-sm-3">
              <input type="hidden" name="idReservaAdiAco" id="idReservaAdiAco">
              <input type="hidden" name="nuevoPax" id="nuevoPax">
              <input type="hidden" name="idHuesAdi" id="idHuesAdi">
              <input type="text" class="form-control" name="identificaAdiAco" id="identificaAdiAco" placeholder="Identificacion" onblur="buscaHuespedAcompanante(this.value)" >

              <!-- <input type="text" class="form-control" name="identifica" id="identifica" placeholder="Identificacion" required=""> -->
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
            <label for="ciudadExp" class="col-sm-2 control-label">Ciudad </label>
            <div class="col-sm-3">
              <select name="ciudadExp" id="ciudadExp" required="">
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
  
  <!-- <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Acompañantes</h4>
      </div>
      <form id="acompananteReserva" class="form-horizontal" style="padding :0px;" action="javascript:guardaAcompanante()">
        <div class="modal-body" style="font-size:12px;">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
            <div class="col-sm-4">
              <input type="hidden" name="idReservaAdiAco" id="idReservaAdiAco">
              <input type="hidden" name="nuevoPax" id="nuevoPax">
              <input type="hidden" name="idHuesAdi" id="idHuesAdi">
              <input type="text" class="form-control" name="identificaAdiAco" id="identificaAdiAco" placeholder="Identificacion" onblur="buscaHuespedAcompanante(this.value)" >
            </div>
            <label for="inputEmail3" class="col-sm-1 control-label">Tipo</label>
            <div class="col-sm-4">
              <select name="tipodocAdiAco" id='tipodocAdiAco' value="">
                <option value="">Seleccione el Tipo de Documeto</option>
                <?php
                  $tipodocs = $hotel->getTipoDocumento(); ?>
                  <?php foreach ($tipodocs as $tipodoc) { ?>
                    <option value="<?php echo $tipodoc['id_doc']; ?>"><?php echo $tipodoc['descripcion_documento']; ?></option>
                  <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="apellidos" class="col-sm-2 control-label">1r Apellidos</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="apellido1AdiAco" id="apellido1AdiAco" placeholder="1er Apellido" required>
            </div>
            <label for="apellidos" class="col-sm-1 control-label">2o Apellido</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="apellido2AdiAco" id="apellido2AdiAco" placeholder="2o Apellido">
            </div>
          </div>
          <div class="form-group">
            <label for="nombres" class="col-sm-2 control-label">1r Nombres</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="nombre1AdiAco" id="nombre1AdiAco" placeholder="1er Nombre">
            </div>
            <label for="nombres" class="col-sm-1 control-label">2o Nombre</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="nombre2AdiAco" id="nombre2AdiAco" placeholder="2o Nombre">
            </div>
          </div>
          <div class="form-group">
            <label for="fechanace" class="col-sm-2 control-label">Fecha Nac. </label>
            <div class="col-sm-4">
              <input type="date" class="form-control" name="fechanaceAdiAco" id="fechanaceAdiAco" placeholder="" value="">
            </div> 
            <label for="apellidos" class="col-sm-1 control-label">Sexo</label>
            <div class="col-sm-4" style="padding:0px 10px">
              <div class="col-sm-6" style="padding:0;height: 15px">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="sexOptionAdiAco" id="inlineRadio1AdiAco" value="1" checked>
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio1" >Masculino</label>
                </div>                    
              </div>
              <div class="col-sm-6" style="padding:0;height: 15px"> 
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="radio" name="sexOptionAdiAco" id="inlineRadio2AdiAco" value="2">
                  <label style="margin-top:-25px;margin-left:25px" class="form-check-label" for="inlineRadio2">Femenino</label>
                </div>
              </div> 
            </div>
          </div>
          <div class="form-group">
            <label for="direccion" class="col-sm-2 control-label">Nacionalidad </label>
            <div class="col-sm-4">
              <select name="paicesAdiAco" id="paicesAdiAco" onchange="getCiudadesPais(this.value)">
                <option value="">Seleccione la Nacionalidad</option>
                <?php
                $paices = $hotel->getPaices();
                foreach ($paices as $pais) { ?>
                  <option value="<?php echo $pais['id_pais']; ?>"><?php echo $pais['descripcion']; ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
            <div id="ciudadesPais">
              <label class="col-lg-1 col-md-1 control-label" style="padding-top:0">Ciudad</label>
              <div class="col-sm-4">
                <select name="ciudadAdiAco" id='ciudadAdiAco'>
                  <option value="">Ciudad</option>
                  <?php
                    $ciudades = $hotel->getCiudades();
                    foreach ($ciudades as $ciudad) { ?> 
                      <option value="<?php echo $ciudad['id_ciudad']; ?>"><?php echo $ciudad['municipio'].' '.$ciudad['depto']; ?></option>
                    <?php
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="correo" class="col-sm-2 control-label">Correo </label>
            <div class="col-sm-4">
              <input type="email" class="form-control" name="correoAco" id="correoAco" placeholder="Correo Electronico" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
            <button type="submit" class="btn btn-primary" ><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
          </div>
        </div>
      </form>
    </div>
  </div> -->
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

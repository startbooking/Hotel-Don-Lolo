<?php
$paices = $hotel->getPaices();
$hoy = date('Y-m-d');

?>
<div class="modal fade bs-example-modal-lg" id="myModalAdicionaPerfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span>
        </button>
        <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-user-plus"></i> Adiciona Perfil del Huesped</h4>
        <input type="hidden" name="creaReser"   id="creaReser" value="0">
        <input type="hidden" name="editaPer"    id="editaPer" value="0">
        <input type="hidden" name="acompanaRes"    id="acompanaRes" value="0">
        <input type="hidden" name="edita"    id="edita" value="0">
        <input type="hidden" name="paginaviene" id="paginaviene" value="">
        <div class="container-fluid"></div>
      </div>
      <form class="form-horizontal" id="formAdicionaHuespedes" action="javascript:guardaHuesped(this)" method="POST">
        <div class="modal-body">
          <div class="alert alert-warning oculto centro" id="alerta"></div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="identifica" id="identifica" placeholder="Identificacion" required="">
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
</div>

<div class="modal fade bs-example-modal-lg" id="myModalModificaPerfilHuesped" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 class="modal-title" id="myModalLabel">Modifica Perfil del Huesped</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="txtIdHuespedUpd" id="txtIdHuespedUpd">
        <div id="datosHuesped" style="position: relative;	text-align: center;top: 5px;width: 100%;"></div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalHistoricoReservas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="row-fluid imprime_productos_mov">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Historico de Reservas</h4>
          <button style="float: right;margin-top: -25px" class="btn btn-info" onclick="exportTableToExcel('tablaReservas')">
          <!-- <i class="glyphicon glyphicon-th" aria-hidden="true"></i>  -->
          <i class="fa-solid fa-file-export"></i>
          Exportar</button>
          <input type="hidden" name="txtIdHuespedHis" id="txtIdHuespedHis">
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div div id="historicoReserva" style="position: relative;	text-align: center;top: 5px;width: 100%;"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button style="width:25%" type="button" class="btn btn-warning btn-block pull-right" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalReservasEsperadas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="row-fluid imprime_productos_mov">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
          <h4 class="modal-title" id="myModalLabel">Reservas Activas</h4>
          <input type="hidden" name="txtIdHuespedAbo" id="txtIdHuespedAbo">
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body">
          <div id="reservaEsperadas" style="position: relative;	text-align: center;top: 5px;width: 100%;"></div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row-fluid">
          <div class="col-lg-3 pull-right">
            <button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalAsignarCompania" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="row-fluid imprime_productos_mov">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
          <h4 class="modal-title" id="myModalLabel">Asignar Compañia al Huesped</h4>
        </div>
        <div id="mensage"></div>
        <form class="form-horizontal" id="formActualizaCia" action="javascript:actualizaCiaHuesped()" method="POST">
          <div class="modal-body">
            <div class="form-horizontal">
              <div class="form-group">
                <input type="hidden" id="idHuespCia" name="idHuespCia">
                <label for="companiaSele" class="col-sm-3 control-label">Empresa </label>
                <div class="col-sm-8">
                  <select name="companiaSele" id="companiaSele" onblur="seleccionaCentro(this.value)">
                    <?php
                    if (count($companias) != 0) {
                      foreach ($companias as $key => $value) { ?>
                        <option value="<?php echo $value['id_compania']; ?>"><?php echo $value['empresa']; ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <div class="btn-group">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Procesar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalFotoIdentificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Foto Identificacion</h4>
      </div>
      <form id="fotoIdentificacion" class="form-horizontal" action="#">
        <div class="modal-body" style="font-size:12px;">
          <div id="mensajeEli"></div>
          <div class="form-group">
            <label for="" class="col-md-4">Selecciona un dispositivo</label>
            <div class="col-md-6">
              <select style="padding:2px 12px" class="form-control" name="listaDeDispositivos" id="listaDeDispositivos"></select>
            </div>
            <button type="button" style="height: 28px;width: 60px;color: brown;padding: 2px;" class="btn btn-info" id="boton"><i class="fa fa-camera-retro"></i></button>
            <h3 id="estado" style="text-align: center;color:brown"></h3>
          </div>
          <br>
          <div class="form-group">
            <div class="col-lg-6">
              <video muted="muted" id="video" width="100%"></video>
              <canvas id="canvas" style="display: none;"></canvas>
            </div>
            <div class="col-lg-4">
              <div class="row-fluid">
                <img style="margin-top:0px" class="img-thumbnail" id="fotoTomada" src="" alt="">
              </div>
            </div>
            <div class="col-lg-2" style="padding:2px">
              <div class="row-fluid" style="padding:2px">
                <div class="table-responsive" style="height: 320px;overflow: auto">
                  <table id="tablaFotos" class="table modalTable table-bordered">
                    <thead>
                      <tr>
                        <th style="text-align: center;padding:2px;background-color: azure">Fotos</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
          <button onclick="guardarFoto()" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Foto</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalverRegistroHotelero" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 75%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close " data-dismiss="modal" aria-label="Close"><span class="fa fa-power-off" aria-hidden="true"></span></button>
        <h4 class="modal-title" id="myModalLabel">Registro Hotelero</h4>
      </div>
      <div class="modal-body" style="font-size:12px;">
        <div id="mensajeEli"></div>
        <div class="form-group">
          <object id="verRegistroHotelero" width="100%" height="450" data=""></object>
        </div>
        <!-- <div id="" class="container-fluid" style="padding:0"></div> -->
      </div>
      <div class="modal-footer">
        <div class="container-fluid">
          <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
        </div>
      </div>
    </div>
  </div>
</div>
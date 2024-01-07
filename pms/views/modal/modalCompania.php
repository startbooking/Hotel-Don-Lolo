<div class="modal fade bs-example-modal-lg" id="myModalAdicionaCompania" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Compañia</h4>
      </div>
      <form class="form-horizontal" id="formCompania" action="javascript:guardaCompania()" style="padding :0;" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="nit" class="col-sm-2 control-label">Nit</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="nit" id="nit" placeholder="Nit" onblur="buscaCompaniaActiva(this.value)" required="" minlength="8" maxlength="12" pattern="[0-9]+">
            </div>
            <label for="dv" class="col-sm-1 control-label">Digito</label>
            <div class="col-sm-1">
              <input type="text" class="form-control" name="dv" id="dv" placeholder="Dv" required="" onfocus="calcularDigitoVerificacion()" readonly="">
            </div>

            <label for="tipodoc" class="col-sm-2 control-label">Tipo Documento</label>
            <div class="col-sm-4">
              <select name="tipodoc" required>
                <option value="">Seleccione el Tipo de Documento</option>
                <?php
                $tipodocs = $hotel->getTipoDocumento();
                foreach ($tipodocs as $tipodoc) { ?>
                  <option value="<?php echo $tipodoc['id_doc']; ?>" <?php
                                                  if ($tipodoc['id_doc'] == 8) { ?> selected <?php
                                                                                                              }
                                                                                                                ?>><?php echo $tipodoc['descripcion_documento']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="compania" class="col-sm-2 control-label">Razon Social</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="compania" id="compania" placeholder="Nombre Compañia" required>
            </div>
          </div>
          <div class="form-group">
            <label for="tipoEmpresaAdi" class="col-sm-2 control-label">Tipo de Empresa</label>
            <div class="col-sm-4">
              <select name="tipoEmpresaAdi" id="tipoEmpresaAdi" required>
                <option value="">Seleccione el Tipo de Empresa</option>
                <?php
                $motivos = $hotel->getMotivoGrupo('TEM');
                foreach ($motivos as $motivo) { ?>
                  <option value="<?php echo $motivo['id_grupo']; ?>"><?php echo $motivo['descripcion_grupo']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <label for="codigoCiiuAdi" class="col-sm-2 control-label">Codigo CIIU</label>
            <div class="col-sm-4">
              <select name="codigoCiiuAdi" id="codigoCiiuAdi" required>
                <option value="">Seleccione el Codigo CIIU</option>
                <?php
                $codigosCiiu = $admin->getCodigosCiiu();
                foreach ($codigosCiiu as $codigoCiiu) { ?>
                  <option value="<?php echo $codigoCiiu['id_ciiu']; ?>"><?php echo $codigoCiiu['codigo'] . ' ' . substr($codigoCiiu['descripcion'], 0, 50); ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="direccion" class="col-sm-2 control-label">Direccion </label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion" required pattern="[A-Za-z0-9 ]+" title="Simbolos @#$Ñ NO Permitidos">
            </div>
            <label for="ciudad" class="col-sm-2 control-label">Ciudad</label>
            <div class="col-sm-4">
              <select name="ciudad" id="ciudad" required="">
                <option value="">Seleccione la Ciudad</option>
                <?php
                $ciudades = $hotel->getCiudadesPais(LAND_HOTEL);
                foreach ($ciudades as $ciudad) { ?>
                  <option value="<?php echo $ciudad['id_ciudad']; ?>"><?php echo $ciudad['municipio'] . ' ' . $ciudad['depto']; ?></option>
                <?php
                }
                ?>
              </select>
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
            <label for="web" class="col-sm-2 control-label">Pagina Web </label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="web" id="web" placeholder="Pagina Web" value="">
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
                <option value="">Seleccione La Tarifa</option>

                <?php
                $tarifas = $hotel->getTarifasHuespedes(); ?>
                <?php foreach ($tarifas as $tarifa) { ?>
                  <option value="<?php echo $tarifa['id_tarifa']; ?>"><?php echo $tarifa['descripcion_tarifa']; ?></option>
                <?php } ?>
              </select>
            </div>
            <label for="formapago" class="col-sm-2 control-label">Forma de Pago </label>
            <div class="col-sm-4">
              <select name="formapago" id="formapago" required="">
                <option value="">Seleccione La Forma de Pago</option>
                <?php
                $codigos = $hotel->getCodigosConsumos(3);
                foreach ($codigos as $codigo) { ?>
                  <option value="<?php echo $codigo['id_cargo']; ?>"><?php echo $codigo['descripcion_cargo']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="fechanace" class="col-sm-2 control-label">Tipo Empresa </label>
            <div class="col-sm-4">
              <select name="tipoAdquiriente" id="tipoAdquiriente" required>
                <option value="">Seleccione el Tipo Empresa</option>
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
            <label for="correo" class="col-sm-2 control-label">Tipo Obligacion</label>
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
          </div>
          <div class="divs divCredito">
            <div class="form-group">
              <label for="creditOption" class="col-sm-2 control-label">Credito </label>
              <div class="col-sm-2">
                <div class="col-sm-6">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="creditOption" id="inlineRadio1" value="1" onclick="cambiaEstadoCredito(this.value)">
                    <label style="margin-top:-18px;margin-left:25px" class="form-check-label" for="inlineRadio1">Si</label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-check form-check-inline">
                    <input style="margin-top:5px" class="form-check-input" type="radio" name="creditOption" id="inlineRadio2" value="2" checked onclick="cambiaEstadoCredito(this.value)">
                    <label style="margin-top:-18px;margin-left:25px" class="form-check-label" for="inlineRadio2">No</label>
                  </div>
                </div>
              </div>
              <label for="reteIva" class="col-sm-1 control-label">ReteIva </label>
              <div class="col-sm-1">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="checkbox" name="reteIva" id="reteIva" value="1">
                </div>
              </div>
              <label for="creditOption" class="col-sm-1 control-label">ReteICa </label>
              <div class="col-sm-1">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="checkbox" name="reteIca" id="reteIca" value="1">
                </div>
              </div>
              <label for="creditOption" class="col-sm-1 control-label">ReteFuente </label>
              <div class="col-sm-1">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="checkbox" name="retefuente" id="retefuente" value="1">
                </div>
              </div>
              <label for="creditOption" class="col-sm-1 control-label">Sin Base de Retenciones</label>
              <div class="col-sm-1">
                <div class="form-check form-check-inline">
                  <input style="margin-top:5px" class="form-check-input" type="checkbox" name="sinBaseRetencion" id="sinBaseRetencion" value="1">
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
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button class="btn btn-success" align="right"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
      </form>
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
        <div id="datosCia" style="position: relative;	text-align: center;width: 100%;"></div>
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

<div class="modal fade bs-example-modal-lg" id="myModalCentrosCia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
        <h4 class="modal-title" id="myModalLabel">Centros de Costo Compañia</h4>
        <a class="btn btn-success pull-right" data-toggle="modal" href="#myModalAdicionaCentroCia">
          <i class="fa fa-plus" aria-hidden="true"></i>
          Adicionar Centro de Costo
        </a>
      </div>
      <div id="datos_ajax_register"></div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr class="warning">
                  <td>Centro de Costo</td>
                  <td>Responsable</td>
                  <td>Accion</td>
                </tr>
              </thead>
              <tbody id='centrosCia'>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply" aria-hidden="true"></i> Regresar</button>
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
        <div id="huespedesCia" style="position: relative;	text-align: center;top: 5px;width: 100%;max-height: 450px; overflow: auto;"></div>
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
      <div class="row-fluid imprime_productos_mov">
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
  <div class="modal-dialog modal-lg" role="document" style="width: 75%">
    <div class="modal-content">
      <div class="row-fluid imprime_productos_mov">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Historico de Reservas</h4>
          <button style="float: right;margin-top: -25px" class="btn btn-info" onclick="exportTableToExcel('tablaReservas')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
          <input type="hidden" name="txtIdReservasCiaHis" id="txtIdReservasCiaHis">
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body" style="max-height: 480px;overflow: auto;">
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
  <div class="modal-dialog modal-lg" role="document" style="width: 85%">
    <div class="modal-content">
      <div class="row-fluid imprime_productos_mov">
        <div class="modal-header">
          <input type="hidden" name="txtIdReservasCiaHis" id="txtIdReservasCiaHis">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class='glyphicon glyphicon-off' style="color:#530505"></span></button>
          <h3 class="modal-title" id="myModalLabel">Historico Reservas</h3>
        </div>
        <div id="datos_ajax_register"></div>
        <div class="modal-body" style="height: 480px;overflow: auto;">
          <div id="historicoFacturas" style="position:relative;text-align:center;top:5px;width:100%;"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button style="width: 25%;right:inherit" type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
      </div>
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
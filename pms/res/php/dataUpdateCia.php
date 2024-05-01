<?php
// require_once '../../../res/php/titles.php';
require_once '../../../res/php/app_topHotel.php';
$id = $_POST['id'];
$empresa = $hotel->getBuscaIdEmpresa($id);

?>
<form class="form-horizontal" style="padding:0;" id="formUpdateCompania" action="javascript:updateCompania()" method="POST">
  <div class="divHuesped">
    <div class="form-group">
      <label for="nit" class="col-sm-2 control-label">Nit</label>
      <div class="col-sm-3">
        <input type="hidden" name="txtIdCiaUpd" id="txtIdCiaUpd" value="<?php echo $id; ?>">
        <input type="text" class="form-control" name="nit" id="nit" placeholder="Nit" value="<?php echo $empresa[0]['nit']; ?>" minlength="8">
      </div>
      <label for="dv" class="col-sm-1 control-label">Digito</label>
      <div class="col-sm-1">
        <input type="text" class="form-control" name="dv" id="dv" value="<?php echo $empresa[0]['dv']; ?>">
      </div>
      <label for="tipodoc" class="col-sm-2 control-label">Tipo Documento</label>
      <div class="col-sm-3">
        <select name="tipodoc" required>
          <?php
          $tipodocs = $hotel->getTipoDocumento();
          foreach ($tipodocs as $tipodoc) { ?>
            <option value="<?php echo $tipodoc['id_doc']; ?>" <?php if ($empresa[0]['tipo_documento'] == $tipodoc['id_doc']) { ?> selected <?php } ?>><?php echo $tipodoc['descripcion_documento']; ?></option>}
          <?php
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="compania" class="col-sm-2 control-label">Nombre</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="compania" id="compania" value="<?php echo $empresa[0]['empresa']; ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label for="tipoEmpresaAdi" class="col-sm-2 control-label">Tipo de Empresa</label>
      <div class="col-sm-4">
        <select name="tipoEmpresaUpd" id="tipoEmpresaUpd" required>
          <option value="<?php echo $empresa[0]['tipo_compania']; ?>">Seleccione el Tipo de Empresa</option>
          <?php
          $motivos = $hotel->getMotivoGrupo('TEM');
          foreach ($motivos as $motivo) { ?>
            <option value="<?php echo $motivo['id_grupo']; ?>" <?php if ($empresa[0]['tipo_empresa'] == $motivo['id_grupo']) { ?> selected <?php } ?>><?php echo $motivo['descripcion_grupo']; ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <label for="codigoCiiuAdi" class="col-sm-2 control-label">Codigo CIIU</label>
      <div class="col-sm-4">
        <select name="codigoCiiuUpd" id="codigoCiiuUpd" required>
          <option value="<?php echo $empresa[0]['id_codigo_ciiu']; ?>">Seleccione el Codigo CIIU</option>
          <?php
          $codigosCiiu = $admin->getCodigosCiiu();
          foreach ($codigosCiiu as $codigoCiiu) { ?>
            <option value="<?php echo $codigoCiiu['id_ciiu']; ?>" <?php if ($empresa[0]['id_codigo_ciiu'] == $codigoCiiu['id_ciiu']) { ?> selected <?php } ?>><?php echo $codigoCiiu['codigo'] . ' ' . substr($codigoCiiu['descripcion'], 0, 50); ?></option>
          <?php
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="direccion" class="col-sm-2 control-label">Direccion </label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $empresa[0]['direccion']; ?>" required pattern="[A-Za-z0-9 ]+">
      </div>
      <label for="ciudad" class="col-sm-2 control-label">Ciudad</label>
      <div class="col-sm-4">
        <select name="ciudad" id="ciudad">
          <?php
          $ciudades = $hotel->getCiudades();
          foreach ($ciudades as $ciudad) { ?>
            <option value="<?php echo $ciudad['id_ciudad']; ?>" <?php if ($empresa[0]['ciudad'] == $ciudad['id_ciudad']) { ?> selected <?php } ?>><?php echo $ciudad['municipio'] . ' ' . $ciudad['depto']; ?></option>
          <?php
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="telefono" class="col-sm-2 control-label">Telefono</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $empresa[0]['telefono']; ?>" required="">
      </div>
      <label for="celular" class="col-sm-2 control-label">Celular</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="celular" id="celular" minlength="10" value="<?php echo $empresa[0]['celular']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="web" class="col-sm-2 control-label">Pagina Web </label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="web" id="web" value="<?php echo $empresa[0]['web']; ?>">
      </div>
      <label for="correo" class="col-sm-2 control-label">Correo </label>
      <div class="col-sm-4">
        <input type="email" class="form-control" name="correo" id="correo" value="<?php echo $empresa[0]['email']; ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label for="tarifa" class="col-sm-2 control-label">Tarifa </label>
      <div class="col-sm-4">
        <select name="tarifa" id="tarifa" required="">
          <?php
          $tarifas = $hotel->getTarifasHuespedes(); ?>
          <?php foreach ($tarifas as $tarifa) { ?>
            <option value="<?php echo $tarifa['id_tarifa']; ?>" <?php if ($empresa[0]['id_tarifa'] == $tarifa['id_tarifa']) { ?> selected <?php } ?>><?php echo $tarifa['descripcion_tarifa']; ?></option>
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
            <option value="<?php echo $codigo['id_cargo']; ?>" 
            <?php
              if ($empresa[0]['id_forma_pago'] == $codigo['id_cargo']) { ?> selected 
              <?php }
              ?>>
            <?php echo $codigo['descripcion_cargo']; ?></option>
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
            <option value="<?php echo $tipoAdqui['id']; ?>" 
              <?php
                if ($empresa[0]['tipoAdquiriente'] == $tipoAdqui['id']) { ?> selected <?php } 
              ?>>
              <?php echo $tipoAdqui['descripcionAdquiriente']; ?></option>
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
            <option value="<?php echo $tipoRes['id']; ?>" 
            <?php
              if ($empresa[0]['tipoResponsabilidad'] == $tipoRes['id']) { ?> selected <?php } ?>>
              <?php echo $tipoRes['descripcion']; ?></option>
          <?php
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="correo" class="col-sm-2 control-label">Tipo Obligacion </label>
      <div class="col-sm-4">
        <select name="responsabilidadTribu" id="responsabilidadTribu">
          <option value="">Seleccione Tipo Obligacion</option>
          <?php
          $tipoTribus = $hotel->getResponsabilidadTributaria();
          foreach ($tipoTribus as $tipoTribu) { ?>
            <option value="<?php echo $tipoTribu['id']; ?>" <?php
                                                            if ($empresa[0]['responsabilidadTributaria'] == $tipoTribu['id']) { ?> selected <?php
                                                                                                                                          }
                                                                                                                                            ?>><?php echo $tipoTribu['descripcionResponsabilidad']; ?></option>
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
              <input style="margin-top:5px" class="form-check-input" type="radio" name="creditOption" id="inlineRadio1" value="1" onclick="cambiaEstadoCreditoUpd(this.value)" <?php
                                                                                                                                                                                if ($empresa[0]['credito'] == 1) { ?> checked <?php
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                              ?>>
              <label style="margin-top:-18px;margin-left:25px" class="form-check-label" for="inlineRadio1">Si</label>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-check form-check-inline">
              <input style="margin-top:5px" class="form-check-input" type="radio" name="creditOption" id="inlineRadio2" value="2" onclick="cambiaEstadoCreditoUpd(this.value)" <?php if ($empresa[0]['credito'] == 2) { ?> checked <?php } ?>>
              <label style="margin-top:-18px;margin-left:25px" class="form-check-label" for="inlineRadio2">No</label>
            </div>
          </div>
        </div>
        <label for="reteIva" class="col-sm-1 control-label">ReteIva </label>
        <div class="col-sm-1">
          <div class="form-check form-check-inline">
            <input style="margin-top:5px" class="form-check-input" type="checkbox" name="reteIva" id="reteIva" value="1" <?php if ($empresa[0]['reteiva'] == 1) { ?> checked <?php } ?>>
          </div>
        </div>
        <label for="reteIca" class="col-sm-1 control-label">ReteICa </label>
        <div class="col-sm-1">
          <div class="form-check form-check-inline">
            <input style="margin-top:5px" class="form-check-input" type="checkbox" name="reteIca" id="reteIca" value="1" <?php if ($empresa[0]['reteica'] == 1) { ?> checked <?php } ?>>
          </div>
        </div>
        <label for="retefuente" class="col-sm-1 control-label">ReteFuente </label>
        <div class="col-sm-1">
          <div class="form-check form-check-inline">
            <input style="margin-top:5px" class="form-check-input" type="checkbox" name="retefuente" id="retefuente" value="1" <?php if ($empresa[0]['retefuente'] == 1) { ?> checked <?php } ?>>
          </div>
        </div>
        <label for="creditOption" class="col-sm-1 control-label">Sin Base de Retenciones</label>
        <div class="col-sm-1">
          <div class="form-check form-check-inline">
            <input style="margin-top:5px" class="form-check-input" type="checkbox" name="sinBaseRetencion" id="sinBaseRetencion" value="1" <?php if ($empresa[0]['sinBaseRete'] == 1) { ?> checked <?php } ?>>
          </div>
        </div>
      </div>
      <div class="form-group" id='estadocreditoUpd' style=<?php if ($empresa[0]['credito'] == 1) { ?> display:block <?php } else { ?> display:none <?php } ?>>
        <label for="montocredito" class="col-sm-2 control-label">Monto Credito </label>
        <div class="col-sm-2">
          <input type="text" class="form-control" name="montocredito" id="montocredito" value="<?php echo $empresa[0]['monto_credito']; ?>">
        </div>
        <label for="diascredito" class="col-sm-2 control-label">Dias Credito </label>
        <div class="col-sm-2">
          <input type="text" class="form-control" name="diascredito" id="diascredito" placeholder="0" value="<?php echo $empresa[0]['dias_credito']; ?>">
        </div>
        <label for="diacorte" class="col-sm-2 control-label">Dia de Corte </label>
        <div class="col-sm-2">
          <input type="text" class="form-control" name="diacorte" id="diacorte" placeholder="0" value="<?php echo $empresa[0]['dia_corte_credito']; ?>">
        </div>
      </div>
    </div>
  </div>
  <div class="btn-group" style="width: 40%;">
    <button style="width: 50%" type="button" class="btn btn-warning btn-block" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
    <button style="width: 50%" class="btn btn-success" style="text-align:right;"><i class="fa fa-save"></i> Actualizar</button>
  </div>
</form>
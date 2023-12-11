<?php
// require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';
$id = $_POST['id'];

$huesped = $hotel->getBuscaIdHuesped($id);

$tipodocs = $hotel->getTipoDocumento();
$paices = $hotel->getPaices();
$nombreExp = $hotel->getNombreCiudad($huesped[0]['ciudad_expedicion']);
$nombreCiu = $hotel->getNombreCiudad($huesped[0]['ciudad']);

?>
<form class="form-horizontal" id="formUpdateHuesped" action="javascript:actualizaHuesped()" method="POST">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Documento</label>
    <div class="col-sm-3">
      <input type="hidden" name="txtIdHuespedUpd" id="txtIdHuespedUpd" value="<?php echo $id; ?>">
      <input type="text" class="form-control" name="identifica" id="identifica" value="<?php echo $huesped[0]['identificacion']; ?>">
    </div>
    <label for="inputEmail3" class="col-sm-2 control-label">Tipo Documento</label>
    <div class="col-sm-3">
      <select name="tipodoc" required value="<?php echo $huesped[0]['tipo_identifica']; ?>">
        <option value="">Seleccione el Tipo de Documeto</option>
        <?php foreach ($tipodocs as $tipodoc) { ?>
          <option value="<?php echo $tipodoc['id_doc']; ?>" 
          <?php
                                                            if ($huesped[0]['tipo_identifica'] == $tipodoc['id_doc']) { ?> selected <?php
                                                                                                                                  }
                                                                                                                                    ?>><?php echo $tipodoc['descripcion_documento']; ?></option>}
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="paisExp" class="col-sm-2 control-label">Expedicion </label>
    <div class="col-sm-3">
      <select name="paisExpUpd" id="paisExpUpd" required="" onblur="ciudadesExpedicion(this.value,'<?php echo $huesped[0]['ciudad_expedicion']; ?>')">
        <?php
        foreach ($paices as $pais) { ?>
          <option value="<?php echo $pais['id_pais']; ?>" <?php
                                                          if ($huesped[0]['pais_expedicion'] == $pais['id_pais']) { ?> selected <?php
                                                                                                                              }
                                                                                                                                ?>><?php echo $pais['descripcion']; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <label for="ciudadExp" class="col-sm-2 control-label">Ciudad </label>
    <div class="col-sm-3">
      <select name="ciudadExpUpd" id="ciudadExpUpd" required="">
        <option value="<?php echo $huesped[0]['ciudad_expedicion']; ?>"><?php echo $nombreExp; ?></option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="apellidos" class="col-sm-2 control-label">1er Apellidos</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="apellido1" id="apellido1" required value="<?php echo $huesped[0]['apellido1']; ?>">
    </div>
    <label for="apellidos" class="col-sm-2 control-label">2o Apellido</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="apellido2" id="apellido2" value="<?php echo $huesped[0]['apellido2']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="nombres" class="col-sm-2 control-label">1er Nombre</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="nombre1" id="nombre1" required value="<?php echo $huesped[0]['nombre1']; ?>">
    </div>
    <label for="nombres" class="col-sm-2 control-label">2o Nombre</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="nombre2" id="nombre2" value="<?php echo $huesped[0]['nombre2']; ?>">
    </div>
    <div class="col-sm-2" style="padding:0">
      <div class="col-sm-6" style="padding:0;height: 15px">
        <div class="form-check form-check-inline" style="text-align: left">
          <input style="margin-top:5px" class="form-check-input" type="radio" name="sexOption" id="inlineRadio1" value="1" <?php
                                                                                                                            if ($huesped[0]['sexo'] == 1) { ?> checked <?php
                                                                                                                                                                      }
                                                                                                                                                                        ?>>
          <label style="margin-top:-18px;margin-left:25px" class="form-check-label" for="inlineRadio1">Masc</label>
        </div>
      </div>
      <div class="col-sm-6" style="padding:0;height: 15px">
        <div class="form-check form-check-inline" style="text-align: left">
          <input style="margin-top:5px" class="form-check-input" type="radio" name="sexOption" id="inlineRadio2" value="2" <?php
                                                                                                                            if ($huesped[0]['sexo'] == 2) {  ?> checked="" <?php
                                                                                                                                                                          }
                                                                                                                                                                            ?>>
          <label style="margin-top:-18px;margin-left:25px" class="form-check-label" for="inlineRadio2">Fem</label>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="direccion" class="col-sm-2 control-label">Direccion </label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="direccion" id="direccion" required value="<?php echo $huesped[0]['direccion']; ?>" pattern="[A-Za-z0-9 -]+">
    </div>
  </div>
  <div class="form-group">
    <label for="paices" class="col-sm-2 control-label">Nacionalidad </label>
    <div class="col-sm-4">
      <select name="paices" id="paices" onblur="getCiudadesPais(this.value,'<?php echo $huesped[0]['ciudad']; ?>')">
        <option value="">Seleccione la Nacionalidad</option>
        <?php
        foreach ($paices as $pais) { ?>
          <option value="<?php echo $pais['id_pais']; ?>" <?php
                                                          if ($huesped[0]['pais'] == $pais['id_pais']) { ?> selected <?php
                                                                                                                    }
                                                                                                                      ?>><?php echo $pais['descripcion']; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <label class="col-lg-2 col-md-2 control-label" style="padding-top:0">Ciudad</label>
    <div class="col-sm-4">
      <select name="ciudadUpd" id='ciudadUpd'>
        <option value="<?php echo $huesped[0]['ciudad']; ?>"><?php echo $nombreCiu; ?></option>
      </select>
    </div>
    <div id="ciudadesPais"></div>
  </div>
  <div class="form-group">
    <label for="telefono" class="col-sm-2 control-label">Telefono</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $huesped[0]['telefono']; ?>" required="" minlength="10" maxlength="18" pattern="[0-9]+">
    </div>
    <label for="celular" class="col-sm-2 control-label">Celular</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="celular" id="celular" value="<?php echo $huesped[0]['celular']; ?>" minlength="10" maxlength="18" pattern="[0-9]+">
    </div>
  </div>
  <div class="form-group">
    <label for="correo" class="col-sm-2 control-label">Correo </label>
    <div class="col-sm-4">
      <input type="email" class="form-control" name="correo" id="correo" value="<?php echo $huesped[0]['email']; ?>" required>
    </div>
    <label for="fechanace" class="col-sm-2 control-label">Fecha Nacimiento </label>
    <div class="col-sm-4">
      <input type="date" class="form-control" name="fechanace" id="fechanace" value="<?php echo $huesped[0]['fecha_nacimiento']; ?>">
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
          <option value="<?php echo $tipoAdqui['id']; ?>" <?php
                                                          if ($huesped[0]['tipoAdquiriente'] == $tipoAdqui['id']) { ?> selected <?php
                                                                                                                              }
                                                                                                                                ?>><?php echo $tipoAdqui['descripcionAdquiriente']; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <label for="correo" class="col-sm-2 control-label">Tipo Regimen </label>
    <div class="col-sm-4">
      <select name="tipoResponsabilidad" id="tipoResponsabilidad" required>
        <option value="">Seleccione Tipo de Responsabilidad</option>
        <?php
        $tipoRespo = $hotel->getTipoResponsabilidad();
        foreach ($tipoRespo as $tipoRes) { ?>
          <option value="<?php echo $tipoRes['id']; ?>" <?php
                                                        if ($huesped[0]['tipoResponsabilidad'] == $tipoRes['id']) { ?> selected <?php
                                                                                                                              }
                                                                                                                                ?>><?php echo $tipoRes['descripcion']; ?></option>
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
          <option value="<?php echo $tipoTribu['id']; ?>" <?php if ($huesped[0]['responsabilidadTributaria'] == $tipoTribu['id']) { ?> selected <?php } ?>><?php echo $tipoTribu['descripcionResponsabilidad']; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <label for="profesion" class="col-sm-2 control-label">Profesion </label>
    <div class="col-sm-4">
      <select name="profesion" id="profesion">
        <option value="">Seleccione La Profesion</option>
        <?php
        $motivos = $hotel->getMotivoGrupo('PRO');
        foreach ($motivos as $motivo) { ?>
          <option value="<?php echo $motivo['id_grupo']; ?>" <?php
                                                              if ($motivo['id_grupo'] == $huesped[0]['profesion']) {
                                                              ?> selected <?php
                                                                        }
                                                                          ?>><?php echo $motivo['descripcion_grupo']; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
  </div>


  <!-- <div class="form-group">
    <label for="tarifa" class="col-sm-2 control-label">Tarifa </label>
    <div class="col-sm-4">
      <select name="tarifa" id="tarifa" required="">
        <?php
        $tarifas = $hotel->getTarifasHuespedes(); ?>
        <?php foreach ($tarifas as $tarifa) { ?>
          <option value="<?php echo $tarifa['id_tarifa']; ?>" <?php
                                                              if ($huesped[0]['id_tarifa'] == $tarifa['id_tarifa']) { ?> selected <?php
                                                                                                                                }
                                                                                                                                  ?>><?php echo $tarifa['descripcion_tarifa']; ?></option>
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
          <option value="<?php echo $codigo['id_cargo']; ?>" <?php
                                                              if ($huesped[0]['id_forma_pago'] == $codigo['id_cargo']) { ?> selected <?php
                                                                                                                                    }
                                                                                                                                      ?>><?php echo $codigo['descripcion_cargo']; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
  </div> -->
  <div class="form-group">
    <label for="empresa" class="col-sm-2 control-label">Empresa </label>
    <div class="col-sm-6">
      <select name="empresaUpd" id="empresaUpd">
        <!-- <option value="">Seleccione La Empresa</option> -->
        <option value="">SIN COMPAÑIA</option>
        <?php
        $companias = $hotel->getCompanias();
        foreach ($companias as $compañia) { ?>
          <option value="<?= $compañia['id_compania'] ?>" <?php
                                                          if ($huesped[0]['id_compania'] == $compañia['id_compania']) { ?> selected <?php
                                                                                                                                  }
                                                                                                                                    ?>><?= $compañia['empresa'] ?></option>
        <?php
        } ?>
      </select>
    </div>
  </div>
  <div class="container-fluid">
    <div class="btn-group" style="margin-top:15px">
      <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
      <button class="btn btn-success" align="right"><i class="fa fa-save"></i> Procesar</button>
    </div>
  </div>
</form>
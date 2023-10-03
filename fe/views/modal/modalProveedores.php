<?php 
  $tiposCia    = $admin->getTiposCia();
  $tiposDoc    = $admin->getTipoDocumento();
  $codigosCiiu = $admin->getCodigosCiiu();
  $ciudades    = $admin->getCiudadesPais(CODIGO_PAIS_EMPRESA);

?>

<div class="modal fade" id="myModalAdicionarProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="dataRegistrarProveedor" class="form-horizontal" action="javascript:guardaProveedor()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="exampleModalLabel"><span class="material-symbols-outlined">person_add</span> Adiciona Proveedor</h4>
        </div>
        <div class="modal-body">
          <div id="datos_ajax"></div>
          <form class="form-horizontal">
            <div class="card-body">
              <div class="form-group row">
                <label for="empresa" class="control-label col-lg-2 col-md-2">Empresa</label>
                <div class="col-lg-6 col-md-6">
                  <input type="text" class="form-control" id="empresa" name="empresa" required >
                </div>
                <label for="nit" class="control-label col-lg-1 col-md-1">Nit</label>
                <div style="padding-right:0" class="col-lg-2 col-md-2">
                  <input  type="text" class="form-control" id="nit" onblur="calcularDV()" name="nit" min="1000000" required >
                </div>
                <div style="padding-left:2px" class="col-lg-1 col-md-1" id="dvnit">
                  <label for="nit">-</label>
                  <input style="width: 80%;margin-left: 12px;margin-top: -34px;" type="text" class="form-control" id="dv" name="dv" min="" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="direccion" class="control-label col-lg-2 col-md-2">Direccion</label>
                <div class="col-lg-6 col-md-6">
                  <input type="text" class="form-control" id="direccion" name="direccion" required >
                </div>
                <label for="ciudad" class="control-label col-lg-1  col-md-1">Ciudad</label>
                <div class="col-lg-3 col-md-3">
                  <select class="form-control" name="ciudad" id="ciudad" required>
                    <option value="">Seleccione La Ciudad</option>
                    <?php 
                    foreach ($ciudades as $ciudad) { ?>
                      <option value="<?=$ciudad['id_ciudad'];?>"><?= $ciudad['municipio'].' - '.$ciudad['depto'];?> </option>
                      <?php 
                    }
                    ?>
                  </select> 
                </div>
              </div>
              <div class="form-group row">
                <label for="seccion" class="control-label col-lg-2 col-md-2">Telefono</label>
                <div class="col-lg-3 col-md-3">
                  <input type="text" class="form-control" id="telefono" name="telefono" required >
                </div>
                <label for="seccion" class="control-label col-lg-2 col-md-2">Celular</label>
                <div class="col-lg-3 col-md-3">
                  <input type="text" class="form-control" id="celular" name="celular" required >
                </div>
              </div>
              <div class="form-group row">
                <label for="seccion" class="control-label col-lg-2 col-md-2">Email</label>
                <div class="col-lg-4 col-md-4">
                  <input type="email" class="form-control" id="correo" name="correo" required >
                </div>
                <label class="control-label col-lg-2  col-md-2" for="">Pagina web</label>
                <div class="col-lg-4 col-md-4">
                  <input class="form-control" type="text" name="web" id="web">
                </div>
              </div>
              <div class="form-group row">
                <label for="seccion" class="control-label col-lg-2 col-md-2">Tipo Empresa</label>
                <div class="col-lg-4 col-md-4">
                  <select class="form-control" name="tipo_emp" id="tipo_emp" required>
                    <option value="">Seleccione El Tipo de Empresa</option>
                    <?php 
                    foreach ($tiposCia as $tipoCia) {
                      ?>
                      <option value="<?= $tipoCia['id_tipo_cia']?>"><?php echo $tipoCia['descripcion']?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <label for="costo" class="control-label col-lg-2  col-md-2">Documento</label>
                <div class="col-lg-4 col-md-4">
                  <select class="form-control" name="tipo_doc" id="tipo_doc" required>
                    <option value="">Seleccione El Tipo de Documento</option>
                    <?php 
                    foreach ($tiposDoc as $tipoDoc) { ?>
                      <option value="<?= $tipoDoc['id_doc']?>"
                        <?php 
                        if($tipoDoc['id_doc']==8) {
                        ?>
                        selected
                          <?php
                        }
                        ?>
                      ><?php echo $tipoDoc['descripcion_documento']?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div id='nombre_personas'></div>
              <div class="form-group row"> 
                <label for="promedio" class="control-label col-lg-2  col-md-2">Codigo CIIU</label>
                <div class="col-lg-4 col-md-4">
                  <select class="form-control" name="ciiu" id="ciiu">
                    <option value="">Seleccione El Codigo CIIU</option>
                    <?php 
                    foreach ($codigosCiiu as $codigoCiiu) { ?>
                      <option value="<?= $codigoCiiu['id_ciiu']?>"><?php echo $codigoCiiu['codigo'].' '.substr($codigoCiiu['descripcion'],0,50)?></option>
                      <?php
                      }
                    ?>
                  </select>
                </div>
                <label for="tipoAdquiriente" class="col-sm-2 control-label">Tipo Empresa </label>
                <div class="col-sm-4">
                  <select class="form-control" name="tipoAdquiriente" id="tipoAdquiriente" required>
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
              </div>
              <div class="form-group row">
                <label for="tipoResponsabilidad" class="col-sm-2 control-label">Tipo Regimen </label>
                <div class="col-sm-4">
                  <select class="form-control" name="tipoResponsabilidad" id="tipoResponsabilidad" required>
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
              <!-- </div>
              <div class="form-group row"> -->
                <label for="responsabilidadTribu" class="col-sm-2 control-label">Tipo Obligacion</label>
                <div class="col-sm-4">
                  <select class="form-control" name="responsabilidadTribu" id="responsabilidadTribu" required>
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
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
            </div>
          </form>
        </div>
        <!-- <div class="modal-footer">
          <div class="btn-group">
          </div>
        </div> -->
      </div>
    </div>
  </form>
</div>

<div class="modal fade" id="myModalModificaProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form id="dataActualizaProveedor" class="form-horizontal" action="javascript:actualizaProveedor()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="idTituloProveedor">Modifica Proveedor</h4>
        </div>
        <div class="modal-body" id='updProveedor'>
          <div id="datos_ajax"></div>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Regresar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
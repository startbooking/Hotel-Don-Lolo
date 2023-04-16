<?php 
  require '../../../res/php/app_topInventario.php'; 

  $id          = $_POST['idprod'];
  $infoProv    = $inven->traeCompania($id);
  $tiposCia    = $admin->getTiposCia();
  $tiposDoc    = $admin->getTipoDocumento();
  $codigosCiiu = $admin->getCodigosCiiu();
  $ciudades    = $admin->getCiudadesPais(CODIGO_PAIS_EMPRESA);


?>
  <input type="hidden" name="idProv" id="idProv" value="<?=$infoProv[0]['id_compania']?>">  
  <div class="form-group">
    <label for="empresa" class="control-label col-lg-2 col-md-2">Empresa</label>
    <div class="col-lg-6 col-md-6">
      <input type="text" class="form-control" id="empresa" name="empresa" required  value="<?=$infoProv[0]['empresa']?>">
    </div>
    <label for="nit" class="control-label col-lg-1 col-md-1">Nit</label>
    <div style="padding-right:0" class="col-lg-2 col-md-2">
      <input  type="text" class="form-control" onblur="calculaDV()" id="nitUpd" name="nitUpd" min="1000000" required  value="<?=$infoProv[0]['nit']?>">
    </div>
    <div style="padding-left:2px" class="col-lg-1 col-md-1" id="dvnit">
      <label for="nit">-</label>
      <input style="width: 80%;margin-left: 12px;margin-top: -34px;" type="text" class="form-control" id="dvUpd" name="dvUpd" min="" required value="<?=$infoProv[0]['dv']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="direccion" class="control-label col-lg-2 col-md-2">Direccion</label>
    <div class="col-lg-6 col-md-6">
      <input type="text" class="form-control" id="direccion" name="direccion" required value="<?=$infoProv[0]['direccion']?>">
    </div>
    <label for="ciudad" class="control-label col-lg-1  col-md-1">Ciudad</label>
    <div class="col-lg-3 col-md-3">
      <select class="form-control" name="ciudad" id="ciudad" required>
          <option value="">Seleccione La Ciudad</option>
          <?php 
          foreach ($ciudades as $ciudad) { ?>
            <option value="<?=$ciudad['id_ciudad'];?>" 
              <?php 
              if($ciudad['id_ciudad']== $infoProv[0]['ciudad']){ ?>
                selected
              <?php 
              }
              ?>
              ><?= $ciudad['municipio'].' - '.$ciudad['depto'];?> </option>
            <?php 
          }
          ?>
        </select> 
    </div>
  </div>
  <div class="form-group">
    <label for="seccion" class="control-label col-lg-2 col-md-2">Telefono</label>
    <div class="col-lg-2 col-md-2">
      <input type="text" class="form-control" id="telefono" name="telefono" required value="<?=$infoProv[0]['telefono']?>">
    </div>
    <label for="seccion" class="control-label col-lg-2 col-md-2">Celular</label>
    <div class="col-lg-2 col-md-2">
      <input type="text" class="form-control" id="celular" name="celular" required value="<?=$infoProv[0]['celular']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="seccion" class="control-label col-lg-2 col-md-2">email</label>
    <div class="col-lg-4 col-md-4">
      <input type="email" class="form-control" id="correo" name="correo" required value="<?=$infoProv[0]['email']?>">
    </div>
    <label class="control-label col-lg-2  col-md-2" for="">web</label>
    <div class="col-lg-4 col-md-4">
      <input class="form-control" type="text" name="web" id="web" value="<?=$infoProv[0]['web']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="seccion" class="control-label col-lg-2 col-md-2">Tipo Empresa</label>
    <div class="col-lg-4 col-md-4">
      <select class="form-control" name="tipo_emp" id="tipo_emp" required>
        <option value="">Seleccione El Tipo de Empresa</option>
        <?php 
        foreach ($tiposCia as $tipoCia) {
          ?>
          <option value="<?= $tipoCia['id_tipo_cia']?>"
            <?php 
              if($tipoCia['id_tipo_cia']== $infoProv[0]['tipo_empresa']){ ?>
                selected
                <?php 
              }
            ?>
            ><?php echo $tipoCia['descripcion']?></option>
          <?php
        }
        ?>
      </select>
    </div>
    <label for="costo" class="control-label col-lg-2  col-md-2">Tipo Documento</label>
    <div class="col-lg-4 col-md-4">
      <select class="form-control" name="tipo_doc" id="tipo_doc" required>
        <option value="">Seleccione El Tipo de Documento</option>
        <?php 
        foreach ($tiposDoc as $tipoDoc) { ?>
          <option value="<?= $tipoDoc['id_doc']?>"
          <?php 
              if($tipoDoc['id_doc']== $infoProv[0]['tipo_documento']){ ?>
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
  <div class="form-group"> 
    <label for="promedio" class="control-label col-lg-2  col-md-2">Codigo CIIU</label>
    <div class="col-lg-4 col-md-4">
      <select class="form-control" name="ciiu" id="ciiu" required>
        <option value="">Seleccione El Codigo CIIU</option>
        <?php 
        foreach ($codigosCiiu as $codigoCiiu) { ?>
          <option value="<?= $codigoCiiu['id_ciiu']?>"
            <?php 
              if($codigoCiiu['id_ciiu']== $infoProv[0]['id_codigo_ciiu']){ ?>
                selected
                <?php 
              }
            ?>
            ><?php echo $codigoCiiu['codigo'].' '.substr($codigoCiiu['descripcion'],0,50)?></option>
          <?php
          }
        ?>
      </select>
    </div>
  </div>

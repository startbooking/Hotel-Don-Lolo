<?php 
  require '../../../res/php/app_topInventario.php'; 

  $id        = $_POST['idprod'];
  $infoProd  = $inven->traeProducto($id);
  $familias  = $admin->getFamiliasInventarios();
  $grupos    = $inven->getGruposFamilia($infoProd[0]['id_familia']);
  $subgrupos = $inven->getSubGruposFamilia($infoProd[0]['id_grupo']);
  $unidades  = $inven->getUnidadesMedida();

?>
  <input type="hidden" name="idProd" id="idProd" value="<?=$infoProd[0]['id_producto']?>">  
  <div class="form-group">
    <label for="producto" class="control-label col-lg-2 col-md-2">Producto</label>
    <div class="col-lg-6 col-md-6">
      <input type="text" class="form-control" id="producto" name="producto" required value="<?=$infoProd[0]['nombre_producto']?>">
    </div>
  </div>
  <div class="form-group">
    <label for="familia" class="control-label col-lg-2 col-md-2">Familia</label>
    <div class="col-lg-4 col-md-4">
      <select class="form-control" name="familiaUpd" id="familiaUpd" required onblur="cambiaGrupo()">
        <option value="">Seleccione la Familia del Producto</option>
        <?php 
        foreach ($familias as $familia) { ?>
          <option value="<?=$familia['id_familia']?>"
            <?php 
              if($familia['id_familia']==$infoProd[0]['id_familia']){?>
                selected
                <?php 
              }
            ?>
            ><?=$familia['descripcion_familia']?></option>
          <?php 
        }
        ?>
      </select>
    </div>
    <label for="seccion" class="control-label col-lg-2 col-md-2">Grupo</label>
    <div class="col-lg-4 col-md-4">
      <select class="form-control" name="gruposUpd" id="gruposUpd" required onblur="cambiasubGrupo()">
        <?php 
        foreach ($grupos as $grupo) { ?>
          <option value="<?=$grupo['id_grupo']?>"
            <?php 
              if($grupo['id_grupo']==$infoProd[0]['id_grupo']){?>
                selected
                <?php 
              }
            ?>
            ><?=$grupo['descripcion_grupo']?></option>
          <?php 
        }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="seccion" class="control-label col-lg-2 col-md-2">Subgrupo</label>
    <div class="col-lg-4 col-md-4">
      <select class="form-control" name="subgrupoUpd" id="subgrupoUpd" requierd>
        <?php 
        foreach ($subgrupos as $subgrupo) { ?>
          <option value="<?=$subgrupo['id_subgrupo']?>"
            <?php 
              if($subgrupo['id_subgrupo']==$infoProd[0]['id_subgrupo']){?>
                selected
                <?php 
              }
            ?>
            ><?=$subgrupo['descripcion_subgrupo']?></option>
          <?php 
        }
        ?>
      </select>
    </div>
    <label for="seccion" class="control-label col-lg-2 col-md-2">Unidad Compra</label>
    <div class="col-lg-4 col-md-4">
      <select class="form-control" name="compraUpd" id="compraUpd" required>
        <option>Seleccione la unidad de Compra</option>
        <?php
        foreach ($unidades as $unidad) { ?>
          <option value="<?= $unidad['id_unidad']?>" 
            <?php 
              if($unidad['id_unidad']==$infoProd[0]['unidad_compra']){?>
                selected
                <?php 
              }
            ?>
            ><?php echo $unidad['descripcion_unidad']?></option>
          <?php 
        }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group" id="compra">
    <label for="seccion" class="control-label col-lg-2 col-md-2">Almacenamiento</label>
    <div class="col-lg-4 col-md-4">
      <select class="form-control" name="almacenaUpd" id="almacenaUpd" required>
        <option>Seleccione la unidad de Almacenamiento</option>
        <?php 
        foreach ($unidades as $unidad) { ?>
          <option value="<?= $unidad['id_unidad']?>"
            <?php 
              if($unidad['id_unidad']==$infoProd[0]['unidad_almacena']){?>
                selected
                <?php 
              }
            ?>
            ><?php echo $unidad['descripcion_unidad']?></option>
          <?php 
        }
        ?>
      </select>
    </div>
    <label for="seccion" class="control-label col-lg-2 col-md-2">Procesamiento</label>
    <div class="col-lg-4 col-md-4">
      <select class="form-control" name="procesaUpd" id="procesaUpd" required>
        <option>Seleccione la unidad de Procesamiento</option>
        <?php 
        foreach ($unidades as $unidad) { ?>
          <option value="<?= $unidad['id_unidad']?>"
            <?php 
              if($unidad['id_unidad']==$infoProd[0]['unidad_procesa']){?>
                selected
                <?php 
              }
            ?>
            ><?php echo $unidad['descripcion_unidad']?></option>
          <?php 
        }
        ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="costo" class="control-label col-lg-2  col-md-2">Precio Costo</label>
    <div class="col-lg-4 col-md-4">
      <input type="number" class="form-control" step="0.001" id="costoUpd" name="costoUpd" min='0' value="<?=$infoProd[0]['valor_costo']?>"> 
    </div>
    <label for="promedio" class="control-label col-lg-2  col-md-2">Precio Promedio</label>
    <div class="col-lg-4 col-md-4">
      <input type="number" class="form-control" step="0.001" id="promedioUpd" name="promedioUpd" min='0' value="<?=$infoProd[0]['valor_promedio']?>"> 
    </div>
  </div>

  <div class="form-group">
    <label for="costo" class="control-label col-lg-2  col-md-2">Stock Minimo</label>
    <div class="col-lg-4 col-md-4">
      <input type="number" class="form-control" id="minimoUpd" name="minimoUpd" required min='0' value="<?=$infoProd[0]['stock_minimo']?>"> 
    </div>
    <label for="promedio" class="control-label col-lg-2  col-md-2">Stock maximo</label>
    <div class="col-lg-4 col-md-4">
      <input type="number" class="form-control" id="maximoUpd" name="maximoUpd" required min='0' value="<?=$infoProd[0]['stock_maximo']?>"> 
    </div>
  </div>

  <!--
  <div class="form-group">
    <label class="control-label col-lg-2  col-md-2" for="">Porcionar</label>
    <div class="col-lg-2 col-md-2">
      <input type="checkbox" name="porciona" id="porciona" title="Producto Para Porcionar ?" 
      <?php 
      if($infoProd[0]['porcionar']==1){ ?> 
        checked
        <?php 
      }
     ?>
      >
    </div>
    <label for="costo" class="control-label col-lg-2  col-md-2">% Equivalente</label>
    <div class="col-lg-2 col-md-2">
      <input type="number" class="form-control" id="equivale" name="equivale" min='0' value='0'> 
    </div>
    <label for="promedio" class="control-label col-lg-2  col-md-2">Peso Porcion</label>
    <div class="col-lg-2 col-md-2">
      <input type="number" class="form-control" id='cantidad' name="cantidad" min='0' value='0'> 
    </div>
  </div>
-->
  <div class="form-group">
    <label class="control-label col-lg-2  col-md-2" for="exampleTextarea">Ubicacion</label>
    <div class="col-lg-10 col-md-10">
      <textarea class="form-control" id="ubicacionUpd" name="ubicacionUpd" ><?=$infoProd[0]['ubicacion']?></textarea>
    <!--
      <input class="form-control" type="text" id="ubicacion" name="ubicacion" value="<?=$infoProd[0]['ubicacion']?>">
    -->
    </div>
  </div>

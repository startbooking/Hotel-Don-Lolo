<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

  $id     = $_POST['id'];
  $grupos = $admin->traeGrupoInventarios($id);  
 ?>

  <input type="hidden" name="idEliminaGrupo" id="idEliminaGrupo" value="<?=$grupos[0]['id_grupo']?>">
  <div class="form-group">
    <label for="nombre" class="control-label col-lg-4 col-md-4">Familia </label>
    <div class="col-lg-6 col-md-6">
      <select name="familiaGrp" id="familiaGrp" required>
        <?php 
          $familias = $admin->getFamiliasInventarios();
          foreach ($familias as $familia) { ?>
            <option value="<?=$familia['id_familia']?>" 
              <?php 
                if($familia['id_familia']==$grupos[0]['id_familia']){ ?>
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
  </div>
  <div class="form-group">
    <label for="nombre" class="control-label col-lg-4 col-md-4">Grupo </label>
    <div class="col-lg-6 col-md-6">
      <input type="text" class="form-control" id="nombreGrp" name="nombreGrp" required value="<?=$grupos[0]['descripcion_grupo']?>">
    </div>
  </div>
 
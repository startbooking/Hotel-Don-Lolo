<?php 
  include '../../../../res/php/titles.php';
  include '../../../../res/php/app_topPos.php'; 

  $id        = $_POST['id'];
  $updateRec = $pos->treaReceta($id);
  $tipos     = $pos->getTipoPlatos();
  $imptos    = $pos->getImpuestos();

?>

<div class="modal-body">
  <div class="form-group">
    <div class="col-md-9">
      <div class="form-group">
        <input type="hidden" name="idReceta" id="idReceta" value="<?=$updateRec[0]['id_receta']?>">
        <label for="receta" class="control-label col-lg-2 col-md-2" style="padding:5px">Receta</label>
        <div class="col-lg-6 col-md-6">
          <input type="text" class="form-control" id="receta" name="receta" required value="<?=$updateRec[0]['nombre_receta']?>">
        </div>
        <label for="porcion" class="control-label col-lg-2 col-md-2">Porciones</label>
        <div class="col-lg-2 col-md-2">
          <input type="number" min='1' class="form-control" id="porcion" name="porcion" required value="<?=$updateRec[0]['cantidad']?>">
        </div>
      </div>
      <div class="form-group">
        <label for="tipoReceta" class="control-label col-lg-2 col-md-2" style="padding:5px 0">Tipo de Receta</label>
        <div class="col-lg-3 col-md-3">
          <select name="tipoReceta" id="tipoReceta" required>
            <option value="">Seleccione el Tipo de Receta</option>
            <?php 
            foreach ($tipos as $tipo) { ?>
              <option value="<?=$tipo['id_seccion']?>" 
                <?php
                if($tipo['id_seccion'] = $updateRec[0]['id_seccion']){ ?>
                  selected
                <?php 
                }
                ?>
                ><?php echo $tipo['nombre_seccion']?></option>
              <?php 
            }
            ?>
          </select>
        </div>
        <label for="impto" class="control-label col-lg-2  col-md-2">Impuesto</label>
        <div class="col-lg-3 col-md-3">
          <select name="impto" id="impto" required>

            <option value="">Seleccione el Impuesto</option>
            <?php
            foreach ($imptos as $impto) { ?>
              <option value="<?=$impto['id_cargo']?>"
                <?php
                if($updateRec[0]['id_impuesto'] == $impto['id_cargo']){ ?>
                  selected
                <?php 
                }
                ?>
                ><?php echo $impto['descripcion_cargo']?></option>
              <?php 
             } 
            ?>
          </select>
        </div>
        <label class="control-label col-md-2" style="padding:0"><input  type="checkbox" name="subreceta" value="0"
          <?php
          if($updateRec[0]['subreceta']==1){ ?>
            checked
          <?php 
          }
          ?>
          > Sub Receta</label>
      </div>
      <div class="form-group">
        <label for="vlrVenta" class="control-label col-lg-2  col-md-2" style="padding:5px 0">Precio Venta</label>
        <div class="col-lg-2 col-md-2" style="padding:5px 0 5px 15px">
          <input type="number" min='0' class="form-control" id="vlrVenta" name="vlrVenta" required maxlength="12" value="<?=$updateRec[0]['valor_venta']?>"> 
        </div>
        <label for="vlrVenta" class="control-label col-lg-2  col-md-2">% Margen Error</label>
        <div class="col-lg-2 col-md-2">
          <input type="number" min='0' class="form-control" id="margen" name="margen" required maxlength="12" value="<?=$updateRec[0]['margen_error']?>"> 
        </div>
        <label for="costo0" class="control-label col-lg-2  col-md-2">Tiempo Coccion</label>
        <div class="col-lg-2 col-md-2">
          <input type="number" min='1' class="form-control" id="tiempo" name="tiempo" required maxlength="12" value="<?=$updateRec[0]['duracion_prep']?>"> 
        </div>
      </div>
    </div> 
    <div class="col-md-3">
      <img style="margin-top:0px" src="images/<?= $updateRec[0]['foto'];?>" class="img-thumbnail" alt="">
    </div>
  </div>
  <div class="form-group">
    <label for="preparacion" class="control-label col-lg-2  col-md-2">Preparacion</label>
    <div class="col-lg-10 col-md-10">
      <textarea id="preparacion" name="preparacion" id="" cols="30" rows="3" ><?php echo $updateRec[0]['preparacion']
       ?>
   </textarea>
    </div>            
  </div>
  <div class="form-group">
    <label for="montaje" class="control-label col-lg-2  col-md-2">Montaje</label>
    <div class="col-lg-10 col-md-10">
      <textarea id="montaje" name="montaje" id="" cols="30" rows="3" ><?php echo $updateRec[0]['montaje']?></textarea>
    </div>            
  </div>
</div>


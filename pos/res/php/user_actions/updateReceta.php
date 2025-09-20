<?php
include '../../../../res/php/app_topPos.php';
extract($_POST);
$updateRec = $pos->treaReceta($id);
$tipos = $pos->getTipoPlatos($id_ambiente);
$imptos = $pos->getImpuestos();

?>

<div class="modal-body pd0">
  <ul class="nav nav-tabs">
    <li class="active">
      <a href="#info" class="" data-toggle="tab">
        <i class="fa-solid fa-money-bills"></i>
        Informacion Receta
      </a>
    </li>
    <li>
      <a href="#foto" class="" data-toggle="tab">
        <i class="fa-solid fa-wallet"></i> Foto Receta
      </a>
    </li>
  </ul>
  <div class="tab-content py10">
    <div class="tab-pane active" id="info">
      <div class="form-group">
        <div class="form-group">
          <input type="hidden" name="idReceta" id="idReceta" value="<?php echo $updateRec['id_receta']; ?>">
          <label for="receta" class="control-label col-lg-2 col-md-2" style="padding:5px">Receta</label>
          <div class="col-lg-6 col-md-6">
            <input type="text" class="form-control" id="receta" name="receta" required value="<?php echo $updateRec['nombre_receta']; ?>">
          </div>
          <label for="porcion" class="control-label col-lg-2 col-md-2">Porciones</label>
          <div class="col-lg-1 col-md-1 pd0">
            <input type="number" min='1' class="form-control" id="porcion" name="porcion" required value="<?php echo $updateRec['cantidad']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="tipoReceta" class="control-label col-lg-2 col-md-2" style="padding:5px 0">Tipo de Receta</label>
          <div class="col-lg-3 col-md-3">
            <select name="tipoReceta" id="tipoReceta" required>
              <option value="">Seleccione el Tipo de Receta</option>
              <?php
              foreach ($tipos as $tipo) { ?>
                <option value="<?php echo $tipo['id_seccion']; ?>"
                  <?php
                  if ($tipo['id_seccion'] = $updateRec['id_seccion']) { ?>
                  selected
                  <?php
                  }
                  ?>><?php echo $tipo['nombre_seccion']; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <label for="impto" class="control-label col-lg-1 col-md-1">Impuesto</label>
            <div class="col-lg-3 col-md-3">
              <select name="impto" id="impto" required>
                <option value="">Seleccione el Impuesto</option>
                <?php
                foreach ($imptos as $impto) { ?>
                    <option value="<?php echo $impto['id_cargo']; ?>"
                    <?php
                    if ($updateRec['id_impuesto'] == $impto['id_cargo']) { ?>
                      selected
                      <?php
                    }
                      ?>
                    ><?php echo $impto['descripcion_cargo']; ?></option>
                    <?php
                  }
                    ?>
              </select>
            </div>
          <label class="control-label col-md-2" style="padding:0"><input type="checkbox" name="subreceta" value="0"
              <?php
              if ($updateRec['subreceta'] == 1) { ?>
              checked
              <?php
              }
              ?>> Sub Receta</label>
        </div>
        <div class="form-group">
          <label for="vlrVenta" class="control-label col-lg-2  col-md-2" style="padding:5px 0">Precio Venta</label>
          <div class="col-lg-2 col-md-2" style="padding:5px 0 5px 15px">
            <input type="number" min='0' class="form-control" id="vlrVenta" name="vlrVenta" required maxlength="12" value="<?php echo $updateRec['valor_venta']; ?>">
          </div>
          <label for="vlrVenta" class="control-label col-lg-2  col-md-2">% Error</label>
          <div class="col-lg-2 col-md-2">
            <input type="number" min='0' class="form-control" id="margen" name="margen" required maxlength="12" value="<?php echo $updateRec['margen_error']; ?>">
          </div>
          <label for="costo0" class="control-label col-lg-2 col-md-2">Tiempo Coccion</label>
          <div class="col-lg-1 col-md-1 pd0">
            <input type="number" min='1' class="form-control" id="tiempo" name="tiempo" required maxlength="12" value="<?php echo $updateRec['duracion_prep']; ?>">
          </div>
        </div>
        <!-- 
          <div class="col-md-12">
          </div> 
          <div class="col-md-3">
            <?php
            if ($updateRec['foto'] == '') { ?>
              <img style="margin-top: 0px;width: 140px;float: right;" src="/img/noimage.png" class="img-thumbnail" alt="">
              <?php
            } else { ?>
              <img style="margin-top:0px" src="images/<?php echo $updateRec['foto']; ?>" class="img-thumbnail" alt="">
              <?php
            }
              ?>
          </div> -->
      </div>
      <div class="form-group pd10">
        <label for="preparacion" class="control-label col-lg-2  col-md-2">Preparacion</label>
        <div class="col-lg-10 col-md-10 pd0">
          <textarea id="preparacion" name="preparacion" id="" cols="30" rows="8">
            <?php echo $updateRec['preparacion']; ?>
          </textarea>
        </div>
      </div>
      <div class="form-group pd10">
        <label for="montaje" class="control-label col-lg-2  col-md-2">Montaje</label>
        <div class="col-lg-10 col-md-10 pd0">
          <textarea id="montaje" name="montaje" id="" cols="30" rows="5"><?php echo $updateRec['montaje']; ?></textarea>
        </div>
      </div>
    </div>
    <div class="tab-pane" id="foto">
      <div id="foto-container" class="bg-white rounded-xl shadow-lg p-6 w-full flex flex-col items-center justify-center">
        <!-- El elemento div con el id 'foto' es donde se mostrará la imagen. -->
        <div id="foto" class="centrar">
            <!-- La imagen se inyectará aquí a través de JavaScript -->
            <?php
            if ($updateRec['foto'] == '') { ?>
              <img style="margin-top: 0px;height:300px;" src="/img/noimage.png" class="img-thumbnail" alt="">
            <?php
            } else { ?>
              <img style="margin-top:0px;height:300px;" src="images/<?php echo $updateRec['foto']; ?>" class="img-thumbnail" alt="">
            <?php
            }
            ?>
        </div>
      </div>
      <div class="form-group">
      </div>
    </div>

  </div>
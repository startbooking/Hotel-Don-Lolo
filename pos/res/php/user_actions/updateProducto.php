<?php
include '../../../../res/php/titles.php';
include '../../../../res/php/app_topPos.php';

$id = $_POST['id'];
$idamb = $_POST['idamb'];
$updateProd = $pos->traeProducto($id);
$tipos = $pos->traeGrupos($idamb);
$imptos = $pos->getImpuestos();

?> 

<div class="form-group">
  <input type="hidden" name="idProd" id="idProd" value="<?php echo $updateProd[0]['producto_id']; ?>">
  <label for="producto" class="control-label col-lg-2 col-md-2">Producto</label>
  <div class="col-lg-6 col-md-6">
    <input type="text" class="form-control" id="producto" name="producto" value="<?php echo $updateProd[0]['nom']; ?>" required >
  </div>
  <label for="producto" class="control-label col-lg-1 col-md-1">Codigo</label>
  <div class="col-lg-3 col-md-3">
    <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $updateProd[0]['cod']; ?>" >
  </div>
</div>
<div class="form-group">
  <label for="seccion" class="control-label col-lg-2 col-md-2">Tipo de Plato</label>
  <div class="col-lg-4 col-md-4">
    <select name="seccion" id="seccion" required value="$updateProd[0]['seccion']">
      <option value="">Seleccione el Tipo de Plato</option>
      <?php
      foreach ($tipos as $tipo) { ?>
        <option value="<?php echo $tipo['id_seccion']; ?>" 
          <?php
          if ($tipo['id_seccion'] == $updateProd[0]['seccion']) { ?>
            selected
            <?php
          }
          ?>
          ><?php echo $tipo['nombre_seccion']; ?></option>
        <?php
      }
?>
    </select>
  </div>
  <label for="costo0" class="control-label col-lg-2  col-md-2">Precio Venta</label>
  <div class="col-lg-4 col-md-4">
    <input type="number" min='0' class="form-control" id="venta" name="venta" required maxlength="12" value="<?php echo $updateProd[0]['venta']; ?>"> 
  </div>
</div>
<div class="form-group">
  <label for="impto" class="control-label col-lg-2  col-md-2">Impuesto</label>
  <div class="col-lg-4 col-md-4">
    <select name="impto" id="impto" required value="$updateProd[0]['impto']">
      <option value="">Seleccione el Impuesto</option>
      <?php
    foreach ($imptos as $impto) { ?>
        <option value="<?php echo $impto['id_cargo']; ?>"
          <?php
    if ($impto['id_cargo'] == $updateProd[0]['impto']) { ?>
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
  <label for="tipo" class="control-label col-lg-2  col-md-2">Tipo</label>
  <div class="col-lg-4 col-md-4" style="font-size:12px">
    <label class="radio-inline">
      <input onclick="activaSelecRecetaUpd(0)" type="radio" name="tipo" id="tipo" value="0" 
      <?php
        if ($updateProd[0]['tipo_producto'] == 0) {?>
        checked
        <?php
        }
?>
      > Servicio
    </label>            
    <label class="radio-inline">
      <input onclick="activaSelecRecetaUpd(1)" type="radio" name="tipo" id="tipo" value="1"
      <?php
  if ($updateProd[0]['tipo_producto'] == 1) {
      ?>
          checked
          <?php
  }
?>
      > Producto
    </label>
    <label class="radio-inline">
      <input onclick="activaSelecRecetaUpd(2)" type="radio" name="tipo" id="tipo" value="2"
      <?php
  if ($updateProd[0]['tipo_producto'] == 2) {
      ?>
        checked
        <?php
  }
?>

      > Receta
    </label>
  </div>
</div>
 
<div class="form-group" id="recetaUpd" name="recetaUpd" 
<?php
if ($updateProd[0]['tipo_producto'] == 0) { ?>
  style="display:none;"
  <?php
}
?>
>
  <label id="labelRecetaUpd" class="control-label col-lg-2  col-md-2">
  <?php
      if ($updateProd[0]['tipo_producto'] == 1) { ?>
      Producto Inventarios
      <?php
      } elseif ($updateProd[0]['tipo_producto'] == 2) { ?>
      Receta Estandar
      <?php
      }

?>
  </label>
  <div class="col-lg-4 col-md-4">
    <select name="idrecetaUpd" id="idrecetaUpd">
      <?php
      if ($updateProd[0]['tipo_producto'] == 1) {
          $productos = $pos->getProductosInventario();
          foreach ($productos as $producto) { ?>
            <option 
              <?php
                if ($producto['id_producto'] == $updateProd[0]['id_receta']) { ?>
                  selected
                  <?php
                }
              ?>
            value="<?php echo $producto['id_producto']; ?>"><?php echo $producto['nombre_producto']; ?></option>
            <?php
          }
      } elseif ($updateProd[0]['tipo_producto'] == 2) {
          $recetas = $pos->traeRecetas();

          foreach ($recetas as $receta) { ?>
            <option 
              <?php
                if ($receta['id_receta'] == $updateProd[0]['id_receta']) { ?>
                  selected
                  <?php
                }
              ?>
            value="<?php echo $receta['id_receta']; ?>"><?php echo $receta['nombre_receta']; ?></option>
            <?php
          }
      }
?>
    </select>
  </div>
</div>

<?php 

  require '../../../res/php/app_topHotel.php'; 
  
  $idres    = $_POST['idres'];
  $idcia    = $_POST['idcia'];
  $id       = $_POST['id'];
  $cias     = $hotel->getCompanias();

?>

<div class="form-group">
  <input type="hidden" id="idReservaCia" name="idReservaCia" value="<?=$idres?>">
  <label for="direccion" class="col-sm-3 control-label">Empresa </label>
  <div class="col-sm-8">
    <select name="companiaSele" id="companiaSele">
      <option value="">Seleccione la Compañia</option>
      <?php foreach ($cias as $key => $value) { ?> 
        <option value="<?=$value['id_compania']?>"<?php if($value['id_compania']==$idcia){ ?> selected <?php } ?>><?php echo substr($value['empresa'],0,70)?></option>
      <?php }?>
    </select>
  </div>
</div>

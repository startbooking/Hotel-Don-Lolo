<?php
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  $idamb  = $_POST['id'];
  $nomamb = $_POST['amb'];  
  $user   = $_POST['user'];
  $impto  = $_POST['impto'];
  $prop   = $_POST['prop']; 

  $resol = $pos->getResolucionFacturacion($idamb);
  $rpre  = $resol[0]['prefijo'];
  $pref  = $pos->getPrefijoAmbiente($idamb);

?>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-lg-6 col-md-6">
      <h3 align="center" style="font-weight:700">Facturas del Dia</h3>
      <input type="hidden" name="facturaActiva" id="facturaActiva">
      <input type="hidden" name="prefijoFac" id="prefijoFac" value="<?=$rpre?>">
      <input type="hidden" name="prefijoAmb" id="prefijoAmb" value="<?=$pref?>">
      <input type="hidden" name="tipoCargo" id="tipoCargo" value="0">
    </div>
    <div class="col-lg-6 col-md-6">
        <h3 name="numeroFactura" id="numeroFactura" align="center" style="font-weight:700">Productos Factura </h3>
      <div class="col-lg-6 col-md-6 ">
      </div>
    </div>
  </div>
</div>
<div class="container-fluid" style="padding:0">
  <div class="col-lg-6 col-md-6 col-xs-12" id="ComandasList" style="padding-right: 0"></div>   
  <div class="col-lg-6 col-md-6 col-xs-12" id="ventasList" style="padding :0"></div>
</div>

<script>
  getVentasDia('<?=$idamb?>')
</script>



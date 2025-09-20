<?php 
  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topPos.php'; 
  $ambientes = $pos->getAmbientes(); 
  $regis = count($ambientes); 
  if($regis==0){
    echo 0;
  }else{
    ?>
      <div class="col-lg-8 col-lg-offset-2">        
        <h2 align="center" style="font-weight:700;margin-top:20px; font-size:2rem;">Punto de Venta no Seleccionado <br>
        <small><strong aling="center">Seleccione el Punto de Venta</strong></small></h2>
        <h4 align="center" style="padding:15px;margin:10px;font-size:3em;"></h4>
        <?php
          foreach ($ambientes as $ambiente ) { ?>
            <div class="col-lg-6 col-xs-6">
              <div class="small-box bg-orange">
                <div class="inner">
                  <button onclick="getSeleccionaAmbiente(this.name)" name="<?php echo $ambiente['id_ambiente'] ?>" style="background-color:transparent" class="btn btn-block" title="<?php echo $ambiente['nombre'] ?>">
                  <h3><?php echo substr($ambiente['nombre'],0,20) ?></h3>
                  </button>
                  <?php 
                    $comandas = $pos->getComandasAmbiente($ambiente['id_ambiente']);
                  ?>
                  <p style="margin-left:25px">Cuentas Activas <?php echo number_format($comandas,0,",",".") ?></p>
                </div>
                <div class="icon">
                  <i class="ion ion-fork"></i>
                  <i class="ion ion-knife"></i>
                </div>
              </div>
            </div>
            <?php
          }
        ?>
      </div>
    <?php 
  }    
 ?>
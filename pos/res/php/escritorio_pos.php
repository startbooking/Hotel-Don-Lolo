<?php
  $ambientes = $pos->getAmbientes();

  if (count($ambientes) == 1) {?>
    <script>
      getSeleccionaAmbiente(<?php echo $ambientes[0]['id_ambiente']; ?>)
    </script>
    <?php
  } else { ?>
      <div class="container-fluid">
        <h2 style="text-align:center" style="font-weight:700">Punto de Venta no Seleccionado</h2>
        <h4 "" style="padding:15px;margin:10px;font-size:2.5em;text-align:center">Seleccione el Punto de Venta</h4>
      </div>
      <div class="container-fluid moduloCentrar" style="margin-bottom: 50px;">
        <?php
          foreach ($ambientes as $ambiente) { ?>
            <div class="col-lg-4 col-xs-6">
              <div class="small-box bg-green-gradient">
                <div class="inner">
                  <button onclick="getSeleccionaAmbiente(this.name)" name="<?php echo $ambiente['id_ambiente']; ?>" style="background-color:transparent" class="btn btn-block" title="<?php echo $ambiente['nombre']; ?>">
                  <h3><?php echo substr($ambiente['nombre'], 0, 20); ?></h3>
                  </button>
                  <?php
                    $comandas = count($pos->getComandasActivas($ambiente['id_ambiente'], 'A'));
              ?>
                  <p style="margin-left:25px">Cuentas Activas <?php echo number_format($comandas, 0, ',', '.'); ?></p>
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

<?php

  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 
  
  $idamb  = $_POST['id'];
  $nomamb = $_POST['amb'];
  $user   = $_POST['user'];
  $iduser = $_POST['iduser'];
  $impto  = $_POST['impto'];
  $prop   = $_POST['prop'];

  define('FECHA_POS', $_POST['fecha']); 
  
  $_SESSION['NOMBRE_AMBIENTE'] = $nomamb;
  $_SESSION['AMBIENTE_ID']     = $idamb;
  $_SESSION['usuario']         = $user;
  $_SESSION['usuario_id']      = $iduser;

  $fecha     = FECHA_POS;
  $huespedes = $pos->getHuespedesenCasa();

?>

<section class="content">
  <div class="panel panel-success">
    <div class="panel-heading"> 
      <div class="row" style="display: flex">
        <div class="col-lg-6">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="clientes.php">
          <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-address-book-o"></i> Huespedes en Casa </h3>
        </div>
        <div class="col-lg-6">
          <span class="badge" style="background: lightseagreen;color:white">Titular Cuenta</span>
          <span class="badge" style="background: dimgrey;color:white">Acompañante</span>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="datos_ajax_delete"></div>
        <div class="container-fluid"> 
        <table id="example1" class="table table-bordered">
          <thead>
            <tr>
              <th>Nro Hab.</th>
              <th width="40%">Huesped</th>
              <th>LLegada</th>
              <th>Salida</th>
              <th>Hom.</th>
              <th>Muj.</th>
              <th>Nin</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach ($huespedes as $huesped) { ?>
              <tr>
                <td>
                    <?php echo $huesped["num_habitacion"];?>
                </td>
                <td>
                  <span class="badge" style="background: lightseagreen">
                    <?php echo $huesped["nombre_completo"];?>
                  </span>
                  <?php 
                    $acompanas = $pos->buscaAcompanantes($huesped["num_reserva"]);
                    if(count($acompanas)>0){
                      foreach ($acompanas as $key => $acompana) { ?>
                        <span class="badge" style="background: dimgrey">
                          <?php echo $acompana["nombre_completo"];?>
                        </span>
                        <?php 
                      }
                    }
                   ?>                                    
                </td>
                <td><?php echo $huesped["fecha_llegada"];?></td>
                <td><?php echo $huesped["fecha_salida"];?></td>
                <td align="right"><?php echo $huesped["can_hombres"];?></td>
                <td align="right"><?php echo $huesped["can_mujeres"];?></td>
                <td align="right"><?php echo $huesped["can_ninos"];?></td>
              </tr>
              <?php         
            }
            ?> 
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
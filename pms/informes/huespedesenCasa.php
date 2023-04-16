<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topHotel.php'; 
  if(!isset($_SESSION["usuario"])){ ?>
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="0;URL=../../index.php" />
    <?php 
  }
  $path      = $_SERVER['PHP_SELF'];

?>

<!DOCTYPE html>
<html>
  <head>
	<title><?= TITLE_PMS ?> | Huespedes en Casa</title>
    <?php include_once("../../res/shared/archivo_head.php") ; ?>
    <link rel="stylesheet" type="text/css" href="../css/stylepms.css">
  </head>
  <body class="skin-yellow sidebar-mini">
 	  <?php 
      include_once("../menus/menu_titulo.php");
      include_once("../menus/menu_hotel.php");
     ?>
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-9">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="balanceCajero.php">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Informe de Huespedes en Casa</h3>
              </div>
              <div class="col-lg-3" align="right">
                <a style="margin:20px 0" type="button" class="btn btn-success" href=""> <i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <?php 
              $reservas = $hotel->getHuespedesenCasa(2,'CA');
              $regis    = count($reservas);
              if($regis==0){ ?> 
                <h4 class="bg-red" style="padding:10px;font-size:30px">Sin HUespedes en Casa</h4>
                <?php 
              }else{
                ?>
                <table id="example1" class="table table-bordered">
                  <thead>
                    <tr class="warning">
                      <td>Hab.</td>
                      <td>Tipo Hab.</td>
                      <td>Huesped</td>
                      <td>Llegada</td>
                      <td>Salida</td>
                      <td>Noc</td>
                      <td>H</td>
                      <td>M</td>
                      <td>N</td>
                      <td>Tarifa</td>
                      <td>Reserva</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($reservas as $reserva) { ?>
                      <tr style='font-size:12px'>
                        <td width="22px"><?php echo $reserva['num_habitacion']; ?></td>
                        <td><?php echo $reserva['tipo_habitacion']; ?></td>
                        <td><?php echo $reserva['apellidos'].' '.$reserva['nombres']; ?></td>
                        <td align="right"><?php echo $reserva['fecha_llegada']; ?></td>
                        <td align="right"><?php echo $reserva['fecha_salida'];?></td>
                        <td align="right"><?php echo $reserva['dias_reservados'];?></td>
                        <td align="right"><?php echo $reserva['can_hombres']; ?></td>
                        <td align="left"><?php echo $reserva['can_mujeres']; ?></td>
                        <td align="left"><?php echo $reserva['can_ninos']; ?></td>
                        <td align="right"><?php echo number_format($reserva['valor_diario'],2); ?></td>
                        <td align="right"><?php echo number_format($reserva['num_reserva'],0); ?></td>
                      </tr>
                      <?php 
                    }
                    ?>
                  </tbody>
                </table>
                </div>
                  <?php 
                
              }
            ?>
          </div>
        </div>
      </section>
    </div>
    <?php 
      include("../../res/shared/archivo_pie.php") ;
      include("../../res/shared/archivo_script.php") ;
    ?>
    <script src="../js/ajax-pms.js"></script> 
  </body> 
</html>


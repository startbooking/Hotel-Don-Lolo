<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topHotel.php'; 
  $path = $_SERVER['PHP_SELF'];

  $reservas = $hotel->getReservasActuales(); 
?>

<!DOCTYPE html>
<html>
  <head>
	<title><?= TITLE_PMS ?> | Gestion de Reservas</title>
    <?php include_once("../../res/shared/archivo_head.php") ; ?>
    <link rel="stylesheet" type="text/css" href="../css/stylepms.css">
  </head>
  <body class="skin-yellow sidebar-mini">
 	  <?php 
      include_once("../menus/menu_titulo.php");
      include_once("../menus/menu_hotel.php");
     ?>
    <div class="content-wrapper" > 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <h3 class="w3ls_head" style="">Reservas Activas en el Sistema </h3>
              </div>
              <div class="col-lg-3 col-lg-offset-3 col-sm-3 col-xs-12">
                <button class="btn btn-success btn-block" onclick='imprimirReserva()'><span><i class="fa fa-print"></i> </span>Imprimir</button>
              </div>            
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <table id="example1" class="table table-bordered">
              <thead>
                <tr class="warning" style="font-weight: bold">
                  <td>Reserva Nro</td>
                  <td>Tipo Hab.</td>
                  <td>Nro Hab.</td>
                  <td>Apellidos</td>
                  <td>Nombres</td>
                  <td>Llegada</td>
                  <td>Salida</td>
                  <td>Noches</td>
                  <td>Hombres</td>
                  <td>Mujeres</td>
                  <td>Niños</td>
                  <td align="center">Estado</td>
                  <td align="center">Compañia</td>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($reservas as $reserva) { ?>
                  <tr style='font-size:12px'>
                    <td><?php echo $reserva['num_reserva']?></td>
                    <td><?php echo $reserva['tipo_habitacion']; ?></td>
                    <td><?php echo $reserva['num_habitacion']; ?></td>
                    <td><?php echo $reserva['apellidos']; ?></td>
                    <td><?php echo $reserva['nombres']; ?></td>
                    <td><?php echo $reserva['fecha_llegada']; ?></td>
                    <td><?php echo $reserva['fecha_salida']; ?></td>
                    <td align="center"><?php echo $reserva['dias_reservados']; ?></td>
                    <td align="center"><?php echo $reserva['can_hombres']; ?></td>
                    <td align="center"><?php echo $reserva['can_mujeres']; ?></td>
                    <td align="center"><?php echo $reserva['can_ninos']; ?></td>
                    <td><?php echo estadoReserva($reserva['estado']); ?></td>                       
                    <td><?php echo asignaCompania($reserva['id_compania']); ?></td>                       
                  </tr>
                  <?php 
                }
                ?>
              </tbody>
            </table>
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


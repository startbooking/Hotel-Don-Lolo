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
	<title><?= TITLE_PMS ?> | Pagos Recibidos del Dia Hotel</title>
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
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Pagos del Dia Por Cajero</h3>
              </div>
              <div class="col-lg-3" align="right">
                <a style="margin:20px 0" type="button" class="btn btn-success" href=""> <i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <?php 
              $usuarios = $hotel->getUsuarios(); 
              foreach ($usuarios as $usuario) { ?>
                <h3>Usuario <?=$usuario['apellidos'].' '.$usuario['nombres']?></h3>
                  <?php 
                $user = $usuario["usuario"];
                $cargos = $hotel->getCargosdelDiaporcajero(FECHA_PMS,$user,3,0); 
                $monto  = 0 ;
                $impto  = 0 ;
                $total  = 0 ;
                $regis  = count($cargos);
                if($regis==0){ ?> 
                  <div class="row">
                    <h4 align="center" class="bg-red" style="padding:10px;font-size:30px;width: 50%">Sin Pagos Recibidos por el Usuario</h4>
                  </div>
                  <?php 
                }else{
                  ?>
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr class="warning">
                        <td>Hab.</td>
                        <td>Huesped</td>
                        <td>Detalle</td>
                        <td>Monto</td>
                        <td>Abono</td>
                        <td>Deposito</td>
                        <td>Factura</td>
                        <td>Informacion</td>
                        <td>Reserva</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($cargos as $cargo) { ?>
                        <tr style='font-size:12px'>
                          <td width="22px"><?php echo $cargo['habitacion_cargo']; ?></td>
                          <td><?php echo substr($cargo['apellidos'].' '.$cargo['nombres'],0,24); ?></td>
                          <td><?php echo substr($cargo['descripcion_cargo'],0,19); ?></td>
                          <td align="right"><?php echo number_format($cargo['pagos_cargos'],2); ?></td>
                          <td align="right"><?php if($cargo['concecutivo_abono']==0){
                             echo '';
                          }else{
                            echo $cargo['concecutivo_abono']; 
                          }
                          ?></td>
                          <td align="right"><?php if($cargo['concecutivo_deposito']==0){
                            echo '';
                          }else{
                            echo $cargo['concecutivo_deposito']; 
                          }
                          ?></td>
                          <td align="right"><?php echo $cargo['factura_numero']; ?></td>
                          <td align="left"><?php echo $cargo['informacion_cargo']; ?></td>
                          <td align="left"><?php 
                            if($cargo['id_reserva']==0){
                              echo '';
                            }else{                          
                              echo $cargo['id_reserva']; 
                            }
                          ?></td>
                        </tr>
                        <?php 
                      }
                      ?>
                    </tbody>
                  </table>
                    </div>
                    <?php 
                  
                }
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


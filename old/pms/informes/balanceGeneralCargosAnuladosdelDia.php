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
	<title><?= TITLE_PMS ?> | Cargos Anulados del Dia Hotel</title>
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
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Cargos del Dia Por Cajero</h3>
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
                    $user   = $usuario['usuario'];
                    $cargos = $hotel->getCargosAnuladosdelDiaporcajero(FECHA_PMS,$user,1,0); 
                    $monto  = 0 ;
                    $impto  = 0 ;
                    $total  = 0 ;
                    $regis2 = count($cargos);
                  if($regis2==0){ ?> 
                    <div class="row">
                      <h4 align="center" class="bg-red" style="padding:10px;font-size:30px;width: 50%">Usuario Sin Cargos Anulados Para Este Dia</h4>
                    </div>
                    <?php 
                  }else{ ?>   
                    <div class="table-responsive">
                      <h4>CARGOS DEL DIA</h4>  
                      <table id="example1" class="table table-bordered">
                        <thead>
                          <tr class="warning">
                            <td>Hab.</td>
                            <td>Huesped</td>
                            <td>Detalle</td>
                            <td>Cant.</td>
                            <td>Monto</td>
                            <td>Impuesto</td>
                            <td>Total</td>
                            <td>Referencia</td>
                            <td>Informacion Cargo</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($cargos as $cargo) { ?>
                            <tr style='font-size:12px'>
                              <td width="22px"><?php echo $cargo['habitacion_cargo']; ?></td>
                              <td><?php echo substr($cargo['apellidos'].' '.$cargo['nombres'],0,24); ?></td>
                              <td><?php echo $cargo['descripcion_cargo']; ?></td>
                              <td align="center"><?php echo $cargo['cantidad_cargo']; ?></td>
                              <td align="right"><?php echo number_format($cargo['monto_cargo'],2); ?></td>
                              <td align="right"><?php echo number_format($cargo['impuesto'],2); ?></td>
                              <td align="right"><?php echo number_format($cargo['monto_cargo']+$cargo['impuesto'],2); ?></td>
                              <td><?php echo substr($cargo['referencia_cargo'],0,19); ?></td>
                              <td><?php echo substr($cargo['informacion_cargo'],0,19); ?></td>
                            </tr>
                            <?php 
                            $monto  = $monto + $cargo['monto_cargo'];
                            $impto  = $impto + $cargo['impuesto'];
                            $total  = $total + $cargo['monto_cargo'] + $cargo['impuesto'];        
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <?php 
                  }
                  ?>
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


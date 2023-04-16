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
	<title><?= TITLE_PMS ?> | Estado de Cuenta Huespedes</title>
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
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Estado de Cuenta Huespedes</h3>
              </div>
              <div class="col-lg-3" align="right">
                <a style="margin:20px 0" type="button" class="btn btn-success" href=""> <i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <?php 
              $encasas = $hotel->getHuespedesenCasa(2,'CA');
              $regis   = count($encasas);
              if($regis==0){ ?> 
                <div class="container">
                  <h4 class="bg-red" style="padding:10px;font-size:30px">Sin Huespedes Alojados en el Dia</h4>
                </div>

                <?php 
              }else{
                foreach ($encasas as $encasa) {?>
                  <div class="row" style="margin:20px 0px 0px 0px ">
                    <div class="form-horizontal" style="margin: 0px 0 20px 0;padding:15px;background-color:#dff0d8;border-radius: 3px;">
                      <div class="form-group" style="margin-left:0">
                        <label for="" class="control-label col-sm-1">Huesped</label>
                        <div class="col-sm-3">
                          <input class="form-control" type="text" value="<?=$encasa['apellidos'].' '.$encasa['nombres']?>" readonly>
                        </div>
                        <label for="" class="control-label col-sm-1">Hab.</label>
                        <div class="col-sm-1">
                          <input class="form-control" type="text" value="<?=$encasa['num_habitacion']?>" readonly>
                        </div>
                        <label for="" class="control-label col-sm-1">Tipo Hab.</label>
                        <div class="col-sm-1">
                          <input class="form-control" type="text" value="<?=$encasa['tipo_habitacion']?>" readonly>
                        </div>
                        <label for="" class="control-label col-sm-1">Adultos</label>
                        <div class="col-sm-1">
                          <input class="form-control" type="text" value="<?=$encasa['can_hombres']+$encasa['can_mujeres']?>" readonly>
                        </div>
                        <label for="" class="control-label col-sm-1">Niños</label>
                        <div class="col-sm-1">
                          <input class="form-control" type="text" value="<?=$encasa['can_ninos']+$encasa['can_mujeres']?>" readonly>
                        </div>
                      </div>
                      <div class="form-group" style="margin-left:0">
                        <label for="" class="control-label col-sm-1">Fecha Llegada</label>
                        <div class="col-sm-2">
                          <input class="form-control" type="text" value="<?=$encasa['fecha_llegada'];?>" readonly>
                        </div>
                        <label for="" class="control-label col-sm-1">Fecha Salida</label>
                        <div class="col-sm-2">
                          <input class="form-control" type="text" value="<?=$encasa['fecha_salida'];?>" readonly>
                        </div>
                        <label for="" class="control-label col-sm-1">Noches</label>
                        <div class="col-sm-1">
                          <input class="form-control" type="text" value="<?=$encasa['dias_reservados'];?>" readonly>
                        </div>
                        <label for="" class="control-label col-sm-1">Tarifa</label>
                        <div class="col-sm-2">
                          <input class="form-control" type="text" value="<?=number_format($encasa['valor_diario'],2)?>" readonly>
                        </div>
                      </div>                    
                    </div>
                    <?php 
                      $cargos = $hotel->getCargosporReserva($encasa['num_reserva']); 
                      $monto = 0 ;
                      $impto = 0 ;
                      $total = 0 ;
                      $pagos = 0 ;
                      $regis = count($cargos);
                      if($regis==0){ ?> 
                        <div align="center" class="row" style="width: 80%;margin-bottom: 25px;margin-left: 10%">
                          <h4 class="bg-red" style="padding:10px;font-size:30px">Sin Consumos Registrados a este Huesped</h4>
                        </div>
                        <?php 
                      }else{
                        ?>
                        <div class="row" style="width: 90%;margin-left: 5%;margin-top:-20px;">
                          <table id="example1" class="table table-bordered">
                            <thead>
                              <tr class="warning">
                                <td>Cant</td>
                                <td>Detalle</td>
                                <td>Monto</td>
                                <td>Impuesto</td>
                                <td>Total Cargo</td>
                                <td>Pagos </td>
                                <td>Fecha Cargo</td>
                                <td>Usuario</td>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              foreach ($cargos as $cargo) { ?>
                                <tr style='font-size:12px'>
                                  <td><?php echo $cargo['cantidad_cargo']; ?></td>
                                  <td><?php echo $cargo['descripcion_cargo']; ?></td>
                                  <td align="right"><?php echo number_format($cargo['monto_cargo'],2); ?></td>
                                  <td align="right"><?php echo number_format($cargo['impuesto'],2); ?></td>
                                  <td align="right"><?php echo number_format($cargo['monto_cargo']+$cargo['impuesto'],2); ?></td>
                                  <td align="right"><?php echo number_format($cargo['pagos_cargos'],2); ?></td>
                                  <td align="right"><?php echo $cargo['fecha_sistema_cargo']; ?></td>
                                  <td align="right"><?php echo $cargo['usuario']; ?></td>
                                </tr>
                                <?php 
                                  $monto = $monto + $cargo['monto_cargo'];
                                  $impto = $impto + $cargo['impuesto'];
                                  $total = $total + $cargo['monto_cargo'] + $cargo['impuesto']; 
                                  $pagos = $pagos + $cargo['pagos_cargos']; 
                              }
                              ?>
                            </tbody>
                          </table>                        
                          <div class="form-horizontal" style="margin: -20px 0 20px 0;padding:15px;background-color:#dff0d8;border-radius: 3px;">
                            <div class="form-group">
                              <label for="consumo" class="col-sm-1 control-label">Consumos</label>
                              <div class="col-sm-2">
                                <input type="text" style="text-align: right;" class="form-control" id="consumo" value="<?php echo number_format($monto,2) ?>" readonly>
                              </div>
                              <label for="impto" class="col-sm-1 control-label">Impuesto</label>
                              <div class="col-sm-2">
                                <input type="text" style="text-align: right;" class="form-control" id="impto" placeholder="" value="<?php echo number_format($impto,2)  ?>" readonly>
                              </div>
                              <label for="abono" class="col-sm-1 control-label">Abonos</label>
                              <div class="col-sm-2">
                                <input type="text" style="text-align: right;" class="form-control" id="abono" placeholder="" value="<?php echo number_format($pagos,2) ?>" readonly>
                              </div>
                              <label for="total" class="col-sm-1 control-label">Saldo</label>
                              <div class="col-sm-2">
                                <input type="text" style="text-align: right;" class="form-control" id="total" placeholder="" value="<?php echo number_format($monto+$impto-$pagos,2)?>" readonly>
                              </div>
                            </div>
                            <!-- 
                            <div class="form-group">
                              <label for="" class="control-label col-sm-1">Huesped</label>
                              <div class="col-sm-4">
                                <input class="form-control" type="text" value="<?=$encasa['apellidos'].' '.$encasa['nombres']?>" readonly>
                              </div>
                              <label for="" class="control-label col-sm-1">Hab.</label>
                              <div class="col-sm-1">
                                <input class="form-control" type="text" value="<?=$encasa['num_habitacion']?>" readonly>
                              </div>
                              <div class="col-sm-1">
                                <input class="form-control" type="text" value="<?=$encasa['tipo_habitacion']?>" readonly>
                              </div>
                              <label for="" class="control-label col-sm-1">Tarifa</label>
                              <div class="col-sm-2">
                                <input class="form-control" type="text" value="<?=number_format($encasa['valor_diario'],2)?>" readonly>
                              </div>
                            </div>                    
                            -->
                          </div>
                        </div>
                        <?php                  
                      }
                    ?>                    
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


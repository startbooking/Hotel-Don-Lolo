<?php
  require '../../res/php/app_topPos.php'; 

  $idamb    = $_POST['idamb'];
  $prefijo  = $_POST['prefijo'];
  $tipoUsr  = $_POST['tipousr'];
  $nomamb   = $_POST['nomamb'];
  $user     = $_POST['user'];
  $perfReso = '';

  $comandas = $pos->getVentasdelDia($idamb);

?>

<div class="row-fluid">
  <div class="content-fluid" style="margin-bottom: 50px">
    <div class="panel panel-success">
      <div class="panel-heading">
        <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
        <input type="hidden" name="ubicacion" id="ubicacion" value="facturasDelDia">
        <input type="hidden" name="pasos" id="pasos">
        <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Facturas del Dia</h3>
      </div> 
      <div class="datos_ajax_delete"></div>
      <form id="formCierreDiario" class="form-horizontal" action="javascript:buscaFacturas()" method="POST" enctype="multipart/form-data">
        <div class="panel-body">
          <div class="row">
            <?php 
              $regis = count($comandas);
              if($regis==0){ ?>
                <div class="container-fluid">
                  <h4 class="bg-red-gradient" style="padding:10px;text-align: center;font-weight: 600;width: 30%">Sin Facturas Generadas En el Dia <span style="font-size:16px;font-weight: 600;font-family: 'ubuntu'"></span></h4>         
                </div>
                <?php 
              }else{ ?> 
                <div class="col-lg-6" id="muestraResultado" style="font-size:12px">
                  <div class="table-responsive"> 
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <tr class="warning">
                          <td>Factura</td>
                          <td>Fecha Factura - Hora</td>
                          <td>Nro Mesa</td>
                          <td>Valor</td>
                          <td>Estado</td>
                          <td>Accion</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($comandas as $factura) { ?>
                          <tr style='font-size:12px'>
                            <td style="padding:3px 5px"><?php echo $factura['factura']; ?></td>
                            <td style="padding:3px 5px"><?php echo $factura['fecha_factura']; ?></td>
                            <td style="padding:3px 5px"><?php echo $factura['mesa']; ?></td>
                            <td align="right" style="padding:3px 5px"><?php echo number_format($factura['valor_total'],2); ?></td>
                            <td align="right" style="padding:3px 5px;"><?php echo estadoFacturaAlert($factura['estado']); ?></td>
                            <td align="left" style="padding:3px 5px;width: 25%">
                              <button class="btn btn-info btn-xs" onclick="verfactura('Factura_<?=$prefijo?>-<?=$factura['factura']?>')" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" title="Ver Factura"></i></button>
                              <?php 
                              if($factura['estado']=='A' && $tipoUsr =='A'){?>
                                <button 
                                  data-factura ="<?= $factura['factura']?>" 
                                  type         ="button" 
                                  class        ="btn btn-danger btn-xs" 
                                  title        ="Anula Ingreso Actual Factura"
                                  onclick      ="botonAnulaFactura(<?=$factura['factura']?>,<?=$idamb?>)"
                                  >
                                  <i class="fa fa-window-close"></i>
                                </button>
                                <?php 
                              }
                              if($factura['num_movimiento_inv']!=0){  ?>
                                <button class="btn btn-success btn-xs" onclick="verSalidaInventarios('Salida_<?=$factura['num_movimiento_inv']?>.pdf')" type="button"><i class="fa fa-inbox" aria-hidden="true" title="Ver Salida de Inventarios"></i></button>
                              <?php 
                              }
                              ?>
                              <button class="btn btn-warning btn-xs" onclick="verComanda('comandaCocina_<?=$prefijo?>_<?=$factura['comanda']?>.pdf')" type="button"><i class="fa fa-building-o" aria-hidden="true" title="Ver Comanda Cocina"></i></button>
                            </td>
                          </tr>
                          <?php 
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <?php 
              }
            ?>                    
            <div class="col-lg-6" id="verCargosFactura"></div>
            <div class="col-lg-6" id="Factura">
              <object id="verFactura" width="100%" height="500" data=""></object> 
            </div>
          </div>               
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-lg-4 col-lg-offset-4" >
              <div class="col-xs-12" style="padding:0">
                <a type="button" class="btn btn-warning btn-block" onclick="getSeleccionaAmbiente(<?=$idamb?>)"><i class="fa fa-reply"></i> Regresar</a>
              </div>
            </div>
          </div>
        </div>  
      </form> 
    </div>
  </div>
</div>

<div class="modal fade" id="myModalAnulafactura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content modal-md">
      <div class="modal-header">
        <button type="button" class="close glyphicon glyphicon-off" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
        <h3 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> Anular Factura Actual</h3>
        <h4><?=$nomamb?></h4>  
      </div>
      <form class="form-horizontal" method="POST" id="formdescuento" name="descuento" action="javascript:anulaFactura()">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-lg-4 col-md-4 control-label" style="padding-top:0">Motivo Anulacion</label>
            <div class="col-lg-8 col-md-8"> 
              <input type="text" class="form-control" name="motivoAnula" id="motivoAnula" required="">
            </div>           
          </div>
          <div id="resultado"></div>              
        </div>
        <div class="modal-footer">
          <input id = 'comanda'  type="hidden" value='0'>
          <input id = 'facturaActiva'  type="hidden" value='0'>
          <input id = 'ambiente' type="hidden" value='<?=$idamb?>'>
          <input id = 'usuario'  type="hidden" value='<?=$user?>'>
          <div class="btn-group">
            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-reply"></i> Cancelar</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Procesar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


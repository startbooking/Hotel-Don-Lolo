<?php

$eToken = $hotel->datosTokenCia();
$facturador = $eToken[0]['facturador'];

?>

<div class="content-wrapper">
  <section class="content" style="height: 780px;">
    <div class="content" style="margin-bottom: 50px">
      <div class="panel panel-success">
        <div class="panel-heading">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="facturasDelDia">
          <input type="hidden" name="pasos" id="pasos">
          <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black"></i> Facturas del Dia</h3>
        </div>
        <div class="datos_ajax_delete"></div>
        <form id="formCierreDiario" class="form-horizontal" action="javascript:buscaFacturas()" method="POST" enctype="multipart/form-data">
          <div class="panel-body">
            <div class="row">
              <?php
              $regis = count($facturas);
              if ($regis == 0) { ?>
                <h4 class="bg-red-gradient" style="padding:10px;text-align: center;font-weight: 600;">Sin Facturas Generadas En el Dia <span style="font-size:16px;font-weight: 600;font-family: 'ubuntu'"></span></h4>
              <?php
              } else { ?>
                <div class="col-lg-12" id="muestraResultado" style="font-size:12px">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered">
                      <thead>
                        <tr class="warning centro">
                          <td>Factura</td>
                          <td>Facturado a</td>
                          <td>Huesped</td>
                          <td>Fecha Llegada</td>
                          <td>Fecha Factura</td>
                          <td>Estado</td>
                          <?php
                            if($facturador==1){ ?>
                              <td>Estado DIAN</td>
                              <?php
                            }
                          ?>
                          <td>Accion</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        foreach ($facturas as $factura) {
                          if ($factura['tipo_factura'] == 1) {
                            $nombrecia = 'SIN COMPAÑIA ASOCIADA';
                            $nitcia = '';
                          } else {
                            $cias = $hotel->getBuscaCia($factura['id_perfil_factura']);
                            $nombrecia = $cias[0]['empresa'];
                            $nitcia = $cias[0]['nit'] . '-' . $cias[0]['dv'];
                          }
                          $numFactura = $factura['prefijo_factura'] . $factura['factura_numero']; ?>
                          <tr style='font-size:12px'>
                            <td style="padding:3px 5px"><?php echo $factura['factura_numero']; ?></td>
                            <td style="padding:3px 5px"><?php 
                              if($factura['tipo_factura'] == 1){
                                echo $factura['nombre_completo'];
                              }else{
                                echo $nombrecia; 
                              }                                                      
                            ?></td>
                            <td style="padding:3px 5px"><?php echo $factura['nombre_completo']; ?></td>
                            <td style="padding:3px 5px"><?php echo $factura['fecha_llegada']; ?></td>
                            <td style="padding:3px 5px"><?php echo $factura['fecha_factura']; ?></td>
                            <td style="padding:3px 5px"><?php echo estadoFactura($factura['factura_anulada']); ?></td>
                            <?php 
                                if($facturador==1){ ?>
                                  <td style="padding:3px 5px"> 
                                  <?php
                                    echo estadoFacturaDIAN($factura['estadoEnvio']); 
                                  ?>
                                </td>
                                <?php
                                }
                            ?>
                            <td style="padding:3px 5px;width: 10%;text-align:center;">
                              <button 
                                class="btn btn-info btn-xs" 
                                type="button" 
                                data-toggle="modal" 
                                data-tipo="0"
                                data-facturador="<?php echo $facturador; ?>" 
                                data-apellidos="<?php echo $factura['apellido1'] . ' ' . $factura['apellido2']; ?>" 
                                data-nombres="<?php echo $factura['nombre1'] . ' ' . $factura['nombre2']; ?>" 
                                data-fechafac="<?php echo $factura['fecha_factura']; ?>" 
                                data-numero="<?php echo $factura['factura_numero']; ?>" 
                                data-reserva="<?php echo $factura['num_reserva']; ?>" 
                                href="#myModalVerFactura" title="Ver Factura">
                                <i class="fa fa-file-pdf" aria-hidden="true"></i>
                              </button>
                              <?php
                              if ($factura['factura_anulada'] == 0) { ?>
                                <a class="btn btn-danger btn-xs" data-toggle="modal" 
                                data-facturador="<?php echo $facturador; ?>" data-apellidos="<?php echo $factura['apellido1'] . ' ' . $factura['apellido2']; ?>" data-nombres="<?php echo $factura['nombre1'] . ' ' . $factura['nombre2']; ?>" data-llegada="<?php echo $factura['fecha_llegada']; ?>" data-salida="<?php echo $factura['fecha_salida']; ?>" data-fechafac="<?php echo $factura['fecha_factura']; ?>" data-numero="<?php echo $factura['factura_numero']; ?>" data-reserva="<?php echo $factura['num_reserva']; ?>" data-perfil="<?php echo $factura['perfil_factura']; ?>" data-idperfil="<?php echo $factura['id_perfil_factura']; ?>" data-prefijo="<?php echo $factura['prefijo_factura']; ?>" href="#myModalAnulaFactura" type="button" title="Anular Factura">
                                  <i class="fa fa-window-close" aria-hidden="true"></i></a>
                                <?php
                                  if($facturador == 1){
                                      ?>
                                    <button class="btn btn-default btn-xs" onclick="donwloadFile('<?php echo $factura['factura_numero']; ?>.xml','<?php echo NIT; ?>','xml','false');" type="button" title="Descarga ZIP Attached">
                                      <i class="fa-solid fa-download"></i>
                                    </button>
                                    <?php
                                  }
                              }else{ ?>
                                <button 
                                  class="btn btn-success btn-xs" 
                                  type="button" 
                                  data-toggle="modal"
                                  data-tipo="1"
                                  data-facturador="<?php echo $facturador; ?>" 
                                  data-apellidos="<?php echo $factura['apellido1'] . ' ' . $factura['apellido2']; ?>" 
                                  data-nombres="<?php echo $factura['nombre1'] . ' ' . $factura['nombre2']; ?>" 
                                  data-fechafac="<?php echo $factura['fecha_factura']; ?>" 
                                  data-numero="<?php echo $factura['numero_factura_cargo']; ?>" data-reserva="<?php echo $factura['num_reserva']; ?>" href="#myModalVerFactura" title="Ver Nota Credito">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                              </button>
                              <?php
                              }
                              
                              ?>
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
            </div>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <div class="col-xs-12" style="padding:0">
                  <a type="button" class="btn btn-warning btn-block" href="home"><i class="fa fa-reply"></i> Regresar</a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
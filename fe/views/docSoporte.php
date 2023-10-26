<?php 
  $fecha  = date('Y-m-d');
  $dia = strtotime('-1 day', strtotime($fecha));
  $ayer = date('Y-m-d', $dia);
  $inicial = date('Y-m-01', $dia);
?>
<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success" id="paginaDS">
      <div class="panel-heading"> 
        <div class="row">
          <div class="col-lg-6 col-xs-12">
            <input type="hidden" name="prefijo" id="prefijo" value="<?php echo $prefDS; ?>">                  
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_FE; ?>">                  
            <input type="hidden" name="ubicacion" id="ubicacion" value="docSoporte">
            <h3 class="w3ls_head tituloPagina">
            <i class="fa-solid fa-square-poll-vertical"></i>
            Documento Soporte</h3>
          </div>
          <div class="col-lg-6 col-xs-12">
            <a
              type="button" class="btn btn-success pull-right" 
              href="nuevoDocumento"
            >
            <i class="fa-regular fa-square-plus"></i> Nuevo Documento </a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="container-fluid">
          <div class="datos_ajax_delete"></div>
          <div class="row">              
            <div class="table-responsive"> 
              <form class="row-fluid" role="form" id="datosDS" method="post">
                <table id="example1" class="table table-bordered table-condensed" style="width:100%;">
                  <thead>
                    <tr class="warning">
                      <td>ID</td>
                      <td>Documento</td>
                      <td>Proveedor</td>
                      <td>Nit</td>
                      <td>Fecha</td>
                      <td>Vencimiento</td>
                      <td>Total</td>
                      <td>Forma de Pago</td>
                      <td>Operacion</td>
                      <td>Estado</td>
                      <td>Estado DIAN</td>
                      <td style="width:145px;">Accion</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($documentos as $documento) { ?>
                        <tr style='font-size:12px'>
                          <td><?php echo $documento['idDocumento']; ?></td>
                          <td class="derecha"><?php echo $documento['documentoSoporte']; ?></td>
                          <td><?php echo $documento['empresa']; ?></td>
                          <td><?php echo $documento['nit'].'-'.$documento['dv']; ?></td>
                          <td><?php echo $documento['fechaDocumento']; ?></td>
                          <td><?php echo $documento['fechaVencimiento']; ?></td>
                          <td class="derecha"><?php echo number_format($documento['total'],2); ?></td>
                          <td><?php echo $documento['descripcion_cargo']; ?></td>
                          <td><?php echo operacionDocumento($documento['tipoOperacion']); ?></td>
                          <td class="centro"><?php echo estadoDocumento($documento['estado']); ?></td>
                          <td class="centro"><?php echo estadoDocumentoDIAN($documento['estadoDian']); ?></td>
                          <td style="text-align:center;">                            
                            <button 
                              type="submit" 
                              class="btn btn-info btn-xs imprimeDS" 
                              data-id="<?php echo $documento['idDocumento']; ?>"
                              data-estado="<?php echo $documento['estado']; ?>"
                              data-dian="<?php echo $documento['estadoDian']; ?>"
                              data-documento="<?php echo $documento['documentoSoporte']; ?>"
                              data-proveedor="<?php echo $documento['idProveedor']; ?>"
                              title="Imprime Documento">
                                <i class="fa-solid fa-print"></i>
                            </button>
                            <?php
                            if($documento['estado']==1){
                              ?>
                              <button 
                                type="submit" class="btn btn-success btn-xs imprimeNC" 
                                data-id="<?php echo $documento['idDocumento']; ?>"  
                                data-estado="<?php echo $documento['estado']; ?>"
                                data-documento="<?php echo $documento['documentoSoporte']; ?>"
                                data-dian="<?php echo $documento['estadoDian']; ?>"
                                data-proveedor="<?php echo $documento['idProveedor']; ?>"
                                title="Imprimir Nota Credito">
                                <i class="fa-solid fa-print"></i>
                              </button>
                              <?php
                            }else{ ?>
                              <button 
                                type="button" 
                                class="btn btn-danger btn-xs anulaDS" 
                                data-id="<?php echo $documento['idDocumento']; ?>"  
                                data-estado="<?php echo $documento['estado']; ?>"
                                data-dian="<?php echo $documento['estadoDian']; ?>"
                                data-documento="<?php echo $documento['documentoSoporte']; ?>"
                                data-proveedor="<?php echo $documento['idProveedor']; ?>"
                                data-fecha="<?php echo $documento['fechaDocumento']; ?>"
                                data-toggle="modal" 
                                data-target="#myModalAnulaDS"
                                title="Anula Documento Soporte">
                                  <i class="fa-solid fa-ban"></i>
                              </button>
                              <?php
                            }
                            if($documento['estadoDian']==0 && $documento['estado']==0){
                              ?>
                              <button 
                                type="submit" class="btn btn-warning btn-xs enviaDS" 
                                data-id="<?php echo $documento['idDocumento']; ?>"  
                                data-estado="<?php echo $documento['estado']; ?>"
                                data-documento="<?php echo $documento['documentoSoporte']; ?>"
                                data-dian="<?php echo $documento['estadoDian']; ?>"
                                data-proveedor="<?php echo $documento['idProveedor']; ?>"
                                title="Envia Documento Soporte">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                              </button>
                              <?php
                            }                           
                            ?>
                            <div class="btn-group">
                            </div>
                          </td>
                        </tr>
                        <?php
                      }
                    ?>
                  </tbody> 
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>      
  </div>
</div>

<?php 
  include_once 'views/modal/modalDocSoporte.php';  
  include_once 'views/modal/modalImpresiones.php';  
?> 
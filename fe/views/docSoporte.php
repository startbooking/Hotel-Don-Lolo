<?php 
  $fecha  = date('Y-m-d');
  $dia = strtotime('-1 day', strtotime($fecha));
  $ayer = date('Y-m-d', $dia);
  $inicial = date('Y-m-01', $dia);
?>
    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-6 col-xs-12">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_FE; ?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="docSoporte">
                <h3 class="w3ls_head tituloPagina">
                <span class="material-symbols-outlined">group</span> Documento Soporte</h3>
              </div>
              <div class="col-lg-6 col-xs-12">
                <a
                  style="display:inline-flex;" type="button" class="btn btn-success pull-right" href="nuevoDocumento"
                >
                <span class="material-symbols-outlined">add_box</span> Nuevo Documento Soporte </a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="container-fluid">
              <div class="datos_ajax_delete"></div>
              <div class="row">              
                <div class="table-responsive"> 
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
                      // echo print_r($documentos);
                      foreach ($documentos as $documento) { ?>
                        <tr style='font-size:12px'>
                          <td><?php echo $documento['idDocumento']; ?></td>
                          <td><?php echo $documento['documentoSoporte']; ?></td>
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
                            <button type="button" class="btn btn-info btn-xs" 
                              data-id="<?php echo $compania['idDocumento']; ?>"  
                              title="Imprime Documento">
                              <span class="material-symbols-outlined">print</span>
                            </button>
                            <?php
                            if($documento['estado']==1){
                              ?>
                              <button type="button" class="btn btn-success btn-xs" 
                                data-id="<?php echo $compania['idDocumento']; ?>"  
                                title="Imprimir Nota Credito">
                                <span class="material-symbols-outlined">print_lock</span>
                              </button>
                              <?php
                            }else{ ?>
                              <button type="button" class="btn btn-danger btn-xs" 
                                data-id="<?php echo $compania['idDocumento']; ?>"  
                                title="Anula Documento Soporte">
                                <span class="material-symbols-outlined">block</span>
                              </button>
                              <?php
                            }
                            if($documento['estadoDian']==0 && $documento['estado']==0){
                              ?>
                              <button type="button" class="btn btn-warning btn-xs" 
                                data-id="<?php echo $compania['idDocumento']; ?>"  
                                title="Envia Documento Soporte">
                                <span class="material-symbols-outlined" style="color:darkred;">cloud_upload</span>
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
                </div>
              </div>
            </div>
          </div>
        </div>      
      </div>
    </div>

<?php 
  include_once 'views/modal/modalDocSoporte.php';  
?> 

<!-- <script src="<?php echo BASE_FE; ?>res/js/docsoporte.js"></script> -->

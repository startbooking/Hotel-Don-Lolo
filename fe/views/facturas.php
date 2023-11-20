<?php 
  $fecha  = date('Y-m-d');
  $dia = strtotime('-1 day', strtotime($fecha));
  $ayer = date('Y-m-d', $dia);
  $inicial = date('Y-m-01', $dia);
  
  $eResolucion = $user->getResolucion(1);
  
  $eToken     = $user->datosTokenFE();  
  $prefDS     = $eToken[0]['prefijoDS']; 
  

 
?>
    <div class="content-wrapper"> 
      <div class="container-fluid">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-6 col-xs-12">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_FE; ?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="docSoporte">
                <h3 class="w3ls_head tituloPagina">
                <i class="fa-solid fa-laptop-file"></i> 
                Facturas</h3>
              </div>
              <div class="col-lg-6 col-xs-12">
              <?php 
                if(count($eResolucion)==0 || count($eToken) == 0){ ?>
                  <div class="alert alert-warning pd0">
                  <h3 class="centro"><i class="fa-solid fa-circle-exclamation fa-2x" style="color:red"></i> Precaucion</h3>
                  <h3 class="centro"> Sin Resolucion de Facturacion</h3>
                  </div>
                  <?php
                }else{ ?>                            
                  <a
                    type="button" 
                    class="btn btn-success pull-right" 
                    href="nuevaFactura"
                  >
                  <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                  Nueva Factura </a>
                  <?php 
                };
                ?> 
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
                        <td>Numero</td>
                        <td>Titular</td>
                        <td>Fecha</td>
                        <!-- <td>Vencimiento</td> -->
                        <td>Total</td>
                        <!-- <td>Pagado</td> -->
                        <td>Estado DIAN</td>
                        <td>Accion</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      /* foreach ($proveedores as $compania) { ?>
                        <tr style='font-size:12px'>
                          <td><?php echo $compania['nit'].'-'.$compania['dv']; ?></td>
                          <td><?php echo $compania['empresa']; ?></td>
                          <td><?php echo $compania['direccion']; ?></td>
                          <td><?php echo $compania['celular']; ?></td>
                          <td><?php echo $compania['email']; ?></td>
                          <td><?php echo estadoCompania($compania['activo']); ?></td>
                          <td><?php echo tipoCompania($compania['tipo_compania']); ?></td>
                          <td style="text-align:center;">
                            <button type="button" class="btn btn-info btn-xs" 
                              onclick="botonModificaProveedor('<?php echo $compania['id_compania']; ?>','<?php echo $compania['empresa']; ?>')"
                              idprov = "<?php echo $compania['id_compania']; ?>"
                              nombre = "<?php echo $compania['empresa']; ?>"
                              data-id="<?php echo $compania['id_compania']; ?>"  
                              data-nombre="<?php echo $compania['empresa']; ?>"  
                              title="Modifica Datos del Proveedor">
                              <span class="material-symbols-outlined">edit</span>
                              <!-- <i class='glyphicon glyphicon-edit'></i> -->
                            </button>
                            <div class="btn-group">
                            </div>
                          </td>
                        </tr>
                        <?php
                      } */
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
  include_once 'views/modal/modalFacturas.php';  
?> 

<!-- <script src="<?php echo BASE_FE; ?>res/js/docsoporte.js"></script> -->


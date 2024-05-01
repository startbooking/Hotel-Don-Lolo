<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';
$fact    =  $_POST['fechafac'];

$facturas = $hotel->getBuscaFacturasFecha($fact, 'historico_reservas_pms', 'historico_cargos_pms');

// echo print_r($facturas);

$regis = count($facturas);

if ($regis == 0) { ?>
  <h4 class="bg-red-gradient" style="padding:10px">Sin Facturas Generadas Para la Fecha: <span style="font-size:16px;font-weight: 600;font-family: 'ubuntu'"> <?= $fact ?></span></h4>
<?php
} else { ?>
  <div class="table-responsive">
    <table id="example1" class="table table-bordered">
      <thead>
        <tr class="warning">
          <td>Factura</td>
          <td>Facturado a</td>
          <td>Huesped</td>
          <td>Fecha Llegada</td>
          <td>Fecha Factura</td>
          <td>Estado</td>
          <?php
          if ($facturador == 1) { ?>
            <td>Estado DIAN</td>
          <?php
          }
          ?>
          <td>Accion</td>
          <!-- <td>Factura</td>
          <td>Huesped</td>
          <td>Fecha Llegada</td>
          <td>Fecha Factura</td>
          <td>Accion</td> -->
        </tr>
      </thead>
      <tbody>
        <?php
        /* foreach ($facturas as $factura) { ?>
          <tr style='font-size:12px'>
            <td style="padding:3px 5px"><?php echo $factura['factura_numero']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['apellido1'] . ' ' . $factura['apellido2'] . ' ' . $factura['nombre1'] . ' ' . $factura['nombre2']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha_llegada']; ?></td>
            <td style="padding:3px 5px"><?php echo $factura['fecha_factura']; ?></td>
            <td style="padding:3px 5px">
              <button class="btn btn-info btn-xs" onclick="verfactura(<?= $factura['factura_numero'] ?>)" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>

              <!-- <button class="btn btn-danger btn-xs" onclick="anulaFacturaHist(<?= $factura['factura_numero'] ?>)" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" ></i></button> -->
            </td>
          </tr>
          <?php
        } */
        foreach ($facturas as $factura) {
          if ($factura['tipo_factura'] == 1) {
            $nombrecia = 'SIN COMPAÑIA ASOCIADA';
            $nitcia = '';
            $correoFac = $factura['email'];
          } else {
            $cias = $hotel->getBuscaCia($factura['id_perfil_factura']);
            $nombrecia = $cias[0]['empresa'];
            $nitcia = $cias[0]['nit'] . '-' . $cias[0]['dv'];
            $correoFac = $cias[0]['email'];
            
          }
          $numFactura = $factura['prefijo_factura'] . $factura['factura_numero']; ?>
          <tr style='font-size:12px'>
            <td style="padding:3px 5px"><?php echo $factura['factura_numero']; ?></td>
            <td style="padding:3px 5px"><?php 
              if($factura['tipo_factura'] == 1){
                echo substr($factura['nombre_completo'],0,35);
              }else{
                echo substr($nombrecia,0,35); 
              }                                                      
            ?></td>
            <td style="padding:3px 5px"><?php echo substr($factura['nombre_completo'],0,35); ?></td>
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
            <td style="padding:3px 5px;width: 15%;text-align:center;">
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
                  <a 
                    class="btn btn-danger btn-xs btnAdiciona" 
                    data-toggle="modal" 
                    data-facturador="<?php echo $facturador; ?>" 
                    data-apellidos="<?php echo $factura['apellido1'] . ' ' . $factura['apellido2']; ?>" 
                    data-nombres="<?php echo $factura['nombre1'] . ' ' . $factura['nombre2']; ?>" 
                    data-llegada="<?php echo $factura['fecha_llegada']; ?>" 
                    data-salida="<?php echo $factura['fecha_salida']; ?>" 
                    data-fechafac="<?php echo $factura['fecha_factura']; ?>" 
                    data-numero="<?php echo $factura['factura_numero']; ?>" 
                    data-reserva="<?php echo $factura['num_reserva']; ?>" 
                    data-perfil="<?php echo $factura['perfil_factura']; ?>" 
                    data-idperfil="<?php echo $factura['id_perfil_factura']; ?>" 
                    data-prefijo="<?php echo $factura['prefijo_factura']; ?>" 
                    href="#myModalAnulaFactura" 
                    type="button" 
                    title="Anular Factura">
                    <i class="fa fa-window-close" aria-hidden="true"></i>
                  </a>                                
                  <?php
                }else{ ?>
                  <button 
                    class="btn btn-success btn-xs" 
                    type="button" 
                    data-toggle="modal<button 
                    class="btn btn-success btn-xs" 
                    type="button" 
                    data-toggle="modal"
                    data-tipo="1"
                    data-facturador="<?php echo $facturador; ?>" 
                    data-apellidos="<?php echo $factura['apellido1'] . ' ' . $factura['apellido2']; ?>" 
                    data-nombres="<?php echo $factura['nombre1'] . ' ' . $factura['nombre2']; ?>" 
                    data-fechafac="<?php echo $factura['fecha_factura']; ?>" 
                    data-numero="<?php echo $factura['numero_factura_cargo']; ?>" 
                    data-reserva="<?php echo $factura['num_reserva']; ?>" 
                    href="#myModalVerFactura" 
                    title="Ver Nota Credito">
                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                  </button>"                                
                  <?php
                }                            
              ?>
              <button 
                class="btn btn-primary btn-xs" 
                onclick="event.preventDefault();DonwloadFile('<?php echo $factura['prefijo_factura'].$factura['factura_numero']; ?>','<?php echo NIT; ?>','zip');" 
                type="button" 
                title="Descarga ZIP Attached">
                <i class="fa-solid fa-file-zipper"></i>
              </button>
              <button 
                class="btn btn-default btn-xs"                               
                onclick="event.preventDefault();ValidaFactura('<?=FECHA_PMS?>',`FES-<?php echo $factura['prefijo_factura'].$factura['factura_numero']; ?>`,'<?php echo $correoFac; ?>');" 
                type="button" 
                title="Ver Constancia Envio Factura ">
                <i class="fa-solid fa-envelope-circle-check"></i>
              </button>
              <button 
                class="btn btn-success btn-xs"                               
                onclick="event.preventDefault();ValidaDIAN('<?=$factura['cufe'];?>');" 
                type="button" 
                title="Valida Estado DIAN  ">
                <i class="fa-solid fa-square-check"></i>
                <!-- <i class="fa-solid fa-envelope-circle-check"></i> -->
              </button>

            </td>
          </tr>
        <?php
        }        
        ?>
      </tbody>
    </table>
  </div>
<?php
}

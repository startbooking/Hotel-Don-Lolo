<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="edita" id="edita" value="0">
            <input type="hidden" name="cuentadepositos" id="cuentadepositos" value="<?=CTA_DEPOSITO?>"> 
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">              
            <input type="hidden" name="ubicacion" id="ubicacion" value="reservasActivas">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Reservas </h3>
          </div>
          <div class="col-lg-6" align="right">
            <a 
              class="btn btn-success" 
              data-toggle="modal" 
              href="#myModalAdicionaReserva">
              <i class="fa fa-plus" aria-hidden="true"></i>
               Adicionar Reserva
            </a>
          </div> 
        </div>
      </div>
      <div class="panel-body">
        <div id="imprimeRegistroHotelero"></div>
        <div class='table-responsive'>
          <table id="example1" class="table modalTable table-condensed">
            <thead>
              <tr class="warning">
                <td>Reserva Nro</td>
                <td>Tipo Hab.</td>
                <td>Nro Hab.</td>
                <td>Huesped</td>
                <td>Tarifa</td>
                <td>Llegada</td>
                <td>Salida</td>
                <td>Noc</td>
                <td>Hom</td>
                <td>Muj</td>
                <td>Ni</td>
                <td>Estado</td>
                <td style="width: 9%" align="center">Pre-Registro</td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($reservas as $reserva) { 
                $depositos = $hotel->getDepositosReservas($reserva['num_reserva']);
                if(empty($reserva['id_compania'])){
                  $nombrecia = 'SIN COMPAÑIA ASOCIADA';
                  $nitcia    = '';
                }else{
                  $cias      = $hotel->getBuscaCia($reserva['id_compania']);
                  $nombrecia = $cias[0]['empresa'];
                  $nitcia    = $cias[0]['nit'].'-'.$cias[0]['dv'];
                }
                ?>
                <tr style='font-size:12px'>
                  <td>
                    <div style="display: flex">
                      <span><?php echo $reserva['num_reserva']?></span>
                      <?php 
                        if($reserva['causar_impuesto']==2){ ?>
                          <span class="fa-stack fa-xs" title="Sin Impuestos" style="margin-left:5px;cursor:pointer;">
                            <i style="font-size:10px;margin-top: -2px;margin-left: -3px;" class="fa fa-percent fa-stack-1x"></i>
                            <i style="font-size:20px" class="fa fa-ban text-danger"></i>
                          </span>
                          <?php 
                        }
                        if(count($depositos)<>0){ ?>
                          <span class="fa-stack fa-xs" title="Reserva con Depositos" style="margin-left:0px;cursor:pointer;" onclick="verDepositos('<?=$reserva['num_reserva']?>')">
                            <i style="font-size:20px;color: #085908" class="fa fa-circle fa-stack-2x"></i>
                            <i style="font-size:10px;margin-top: -2px;margin-left: 1px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
                          </span>
                          <?php  
                        }
                        if(!empty($reserva['observaciones'])){ ?>
                          <span class="fa-stack fa-xs" title="Observaciones a la Reserva" style="margin-left:0px;cursor:pointer;" onclick="verObservaciones('<?=$reserva['num_reserva']?>')">
                            <i style="font-size:20px;color: #2993dd" class="fa fa-circle fa-stack-2x"></i>
                            <i style="font-size:10px;margin-top: -2px;margin-left: 1px;" class="fa fa-commenting-o fa-stack-1x fa-inverse"></i>
                          </span>
                          <?php 
                        }
                      ?>
                    </div>
                  </td>
                  <td><?php echo $reserva['tipo_habitacion']; ?></td>
                  <td><?php echo $reserva['num_habitacion']; ?></td>
                  <td width="20%"><?php echo $reserva['nombre_completo']; ?></td>
                  <td align="right"><?php echo number_format($reserva['valor_diario'],2); ?></td> 
                  <td><?php echo $reserva['fecha_llegada']; ?></td>
                  <td><?php echo $reserva['fecha_salida']; ?></td>
                  <td align="center"><?php echo $reserva['dias_reservados']; ?></td>
                  <td align="center"><?php echo $reserva['can_hombres']; ?></td>
                  <td align="center"><?php echo $reserva['can_mujeres']; ?></td>
                  <td align="center"><?php echo $reserva['can_ninos']; ?></td>
                  <td><?php echo estadoReserva($reserva['estado']); ?></td>                       
                  <td style="padding:0px;text-align: center">
                    <button 
                      type="button" class="btn btn-danger btn-xs" 
                      onclick="imprimirPreRegistro(<?=$reserva['num_reserva']?>)"
                      title       ="Imprime Pre Registro Hotelero" >
                      <i class='fa fa-file-text'></i>
                    </button>
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
  </section>
</div>

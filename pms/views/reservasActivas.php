<?php  
  $hoy    = substr(FECHA_PMS,5,5);
?>

<div class="content-wrapper" id="pantallaReservas"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row"> 
          <div class="col-lg-6 col-md-6">
            <input type="hidden" name="editaRes" id="editaRes" value="0">
            <input type="hidden" name="cuentadepositos" id="cuentadepositos" value="<?=CTA_DEPOSITO?>"> 
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="reservasActivas">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Reservas </h3>
          </div> 
          <div class="col-lg-6 col-md-6" style="text-align:right;">
            <a 
              class="btn btn-success"  
              data-toggle="modal" 
              href="#myModalAdicionaReserva">
              <i class="fa fa-plus" aria-hidden="true"></i>
              Adicionar Reserva
            </a>
            <button class="btn btn-info" onclick="exportTableToExcel('tablaReservas')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
          </div> 
        </div>
      </div> 
      <div id="confirmaReserva"></div>
      <div class="panel-body" id="paginaReservas">
        <div class='table-responsive'>    
          <table id="example1" class="table modalTable table-condensed">
            <thead>
              <tr class="warning">
                <td>Nro</td>
                <!-- <td style="width:7%;"></td> -->
                <td>Hab.</td>
                <td style="text-align:center;">Huesped</td>
                <td style="text-align:left;">Compañia</td>
                <td>Tarifa</td>
                <td>Llegada</td>
                <td>Salida</td>
                <td>Noc</td>
                <td>Hom</td>
                <td>Muj</td>
                <td style="width: 9%;text-align:center;">Accion</td>
              </tr>
            </thead>
            <tbody id="paginaReservas"> 
              <?php
                foreach ($reservas as $reserva) {
                  $depositos = $hotel->getDepositosReservas($reserva['num_reserva']);
                  if ($reserva['id_compania'] == 0) {
                    $nombrecia = 'SIN COMPAÑIA ASOCIADA';
                    $nitcia = '';
                  } else { 
                    $cias = $hotel->getBuscaCia($reserva['id_compania']);
                    $nombrecia = $cias[0]['empresa'];
                    $nitcia = $cias[0]['nit'].'-'.$cias[0]['dv'];
                  }
                ?>
                <tr style='font-size:12px'>
                  <td>
                    <div style="display: flex;">
                      <span><?php echo $reserva['num_reserva']; ?></span>  
                      <?php
                        if ($reserva['causar_impuesto'] == 2) { ?>
                          <span class="fa-stack fa-xs" title="Sin Impuestos" style="margin-left:5px;cursor:pointer;">
                            <i style="font-size:10px;margin-top: 1px;margin-left: -1px;" class="fa fa-percent fa-stack-1x"></i>
                            <i style="font-size:20px" class="fa fa-ban text-danger"></i>
                          </span>
                          <?php
                        }
                        if (count($depositos) != 0) { ?>
                          <span class="fa-stack fa-xs" title="Reserva con Depositos" style="margin-left:0px;cursor:pointer;" onclick="verDepositos('<?php echo $reserva['num_reserva']; ?>')">
                            <i style="font-size:20px;color: #085908" class="fa fa-circle fa-stack-2x"></i>
                            <i style="font-size:10px;margin-top: 1px;margin-left: 0px;" class="fa fa-usd fa-stack-1x fa-inverse"></i>
                          </span>
                          <?php
                        }
                        if (!empty($reserva['observaciones'])) { ?>
                          <span class="fa-stack fa-xs" title="Observaciones a la Reserva" style="margin-left:0px;cursor:pointer;" onclick="verObservaciones('<?php echo $reserva['num_reserva']; ?>','1')">
                            <i style="font-size:20px;color: #2993dd" class="fa fa-circle fa-stack-2x"></i>
                            <i style="font-size:10px;margin-top: 1px;margin-left: 1px;" class="fa fa-commenting fa-stack-1x fa-inverse"></i>
                          </span>
                          <?php
                        }
                        if (!empty($reserva['observaciones_cancela'])) { ?>
                          <span class="fa-stack fa-xs" title="Observaciones a Cancelacion de la Reserva" style="margin-left:0px;cursor:pointer;" onclick="verObservaciones('<?php echo $reserva['num_reserva']; ?>','2')">
                            <i style="font-size:20px;color: red" class="fa fa-circle fa-stack-2x"></i>
                            <i style="font-size:10px;margin-top: 1px;margin-left: 1px;" class="fa fa-commenting fa-stack-1x fa-inverse"></i>
                          </span>
                          <?php
                        }
                        if ($hoy == substr($reserva['fecha_nacimiento'], 5, 5)) { ?>
                          <span class="fa-stack fa-xs" title="El Huesped esta de Cumpleaños" style="margin-left:0px;cursor:pointer;" >
                            <i style="font-size:20px;color: yellow" class="fa fa-circle fa-stack-2x"></i>                
                            <i style="font-size:10px;margin-top: 1px;margin-left: 0px;color:black" class="fa fa-birthday-cake fa-stack-1x fa-inverse"></i> 
                          </span>
                        <?php
                        }
                      ?>
                    </div>
                  </td>
                  <!--             
                    <td style="width:7%;">
                    </td>
                  -->            
                  <td style="text-align:right"><?php echo $reserva['num_habitacion']; ?></td>
                  <td>
                    <span class="badge" style="background: #20b2aa91;padding: 2px 6px 0px 11px;">
                      <label for="" class="control-label" style="text-align: left;color:#000">
                        <?php echo $reserva['nombre_completo']; ?>
                      </label>
                    </span>
                    <?php
                    $acompanas = $hotel->buscaAcompanantes($reserva['num_reserva']);
                      if (count($acompanas) > 0) {
                        foreach ($acompanas as $key => $acompana) { ?>
                          <span class="badge" style="background: #3faa558a;margin-top:2px;margin-left:15px;font-size:12px">
                            <label for="" class="control-label" style="font-size:11px;text-align: left;padding: 5px 0px 2px 2px;color:#000"><?php echo substr($acompana['nombre_completo'],0,35); ?>
                            </label>
                          </span>
              
                          <?php
                        }
                      }
                    ?>
                  </td>
                  <td style="width:20%;"><?php echo $nombrecia; ?></td> 
                  <td style="text-align:right;"><?php echo number_format($reserva['valor_diario'], 2); ?></td> 
                  <td><?php echo $reserva['fecha_llegada']; ?></td>
                  <td><?php echo $reserva['fecha_salida']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['dias_reservados']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_hombres']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_mujeres']; ?></td>
                  <!-- <td align="center"><?php echo $reserva['can_ninos']; ?></td> -->
              
                  <!-- <td><?php echo estadoReserva($reserva['estado']); ?></td> -->
                  <td style="padding:3px;width: 15%">
                    <?php
                      if ($reserva['estado'] == 'ES') { ?>
                        <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px">
                            <ul class="nav navbar-nav" style="margin :0;width: 100%">
                              <li class="dropdown" style="width: 100%">
                                <a 
                                  href          ="#" 
                                  class         ="dropdown-toggle" 
                                  data-toggle   ="dropdown" 
                                  role          ="button" 
                                  aria-haspopup ="true" 
                                  aria-expanded ="false" 
                                  style         ="padding:3px 5px;font-weight: bold;color:#000">Ficha Reservas<span class="caret" style="margin-left:10px;"></span>
                                </a>
                                <ul class="dropdown-menu submenu" style="float:left;margin-left:-180px;top:40px;">  
                                  <li>
                                    <a 
                                      data-toggle        ="modal"
                                      data-target        = "#myModalAcompanantesReserva"
                                      data-id            ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-tipohab       ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                                      data-nrohab        ="<?php echo $reserva['num_habitacion']; ?>" 
                                      data-nombre        ="<?php echo $reserva['nombre_completo']; ?>" 
                                      data-llegada       ="<?php echo $reserva['fecha_llegada']; ?>" 
                                      data-salida        ="<?php echo $reserva['fecha_salida']; ?>" 
                                      data-noches        ="<?php echo $reserva['dias_reservados']; ?>" 
                                      data-hombres       ="<?php echo $reserva['can_hombres']; ?>" 
                                      data-mujeres       ="<?php echo $reserva['can_mujeres']; ?>" 
                                      data-ninos         ="<?php echo $reserva['can_ninos']; ?>" 
                                      data-orden         ="<?php echo $reserva['orden_reserva']; ?>" 
                                      data-tipo          ="<?php echo $reserva['tipo_reserva']; ?>" 
                                      data-tarifa        ="<?php echo $hotel->getNombreTarifa($reserva['tarifa']); ?>" 
                                      data-valor         ="<?php echo $reserva['valor_diario']; ?>" 
                                      data-observaciones ="<?php echo $reserva['observaciones']; ?>" 
                                      >
                                      <i class="fa fa-users" aria-hidden="true"></i>Acompañantes Reserva
                                    </a>
                                  </li>
                                  <li id="cambiaHuesped">
                                    <a 
                                      data-toggle        ="modal" 
                                      data-target        = "#myModalReasignarHuesped"
                                      data-reserva       ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-tipohab       ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                                      data-nrohab        ="<?php echo $reserva['num_habitacion']; ?>" 
                                      data-apellido1     ="<?php echo $reserva['apellido1']; ?>" 
                                      data-apellido2     ="<?php echo $reserva['apellido2']; ?>" 
                                      data-nombre1       ="<?php echo $reserva['nombre1']; ?>" 
                                      data-nombre2       ="<?php echo $reserva['nombre2']; ?>"  
                                      data-llegada       ="<?php echo $reserva['fecha_llegada']; ?>" 
                                      data-salida        ="<?php echo $reserva['fecha_salida']; ?>" 
                                      data-noches        ="<?php echo $reserva['dias_reservados']; ?>" 
                                      data-hombres       ="<?php echo $reserva['can_hombres']; ?>" 
                                      data-mujeres       ="<?php echo $reserva['can_mujeres']; ?>" 
                                      data-ninos         ="<?php echo $reserva['can_ninos']; ?>" 
                                      data-orden         ="<?php echo $reserva['orden_reserva']; ?>" 
                                      data-tipo          ="<?php echo $reserva['tipo_reserva']; ?>" 
                                      data-tarifa        ="<?php echo $hotel->getNombreTarifa($reserva['tarifa']); ?>" 
                                      data-valor         ="<?php echo $reserva['valor_diario']; ?>" 
                                      data-observaciones ="<?php echo $reserva['observaciones']; ?>" 
                                      >
                                      <i class="fa fa-user-plus" aria-hidden="true"></i>Reasignar Huesped
                                    </a>
                                  </li> 
                                  <li>
                                    <a 
                                      data-toggle        ="modal" 
                                      data-target        = "#myModalModificaReserva" 
                                      data-id            ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-tipohab       ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                                      data-nrohab        ="<?php echo $reserva['num_habitacion']; ?>" 
                                      data-apellido1     ="<?php echo $reserva['apellido1']; ?>" 
                                      data-apellido2     ="<?php echo $reserva['apellido2']; ?>" 
                                      data-nombre1       ="<?php echo $reserva['nombre1']; ?>" 
                                      data-nombre2       ="<?php echo $reserva['nombre2']; ?>"  
                                      data-nombrecomp    ="<?php echo $reserva['nombre_completo']; ?>"  
                                      data-llegada       ="<?php echo $reserva['fecha_llegada']; ?>" 
                                      data-salida        ="<?php echo $reserva['fecha_salida']; ?>" 
                                      data-noches        ="<?php echo $reserva['dias_reservados']; ?>" 
                                      data-hombres       ="<?php echo $reserva['can_hombres']; ?>" 
                                      data-mujeres       ="<?php echo $reserva['can_mujeres']; ?>" 
                                      data-ninos         ="<?php echo $reserva['can_ninos']; ?>" 
                                      data-orden         ="<?php echo $reserva['orden_reserva']; ?>" 
                                      data-tarifa        ="<?php echo $hotel->getNombreTarifa($reserva['tarifa']); ?>" 
                                      data-valor         ="<?php echo $reserva['valor_reserva']; ?>" 
                                      data-observaciones ="<?php echo $reserva['observaciones']; ?>" 
                                      >
                                      <i class="fa fa-pencil-square" aria-hidden="true"></i>Modificar Reserva
                                    </a>
                                  </li>
                                  <li>
                                    <a 
                                      data-toggle        ="modal" 
                                      data-target        = "#myModalCancelaReserva"
                                      data-id            ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-tipohab       ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>"                                       
                                      data-nrohab        ="<?php echo $reserva['num_habitacion']; ?>" 
                                      data-apellido1     ="<?php echo $reserva['apellido1']; ?>" 
                                      data-apellido2     ="<?php echo $reserva['apellido2']; ?>" 
                                      data-nombre1       ="<?php echo $reserva['nombre1']; ?>" 
                                      data-nombre        ="<?php echo $reserva['nombre_completo']; ?>"  
                                      data-llegada       ="<?php echo $reserva['fecha_llegada']; ?>" 
                                      data-salida        ="<?php echo $reserva['fecha_salida']; ?>" 
                                      data-noches        ="<?php echo $reserva['dias_reservados']; ?>" 
                                      data-hombres       ="<?php echo $reserva['can_hombres']; ?>" 
                                      data-mujeres       ="<?php echo $reserva['can_mujeres']; ?>" 
                                      data-ninos         ="<?php echo $reserva['can_ninos']; ?>" 
                                      data-orden         ="<?php echo $reserva['orden_reserva']; ?>" 
                                      data-tarifa        ="<?php echo $hotel->getNombreTarifa($reserva['tarifa']); ?>" 
                                      data-valor         ="<?php echo $reserva['valor_diario']; ?>" 
                                      data-observaciones ="<?php echo $reserva['observaciones']; ?>" 
                                      >
                                      <i class="fa fa-times" aria-hidden="true"></i>Cancelar Reserva</a>
                                  </li>
                                  <li>  
                                    <a 
                                      data-toggle    ="modal" 
                                      data-id        ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-huesped   ="<?php echo $reserva['nombre_completo']; ?>" 
                                      data-orden     ="<?php echo $reserva['orden_reserva']; ?>" 
                                      data-causar    ="<?php echo $reserva['causar_impuesto']; ?>" 
                                      data-llegada   ="<?php echo $reserva['fecha_llegada']; ?>" 
                                      data-salida    ="<?php echo $reserva['fecha_salida']; ?>" 
                                      data-noches    ="<?php echo $reserva['dias_reservados']; ?>" 
                                      data-tarifa    ="<?php echo $hotel->getNombreTarifa($reserva['tarifa']); ?>" 
                                      data-tipohab   ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>"                                       
                                      data-nrohab    ="<?php echo $reserva['num_habitacion']; ?>" 
                                      onclick="confirmarReserva(<?=$reserva['num_reserva']?>)"
                                      >
                                      <i class="fa fa-book" aria-hidden="true"></i>Confirmar Reserva
                                    </a>
                                  </li> 
                                  <li>
                                    <a 
                                      data-toggle    ="modal" 
                                      data-id        ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-apellido1 ="<?php echo $reserva['apellido1']; ?>" 
                                      data-apellido2 ="<?php echo $reserva['apellido2']; ?>" 
                                      data-nombre1   ="<?php echo $reserva['nombre1']; ?>" 
                                      data-nombre2   ="<?php echo $reserva['nombre2']; ?>" 
                                      data-orden     ="<?php echo $reserva['orden_reserva']; ?>" 
                                      data-causar    ="<?php echo $reserva['causar_impuesto']; ?>" 
                                      onclick        ="imprimirRegistro(<?php echo $reserva['num_reserva']; ?>,<?php echo $reserva['causar_impuesto']; ?>)" 
                                      >
                                      <i class="fa fa-book" aria-hidden="true"></i>Imprimir Registro Hotelero
                                    </a>
                                  </li>
                                  <li>
                                    <a 
                                      data-toggle    ="modal" 
                                      data-id        ="<?php echo $reserva['id_huesped']; ?>" 
                                      data-apellido1 ="<?php echo $reserva['apellido1']; ?>" 
                                      data-apellido2 ="<?php echo $reserva['apellido2']; ?>" 
                                      data-nombre1   ="<?php echo $reserva['nombre1']; ?>" 
                                      data-nombre2   ="<?php echo $reserva['nombre2']; ?>"  
                                      data-nombre   ="<?php echo $reserva['nombre_completo']; ?>"  
                                      href           ="#myModalInformacionHuesped">
                                      <i class="fa fa-user-md" aria-hidden="true"></i>Perfil Huesped
                                    </a> 
                                  </li> 
                                  <li>
                                    <a 
                                      data-toggle        ="modal" 
                                      data-target        = "#myModalDepositoReserva"
                                      data-id            ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-idhuesped     ="<?php echo $reserva['id_huesped']; ?>" 
                                      data-tipohab       ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                                      data-nrohab        ="<?php echo $reserva['num_habitacion']; ?>" 
                                      data-nombre        ="<?php echo $reserva['nombre_completo']; ?>"  
                                      data-llegada       ="<?php echo $reserva['fecha_llegada']; ?>" 
                                      data-salida        ="<?php echo $reserva['fecha_salida']; ?>" 
                                      data-noches        ="<?php echo $reserva['dias_reservados']; ?>" 
                                      data-hombres       ="<?php echo $reserva['can_hombres']; ?>" 
                                      data-mujeres       ="<?php echo $reserva['can_mujeres']; ?>" 
                                      data-ninos         ="<?php echo $reserva['can_ninos']; ?>" 
                                      data-orden         ="<?php echo $reserva['orden_reserva']; ?>" 
                                      data-tarifa        ="<?php echo $hotel->getNombreTarifa($reserva['tarifa']) ?>" 
                                      data-valor         ="<?php echo $reserva['valor_reserva']; ?>" 
                                      data-observaciones ="<?php echo $reserva['observaciones']; ?>" 
                                      >
                                      <i class="fa fa-money" aria-hidden="true"></i>Deposito a Reserva
                                    </a>
                                  </li>
                                  <li>
                                    <a 
                                      data-toggle    ="modal" 
                                      data-idres     ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-idcia     ="<?php echo $reserva['id_compania']; ?>" 
                                      data-idcen     ="<?php echo $reserva['idCentroCia']; ?>" 
                                      data-tipohab   ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                                      data-nrohab    ="<?php echo $reserva['num_habitacion']; ?>" 
                                      data-nombre    ="<?php echo $reserva['nombre_completo']; ?>"
                                      data-nombrecia ="<?php echo $nombrecia; ?>" 
                                      data-nitcia    ="<?php echo $nitcia; ?>" 
                                      href           ="#myModalAsignarCompania">
                                      <i class="fa fa-window-restore" aria-hidden="true"></i>
                                    Asignar Compañia</a>
                                  </li>
                                  <?php
                                  if ($reserva['id_compania'] != 0) { ?>
                                    <li>
                                      <a 
                                        data-toggle    ="modal" 
                                        data-id        ="<?php echo $reserva['num_reserva']; ?>" 
                                        data-idhue     ="<?php echo $reserva['id_huesped']; ?>" 
                                        data-idcia     ="<?php echo $reserva['id_compania']; ?>" 
                                        data-idcentro  ="<?php echo $reserva['idCentroCia']; ?>" 
                                        data-nombre    ="<?php echo $reserva['nombre_completo']; ?>"
                                        data-nombrecia ="<?php echo $nombrecia; ?>" 
                                        href           ="#myModalInformacionCompania">
                                        <i class="fa fa-book" aria-hidden="true"></i>
                                      Datos Compañia</a>
                                    </li>
                                    <?php
                                  }
                                  ?>
                                  <li>
                                    <a 
                                      data-toggle    ="modal" 
                                      data-id        ="<?php echo $reserva['num_reserva']; ?>" 
                                      data-cia       ="<?php echo $reserva['id_compania']; ?>" 
                                      data-tipohab   ="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" 
                                      data-nrohab    ="<?php echo $reserva['num_habitacion']; ?>" 
                                      data-apellido1 ="<?php echo $reserva['apellido1']; ?>" 
                                      data-apellido2 ="<?php echo $reserva['apellido2']; ?>" 
                                      data-nombre1   ="<?php echo $reserva['nombre1']; ?>" 
                                      data-nombre2   ="<?php echo $reserva['nombre2']; ?>" 
                                      data-nombrecia ="<?php echo $nombrecia; ?>" 
                                      data-llegada   ="<?php echo $reserva['fecha_llegada']; ?>" 
                                      data-salida    ="<?php echo $reserva['fecha_salida']; ?>" 
                                      data-noches    ="<?php echo $reserva['dias_reservados']; ?>" 
                                      data-nitcia    ="<?php echo $nitcia; ?>" 
                                      data-observa   ="<?php echo $reserva['observaciones']; ?>" 
                                      href           ="#myModalAdicionaObservaciones">
                                      <i class="fa fa-commenting-o" aria-hidden="true"></i>
                                    Adicionar Observaciones</a>
                                  </li>                            
                                </ul>
                              </li>
                            </ul>
                          </div>
                        </nav>
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
        <table id="tablaReservas" class="table modalTable table-condensed" style="display:none">
          <thead>
            <tr class="warning">
              <td>Reserva</td>
                <td>Hab.</td>
                <td>Huesped</td>
                <td>Compañia</td>
                <td>Tarifa</td>
                <td>Llegada</td>
                <td>Salida</td>
                <td>Noc</td>
                <td>Hom</td>
                <td>Muj</td>
                <td>Estado</td>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($reservas as $reserva) {
                $depositos = $hotel->getDepositosReservas($reserva['num_reserva']);
                if ($reserva['id_compania'] == 0) {
                    $nombrecia = 'SIN COMPAÑIA ASOCIADA';
                    $nitcia = '';
                } else {
                    $cias = $hotel->getBuscaCia($reserva['id_compania']);
                    $nombrecia = $cias[0]['empresa'];
                    $nitcia = $cias[0]['nit'].'-'.$cias[0]['dv'];
                }
                ?>
                <tr style='font-size:12px'>
                  <td>
                    <span><?php echo $reserva['num_reserva']; ?></span>  
                  </td>
                  <td style="text-align:right"><?php echo $reserva['num_habitacion']; ?></td>
                  <td style="width:40px;">
                    <?php echo $reserva['nombre_completo']; ?>
                    <?php
                    $acompanas = $hotel->buscaAcompanantes($reserva['num_reserva']);
                    if (count($acompanas) > 0) {
                        foreach ($acompanas as $key => $acompana) {
                            echo $acompana['nombre_completo'];
                        }
                    }
                    ?>
                  </td>
                  <td style="width:20%;"><?php echo $nombrecia; ?></td> 
                  <td style="text-align:right;"><?php echo number_format($reserva['valor_diario'], 2); ?></td> 
                  <td><?php echo $reserva['fecha_llegada']; ?></td>
                  <td><?php echo $reserva['fecha_salida']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['dias_reservados']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_hombres']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_mujeres']; ?></td>
                  <td><?php echo estadoReserva($reserva['estado']); ?></td>
                </tr>
                <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div> 
  </section>
</div>

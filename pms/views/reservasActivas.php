<div class="content-wrapper" id="pantallaReservas">
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <input type="hidden" name="edita" id="edita" value="0">
            <input type="hidden" name="editaRes" id="editaRes" value="0">
            <input type="hidden" name="creaReser" id="creaReser" value="1">
            <input type="hidden" name="cuentadepositos" id="cuentadepositos" value="<?= CTA_DEPOSITO ?>">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_PMS ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="reservasActivas">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Reservas </h3>
          </div>
          <div class="col-lg-6 col-md-6" style="text-align:right;">
            <a class="btn btn-success btnAdiciona" data-toggle="modal" href="#myModalAdicionaReserva">
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
                <td style="padding:10px;">Hab.</td>
                <td style="text-align:center;width:80px;">Huesped</td>
                <td style="text-align:left;width:180px;">Compañia</td>
                <td>Tarifa</td>
                <td>Llegada</td>
                <td>Salida</td>
                <td>Noc</td>
                <td>Hom</td>
                <td>Muj</td>
                <td style="width: 24%;text-align:center;">Accion</td>
              </tr>
            </thead>
            <tbody id="paginaReservas">
              <?php
              foreach ($reservas as $reserva) {
                $depositos = $hotel->getDepositosReservas($reserva['num_reserva']);
                ?>
                <tr style='font-size:12px'>
                  <td style="display: inline-flex;">
                    <span class="btn btn-default" style="padding:0 2px;font-size:12px;">
                      <?php echo $reserva['num_reserva']; ?>
                    </span>
                    <?php
                    if ($reserva['causar_impuesto'] == 2) { ?>
                      <span class="btn btn-default faReservas" title="Sin Impuestos" style="padding:2px;">
                        <i style="font-size:10px;margin-top: 1px;margin-left: -1px;" class="fa fa-percent fa-stack-1x"></i>
                        <i style="font-size:12px" class="fa fa-ban text-danger"></i>
                      </span>
                    <?php
                    }
                    /* if ($reserva['pagos_cargos'] != null && $reserva['estado'] == 'ES') { ?>
                      <span class="btn btn-success faReservas" title="Reserva con Depositos" onclick="verDepositos('<?php echo $reserva['num_reserva']; ?>')">
                        <i class="fa fa-usd fa-stack-1x fa-inverse "></i>
                      </span>
                    <?php
                    } */
                    if (count($depositos) != 0) { ?>
                      <span class="btn btn-success faReservas" title="Reserva con Depositos" onclick="verDepositos('<?php echo $reserva['num_reserva']; ?>')">
                        <i class="fa fa-usd fa-stack-1x fa-inverse "></i>
                      </span>
                    <?php
                    }
                    if (!empty($reserva['observaciones'])) { ?>
                      <span 
                        class="btn btn-info faReservas" 
                        title="Observaciones a la Reserva" 
                        data-toggle="modal" 
                        data-target="#myModalVerObservaciones" 
                        data-reserva="<?php echo $reserva['num_reserva']; ?>" 
                        data-estado="1"
                        >
                        <i class="fa fa-commenting fa-stack-1x fa-inverse"></i>
                      </span>
                    <?php
                    }
                    if (!empty($reserva['observaciones_cancela'])) { ?>
                      <span 
                        class="btn btn-danger faReservas" 
                        title="Observaciones a Cancelacion de la Reserva" 
                        style="margin-left:0px;cursor:pointer;" 
                        data-toggle="modal" 
                        data-target="#myModalVerObservaciones" 
                        data-reserva="<?php echo $reserva['num_reserva']; ?>" 
                        data-estado="2"
                        >
                        <i class="fa fa-commenting fa-stack-1x fa-inverse"></i>
                      </span>
                    <?php
                    }
                    if ($hoy == substr($reserva['fecha_nacimiento'], 5, 5)) { ?>
                      <span class="btn btn-warning faReservas" title="El Huesped esta de Cumpleaños" style="margin-left:0px;cursor:pointer;">
                        <i class="fa fa-birthday-cake fa-stack-1x fa-inverse"></i>
                      </span>
                    <?php
                    }
                    ?>
                  </td>
                  <td style="text-align:left">
                    <span class="btn btn-default" style="padding:0 2px;font-size:12px;">
                      <?php echo $reserva['num_habitacion']; ?>
                    </span>
                  </td>
                  <td>
                    <span class="btn alert-info alert-function" style="padding:1px 4px; font-size:12px;font-weight: bold;">
                      <?php echo substr($reserva['nombre_completo'], 0, 35); ?></span>
                    <?php
                    $acompanas = $hotel->buscaAcompanantes($reserva['num_reserva']);
                    if (count($acompanas) > 0) {
                      foreach ($acompanas as $key => $acompana) { ?>
                        <span class="btn alert-success alert-function" style="padding:1px 4px; margin-left:15px;margin-top:3px;font-size:10px;font-weight: bold;">
                          <?php echo substr($acompana['nombre_completo'], 0, 35); ?>
                        </span>
                    <?php
                      }
                    }
                    ?>
                  </td>
                  <td><?php 
                    if($reserva['empresa']===null){
                      echo 'SIN COMPAÑIA ASOCIADA';
                    }else{
                      echo substr($reserva['empresa'], 0, 35); 
                    }
                    ?>
                  </td>
                  <td style="text-align:right;"><?php echo number_format($reserva['valor_diario'], 2); ?></td>
                  <td><?php echo $reserva['fecha_llegada']; ?></td>
                  <td><?php echo $reserva['fecha_salida']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['dias_reservados']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_hombres']; ?></td>
                  <td style="text-align:center;"><?php echo $reserva['can_mujeres']; ?></td>
                  <td style="padding:3px;width: 13%">
                    <?php
                    if ($reserva['estado'] == 'ES') { ?>
                      <nav class="navbar navbar-default" id="menuFicha" style="margin-bottom: 0px;min-height:0px;">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px">
                          <ul class="nav navbar-nav" style="margin :0;width: 100%">
                            <li class="dropdown" style="width: 100%">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:3px 5px;font-weight: bold;color:#000">
                                Ficha Reservas<span class="caret" style="margin-left:10px;"></span>
                              </a>
                              <ul class="dropdown-menu submenu" style="float:left;margin-left:-180px;top:40px;">
                                <li>
                                  <a 
                                    data-toggle="modal" 
                                    data-target="#myModalAcompanantesReserva" 
                                    data-id="<?php echo $reserva['num_reserva']; ?>" 
                                    data-nombre="<?php echo $reserva['nombre_completo']; ?>">
                                    <i class="fa fa-users" aria-hidden="true"></i>Acompañantes Reserva
                                  </a>
                                </li>
                                <li id="cambiaHuesped">
                                  <a 
                                    data-toggle="modal" 
                                    data-target="#myModalReasignarHuesped" 
                                    data-reserva="<?php echo $reserva['num_reserva']; ?>">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i>Reasignar Huesped
                                  </a>
                                </li>
                                <li>
                                  <a 
                                    data-toggle="modal" 
                                    data-target="#myModalModificaReserva" 
                                    data-id="<?php echo $reserva['num_reserva']; ?>" 
                                    data-nombre="<?php echo $reserva['nombre_completo']; ?>">
                                    <i class="fa fa-pencil-square" aria-hidden="true"></i>Modificar Reserva
                                  </a>
                                </li>
                                <li>
                                  <a 
                                    data-toggle="modal" 
                                    data-target="#myModalCancelaReserva" 
                                    data-id="<?php echo $reserva['num_reserva']; ?>" 
                                    data-nombre="<?php echo $reserva['nombre_completo']; ?>">
                                    <i class="fa fa-times" aria-hidden="true"></i>Cancelar Reserva</a>
                                </li>
                                <li>
                                  <a 
                                    data-toggle="modal" 
                                    onclick="confirmarReserva(<?= $reserva['num_reserva'] ?>)">
                                    <i class="fa fa-book" aria-hidden="true"></i>Confirmar Reserva
                                  </a>
                                </li>
                                <li>
                                  <a 
                                    data-toggle="modal" 
                                    onclick="imprimirRegistro(<?php echo $reserva['num_reserva']; ?>,<?php echo $reserva['causar_impuesto']; ?>)">
                                    <i class="fa fa-book" aria-hidden="true"></i>Imprimir Registro Hotelero
                                  </a>
                                </li>
                                <li>
                                  <a 
                                    data-toggle="modal" 
                                    data-id="<?php echo $reserva['id_huesped']; ?>" 
                                    data-nombre="<?php echo $reserva['nombre_completo']; ?>" 
                                    href="#myModalModificaPerfilHuesped">
                                    <i class="fa fa-user-md"></i>Perfil Huesped
                                  </a>
                                </li>
                                <li>
                                  <a data-toggle="modal" data-target="#myModalDepositoReserva" data-id="<?php echo $reserva['num_reserva']; ?>" data-idhuesped="<?php echo $reserva['id_huesped']; ?>" data-tipohab="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>" data-nrohab="<?php echo $reserva['num_habitacion']; ?>" data-nombre="<?php echo $reserva['nombre_completo']; ?>" data-llegada="<?php echo $reserva['fecha_llegada']; ?>" data-salida="<?php echo $reserva['fecha_salida']; ?>" data-noches="<?php echo $reserva['dias_reservados']; ?>" data-hombres="<?php echo $reserva['can_hombres']; ?>" data-mujeres="<?php echo $reserva['can_mujeres']; ?>" data-ninos="<?php echo $reserva['can_ninos']; ?>" data-orden="<?php echo $reserva['orden_reserva']; ?>" data-tarifa="<?php echo $hotel->getNombreTarifa($reserva['tarifa']) ?>" data-valor="<?php echo $reserva['valor_reserva']; ?>" data-observaciones="<?php echo $reserva['observaciones']; ?>">
                                    <i class="fa-solid fa-money-bill"></i>
                                    Deposito a Reserva
                                  </a>
                                </li>
                                <li>
                                  <a 
                                    data-toggle="modal" 
                                    data-id="<?php echo $reserva['id_huesped']; ?>" 
                                    data-idres="<?php echo $reserva['num_reserva']; ?>" 
                                    data-idcia="<?php echo $reserva['id_compania']; ?>" 
                                    data-nombre="<?php echo $reserva['nombre_completo']; ?>" 
                                    href="#myModalAsignarCompania">
                                    <i class="fa fa-window-restore" aria-hidden="true"></i>
                                    Asignar Compañia</a>
                                </li>
                                <?php
                                if ($reserva['id_compania'] != 0) { ?>
                                  <li>
                                    <a 
                                      data-toggle="modal" 
                                      data-id="<?php echo $reserva['id_compania']; ?>" 
                                      data-empresa="<?php echo $reserva['empresa']; ?>" 
                                      href="#myModalModificaPerfilCia">
                                      <i class="fa fa-book" aria-hidden="true"></i>
                                      Datos Compañia</a>
                                  </li>
                                <?php
                                }
                                ?>
                                <li>
                                  <a 
                                    data-toggle="modal" 
                                    data-id="<?php echo $reserva['num_reserva']; ?>" 
                                    data-nrohab="<?php echo $reserva['num_habitacion']; ?>" 
                                    data-nombre="<?php echo $reserva['nombre_completo']; ?>" 
                                    data-llegada="<?php echo $reserva['fecha_llegada']; ?>" 
                                    data-salida="<?php echo $reserva['fecha_salida']; ?>" 
                                    data-noches="<?php echo $reserva['dias_reservados']; ?>" 
                                    href="#myModalAdicionaObservaciones">
                                    <i class="fa-regular fa-comments"></i>
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
              /* $depositos = $hotel->getDepositosReservas($reserva['num_reserva']);
              if ($reserva['id_compania'] == 0) {
                $nombrecia = 'SIN COMPAÑIA ASOCIADA';
                $nitcia = '';
              } else {
                $cias = $hotel->getBuscaCia($reserva['id_compania']);
                $nombrecia = $cias[0]['empresa'];
                $nitcia = $cias[0]['nit'] . '-' . $cias[0]['dv'];
              } */
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
                <td style="width:20%;"><?php 
                  if($reserva['empresa'] != null){
                    echo $reserva['empresa']; 
                  }else{
                    echo 'SIN COMPAÑIA ASOCIADA';
                  }
                  ?>
                </td>
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
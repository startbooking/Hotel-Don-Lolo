
<div class="content-wrapper">
      <section class="content" style="height: 780px" id="listado">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
                <input type="hidden" name="ubicacion" id="ubicacion" value="cuentasCongeladas">
                <h3 class="w3ls_head tituloPagina"> <i class="fa fa-snowflake-o icon" style="font-size:36px;color:black"></i> Cuentas Congeladas</h3>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="datos_ajax_delete"></div>
            <div class="table-responsive">
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr class="warning" style="font-weight: bold">
                    <td>Hab.</td>
                    <td>Huesped</td>
                    <td>Compania</td>
                    <td>Llegada</td>
                    <td>Salida</td>
                    <td style="text-align:center;">Consumos</td>
                    <td style="text-align:center;">Impuesto</td>
                    <td style="text-align:center;">Pagos</td>
                    <td style="text-align:center;">Saldo</td>
                    <td style="text-align:center;">Accion</td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($reservas as $reserva) {
                    $consumos = $hotel->getConsumosReserva($reserva['num_reserva']);
                    if (count($consumos) == 0) {
                      $consumos[0]['cargos'] = 0;
                      $consumos[0]['imptos'] = 0;
                      $consumos[0]['pagos'] = 0;
                    }
                    if ($reserva['id_compania'] == 0) {
                      $nombrecia = 'SIN COMPAÑIA ASOCIADA';
                      $nitcia = '222.222.222';
                    } else {
                      $cias = $hotel->getBuscaCia($reserva['id_compania']);
                      if (count($cias) != 0) {
                        $nombrecia = $cias[0]['empresa'];
                        $nitcia = $cias[0]['nit'] . '-' . $cias[0]['dv'];
                      }
                    }
                  ?>
                    <tr style='font-size:12px'>
                      <td style="display: inline-flex;">
                        <?php
                        echo $reserva['num_habitacion'];
                        if ($reserva['causar_impuesto'] == 2) { ?>
                          <span class="btn btn-default faReservas" title="Sin Impuestos" style="padding:2px;">
                            <i style="font-size:10px;margin-top: 1px;margin-left: -1px;" class="fa fa-percent fa-stack-1x"></i>
                            <i style="font-size:12px" class="fa fa-ban text-danger"></i>
                          </span>
                        <?php
                        }
                        if (!empty($reserva['observaciones'])) { ?>
                          <span class="btn btn-info faReservas" title="Observaciones a la Reserva" data-toggle="modal" data-target="#myModalVerObservaciones" data-reserva="<?php echo $reserva['num_reserva']; ?>" data-estado="1">
                            <i class="fa fa-commenting fa-stack-1x fa-inverse"></i>
                          </span>
                        <?php
                        }
                        ?>
                      </td>
                      <td style="width:50px;">
                        <span class="btn btn-primary" style="padding:1px 4px; font-size:12px;font-weight: bold;">
                          <?php echo substr($reserva['nombre_completo'], 0, 35); ?>
                        </span>
                        <?php
                        $acompanas = $hotel->buscaAcompanantes($reserva['num_reserva']);
                        if (count($acompanas) > 0) {
                          foreach ($acompanas as $key => $acompana) { ?>
                            <span class="btn btn-info" style="padding:1px 4px; margin-left:15px;margin-top:3px;font-size:10px;font-weight: bold;">
                              <?php echo substr($acompana['nombre_completo'], 0, 35); ?>
                            </span>
                        <?php
                          }
                        }
                        ?>
                      <td><?php echo $nombrecia; ?></td>
                      <td><?php echo $reserva['fecha_llegada']; ?></td>
                      <td><?php echo $reserva['fecha_salida']; ?></td>
                      <td style="text-align:right;"><a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($consumos[0]['cargos'], 2); ?></a></td>
                      <td style="text-align:right;"><a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($consumos[0]['imptos'], 2); ?></a></td>
                      <td style="text-align:right;"><a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($consumos[0]['pagos'], 2); ?></a></td>
                      <td style="text-align:right;"><a onclick="cargosHuesped(<?php echo $reserva['num_reserva']; ?>)"><?php echo number_format($consumos[0]['cargos'] + $consumos[0]['imptos'] - $consumos[0]['pagos'], 2); ?></a></td>
                      <td style="padding:3px;width: 12%">

                        <nav class="navbar navbar-default " style="margin-bottom: 0px;min-height:0px;">
                          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:0px;">
                            <ul class="nav navbar-nav" style="margin :0;width:100%;">
                              <li class="dropdown" style="margin :0;width:100%;">
                                <a href="#" class="dropdown-toggle aSub" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:3px 5px;font-weight: 700;color:#000">Ficha Facturacion<span class="caret caretSub"></span></a>
                                <ul class="dropdown-menu submenu" style="float:left;margin-left:-180px;top:40px;">
                                  <li>
                                    <a onclick="regresaCasa('<?php echo $reserva['num_reserva']; ?>')">
                                      <i class="fa-solid fa-house"></i> Regresar a Casa</a>
                                  </li>
                                  
                                  <li>
                                    <a data-toggle="modal" data-id="<?php echo $reserva['id_huesped']; ?>" data-nombre="<?php echo $reserva['nombre_completo']; ?>" href="#myModalModificaPerfilHuesped">
                                      <i class="fa fa-user-md" aria-hidden="true"></i>
                                      Perfil Huesped</a>
                                  </li>
                                  <?php
                                  if ($reserva['id_compania'] != 0) { ?>
                                    <li>
                                      <a data-toggle="modal" data-id="<?php echo $reserva['id_compania']; ?>" data-empresa="<?php echo $nombrecia; ?>" href="#myModalModificaPerfilCia">
                                        <i class="fa fa-industry" aria-hidden="true"></i>
                                        Datos Compañia</a>
                                    </li>
                                  <?php
                                  }
                                  ?>
                                  <li>
                                    <a data-toggle="modal" data-target="#myModalEstadoCuenta" data-id="<?php echo $reserva['num_reserva']; ?>" data-nombre="<?php echo $reserva['nombre_completo']; ?>" data-impto="<?php echo $reserva['causar_impuesto']; ?>" data-nrohab="<?php echo $reserva['num_habitacion']; ?>" data-tipohab="<?php echo descripcionTipoHabitacion($reserva['tipo_habitacion']); ?>">
                                      <i class="fa fa-book" aria-hidden="true"></i>
                                      Estado de Cuenta</a>
                                  </li>                                  
                                </ul>
                              </li>
                            </ul>
                          </div>
                        </nav>                        
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
      <section class="container-fluid" style="height: 900px" id="movimiento" style="display:none;margin-top:20px"></section>
    </div>
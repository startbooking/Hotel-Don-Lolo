<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="agencias">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-plane "></i> Agencias de Viajes </h3>
          </div>
          <div class="col-lg-6" align="right">
            <a 
              class="btn btn-success"
              data-toggle="modal" 
              href="#myModalAdicionaAgencia">
              <i class="fa fa-plus" aria-hidden="true"></i>
               Adicionar Agencia
            </a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div class="table-responsive"> 
          <table id="example1" class="table modalTable table-bordered">
            <thead>
              <tr class="warning">
                <td>Nit</td>
                <td>Agencia</td>
                <td>Direccion</td>
                <td>Celular</td>
                <td>Correo</td>
                <td>Tarifa</td>
                <td>Estado</td>
                <td>Accion</td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($agencias as $agencia) { ?>
                <tr style='font-size:12px'>
                  <td width="22px"><?php echo $agencia['nit'].'-'.$agencia['dv']; ?></td>
                  <td><?php echo $agencia['agencia']; ?></td>
                  <td><?php echo $agencia['direccion']; ?></td>
                  <td><?php echo $agencia['celular']; ?></td>
                  <td><?php echo $agencia['email']; ?></td>
                  <td><?php echo $hotel->getDescripcionTarifa($agencia['id_tarifa']); ?></td>
                  <td><?php echo estadoCompania($agencia['activo']); ?></td>
                  <td>
                    <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                        <ul class="nav navbar-nav">
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding: 3px 1px;">Ficha Agencia<span class="caret"></span></a>
                            <ul class="dropdown-menu" style="float:left;margin-left:none;top:40px;left: -195px">  
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $agencia['id_agencia']?>" 
                                  data-agencia="<?php echo $agencia['agencia']?>" 
                                  href="#myModalIngresaReserva">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                 Modificar Datos</a> 
                              </li>
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $agencia['id_agencia']?>" 
                                  data-agencia="<?php echo $agencia['agencia']?>" 
                                  href="#myModalIngresaReserva">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                 Contactos</a> 
                              </li>
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $agencia['id_agencia']?>" 
                                  data-agencia="<?php echo $agencia['agencia']?>" 
                                  href="#myModalIngresaReserva">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                 Huespedes</a> 
                              </li>
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $agencia['id_agencia']?>" 
                                  data-agencia="<?php echo $agencia['agencia']?>" 
                                  href="#myModalInformacionFichareserva">
                                <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                 Historico Agencia</a> 
                              </li>
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $agencia['id_agencia']?>" 
                                  data-agencia="<?php echo $agencia['agencia']?>" 
                                  href="#myModalInformacionreservaFamilia">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                Reservas Actuales</a>
                              </li>
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $agencia['id_agencia']?>" 
                                  data-agencia="<?php echo $agencia['agencia']?>" 
                                  href="#myModalInformacionMedicareserva">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                 Estado Credito</a>
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
</div>
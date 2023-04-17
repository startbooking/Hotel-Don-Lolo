<style>
  .control-label{
    font-size:11px;
    margin-top:5px;
  }
</style>


<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="objetosOlvidados">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-puzzle-piece"></i> Objetos Olvidados </h3>
          </div>
          <div class="col-lg-6" align="right">
            <a 
              class="btn btn-success"
              data-toggle="modal" 
              href="#myModalAdicionaObjeto">
              <i class="fa fa-plus" aria-hidden="true"></i>
               Adicionar Objeto
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
                <td>Fecha</td>
                <td>Hab.</td>
                <td>Objeto</td>
                <td>Lugar</td>
                <td>Encontrado Por</td>
                <td>Almacenado </td>
                <td>Usuario</td>
                <td>Estado</td>
                <td>Accion</td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($objetos as $objeto) { 
                  $huesped  = $hotel->getNombreHuesped($objeto['id_huesped']);
                ?>
                <tr style='font-size:12px'>
                  <td><?php echo substr($objeto['fecha_encontrado'],0,10);?></td>
                  <td><?php echo $hotel->getNumeroHab($objeto['id_habitacion']); ?></td>
                  <td><?php echo $objeto['objeto_encontrado']; ?></td>
                  <td><?php echo $objeto['lugar_encontrado']; ?></td>
                  <td><?php echo $objeto['encontrado_por']; ?></td>
                  <td><?php echo $objeto['almacenado_en']; ?></td>
                  <td><?php echo $hotel->nombreUsuario($objeto['id_usuario']); ?></td>
                  <td><?php echo estadoObjeto($objeto['accion_objeto']); ?></td>
                  <td style="width: 12%">
                    <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                        <ul class="nav navbar-nav">
                          <li class="dropdown submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding: 3px 4px;font-weight: 400">Ficha Objeto<span class="caret" style="margin-left:30px"></span></a>
                            <ul class="dropdown-menu" style="float:left;margin-left:none;top:40px;left: -195px">  
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $objeto['id_objeto']?>" 
                                  href="#myModalInformacionObjeto">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                 Informacion Objeto</a> 
                              </li>
                              <?php 
                              if($objeto['accion_objeto']==0){ ?>
                                <li>
                                  <a data-toggle="modal" 
                                    data-id="<?php echo $objeto['id_objeto']?>" 
                                    data-huesped="<?php echo $huesped[0]['nombre_completo']?>" 
                                    data-objeto="<?php echo $objeto['objeto_encontrado']?>" 
                                    data-observa="<?php echo $objeto['observaciones_objeto']?>" 
                                    data-ubica="<?php echo $objeto['almacenado_en']?>" 
                                    href="#myModalEntregaObjeto">
                                  <i class="fa fa-sign-out" aria-hidden="true"></i>
                                   Entregar Objeto</a> 
                                </li>
                                <?php 
                              }
                              ?>
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $objeto['id_objeto']?>" 
                                  data-huesped="<?php echo $huesped[0]['nombre_completo']?>" 
                                  data-objeto="<?php echo $objeto['objeto_encontrado']?>" 
                                  data-observa="<?php echo $objeto['observaciones_objeto']?>" 
                                  href="#myModalAdicionaObservacionesObjeto">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                 Adicionar Observaciones</a> 
                              </li>
                      <!--
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $agencia['id_agencia']?>" 
                                  data-objeto="<?php echo $agencia['agencia']?>" 
                                  data-huesped="<?php echo $agencia['agencia']?>" 
                                  href="#myModalInformacionFichareserva">
                                <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                 Dar de Baja</a> 
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
                    -->
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
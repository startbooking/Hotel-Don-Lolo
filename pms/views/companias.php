<div class="content-wrapper" id="pantallaCompanias">
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="companias">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Compañia </h3>
          </div>
          <div class="col-lg-6 col-md-6" style="text-align:right;">
            <a class="btn btn-success btnAdiciona" data-toggle="modal" href="#myModalAdicionaCompania">
              <i class="fa fa-plus" aria-hidden="true"></i>
              Adicionar Compania
            </a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div id="imprimeRegistroHotelero"></div>
        <div class="row-fluid">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr class="warning">
                  <td>Nit</td>
                  <td>Empresa</td>
                  <td>Direccion</td>
                  <td>Celular</td>
                  <td>Correo</td>
                  <td>Accion</td>
                </tr>
              </thead>
              <tbody id="listaCompanias">
                <?php
                foreach ($companias as $compania) { ?>
                  <tr style='font-size:12px'>
                    <td style="width: 10%"><?php echo $compania["nit"]; ?> - <?php echo $compania['dv']; ?></td>
                    <td><?php echo substr($compania["empresa"], 0, 35); ?> </td>
                    <td><?php
                        if ($compania["direccion"] == '') {
                          echo '';
                        } else {
                          echo substr($compania["direccion"], 0, 30);
                        }
                        ?> </td>
                    <td><?php echo $compania["celular"]; ?> </td>
                    <td><?php echo $compania["email"]; ?> </td>
                    <td style="padding:0px;width: 13%">
                      <nav class="navbar navbar-default" id="menuFicha" style="margin-bottom: 0px;">
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                          <ul class="nav navbar-nav" style="width:100%">
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:3px 11px;font-weight: bold;color:#000">Ficha Compañia<span class="caret" style="margin-left:10px;"></span>
                              </a>
                              <ul class="dropdown-menu submenu" style="float:left;margin-left:none;top:40px;left: -195px">
                                <li>
                                  <a data-toggle="modal" data-id="<?php echo $compania['id_compania']; ?>" data-empresa="<?php echo $compania['empresa']; ?>" data-nit="<?php echo $compania['nit'] ?>- <?php echo $compania['dv']; ?>" href="#myModalModificaPerfilCia">
                                    <i class="fa-solid fa-arrow-right-to-city"></i>
                                    Modificar Datos</a>
                                </li>
                                <li>
                                  <a data-toggle="modal" data-id="<?php echo $compania['id_compania']; ?>" data-empresa="<?php echo $compania['empresa'] ?>" data-nit="<?php echo $compania['nit'] ?> - <?php echo $compania['dv'] ?>" href="#myModalHuespedesCia">
                                    <i class="fa-solid fa-users"></i>
                                    Huespedes</a>
                                </li>
                                <li>
                                  <a data-toggle="modal" data-id="<?php echo $compania['id_compania'] ?>" data-empresa="<?php echo $compania['empresa'] ?>" data-nit="<?php echo $compania['nit'] ?> - <?php echo $compania['dv'] ?>" href="#myModalReservasEsperadasCia">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    Reservas Actuales</a>
                                </li>
                                <li>
                                  <a data-toggle="modal" data-id="<?php echo $compania['id_compania'] ?>" data-empresa="<?php echo $compania['empresa'] ?>" data-nit="<?php echo $compania['nit'] ?> - <?php echo $compania['dv'] ?>" href="#myModalHistoricoReservasCia">
                                    <i class="fa-solid fa-calendar-check"></i>
                                    Historico Reservas</a>
                                </li>
                                <li>
                                  <a data-toggle="modal" data-id="<?php echo $compania['id_compania'] ?>" data-empresa="<?php echo $compania['empresa'] ?>" data-nit="<?php echo $compania['nit'] ?>- <?php echo $compania['dv'] ?>" href="#myModalHistoricoFacturasCia">
                                    <i class="fa-solid fa-file-lines"></i>
                                    Historico Facturas</a>
                                </li>
                                <li>
                                  <a data-toggle="modal" data-id="<?php echo $compania['id_compania'] ?>" data-nombre="<?php echo $compania['empresa'] ?>" href="#myModalDocumentosCia">
                                    <i class="fa fa-clone" aria-hidden="true"></i>
                                    Documentos</a>
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
    </div>
  </section>
</div>
<meta http-equiv="Content-type" content="text/html"; charset="utf-8" />

<?php
  setlocale(LC_ALL,"es_CO.utf8","es_CO","esp")  ;

  include_once '../res/php/configdb.php' ;
  require_once '../res/php/paginacion.php' ;

  $connection = new PDO("mysql:host=$server;dbname=$dbname;", $dbuser, $dbpass);
  $connection->query("SET NAMES 'utf8';");
  $pagination = new PDO_Pagination($connection);

  $pagination->rowCount("SELECT * FROM huespedes");
  $pagination->config(5, 20);
  $sql = "SELECT * FROM huespedes ORDER BY apellido1, apellido2 ASC LIMIT $pagination->start_row, $pagination->max_rows";
  $query = $connection->prepare($sql);
  $query->execute();
  $model = array();
  while($rows = $query->fetch()){
    $model[] = $rows;
  }

?>

<div class="content-wrapper"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" name="edita" id="edita" value="0">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>"> 
            <input type="hidden" name="ubicacion" id="ubicacion" value="huespedesPerfil">
            <h3 class="w3ls_head tituloPagina"> <i class="fa fa-address-book" aria-hidden="true"></i> Huespedes </h3>
          </div>
          <div class="col-md-6" align="right">
            <a 
              class="btn btn-success"
              data-toggle="modal" 
              href="#myModalAdicionaPerfil">
              <i class="fa fa-plus" aria-hidden="true"></i>
               Adicionar Huesped
            </a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div id="imprimeRegistroHotelero"></div>
        <div class="container-fluid" style="padding:0 15px 15px 15px;">
          <div class="input-group col-md-4">
            <input name="search" id="search" type="search" class="form-control" onKeyUp="buscarHuesped()" style="height: 30px" placeholder="Buscar Huesped">
            <span class="input-group-btn" style="display:block">
            <button style="height: 28px;padding:4px 10px" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true">
            </span> Buscar </button>
            </span>
          </div>          
        </div>
        <div class="table-responsive" id="huespedes"> 
          <table id="huespedesActivos" class="table table-bordered">
            <thead>
              <tr class="warning">
                <td>Identificacion</td>
                <td>1er Apellido</td>
                <td>2o Apellido</td>
                <td>1er Nombre</td>
                <td>2o Nombre</td> 
                <td>Celular</td>
                <td>Correo</td>
                <td>Accion</td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($model as $huesped) { 
                if(empty($huesped['id_compania'])){
                  $nombrecia = 'SIN COMPAÑIA ASOCIADA';
                  $nitcia    = '';
                }else{
                  $cias      = $hotel->getBuscaCia($huesped['id_compania']);
                  $nombrecia = $cias[0]['empresa'];
                  $nitcia    = $cias[0]['nit'].'-'.$cias[0]['dv'];
                }
                ?>
                <tr style='font-size:12px'>
                  <td width="22px"><?php echo $huesped['identificacion']; ?></td>
                  <td><?php echo $huesped['apellido1']; ?></td>
                  <td><?php echo $huesped['apellido2']; ?></td>
                  <td><?php echo $huesped['nombre1']; ?></td>
                  <td><?php echo $huesped['nombre2']; ?></td>
                  <td><?php echo $huesped['celular']; ?></td>
                  <td><?php echo $huesped['email']; ?></td>
                  <td style="padding:3px;width: 13%">
                    <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                        <ul class="nav navbar-nav">
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:3px 5px;font-weight: 400;color:#000">Ficha Huesped<span class="caret" style="margin-left:20px;"></span></a>
                            <ul class="dropdown-menu submenu" style="left: -180px">  
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $huesped['id_huesped']?>" 
                                  data-apellido1="<?php echo $huesped['apellido1']?>" 
                                  data-apellido2="<?php echo $huesped['apellido2']?>" 
                                  data-nombre1="<?php echo $huesped['nombre1']?>" 
                                  data-nombre2="<?php echo $huesped['nombre2']?>" 
                                  href="#myModalModificaPerfilHuesped">
                                <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                 Modificar Perfil</a> 
                              </li>
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $huesped['id_huesped']?>" 
                                  data-apellido1="<?php echo $huesped['apellido1']?>" 
                                  data-apellido2="<?php echo $huesped['apellido2']?>" 
                                  data-nombre1="<?php echo $huesped['nombre1']?>" 
                                  data-nombre2="<?php echo $huesped['nombre2']?>" 
                                  href="#myModalReservasEsperadas">
                                <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                                Reservas</a>
                              </li>
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $huesped['id_huesped']?>" 
                                  data-apellido1="<?php echo $huesped['apellido1']?>" 
                                  data-apellido2="<?php echo $huesped['apellido2']?>" 
                                  data-nombre1="<?php echo $huesped['nombre1']?>" 
                                  data-nombre2="<?php echo $huesped['nombre2']?>"
                                  href="#myModalHistoricoReservas">
                                  <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                 Historico Reservas</a> 
                              </li>
                              <li>
                                <a data-toggle="modal" 
                                  data-id="<?php echo $huesped['id_huesped']?>" 
                                  data-apellido1="<?php echo $huesped['apellido1']?>" 
                                  data-apellido2="<?php echo $huesped['apellido2']?>" 
                                  data-nombre1="<?php echo $huesped['nombre1']?>" 
                                  data-nombre2="<?php echo $huesped['nombre2']?>"     
                                  data-cia="<?php echo $huesped['id_compania']?>" 
                                  data-nombrecia="<?php echo $nombrecia?>" 
                                  data-nitcia="<?php echo $nitcia?>" 
                                  href="#myModalAsignarCompania">
                                <i class="fa fa-industry" aria-hidden="true"></i>
                                 Asignar Compañia</a>
                              </li>
                              <li>
                                <a data-toggle="modal" 
                                   data-id="<?php echo $huesped['id_huesped']?>" 
                                   data-nombre="<?php echo $huesped['nombre_completo']?>" 
                                   href="#myModalDocumentos">
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
      <div class="panel-footer">
        <div class="row">
          <div class="pull-right" style="padding:20px">
            <?php
              $pagination->pages("btnpage");
            ?>
          </div>
        </div>
      </div>
    </div>
  </section> 
</div>

<?php

require '../../../res/php/configdb.php';
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See https://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - https://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'huespedes';
 
// Table's primary key
$primaryKey = 'id_huesped';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
  array( 'db' => 'identificacion', 'dt' => 0 ),
  array( 'db' => 'apellido1',      'dt' => 1 ),
  array( 'db' => 'apellido2',      'dt' => 2 ),
  array( 'db' => 'nombre1',        'dt' => 3 ),
  array( 'db' => 'nombre2',        'dt' => 4 ),
  array( 'db' => 'celular',        'dt' => 5 ),
  array( 'db' => 'email',          'dt' => 6 ),
  array( 'db' => 'edad',           'dt' => 7 ),
  array( 'db' => 'id_huesped',     'dt' => 8,
    'formatter' => function( $d, $row ) { 
      return '
      <nav class="navbar navbar-default" id="menuFicha" style="margin-bottom: 0px;min-height:0px;">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a 
                href="#" 
                class="dropdown-toggle" 
                data-toggle="dropdown" 
                role="button" 
                aria-haspopup="true" 
                aria-expanded="false" 
                style="padding:3px 8px;font-weight:bold;color:#000">Ficha Huesped<span class="caret" style="margin-left:10px;"></span></a>
                  <ul class="dropdown-menu submenu" style="left: -180px">  
                <li>
                  <a 
                    data-toggle ="modal" 
                    data-id     ="'.$row["id_huesped"].'" 
                    data-nombre ="'.$row["apellido1"].' '.$row["apellido2"].' '.$row["nombre1"].' '.$row["nombre2"].'" 
                    href        ="#myModalModificaPerfilHuesped">
                    <i class="fa-solid fa-user-pen"></i>
                    Modificar Perfil</a> 
                </li>
                <li>
                  <a  
                    data-toggle ="modal" 
                    data-id     ="'.$row["id_huesped"].'" 
                    data-nombre ="'.$row["apellido1"].' '.$row["apellido2"].' '.$row["nombre1"].' '.$row["nombre2"].'" 
                    href        ="#myModalReservasEsperadas">
                    <i class="fa-regular fa-calendar"></i>
                  Reservas</a>
                </li>
                <li> 
                  <a 
                  data-toggle ="modal" 
                  data-id     ="'.$row["id_huesped"].'" 
                  data-nombre ="'.$row["apellido1"].' '.$row["apellido2"].' '.$row["nombre1"].' '.$row["nombre2"].'" 
                  href        ="#myModalHistoricoReservas">
                  <i class="fa-solid fa-calendar-week"></i>
                  Historico Reservas</a> 
                </li>
                <li>
                  <a 
                    data-toggle ="modal" 
                    data-id     ="'.$row["id_huesped"].'" 
                    data-nombre ="'.$row["apellido1"].' '.$row["apellido2"].' '.$row["nombre1"].' '.$row["nombre2"].'" 
                    href        ="#myModalDocumentos">
                  <i class="fa fa-clone" aria-hidden="true"></i>
                  Documentos</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>  
      '; 
    } 
  ),
);
 
$sql_details = array(
    'user' => $dbuser,
    'pass' => $dbpass,
    'db'   => $dbname,
    'host' => $server,
    'charset' => 'utf8' // Depending on your PHP and MySQL config, you may need this
);

require '../../../res/php/ssp.class.php';
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
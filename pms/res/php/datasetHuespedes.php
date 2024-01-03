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
        return `
        <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
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
                      data-id     ="$row["id_huesped"]}" 
                      data-nombre ="$row["nombre_completo"]}" 
                      href        ="#myModalModificaPerfilHuesped">
                      <i class="fa fa-address-card-o" aria-hidden="true"></i>
                      Modificar Perfil</a> 
                  </li>
                  <li>
                    <a  
                      data-toggle ="modal" 
                      data-id     ="$row["id_huesped"]}" 
                      data-nombre ="$row["nombre_completo"]}" 
                      href        ="#myModalReservasEsperadas">
                    <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                    Reservas</a>
                  </li>
                  <li> 
                    <a 
                    data-toggle ="modal" 
                    data-id     ="$row["id_huesped"]}" 
                    data-nombre ="$row["nombre_completo"]}" 
                    href        ="#myModalHistoricoReservas">
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                    Historico Reservas</a> 
                  </li>
                  <li>
                    <a 
                      data-toggle ="modal" 
                      data-id     ="$row["id_huesped"]}" 
                      data-nombre ="$row["nombre_completo"]}" 
                      href        ="#myModalDocumentos">
                    <i class="fa fa-clone" aria-hidden="true"></i>
                    Documentos</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>  
        `; 
        } 
    ),
);
 
// echo print_r($columns);
 
// $columns = ['identificacion','apellido1','apellido2','nombre1','nombre2','celular','email','edad'];
 
// SQL server connection information


/* $columns =  array(
    array({'db' => 'identificacion'}), 
    array({'db' => 'apellido1'}), 
    array({'db' => 'apellido2'}), 
    array({'db' => 'nombre1'}), 
    array({'db' => 'nombre2'}), 
    array({'db' => 'celular'}), 
    array({'db' => 'email'}), 
    array({'db' => 'edad'}), 
    array({"<div class='btn-group'><button type='button' class='btn btn-secondary' data-toggle='tooltip' data-placement='top' title='Modificar' id='btn_modificar'><i class='fas fa-pen'></i></button><button type='button' class='btn btn-success' data-toggle='tooltip' data-placement='top' title='Pagar' id='btn_pagarModal1'><i class='fas fa-money-bill-wave'></i></button></div>"})
), */

/* "columns":[
    {"data": "id_categoria"},
    {"data": "nombre"},
    {"data": "fecha"},
    {"defaultContent": "<button type='button' class='editar btn btn-primary'><i class='fa fa-pencil-square-o'></i></button> <button type='button' class='eliminar btn btn-danger' data-toggle='modal' data-target='#modalEliminar' ><i class='fa fa-trash-o'></i></button>"}                        

],
 */


/* 
lista = lista +
`<tr style='font-size:12px'>
<td width="22px">$row["identificacion"]}</td>
<td>$row["apellido1"]}</td>
<td>$row["apellido2"]}</td>
<td>$row["nombre1"]}</td>
<td>$row["nombre2"]}</td>
<td>$row["celular"]}</td>
<td>$row["email"]}</td>
<td>$row["edad"]}</td>
<td style="padding:3px;width: 13%">
<nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
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
                                           data-id     ="$row["id_huesped"]}" 
                                           data-nombre ="$row["nombre_completo"]}" 
                                           href        ="#myModalModificaPerfilHuesped">
               <i class="fa fa-address-card-o" aria-hidden="true"></i>
               Modificar Perfil</a> 
             </li>
             <li>
               <a  
                                           data-toggle ="modal" 
                                           data-id     ="$row["id_huesped"]}" 
                                           data-nombre ="$row["nombre_completo"]}" 
                                           href        ="#myModalReservasEsperadas">
               <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
               Reservas</a>
             </li>
             <li> 
               <a 
                                           data-toggle ="modal" 
                                           data-id     ="$row["id_huesped"]}" 
                                           data-nombre ="$row["nombre_completo"]}" 
                                           href        ="#myModalHistoricoReservas">
                 <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
               Historico Reservas</a> 
             </li>
             
             <li>
               <a 
                                           data-toggle ="modal" 
                                           data-id     ="$row["id_huesped"]}" 
                                           data-nombre ="$row["nombre_completo"]}" 
                                           href        ="#myModalDocumentos">
               <i class="fa fa-clone" aria-hidden="true"></i>
               Documentos</a>
             </li>
           </ul>
         </li>
       </ul>
     </div>
</nav>                                                  
 </td>
</tr>`; */





$sql_details = array(
    'user' => $dbuser,
    'pass' => $dbpass,
    'db'   => $dbname,
    'host' => $server,
    'charset' => 'utf8' // Depending on your PHP and MySQL config, you may need this
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
require '../../../res/php/ssp.class.php';
 
// require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
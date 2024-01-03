<?php

// require_once '../res/php/functionsHotel.php';

// $filahue   = 25;
// $reghues   = $hotel->getCantidadPerfiles();
// $companias = $hotel->getCompanias();
// $centros   = $hotel->getCentros();
// $paginas   = ceil($reghues / $filahue);
// $huespedes = $hotel->getPerfilHuespedes();


?>
<div class="content-wrapper" id="pantallaHuespedes">
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" name="edita" id="edita" value="0">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_PMS ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="huespedesPerfil">
            <input type="hidden" name="paginas" id="paginas" value="<?=$paginas?>">
            <input type="hidden" name="regishue" id="regishue" value="<?=$reghues?>">
            <h3 class="w3ls_head tituloPagina">
              <i class="fa-solid fa-users-viewfinder"></i>
              </i> Huespedes
            </h3>
          </div>
          <div class="col-md-6">
            <a class="btn btn-success pull-right" data-toggle="modal" data-reserva='0' href="#myModalAdicionaPerfil">
              <i class="fa fa-plus" aria-hidden="true"></i> Adicionar Huesped
            </a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div id="imprimeRegistroHotelero"></div>
        <div class="table-responsive">
          <table id="tablaHuespedes" class="table table-striped table-bordered table-condensed" style="width:100%">
            <thead class="centro b500">
              <tr>
                <td>Identificacion</td>
                <td>Huesped</td>
                <td>Huesped</td>
                <td>Huesped</td>
                <td>Huesped</td>
                <td>Celular</td>
                <td>Correo</td>
                <td>Edad</td>
                <td>Accion</td>                
              </tr>
            </thead>
            <tfoot></tfoot>
          </table>
        </div>
      </div>
      <div class="panel-footer"></div>
    </div>
  </section>
</div>

<?php
  include_once 'views/modal/modalHuespedes.php';
  include_once 'views/modal/modalFacturas.php';
  include_once 'views/modal/modalDocumentos.php';
  include_once 'views/modal/modalAcompanantes.php';
  
  
?>
<script>
  window.onload = function() {
    new DataTable('#tablaHuespedes', {
      lengthMenu: [50, 100, 200, 500],
      ajax: 'res/php/datasetHuespedes.php',
      processing: true,
      serverSide: true,
      iDisplayLength: 50,
      language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
        sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        oAria: {
          sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
          sSortDescending:
            ": Activar para ordenar la columna de manera descendente",
        },
      },
      columnDefs: [{
        targets: "_all",
        orderable: false
      }],
    });      
  };
</script>



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
              data-id     ="${data[i]["id_huesped"]}" 
              data-nombre ="${data[i]["nombre_completo"]}" 
              href        ="#myModalModificaPerfilHuesped">
              <i class="fa fa-address-card-o" aria-hidden="true"></i>
              Modificar Perfil</a> 
          </li>
          <li>
            <a  
              data-toggle ="modal" 
              data-id     ="${data[i]["id_huesped"]}" 
              data-nombre ="${data[i]["nombre_completo"]}" 
              href        ="#myModalReservasEsperadas">
            <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
            Reservas</a>
          </li>
          <li> 
            <a 
            data-toggle ="modal" 
            data-id     ="${data[i]["id_huesped"]}" 
            data-nombre ="${data[i]["nombre_completo"]}" 
            href        ="#myModalHistoricoReservas">
            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
            Historico Reservas</a> 
          </li>
          <li>
            <a 
              data-toggle ="modal" 
              data-id     ="${data[i]["id_huesped"]}" 
              data-nombre ="${data[i]["nombre_completo"]}" 
              href        ="#myModalDocumentos">
            <i class="fa fa-clone" aria-hidden="true"></i>
            Documentos</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>  
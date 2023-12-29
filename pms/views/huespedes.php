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
                <td>Celular</td>
                <td>Correo</td>
                <td>Edad</td>
                <td>Accion</td>                
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <div class="panel-footer">
        <div class="row">
        </div>
      </div>
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
      // alert('Page is loaded');
      $("#tablaHuespedes").DataTable({
         "processing": true,
         "serverSide": true,
         "sAjaxSource": "res/php/datasetHuespedes.php",
         "columnDefs":[{
             "data":null
         }]   
      }); 
    };
</script>

<?php

  require_once '../res/php/functionsHotel.php';
  
  $filahue   = 25;
  $reghues   = $hotel->getCantidadPerfiles();
  $companias = $hotel->getCompanias();
  $centros   = $hotel->getCentros();
  $paginas   = ceil($reghues / $filahue) ;
   
?>

<div class="content-wrapper" id="pantallaHuespedes"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row"> 
          <div class="col-md-6">
            <input type="hidden" name="edita" id="edita" value="0">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>"> 
            <input type="hidden" name="ubicacion" id="ubicacion" value="huespedesPerfil">
            <input type="hidden" name="paginas" id="paginas" value="<?=$paginas?>">
            <input type="hidden" name="regishue" id="regishue" value="<?=$reghues?>">
            <h3 class="w3ls_head tituloPagina"> <i class="fa fa-address-book" aria-hidden="true"></i> Huespedes </h3>
          </div>
          <div class="col-md-6" align="right">
            <a 
              class="btn btn-success"
              data-toggle="modal" 
              data-reserva='0'
              href="#myModalAdicionaPerfil">
              <i class="fa fa-plus" aria-hidden="true"></i>
               Adicionar Huesped
            </a>
          </div>
        </div>
      </div> 
      <div class="panel-body">
        <div id="imprimeRegistroHotelero"></div>
        <div class="row-fluid" style="padding:0 15px 15px 15px;">
          <div class="row">
            <div class="col-lg-6">
              <div class="input-group">
                <label for="">Mostrar 
                  <select name="numFiles" id="numFiles" onblur="traeTotalHuespedes(0,this.value)">
                    <option value="10">10</option>
                    <option value="25" selected="">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select> 
                  Entradas 
                </label>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="input-group">
                <input name="search" id="search" type="search"  class="form-control" style="height: 30px;text-transform: uppercase;" placeholder="Buscar Huesped">
                <span class="input-group-btn">
                  <button style="height: 30px;padding:4px 10px" class="btn btn-primary" type="button" onClick="buscarHuesped()" ><span class="glyphicon glyphicon-search" aria-hidden="true">
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive"> 
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
                <td>Edad</td>
                <td>Accion</td>
              </tr>
            </thead>
            <tbody id="listaHuespedes">
            </tbody>
          </table>
        </div>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="container-fluid pull-right" id="barraPaginas"></div>
        </div>
      </div>
    </div>
  </section> 
</div>


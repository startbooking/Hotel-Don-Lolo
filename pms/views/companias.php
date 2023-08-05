<?php

  require_once '../res/php/functionsHotel.php';

  $filahue = 25;
  $regcias = $hotel->getCantidadCompanias();
  $paginas = ceil($regcias / $filahue);

  ?> 

<div class="content-wrapper" id="pantallaCompanias"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row"> 
          <div class="col-lg-6 col-md-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">                  
            <input type="hidden" name="ubicacion" id="ubicacion" value="companias">
            <input type="hidden" name="paginas" id="paginas" value="<?php echo $paginas; ?>">
            <input type="hidden" name="regiscia" id="regiscia" value="<?php echo $regcias; ?>">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Compañia </h3>
          </div> 
          <div class="col-lg-6 col-md-6" style="text-align:right;">
            <a 
              class="btn btn-success"
              data-toggle="modal" 
              href="#myModalAdicionaCompania">
              <i class="fa fa-plus" aria-hidden="true"></i>
               Adicionar Compania
            </a>
          </div>
        </div>
      </div>
      <div class="panel-body" >
        <div class="datos_ajax_delete"></div>
        <div id="imprimeRegistroHotelero"></div>
        <div class="row-fluid" style="padding:0 15px 15px 15px;">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="input-group">
                <label for="">Mostrar 
                  <select name="numFiles" id="numFiles" onblur="traeTotalCompanias(0,this.value)">
                    <option value="10">10</option>
                    <option value="25" selected="">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select> 
                  Entradas 
                </label>
              </div>              
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="input-group"> 
                <input name="search" id="search" type="search" class="form-control" style="height: 30px;text-transform: uppercase;" placeholder="Busca Compania">
                <span class="input-group-btn">
                  <button style="height: 30px;padding:4px 10px" class="btn btn-primary" type="button" onClick="buscarCompania()" >
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>  
                  </button>
                </span>
              </div>                        
            </div>
          </div>
        </div>
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
                  <td>Tarifa</td>
                  <td>Accion</td>
                </tr>
              </thead>
              <tbody id="listaCompanias"></tbody>
            </table>
          </div>
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

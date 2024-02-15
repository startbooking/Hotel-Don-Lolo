<div class="content-wrapper" id="pantallaHuespedes">
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" name="editaPer" id="editaPer" value="0">
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
            <a class="btn btn-success pull-right btnAdiciona" data-toggle="modal" data-reserva='0' href="#myModalAdicionaPerfil">
              <i class="fa fa-plus" aria-hidden="true"></i> Adicionar Huesped
            </a> 
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div id="imprimeRegistroHotelero"></div>
        <div class="table-responsive">
          <table id="tablaHuespedes" class="table table-striped table-bordered table-condensed">
            <thead class="centro b500">
              <tr>
                <td>Identificacion</td>
                <td>Apellido 1</td>
                <td>Apellido 2</td>
                <td>Nombre 1</td>
                <td>Nombre 2</td>
                <td>Celular</td>
                <td>Correo</td>
                <td>Edad</td>
                <td style="width:13%;">Accion</td>                
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
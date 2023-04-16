<?php 
  $hoy    = substr(FECHA_PMS,5,5);
?>
 
    <div class="content-wrapper" id="pantallaFacturacion"> 
      <section class="content" id="listado">
        <div class="panel panel-success"> 
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="cuentadepositos" id="cuentadepositos" value="<?=CTA_DEPOSITO?>">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">              
                <input type="hidden" name="ubicacion" id="ubicacion" value="facturacionEstadia"> 
                <input type="hidden" name="folioActivo" id="folioActivo" value="1"> 
                <input type="hidden" name="ingreso" id="ingreso" value="1">
                <h3 class="w3ls_head tituloPagina"> <i class="fa fa-money icon" style="font-size:36px;color:black" ></i> Facturacion Huespedes</h3>
              </div>
            </div>
          </div>
          <div class="panel-body" id="paginaFacturacion">
            <div id="imprimeRegistroHotelero"></div>
          </div>
        </div>
      </section>
    </div>

<?php 
  $hoy    = substr(FECHA_PMS,5,5);
?>

    <div class="content-wrapper" id="pantallaLlegadas"> 
      <section class="content" style="margin-bottom: 40px">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-6">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">              
                <input type="hidden" name="ubicacion" id="ubicacion" value="llegadasDelDia.php">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-sign-in" aria-hidden="true"></i> Llegadas del Dia </h3>
              </div>
            </div>
          </div>
          <div class="panel-body" id="paginaLlegadas">
            <div id="imprimeRegistroHotelero"></div>
          </div>
        </div>
      </section>

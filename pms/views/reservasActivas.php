<?php  
  $hoy    = substr(FECHA_PMS,5,5);
?>

<div class="content-wrapper" id="pantallaReservas"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row"> 
          <div class="col-lg-6 col-md-6">
            <input type="hidden" name="editaRes" id="editaRes" value="0">
            <input type="hidden" name="cuentadepositos" id="cuentadepositos" value="<?=CTA_DEPOSITO?>"> 
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="reservasActivas">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-calendar"></i> Reservas </h3>
          </div> 
          <div class="col-lg-6 col-md-6" style="text-align:right;">
            <a 
              class="btn btn-success"  
              data-toggle="modal" 
              href="#myModalAdicionaReserva">
              <i class="fa fa-plus" aria-hidden="true"></i>
               Adicionar Reserva
            </a>
            <button class="btn btn-info" onclick="exportTableToExcel('tablaReservas')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
          </div> 
        </div>
      </div> 
      <div id="confirmaReserva"></div>
      <div class="panel-body" id="paginaReservas">
      </div>
    </div> 
  </section>
</div>

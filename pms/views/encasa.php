<?php 
  $hoy    = substr(FECHA_PMS,5,5);
?>

<div class="content-wrapper" id="pantallaenCasa"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-6"> 
            <input type="hidden" name="cuentadepositos" id="cuentadepositos" value="<?=CTA_DEPOSITO?>">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">              
            <input type="hidden" name="ubicacion" id="ubicacion" value="encasa">
            <h3 class="w3ls_head tituloPagina"> <i style="color:black;font-size:36px;" class="fa fa-home"></i> Huespedes En Casa </h3>
          </div>
          <div class="col-lg-6" align="right">
            <a style="margin:20px 0" type="button" class="btn btn-success" href="llegadasDelDia"> 
              <i class="fa fa-briefcase" aria-hidden="true"></i>
              Llegadas Del Dia
            </a>
            <button class="btn btn-info" onclick="exportTableToExcel('tablaReservas')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button> 

          </div>
        </div>  
      </div>
      <div class="panel-body" id="paginaenCasa">
      </div>
    </div>
  </section>
</div>

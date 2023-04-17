<?php

$tipomovi = $inven->getMovimientoCierre();

echo print_r($tipomovi);

if ($tipomovi == 0) {
    $movi = $inven->movimientoCierre();
}

$periodo = $inven->mesCerrar();

?>

<section class="content-wrapper" style="height: 780px;">
  <div class="content" style="margin-bottom: 50px">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-9"> 
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_POS; ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="cierreMes">
            <input type="hidden" name="pagina" id="pagina" value="cierreMes">
            <input type="hidden" name="periodo" id="periodo" value="<?php echo $periodo; ?>">
            <input type="hidden" name="contador" id="contador">
            <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Cierre Periodo </h3>
          </div>
        </div>   
      </div> 
      <div id="loader">
        
      </div>
      <form id="formCierreDiario" class="form-horizontal" action="javascript:cierreMes()" method="POST" enctype="multipart/form-data">
        <div class="panel-body">
          <div class="form -group">
            <div class="form-group">
              <label style="margin-top:8px" for="fechaAuditoria" class="control-label"> 
                <h3 id="fechaAuditoria" style="font-weight: 700;margin-top: 0;font-size:20px;color:brown;text-align: center"> Periodo a Cerrar <small class="badge btn btn-success" style="font-size:18px"> <?php echo str_pad($periodo, 2, '0', STR_PAD_LEFT); ?>  </small> 
               <?php echo nombreMes($periodo); ?> </h3>
              </label>
            </div>
          </div>                                
          <div class="container-fluid" id='procesosCierre' style="display:none">
            <div class="table-responsive">
            </div>      
          </div>
          <div id="aviso"></div>
          <div id="verInforme"></div>          
        </div>
        <div class="panel-footer" style="text-align: center">
          <a href="home" style="width: 20%" type="button" class="btn btn-warning"><i class="fa fa-home"></i> Regresar</a >
          <button style="width: 20%" type="submit" id="botonCierre" class="btn btn-primary"><i class="fa fa-arrow-circle-right"></i> Procesar</button>
        </div>  
      </form> 
    </div>
  </div>
</section>

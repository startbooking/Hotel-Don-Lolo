<?php 
  $fecha  = date('Y-m-d');
  $dia = strtotime('-1 day', strtotime($fecha));
  $ayer = date('Y-m-d', $dia);
  $inicial = date('Y-m-01', $dia);
?>
    <div class="content-wrapper"> 
      <div class="container-fluid">
        <div class="panel panel-success">
          <form action="" class="form-horizontal">
            <div class="panel-heading"> 
              <div class="row"> 
                <div class="col-lg-9 col-sm-9">
                  <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_FE?>">                  
                  <input type="hidden" name="ubicacion" id="ubicacion" value="informeFacturasRango">
                  <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Documento Soporte</h3>
                </div>
                <div class="col-lg-3 col-sm-3">
                  <button class="btn btn-success pull-right" type="submit"><i class="fa fa-print" aria-hidden="true"></i> Buscar</button>
                  <button class="btn btn-info  pull-right"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Nuevo Documento</button> 
                </div>
              </div>  
            </div>
            <div class="panel-body ">
              <div >
                <div class="form-group">
                  <label class="control-label col-md-1 pd0">Desde Fecha</label>
                  <div class="col-lg-2 col-md-2">
                    <input class="form-control" type="date" min="1" name="desdeFecha" id='desdeFecha' value='<?=$inicial ?>' max="<?=$ayer ?>">
                  </div>
                  <label class="control-label col-md-2">Hasta Fecha</label>
                  <div class="col-lg-2 col-md-2">
                    <input class="form-control" type="date" min="1" name="hastaFecha" id='hastaFecha' value='<?=$ayer ?>' max="<?=$ayer ?>">
                  </div>
                <!-- </div>
                <div class="form-group"> -->
                  <label class="control-label col-md-2">Desde Numero</label>
                  <div class="col-lg-1 col-md-1">
                    <input class="form-control" type="number" min="1" name="desdeNumero" id='desdeNumero' value=''>
                  </div>
                  <label class="control-label col-md-1">Hasta</label>
                  <div class="col-lg-1 col-md-1">
                    <input class="form-control" type="number" min="1" name="hastaNumero" id='hastaNumero' value=''>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-1 pd0">Huesped</label>
                  <div class="col-lg-5 col-md-5">
                    <input class="form-control" type="text" name="desdeHuesped" id='desdeHuesped' value=''>
                  </div>
                <!-- </div>
                <div class="form-group"> -->
                  <label class="control-label col-md-1">Empresa</label>
                  <div class="col-lg-5 col-md-5">
                    <input class="form-control" type="text" name="desdeEmpresa" id='desdeEmpresa' value=''>
                  </div>
                  <!-- <label class="control-label col-md-2">Forma de Pago</label> -->
                  
                </div>
              </div>              
            </div>
          </form>
          <div class="panel-footer">
            <div class="row-fluid">
              <div class="imprimeInforme"></div>
            </div>
          </div>
        </div>
        
      </div>
      <!-- <section class="content centrar">
      </section>   -->
    </div>

<?php 
  include_once 'views/modal/modalDocSoporte.php';  
?> 

<script src="<?php echo BASE_FE; ?>res/js/docsoporte.js"></script>

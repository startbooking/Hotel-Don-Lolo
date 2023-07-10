<?php 
  $hoy  = FECHA_PMS;
  $ayer = strtotime ( '-1 day' , strtotime ( $hoy ) ) ;
  $ayer = date ('Y-m-d' , $ayer );
  $inicial = date('Y-m-01', $ayer);
  

?>
    <div class="content-wrapper"> 
      <section class="content centrar">
        <div class="container">
          <div class="panel panel-success">
            <div class="panel-heading"> 
              <div class="row"> 
                <div class="col-lg-9">
                  <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">                  
                  <input type="hidden" name="ubicacion" id="ubicacion" value="informeRecibosCajaRango">
                  <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Historico de Recibos de Caja</h3>
                </div>
                <div class="col-md-3">
                  <button class="btn btn-success" type="buttom" onclick='recibosPorFecha()'><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                  <button class="btn btn-info" onclick="exportTableToExcel('tablaFacturas')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button> 
                </div>
              </div>  
            </div>
            <div class="panel-body ">
              <div class="form-horizontal">
                <div class="form-group">
                  <label class="control-label col-md-2">Desde Fecha</label>
                  <div class="col-lg-3 col-md-3">
                    <input class="form-control" type="date" min="1" name="desdeFecha" id='desdeFecha' value='<?=$inicial ?>' max="<?=$ayer ?>">
                  </div>
                  <label class="control-label col-md-2">Hasta Fecha</label>
                  <div class="col-lg-3 col-md-3">
                    <input class="form-control" type="date" min="1" name="hastaFecha" id='hastaFecha' value='<?=$ayer ?>' max="<?=$ayer ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Desde Numero</label>
                  <div class="col-lg-2 col-md-2">
                    <input class="form-control" type="number" min="1" name="desdeNumero" id='desdeNumero' value=''>
                  </div>
                  <label class="control-label col-md-2">Hasta Numero</label>
                  <div class="col-lg-2 col-md-2">
                    <input class="form-control" type="number" min="1" name="hastaNumero" id='hastaNumero' value=''>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Huesped</label>
                  <div class="col-lg-6 col-md-6">
                    <input class="form-control" type="text" name="desdeHuesped" id='desdeHuesped' value=''>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="control-label col-md-2">Empresa</label>
                  <div class="col-lg-6 col-md-6">
                    <input class="form-control" type="text" name="desdeEmpresa" id='desdeEmpresa' value=''>
                  </div>
                </div> -->
                <div class="form-group">
                  <label class="control-label col-md-2">Forma de Pago</label>
                  <div class="col-lg-6 col-md-6">
                    <select name="desdeFormaPago" id="desdeFormaPago"  class="form-control" style="padding:4px 12px">
                      <option value=""></option>
                      <?php 
                      $formas = $hotel->getCodigosConsumos(3);
                      foreach ($formas as $forma) { ?>
                        <option value="<?=$forma['id_cargo']?>"><?=$forma['descripcion_cargo']?></option>
                        <?php 
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel-footer">
              <div class="row-fluid">
                <div class="imprimeInforme"></div>
              </div>
            </div>
          </div>
          
        </div>
      </section>  
    </div>

<?php 
  include_once 'views/modal/modalInformesRecibosCaja.php';
?>
<?php 
  $usuario = $_POST['usuario'];
  $usuario_id = $_POST['usuario_id'];
  $hoy  = FECHA_PMS;
  $ayer = strtotime ( '-1 day' , strtotime ( $hoy ) ) ;
  $ayer = date ('Y-m-d' , $ayer );
?>

    <div class="content-wrapper"> 
      <section class="content centrar">
        <div class="container"> 
          <div class="panel panel-success">
            <div class="panel-heading"> 
              <div class="row">
                <div class="col-lg-9">
                  <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="<?=$usuario?>">
                  <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">                  
                  <input type="hidden" name="ubicacion" id="ubicacion" value="informeFacturasRango">
                  <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Historico de Reservas</h3>
                </div>
                <div class="col-md-3">
                  <button class="btn btn-success" type="buttom" onclick='reservasPorFecha()'><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                  <button class="btn btn-info" onclick="exportTableToExcel('tablaReserva')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button> 
                </div>
              </div>   
            </div>
            <div class="panel-body ">
              <div class="form-horizontal">
                <div class="form-group">
                  <label class="control-label col-md-2">Desde Fecha</label>
                  <div class="col-lg-3 col-md-3">
                    <input class="form-control" type="date" min="1" name="desdeFecha" id='desdeFecha' value='<?=$ayer?>' max="<?=$ayer?>">
                  </div>
                  <label class="control-label col-md-2">Hasta Fecha</label>
                  <div class="col-lg-3 col-md-3">
                    <input class="form-control" type="date" min="1" name="hastaFecha" id='hastaFecha' value='<?=$ayer?>' max="<?=$ayer?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Huesped</label>
                  <div class="col-lg-6 col-md-6">
                    <input class="form-control" type="text" name="desdeHuesped" id='desdeHuesped' value=''>
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
  include_once 'views/modal/modalInformesfacturas.php';
?>
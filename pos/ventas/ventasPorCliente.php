<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  $idamb  = $_POST['idamb'];
  $nomamb = $_POST['amb'];
  $user   = $_POST['user'];
  $iduser = $_POST['iduser'];
  $impto  = $_POST['impto'];
  $prop   = $_POST['prop'];
  $logo   = $_POST['logo'];
  $fecha  = $_POST['fecha'];
 
?>
  <section class="content centrar">
    <div class="container">
      <div class="panel panel-success">
        <div class="panel-heading"> 
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="<?=$user?>">
              <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">                  
              <input type="hidden" name="ubicacion" id="ubicacion" value="informeFacturasRango">
              <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Historico Ventas por Cliente</h3> 
            </div>
            <div class="col-md-6 pull-right">
              <div class="btn-group pull-right" style="margin-top: 15px;">
                <button class="btn btn-success" type="buttom" onclick='historicoVentasClientes()'><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                <button class="btn btn-info" onclick="exportTableToExcel('facturasClientes')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button> 
              </div>
            </div>
          </div>  
        </div>
        <div class="panel-body ">
          <div class="form-horizontal">
            <div class="form-group">
              <label class="control-label col-md-2">Desde Fecha</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control" type="date" min="1" name="desdeFecha" id='desdeFecha' value='' style="line-height:16px">
              </div>
              <label class="control-label col-md-2">Hasta Fecha</label>
              <div class="col-lg-3 col-md-3">
                <input class="form-control" type="date" min="1" name="hastaFecha" id='hastaFecha' value='' style="line-height:16px">
              </div>
            </div>
            <!--
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
          -->
            <div class="form-group">
              <label class="control-label col-md-2">Cliente</label>
              <div class="col-lg-6 col-md-6">
                <select name="desdeCliente" id="desdeCliente"  class="form-control" style="padding:4px 12px">
                  <option value=""></option>
                  <?php 
                  $clientes = $pos->getClientes();
                  foreach ($clientes as $cliente) { ?>
                    <option value="<?=$cliente['id_huesped']?>"><?=$cliente['nombre_completo']?></option>
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
<?php 
  /// include_once 'modal/modalInformesfacturas.php';
?>
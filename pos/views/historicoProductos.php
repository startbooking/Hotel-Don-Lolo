<?php
require '../../res/php/titles.php';
require '../../res/php/app_topPos.php';

$idamb = $_POST['id'];
$nomamb = $_POST['amb'];
$user = $_POST['user'];
$iduser = $_POST['iduser'];
$impto = $_POST['impto'];
$prop = $_POST['prop'];
$logo = $_POST['logo'];
$fecha = $_POST['fecha'];

$dia = strtotime('-1 day', strtotime($fecha));
$ayer = date('Y-m-d', $dia);
$inicial = date('Y-m-01', $dia);

?>
<section class="content centrar">
  <div class="container">
    <div class="panel panel-success"> 
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="<?php echo $user; ?>">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="historicoProductos">
            <h3 class="w3ls_head tituloPagina">
              <i style="color:black;font-size:36px;" class="fa fa-industry"></i> Historico Productos
            </h3>
          </div>
          <div class="col-md-6">
            <div class="btn-group pull-right" style="display:flex;">
              <button class="btn btn-success btnTitle" type="buttom" onclick='historicoProductos()'><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
              <button id="exporta" class="btn btn-info btnTitle" type="buttom" disabled onclick="exportTableToExcel('dataProductos')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar Excel</button>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body ">
        <div class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-2">Desde Fecha</label>
            <div class="col-lg-3 col-md-3">
              <input class="form-control" type="date" min="1" name="desdeFecha" id='desdeFecha' value='<?php echo $inicial; ?>' style="line-height:16px" required>
            </div>
            <label class="control-label col-md-2">Hasta Fecha</label>
            <div class="col-lg-3 col-md-3">
              <input class="form-control" type="date" min="1" name="hastaFecha" id='hastaFecha' value='<?php echo $ayer; ?>' style="line-height:16px" required>
            </div>
          </div>
          <div class="imprimeInforme" style="margin-top:20px;">
            <object type="application/pdf" id="verInforme" width="100%" height="500" data=""></object>
          </div>
          <div class="table-responsive"> 
            <table id="dataProductos" class="table table-bordered" style="display:none">
              <thead>
                <tr class="warning">
                  <td>Producto</td>
                  <td>Cantidad</td>
                  <td>Valor</td>
                  <td>Descuento</td>
                  <td>Total</td>
                  <td>Costo</td>
                  <td>Total Costo</td>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <div class="row-fluid">
        </div>
      </div>
    </div>

  </div>
</section>
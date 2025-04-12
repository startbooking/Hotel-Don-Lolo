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
            <input type="hidden" name="ubicacion" id="ubicacion" value="informeFacturasRango">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Historico de Facturas</h3>
          </div>
          <div class="col-md-6">

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
            <label class="control-label col-md-1">Hasta </label>
            <div class="col-lg-3 col-md-3">
              <input class="form-control" type="date" min="1" name="hastaFecha" id='hastaFecha' value='<?php echo $ayer; ?>' style="line-height:16px" required>
            </div>
            <div class="btn-group pull-right" style="display:flex;">
              <button class="btn btn-success" type="buttom" onclick='facturasPorFecha()'><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
              <button class="btn btn-info" onclick="exportTableToExcel('tablaFacturas')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Desde Numero</label>
            <div class="col-lg-2 col-md-2">
              <input class="form-control" type="number" min="1" name="desdeNumero" id='desdeNumero' value=''>
            </div>
            <label class="control-label col-md-1">Hasta</label>
            <div class="col-lg-2 col-md-2">
              <input class="form-control" type="number" min="1" name="hastaNumero" id='hastaNumero' value=''>
            </div>
            <label class="control-label col-md-2">Forma de Pago</label>
            <div class="col-lg-3 col-md-3">
              <select name="desdeFormaPago" id="desdeFormaPago" class="form-control" style="padding:4px 12px">
                <option value=""></option>
                <?php
                $formas = $pos->getFormasdePago();
                foreach ($formas as $forma) { ?>
                  <option value="<?php echo $forma['id_pago']; ?>"><?php echo $forma['descripcion']; ?></option>
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
include_once 'modal/modalInformesfacturas.php';
?>
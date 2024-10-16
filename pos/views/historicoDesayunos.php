<?php
require '../../res/php/app_topPos.php';

$ambientes = $pos->getAmbientes();


extract($_POST);

$dia = strtotime('-1 day', strtotime($fecha_auditoria	));
$ayer = date('Y-m-d', $dia);
$inicial = date('Y-m-01', $dia);

?>
<section class="content centrar">
  <div class="container">
    <div class="panel panel-success">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="<?php echo $usuario; ?>">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
            <input type="hidden" name="ubicacion" id="ubicacion" value="historicoDesayunos">
            <h3 class="w3ls_head tituloPagina">
              <i style="color:black;font-size:36px;" class="fa fa-industry"></i> Historico Planilla Desayunos
            </h3>
          </div>
          <div class="col-md-6">
            <div class="btn-group pull-right" style="display:flex;">
              <button class="btn btn-success btnTitle" type="buttom" onclick='historicoDesayunos()'><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
            </div>
          </div>
        </div>
      </div> 
      <div class="panel-body ">
        <div class="container-fluid">
          <div class="form-horizontal">
            <div class="form-group">
              <label class="control-label col-md-2">Ambiente</label>
              <div class="col-lg-3 col-md-3">
                <select name="ambiente" id="ambiente" class="form-control" required>
                  <option value="">Seleccione el Ambiente</option>
                  <?php 
                    foreach ($ambientes as $ambiente) { ?> 
                      <option value="<?=$ambiente['id_ambiente']?>" 
                      <?php 
                      if($id_ambiente == $ambiente['id_ambiente']) { ?>
                        selected
                      <?php
                      }
                      ?>
                      ><?=$ambiente['nombre']?></option>
                      <?php 
                    }
                  ?>
                </select>
              </div>
            </div>
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
          </div>
        </div>
        <div class="container-fluid">
          <div class="col-lg-6">
            <div class="table-responsive"> 
              <table id="dataDesayunos" class="table table-bordered apaga">
                <thead>
                  <tr class="warning centro">
                    <td>Fecha</td>
                    <td>Desayunos</td>
                    <td>Accion</td>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-lg-6">
            <div id="muestraDesayunos">
              <h3 class="w3ls_head tituloPagina" style="font-size:14px; padding:5px;margin-bottom:10px;font-weight:bold;"></h3>
              <object id="verDesayuno" width="100%" height="500" data=""></object> 
            </div>
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
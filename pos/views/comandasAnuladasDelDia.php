<?php
require '../../res/php/app_topPos.php';

$idamb = $_POST['idamb'];
$prefijo = $_POST['pref'];
$tipoUsr = $_POST['tipousr'];
$nomamb = $_POST['nomamb'];
$user = $_POST['user'];

$comandas = $pos->getComandasActivas($idamb, 'X');

?>
<div class="row-fluid">
  <div class="content-fluid" style="margin-bottom: 50px">
    <div class="panel panel-success">
      <div class="panel-heading">
        <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_PMS; ?>">
        <input type="hidden" name="ubicacion" id="ubicacion" value="facturasDelDia">
        <input type="hidden" name="pasos" id="pasos">
        <h3 class="w3ls_head tituloPagina"> <i class="fa fa-tachometer" style="font-size:36px;color:black"></i> Comandas Anuladas del Dia</h3>
      </div>
      <div class="datos_ajax_delete"></div>
      <form id="formCierreDiario" class="form-horizontal" action="javascript:buscaFacturas()" method="POST" enctype="multipart/form-data">
        <div class="panel-body">
          <div class="row">
            <?php
            $regis = count($comandas);
            if ($regis == 0) { ?>
              <div class="container-fluid">
                <h4 class="bg-red-gradient" style="padding:10px;text-align: center;font-weight: 600;width: 30%">Sin Comandas Anuladas En el Dia <span style="font-size:16px;font-weight: 600;font-family: 'ubuntu'"></span></h4>
              </div>
            <?php
            } else { ?>
              <div class="col-lg-6" id="muestraResultado" style="font-size:12px">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr class="warning">
                        <td>Comanda</td>
                        <td>Fecha Comanda - Hora</td>
                        <td>Nro Mesa</td>
                        <td>Usuario</td>
                        <td>Motivo Anulacion</td>
                        <td>Accion</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($comandas as $factura) { ?>
                        <tr style='font-size:12px'>
                          <td><?php echo $factura['comanda']; ?></td>
                          <td><?php echo $factura['fecha_comanda_anulada']; ?></td>
                          <td><?php echo $factura['mesa']; ?></td>
                          <td><?php echo $factura['usuario_anula']; ?></td>
                          <td><?php echo $factura['motivo_anulada']; ?></td>
                          <td class="centro">
                            <button class="btn btn-warning btn-xs" onclick="verComanda('comandaCocina_<?php echo $prefijo; ?>_<?php echo $factura['comanda']; ?>.pdf')" type="button"><i class="fa fa-building-o" aria-hidden="true" title="Ver Comanda Cocina"></i></button>
                          </td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            <?php
            }
            ?>
            <div class="col-lg-6" id="verCargosFactura"></div>
            <div class="col-lg-6" id="Factura">
              <object id="verFactura" width="100%" height="500" data=""></object>
            </div>
          </div>
        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
              <div class="col-xs-12" style="padding:0">
                <a type="button" class="btn btn-warning btn-block" onclick="getSeleccionaAmbiente(<?php echo $idamb; ?>)"><i class="fa fa-reply"></i> Regresar</a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
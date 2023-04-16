<?php 

  require '../../../../res/php/titles.php';
  require '../../../../res/php/app_topHotel.php'; 

  $fecha   =  $_POST['fecha'];
  $idamb   =  $_POST['idamb'];
  $prefijo =  $_POST['prefijo'];
  // $auditorias = $hotel->getBuscaAuditoriaFecha(); 
?>

<div class="table-responsive">
  <input type="hidden" name="fechaaudi" id="fechaaudi" value="<?=$fecha?>">
  <table id="example1" class="table table-bordered">
    <thead>
      <tr class="warning">
        <td>Informe</td>
        <td>Accion</td>
      </tr>
    </thead>
    <tbody>
      <tr style='font-size:12px'>
        <td style="padding:3px 5px">Balance Diario</td>
        <td style="padding:3px 5px" align="center">
          <button class="btn btn-info btn-xs" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" onclick="verAuditoria('Informe_Diario_Gerencia_<?=$prefijo.'_'.$fecha?>.pdf')"></i></button>
        </td>
      </tr>
      <tr style='font-size:12px'>
        <td style="padding:3px 5px">Ventas del Dia</td>
        <td style="padding:3px 5px" align="center">
          <button class="btn btn-info btn-xs" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" onclick="verAuditoria('Balance_diario_<?=$prefijo.'_'.$fecha?>.pdf')"></i></button>
        </td>
      </tr>
      <tr style='font-size:12px'>
        <td style="padding:3px 5px">Ventas Por Productos</td>
        <td style="padding:3px 5px" align="center">
          <button class="btn btn-info btn-xs" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" onclick="verAuditoria('ventasProductos_<?=$prefijo.'_'.$fecha?>.pdf')"></i></button>
        </td>
      </tr>
      <tr style='font-size:12px'>
        <td style="padding:3px 5px">Ventas Por Grupo de Productos</td>
        <td style="padding:3px 5px" align="center">
          <button class="btn btn-info btn-xs" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" onclick="verAuditoria('ventasGrupos_<?=$prefijo.'_'.$fecha?>.pdf')"></i></button>
        </td>
      </tr>
      <tr style='font-size:12px'>
        <td style="padding:3px 5px">Acumulado de Ventas Por Productos</td>
        <td style="padding:3px 5px" align="center">
          <button class="btn btn-info btn-xs" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" onclick="verAuditoria('acumuladoDiario_<?=$prefijo.'_'.$fecha?>.pdf')"></i></button>
        </td>
      </tr>
      <tr style='font-size:12px'>
        <td style="padding:3px 5px">Acumulado de Ventas Por Grupo de Productos</td>
        <td style="padding:3px 5px" align="center">
          <button class="btn btn-info btn-xs" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" onclick="verAuditoria('acumuladoDiarioGrupos_<?=$prefijo.'_'.$fecha?>.pdf')"></i></button>
        </td>
      </tr>
      <tr style='font-size:12px'>
        <td style="padding:3px 5px">Acumulado Formas de Pago</td>
        <td style="padding:3px 5px" align="center">
          <button class="btn btn-info btn-xs" type="button"><i class="fa fa-file-pdf-o" aria-hidden="true" onclick="verAuditoria('acumuladoDiarioPagos_<?=$prefijo.'_'.$fecha?>.pdf')"></i></button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

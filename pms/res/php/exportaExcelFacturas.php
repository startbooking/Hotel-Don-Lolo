<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Historico de Facturas</title>
  <head>
  <body>
    <?php
      require '../../../res/php/titles.php';
      require '../../../res/php/app_topHotel.php'; 
      
      $desdeFe = $_POST['desdeFe']; 
      $hastaFe = $_POST['hastaFe'];
      $desdeNu = $_POST['desdeNu'];
      $hastaNu = $_POST['hastaNu'];
      $huesped = $_POST['huesped'];
      $empresa = $_POST['empresa'];
      $formaPa = $_POST['formaPa'];

      if($empresa!=''){
        $sele = "SELECT companias.empresa, codigos_vta.descripcion_cargo, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, historico_cargos_pms.habitacion_cargo, historico_cargos_pms.tipo_factura, historico_cargos_pms.id_codigo_cargo, historico_cargos_pms.id_perfil_factura, historico_cargos_pms.factura_numero, historico_cargos_pms.numero_reserva, historico_cargos_pms.factura_anulada, historico_cargos_pms.id_usuario_factura, historico_cargos_pms.total_consumos, historico_cargos_pms.total_impuesto, historico_cargos_pms.total_pagos, historico_cargos_pms.fecha_factura, historico_cargos_pms.fecha_sistema_cargo FROM huespedes, historico_cargos_pms, codigos_vta, companias WHERE ";
          $filtro = "huespedes.id_huesped = historico_cargos_pms.id_huesped AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND factura=1 and tipo_factura = 2 AND companias.id_compania = historico_cargos_pms.id_perfil_factura";
      }else{
        $sele = "SELECT codigos_vta.descripcion_cargo, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, historico_cargos_pms.habitacion_cargo, historico_cargos_pms.tipo_factura, historico_cargos_pms.id_codigo_cargo, historico_cargos_pms.id_perfil_factura, historico_cargos_pms.factura_numero, historico_cargos_pms.numero_reserva, historico_cargos_pms.factura_anulada, historico_cargos_pms.id_usuario_factura, historico_cargos_pms.total_consumos, historico_cargos_pms.total_impuesto, historico_cargos_pms.total_pagos, historico_cargos_pms.fecha_factura, historico_cargos_pms.fecha_sistema_cargo FROM huespedes, historico_cargos_pms, codigos_vta WHERE ";
          $filtro = "huespedes.id_huesped = historico_cargos_pms.id_huesped AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND factura=1";
      }

      $sele2 = " ORDER BY historico_cargos_pms.factura_numero";

      if($desdeFe!='' && $hastaFe!= ''){
        $filtro = $filtro." AND fecha_factura >='$desdeFe' AND fecha_factura <= '$hastaFe'";
      }elseif($desdeFe=='' && $hastaFe!= ''){
        $filtro = $filtro." AND fecha_factura <= '$hastaFe'";
      }elseif($desdeFe!='' && $hastaFe== ''){
        $filtro = $filtro." AND fecha_factura = '$desdeFe'";
      }

      if($desdeNu!='' && $hastaNu!= ''){
        $filtro = $filtro." AND factura_numero >='$desdeNu' AND factura_numero <= '$hastaNu'";
      }elseif($desdeNu=='' && $hastaNu!= ''){
        $filtro = $filtro." AND factura_numero <= '$hastaNu'";
      }elseif($desdeNu!='' && $hastaNu== ''){
        $filtro = $filtro." AND factura_numero = '$desdeNu'";
      }

      if($huesped!=''){
        $filtro = $filtro." AND nombre_completo LIKE '%$huesped%'";
      }

      if($empresa!=''){
        $filtro = $filtro." AND empresa LIKE '%$empresa%'";
      }

      if($formaPa!=''){
        $filtro = $filtro." AND id_codigo_cargo = '$formaPa'";
      }

      
      $query    = $sele.$filtro.$sele2;

      $facturas = $hotel->getFacturasPorRango($query);

      $arquivo = 'historicoFacturas.xls';

      $html= '
      <div class="table-responsive" style="padding:0"> 
        <div class="row-fluid" style="padding:0">
          <table id="example1" class="table table-bordered">
            <thead>
              <tr class="warning">
                <td>Factura</td>
                <td>Huesped</td> 
                <td>Fecha Factura</td>
                <td>Forma de Pago</td>
                <td>Valor</td>
                <td>Impuesto</td>
                <td>Pago</td>
                <td>Estado</td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <div class="col-lg-6" style="padding:0"></div>
        </div>
      </div>';

      header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
      header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
      header ("Cache-Control: no-cache, must-revalidate");
      header ("Pragma: no-cache");
      header ("Content-type: application/x-msexcel");
      header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
      header ("Content-Description: PHP Generated Data" );

      echo $html;
    exit; ?>
  </body>
</html> 


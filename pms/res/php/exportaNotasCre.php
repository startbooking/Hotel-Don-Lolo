<?php
  require_once '../../../res/php/titles.php';
  require_once '../../../res/php/app_topHotel.php';

  $desde = $_POST['desde'];
  $hasta = $_POST['hasta'];

  $query = "SELECT cargosNC.id_cargo, codigos_vta.descripcion_cargo, codigos_vta.cuenta_puc, codigos_vta.descripcion_contable, codigos_vta.centroCosto, codigos_vta.idRetencion, SUM(cargosNC.monto_cargo) AS monto, SUM(cargosNC.pagos_cargos) AS pagos, SUM(cargosNC.impuesto) AS impto, SUM(cargosNC.valor_cargo) AS total, SUM(cargosNC.cantidad_cargo) AS cantidad, cargosNC.valorUnitario AS unitario, cargosNC.valorUnitario, cargosNC.codigo_impto, cargosNC.habitacion_cargo, cargosNC.id_codigo_cargo, cargosNC.tipo_factura, cargosNC.id_perfil_factura, cargosNC.factura, cargosNC.factura_numero, cargosNC.numero_reserva, cargosNC.referencia_cargo, cargosNC.factura_anulada, cargosNC.id_usuario_factura, cargosNC.total_consumos, cargosNC.total_impuesto, cargosNC.total_pagos, cargosNC.fecha_factura, year(cargosNC.fecha_factura) as anio, cargosNC.fecha_sistema_cargo, SUM(cargosNC.reteiva) AS reteiva, SUM(cargosNC.reteica) AS reteica, SUM(cargosNC.retefuente) AS retefuente, SUM(cargosNC.basereteiva) AS baseiva, SUM(cargosNC.basereteica) AS baseica, SUM(cargosNC.baseretefuente) AS basefuent FROM cargosNC, codigos_vta WHERE cargosNC.perfil_factura = 1 AND codigos_vta.id_cargo = cargosNC.id_codigo_cargo AND cargosNC.fecha_factura >= '$desde' AND cargosNC.fecha_factura <= '$hasta' GROUP BY cargosNC.factura_numero, cargosNC.id_codigo_cargo ORDER BY cargosNC.factura_numero";


  $queryIVA = "SELECT cargosNC.id_cargo, codigos_vta.descripcion_cargo, codigos_vta.cuenta_puc, codigos_vta.descripcion_contable, codigos_vta.centroCosto, sum(cargosNC.impuesto) as impuesto, cargosNC.codigo_impto, cargosNC.habitacion_cargo, cargosNC.id_codigo_cargo, cargosNC.tipo_factura, cargosNC.id_perfil_factura, cargosNC.factura, cargosNC.factura_numero, cargosNC.numero_reserva, cargosNC.referencia_cargo, cargosNC.factura_anulada, cargosNC.id_usuario_factura, cargosNC.total_consumos, cargosNC.total_impuesto, cargosNC.total_pagos, cargosNC.fecha_factura, year(cargosNC.fecha_factura) as anio, cargosNC.fecha_sistema_cargo FROM cargosNC, codigos_vta WHERE cargosNC.perfil_factura = 1 AND codigos_vta.id_cargo = cargosNC.codigo_impto AND cargosNC.fecha_factura >= '$desde' AND cargosNC.fecha_factura <= '$hasta' AND cargosNC.codigo_impto <> '' GROUP BY cargosNC.factura_numero, cargosNC.codigo_impto ORDER BY cargosNC.factura_numero";


  $queryRteFte = "SELECT cargosNC.id_cargo, codigos_vta.descripcion_cargo, codigos_vta.cuenta_puc, codigos_vta.descripcion_contable, codigos_vta.centroCosto, codigos_vta.idRetencion, SUM(cargosNC.monto_cargo) AS monto, SUM(cargosNC.pagos_cargos) AS pagos, SUM(cargosNC.impuesto) AS impto, SUM(cargosNC.valor_cargo) AS total, SUM(cargosNC.cantidad_cargo) AS cantidad, cargosNC.valorUnitario AS unitario, cargosNC.valorUnitario, cargosNC.codigo_impto, cargosNC.habitacion_cargo, cargosNC.id_codigo_cargo, cargosNC.tipo_factura, cargosNC.id_perfil_factura, cargosNC.factura, cargosNC.factura_numero, cargosNC.numero_reserva, cargosNC.referencia_cargo, cargosNC.factura_anulada, cargosNC.id_usuario_factura, cargosNC.total_consumos, cargosNC.total_impuesto, cargosNC.total_pagos, cargosNC.fecha_factura, year(cargosNC.fecha_factura) as anio, cargosNC.fecha_sistema_cargo, SUM(cargosNC.reteiva) AS reteiva, SUM(cargosNC.reteica) AS reteica, SUM(cargosNC.retefuente) AS retefuente, SUM(cargosNC.basereteiva) AS baseiva, SUM(cargosNC.basereteica) AS baseica, SUM(cargosNC.baseretefuente) AS basefuent FROM cargosNC, codigos_vta WHERE cargosNC.perfil_factura = 1 AND codigos_vta.id_cargo = cargosNC.id_codigo_cargo AND cargosNC.fecha_factura >= '$desde' AND cargosNC.fecha_factura <= '$hasta' AND cargosNC.factura_anulada = 0 AND cargosNC.factura = 1 AND cargosNC.retefuente > 0 GROUP BY cargosNC.factura_numero, cargosNC.id_codigo_cargo ORDER BY cargosNC.factura_numero";

  $queryRteIva = "SELECT cargosNC.id_cargo, codigos_vta.descripcion_cargo, codigos_vta.cuenta_puc, codigos_vta.descripcion_contable, codigos_vta.centroCosto, codigos_vta.idRetencion, SUM(cargosNC.monto_cargo) AS monto, SUM(cargosNC.pagos_cargos) AS pagos, SUM(cargosNC.impuesto) AS impto, SUM(cargosNC.valor_cargo) AS total, SUM(cargosNC.cantidad_cargo) AS cantidad, cargosNC.valorUnitario AS unitario, cargosNC.valorUnitario, cargosNC.codigo_impto, cargosNC.habitacion_cargo, cargosNC.id_codigo_cargo, cargosNC.tipo_factura, cargosNC.id_perfil_factura, cargosNC.factura, cargosNC.factura_numero, cargosNC.numero_reserva, cargosNC.referencia_cargo, cargosNC.factura_anulada, cargosNC.id_usuario_factura, cargosNC.total_consumos, cargosNC.total_impuesto, cargosNC.total_pagos, cargosNC.fecha_factura, year(cargosNC.fecha_factura) as anio, cargosNC.fecha_sistema_cargo, SUM(cargosNC.reteiva) AS reteiva, SUM(cargosNC.reteica) AS reteica, SUM(cargosNC.retefuente) AS retefuente, SUM(cargosNC.basereteiva) AS baseiva, SUM(cargosNC.basereteica) AS baseica, SUM(cargosNC.baseretefuente) AS basefuent FROM cargosNC, codigos_vta WHERE cargosNC.perfil_factura = 1 AND codigos_vta.id_cargo = cargosNC.id_codigo_cargo AND cargosNC.fecha_factura >= '$desde' AND cargosNC.fecha_factura <= '$hasta' AND cargosNC.factura_anulada = 0 AND cargosNC.factura = 1 AND cargosNC.reteiva > 0 GROUP BY cargosNC.factura_numero, cargosNC.id_codigo_cargo ORDER BY cargosNC.factura_numero";

  $queryRteIca = "SELECT cargosNC.id_cargo, codigos_vta.descripcion_cargo, codigos_vta.cuenta_puc, codigos_vta.descripcion_contable, codigos_vta.centroCosto, codigos_vta.idRetencion, SUM(cargosNC.monto_cargo) AS monto, SUM(cargosNC.pagos_cargos) AS pagos, SUM(cargosNC.impuesto) AS impto, SUM(cargosNC.valor_cargo) AS total, SUM(cargosNC.cantidad_cargo) AS cantidad, cargosNC.valorUnitario AS unitario, cargosNC.valorUnitario, cargosNC.codigo_impto, cargosNC.habitacion_cargo, cargosNC.id_codigo_cargo, cargosNC.tipo_factura, cargosNC.id_perfil_factura, cargosNC.factura, cargosNC.factura_numero, cargosNC.numero_reserva, cargosNC.referencia_cargo, cargosNC.factura_anulada, cargosNC.id_usuario_factura, cargosNC.total_consumos, cargosNC.total_impuesto, cargosNC.total_pagos, cargosNC.fecha_factura, year(cargosNC.fecha_factura) as anio, cargosNC.fecha_sistema_cargo, SUM(cargosNC.reteiva) AS reteiva, SUM(cargosNC.reteica) AS reteica, SUM(cargosNC.retefuente) AS retefuente, SUM(cargosNC.basereteiva) AS baseiva, SUM(cargosNC.basereteica) AS baseica, SUM(cargosNC.baseretefuente) AS basefuent FROM cargosNC, codigos_vta WHERE cargosNC.perfil_factura = 1 AND codigos_vta.id_cargo = cargosNC.id_codigo_cargo AND cargosNC.fecha_factura >= '$desde' AND cargosNC.fecha_factura <= '$hasta' AND cargosNC.factura_anulada = 0 AND cargosNC.factura = 1 AND cargosNC.reteica > 0 GROUP BY cargosNC.factura_numero, cargosNC.id_codigo_cargo ORDER BY cargosNC.factura_numero";

  $facturas = $hotel->getFacturasPorRango($query);
  $retefuente = $hotel->getFacturasPorRango($queryRteFte);
  $reteiva = $hotel->getFacturasPorRango($queryRteIva);
  $reteica = $hotel->getFacturasPorRango($queryRteIca);
  $impuestos = $hotel->getFacturasPorRango($queryIVA);

  $vacio = '';

  $infoRteFTE = $hotel->traeRetenciones(1) ;
  $infoRteIVA = $hotel->traeRetenciones(2) ;
  $infoRteICA = $hotel->traeRetenciones(3) ;

  if (count($facturas) == 0) {
      echo '1';
  } else {
      ?>
	  <tbody>
		<?php
        $numero = 0;
        foreach ($facturas as $factura) {
            $apellido1 = '';
            $apellido2 = '';
            $nombre1 = '';
            $nombre2 = '';
            $empresa = '';
            $nit = '';
            $dv = '';
            $codDepto = '';
            $codCiudad = '';
            $direccion = '';
            $telefono = '';
            $anulada = 'N';
            $sexo = '';
            if ($factura['factura_anulada'] == 1) {
                $anulada = 'S';
            }
            if ($numero == $factura['factura_numero']) {
                ++$i;
            } else {
                $i = 1;
                $numero = $factura['factura_numero'];
            }
            $idC = $factura['id_perfil_factura'];
            if ($factura['tipo_factura'] == 1) {
              $cliente = $hotel->getbuscaDatosHuesped($idC);
              $apellido1 = $cliente[0]['apellido1'];
              $apellido2 = $cliente[0]['apellido2'];
              $nombre1 = $cliente[0]['nombre1'];
              $nombre2 = $cliente[0]['nombre2'];
              $nit = $cliente[0]['identificacion'];
              $sexo = $cliente[0]['sexo'];
            } else {
              $cliente = $hotel->getSeleccionaCompania($idC);
              $empresa = $cliente[0]['empresa'];
              $nit = $cliente[0]['nit'];
              $dv = $cliente[0]['dv'];
            }

            $direccion = $cliente[0]['direccion'];

            if ($cliente[0]['ciudad'] == '' || $cliente[0]['ciudad'] == null) {
                $codigoMun = '';
            } else {
                $codigoMun = $hotel->traeCodigoCiudad($cliente[0]['ciudad']);
            }

            $codCiudad = "'".substr($codigoMun, 2, 3);
            $codDepto = substr($codigoMun, 0, 2);
            $telefono = $cliente[0]['telefono'];
            $totales = $factura['pagos'] + $factura['monto'];
            ?>
                <tr>
                    <td>1</td>
                    <td><?php echo $factura['anio']; ?></td>
                    <td>8</td>
                    <td><?php echo $factura['factura_numero']; ?></td>
                    <td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
                    <td><?php echo $factura['descripcion_cargo']; ?></td>
                    <td><?php echo $anulada; ?></td>
                    <td>CONTABILIDAD</td>
                    <td>1</td>
                    <td><?php echo $factura['anio']; ?></td>
                    <td>8</td>
                    <td><?php echo $factura['factura_numero']; ?></td>
                    <td><?php 
                    if($anulada=='S'){
                        echo '110505';
                    }else{
                        echo $factura['cuenta_puc']; 
                    }
                    ?></td>
                    <td><?php echo $i; ?></td>
                    <td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
                    <td><?php echo "'".$factura['centroCosto']; ?></td>
                    <td><?php echo $nit; ?></td>
                    <td><?php echo $dv; ?></td>
                    <td><?php echo $apellido1; ?></td>
                    <td><?php echo $apellido2; ?></td>
                    <td><?php echo $nombre1; ?></td>
                    <td><?php echo $nombre2; ?></td>
                    <td><?php echo $empresa; ?></td>
                    <td><?php echo $codDepto; ?></td>
                    <td><?php echo $codCiudad; ?></td>
                    <td><?php echo $direccion; ?></td>
                    <td><?php echo $telefono; ?></td>
                    <td><?php echo $sexo; ?></td>
                    <td><?php echo $factura['referencia_cargo']; ?></td>
                    <td><?php echo $factura['descripcion_contable']; ?></td>
                    <td style="text-align:right;">
                      <?php
                        if ($anulada == 1) {
                            echo 0;
                        } else {
                            echo $factura['monto'];
                        }
                      ?>
                    </td>
                    <td style="text-align:right;"> 
                      <?php 
                        if($anulada=='S'){
                          echo 0;
                        }else{
                          echo $factura['pagos']; 
                        }
                      ?>
                    </td>
                    <td><?php echo $vacio; ?></td>
                    <td><?php echo $vacio; ?></td>
                    <td><?php echo $vacio; ?></td>
                    <td style="text-align:right;">
                      <?php 
                        if($anulada=='S'){
                            echo 0;
                        }else{
                            echo $totales; 
                        }
                      ?>
                    </td>
                </tr>
            <?php
        }

        foreach ($impuestos as $factura) {
            $apellido1 = '';
            $apellido2 = '';
            $nombre1 = '';
            $nombre2 = '';
            $empresa = '';
            $nit = '';
            $dv = '';
            $codDepto = '';
            $codCiudad = '';
            $direccion = '';
            $telefono = '';
            $anulada = 'N';
            $sexo = '';
            if ($factura['factura_anulada'] == 1) {
                $anulada = 'S';
            }
            if ($numero == $factura['factura_numero']) {
                ++$i;
            } else {
                $i = 1;
                $numero = $factura['factura_numero'];
            }
            $idC = $factura['id_perfil_factura'];
            if ($factura['tipo_factura'] == 1) {
                $cliente = $hotel->getbuscaDatosHuesped($idC);
                $apellido1 = $cliente[0]['apellido1'];
                $apellido2 = $cliente[0]['apellido2'];
                $nombre1 = $cliente[0]['nombre1'];
                $nombre2 = $cliente[0]['nombre2'];
                $nit = $cliente[0]['identificacion'];
                $sexo = $cliente[0]['sexo'];
            } else {
                $cliente = $hotel->getSeleccionaCompania($idC);
                $empresa = $cliente[0]['empresa'];
                $nit = $cliente[0]['nit'];
                $dv = $cliente[0]['dv'];
            }

            if ($cliente[0]['ciudad'] == '') {
                $codigoMun = '';
            } else {
                $codigoMun = $hotel->traeCodigoCiudad($cliente[0]['ciudad']);
            }

            $codCiudad = "'".substr($codigoMun, 2, 3);
            $codDepto = substr($codigoMun, 0, 2);
            $direccion = $cliente[0]['direccion'];
            $telefono = $cliente[0]['telefono'];

            $totales = $factura['impuesto'];

            if ($factura['impuesto'] != 0) { ?>
              <tr>
                <td>1</td>
                <td><?php echo $factura['anio']; ?></td>
                <td>8</td>
                <td><?php echo $factura['factura_numero']; ?></td>
                <td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
                <td><?php echo $factura['descripcion_cargo']; ?></td>
                <td><?php echo $anulada; ?></td>
                <td>CONTABILIDAD</td>
                <td>1</td>
                <td><?php echo $factura['anio']; ?></td>
                <td>8</td>
                <td><?php echo $factura['factura_numero']; ?></td>
                <td><?php echo $factura['cuenta_puc']; ?></td>
                <td><?php echo $i; ?></td>
                <td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
                <td><?php echo "'".$factura['centroCosto']; ?></td>
                <td><?php echo $nit; ?></td>
                <td><?php echo $dv; ?></td>
                <td><?php echo $apellido1; ?></td>
                <td><?php echo $apellido2; ?></td>
                <td><?php echo $nombre1; ?></td>
                <td><?php echo $nombre2; ?></td>
                <td><?php echo $empresa; ?></td>
                <td><?php echo $codDepto; ?></td>
                <td><?php echo $codCiudad; ?></td>
                <td><?php echo $direccion; ?></td>
                <td><?php echo $telefono; ?></td>
                <td><?php echo $sexo; ?></td>
                <td><?php echo ''; ?></td>
                <td><?php echo $factura['descripcion_cargo']; ?></td>
                <td style="text-align:right;"><?php echo $factura['impuesto']; ?></td>
                <td style="text-align:right;"><?php echo 0; ?></td>
                <td><?php echo $vacio; ?></td>
                <td><?php echo $vacio; ?></td>
                <td><?php echo $vacio; ?></td>
                <td style="text-align:right;"><?php echo $factura['impuesto']; ?></td>
              </tr>
              <?php
            }
        }

        foreach ($retefuente as $factura) {
            $apellido1 = '';
            $apellido2 = '';
            $nombre1 = '';
            $nombre2 = '';
            $empresa = '';
            $nit = '';
            $dv = '';
            $codDepto = '';
            $codCiudad = '';
            $direccion = '';
            $telefono = '';
            $anulada = 'N';
            $sexo = '';
            if ($numero == $factura['factura_numero']) {
                ++$i;
            } else {
                $i = 1;
                $numero = $factura['factura_numero'];
            }
            $idC = $factura['id_perfil_factura'];
            if ($factura['tipo_factura'] == 1) {
                $cliente = $hotel->getbuscaDatosHuesped($idC);
                $apellido1 = $cliente[0]['apellido1'];
                $apellido2 = $cliente[0]['apellido2'];
                $nombre1 = $cliente[0]['nombre1'];
                $nombre2 = $cliente[0]['nombre2'];
                $nit = $cliente[0]['identificacion'];
                $sexo = $cliente[0]['sexo'];
            } else {
                $cliente = $hotel->getSeleccionaCompania($idC);
                $empresa = $cliente[0]['empresa'];
                $nit = $cliente[0]['nit'];
                $dv = $cliente[0]['dv'];
            }

            if ($cliente[0]['ciudad'] == '') {
                $codigoMun = '';
            } else {
                $codigoMun = $hotel->traeCodigoCiudad($cliente[0]['ciudad']);
            }
            $codCiudad = "'".substr($codigoMun, 2, 3);
            $codDepto = substr($codigoMun, 0, 2);
            $direccion = $cliente[0]['direccion'];
            $telefono = $cliente[0]['telefono'];

            $totales = $factura['retefuente'];

            $desReteFte = $infoRteFTE[0]['descripcionRetencion'];
            $pucReteFte = $infoRteFTE[0]['codigoPuc'];
            ?>
            <tr>
                <td>1</td>
                <td><?php echo $factura['anio']; ?></td>
                <td>8</td>
                <td><?php echo $factura['factura_numero']; ?></td>
                <td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
                <td><?php echo $desReteFte; ?></td>
                <td><?php echo $anulada; ?></td>
                <td>CONTABILIDAD</td>
                <td>1</td>
                <td><?php echo $factura['anio']; ?></td>
                <td>8</td>
                <td><?php echo $factura['factura_numero']; ?></td>
                <td><?php echo $pucReteFte; ?></td>
                <td><?php echo $i; ?></td>
                <td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
                <td><?php echo "'".$factura['centroCosto']; ?></td>
                <td><?php echo $nit; ?></td>
                <td><?php echo $dv; ?></td>
                <td><?php echo $apellido1; ?></td>
                <td><?php echo $apellido2; ?></td>
                <td><?php echo $nombre1; ?></td>
                <td><?php echo $nombre2; ?></td>
                <td><?php echo $empresa; ?></td>
                <td><?php echo $codDepto; ?></td>
                <td><?php echo $codCiudad; ?></td>
                <td><?php echo $direccion; ?></td>
                <td><?php echo $telefono; ?></td>
                <td><?php echo $sexo; ?></td>
                <td><?php echo ''; ?></td>
                <td><?php echo $desReteFte; ?></td>
                <td style="text-align:right;"><?php echo 0; ?></td>
                <td style="text-align:right;"><?php echo $factura['retefuente']; ?></td>
                <td><?php echo $vacio; ?></td>
                <td><?php echo $vacio; ?></td>
                <td><?php echo $vacio; ?></td>
                <td style="text-align:right;"><?php echo $factura['retefuente']; ?></td>
            </tr>
            <?php
        }

        foreach ($reteiva as $factura) {            
            $apellido1 = '';
            $apellido2 = '';
            $nombre1 = '';
            $nombre2 = '';
            $empresa = '';
            $nit = '';
            $dv = '';
            $codDepto = '';
            $codCiudad = '';
            $direccion = '';
            $telefono = '';
            $anulada = 'N';
            $sexo = '';
            if ($numero == $factura['factura_numero']) {
                ++$i;
            } else {
                $i = 1;
                $numero = $factura['factura_numero'];
            }
            $idC = $factura['id_perfil_factura'];
            if ($factura['tipo_factura'] == 1) {
                $cliente = $hotel->getbuscaDatosHuesped($idC);
                $apellido1 = $cliente[0]['apellido1'];
                $apellido2 = $cliente[0]['apellido2'];
                $nombre1 = $cliente[0]['nombre1'];
                $nombre2 = $cliente[0]['nombre2'];
                $nit = $cliente[0]['identificacion'];
                $sexo = $cliente[0]['sexo'];
            } else {
                $cliente = $hotel->getSeleccionaCompania($idC);
                $empresa = $cliente[0]['empresa'];
                $nit = $cliente[0]['nit'];
                $dv = $cliente[0]['dv'];
            }

            if ($cliente[0]['ciudad'] == '') {
                $codigoMun = '';
            } else {
                $codigoMun = $hotel->traeCodigoCiudad($cliente[0]['ciudad']);
            }
            $codCiudad = "'".substr($codigoMun, 2, 3);
            $codDepto = substr($codigoMun, 0, 2);
            $direccion = $cliente[0]['direccion'];
            $telefono = $cliente[0]['telefono'];

            $totales = $factura['reteiva'];

            $desReteFte = $infoRteIVA[0]['descripcionRetencion'];
            $pucReteFte = $infoRteIVA[0]['codigoPuc'];
            ?>
            <tr>
                <td>1</td>
                <td><?php echo $factura['anio']; ?></td>
                <td>8</td>
                <td><?php echo $factura['factura_numero']; ?></td>
                <td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
                <td><?php echo $desReteFte; ?></td>
                <td><?php echo $anulada; ?></td>
                <td>CONTABILIDAD</td>
                <td>1</td>
                <td><?php echo $factura['anio']; ?></td>
                <td>8</td>
                <td><?php echo $factura['factura_numero']; ?></td>
                <td><?php echo $pucReteFte; ?></td>
                <td><?php echo $i; ?></td>
                <td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
                <td><?php echo "'".$factura['centroCosto']; ?></td>
                <td><?php echo $nit; ?></td>
                <td><?php echo $dv; ?></td>
                <td><?php echo $apellido1; ?></td>
                <td><?php echo $apellido2; ?></td>
                <td><?php echo $nombre1; ?></td>
                <td><?php echo $nombre2; ?></td>
                <td><?php echo $empresa; ?></td>
                <td><?php echo $codDepto; ?></td>
                <td><?php echo $codCiudad; ?></td>
                <td><?php echo $direccion; ?></td>
                <td><?php echo $telefono; ?></td>
                <td><?php echo $sexo; ?></td>
                <td><?php echo ''; ?></td>
                <td><?php echo $desReteFte; ?></td>
                <td style="text-align:right;"><?php echo 0; ?></td>
                <td style="text-align:right;"><?php echo $factura['reteiva']; ?></td>
                <td><?php echo $vacio; ?></td>
                <td><?php echo $vacio; ?></td>
                <td><?php echo $vacio; ?></td>
                <td style="text-align:right;"><?php echo $factura['reteiva']; ?></td>
            </tr>
            <?php
        }
 
        foreach ($reteica as $factura) {            
            $apellido1 = '';
            $apellido2 = '';
            $nombre1 = '';
            $nombre2 = '';
            $empresa = '';
            $nit = '';
            $dv = '';
            $codDepto = '';
            $codCiudad = '';
            $direccion = '';
            $telefono = '';
            $anulada = 'N';
            $sexo = '';
            if ($numero == $factura['factura_numero']) {
                ++$i;
            } else {
                $i = 1;
                $numero = $factura['factura_numero'];
            }
            $idC = $factura['id_perfil_factura'];
            if ($factura['tipo_factura'] == 1) {
                $cliente = $hotel->getbuscaDatosHuesped($idC);
                $apellido1 = $cliente[0]['apellido1'];
                $apellido2 = $cliente[0]['apellido2'];
                $nombre1 = $cliente[0]['nombre1'];
                $nombre2 = $cliente[0]['nombre2'];
                $nit = $cliente[0]['identificacion'];
                $sexo = $cliente[0]['sexo'];
            } else {
                $cliente = $hotel->getSeleccionaCompania($idC);
                $empresa = $cliente[0]['empresa'];
                $nit = $cliente[0]['nit'];
                $dv = $cliente[0]['dv'];
            }

            if ($cliente[0]['ciudad'] == '') {
                $codigoMun = '';
            } else {
                $codigoMun = $hotel->traeCodigoCiudad($cliente[0]['ciudad']);
            }
            $codCiudad = "'".substr($codigoMun, 2, 3);
            $codDepto = substr($codigoMun, 0, 2);
            $direccion = $cliente[0]['direccion'];
            $telefono = $cliente[0]['telefono'];

            $totales = $factura['reteica'];

            $desReteFte = $infoRteICA[0]['descripcionRetencion'];
            $pucReteFte = $infoRteICA[0]['codigoPuc'];
            ?>
            <tr>
                <td>1</td>
                <td><?php echo $factura['anio']; ?></td>
                <td>8</td>
                <td><?php echo $factura['factura_numero']; ?></td>
                <td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
                <td><?php echo $desReteFte; ?></td>
                <td><?php echo $anulada; ?></td>
                <td>CONTABILIDAD</td>
                <td>1</td>
                <td><?php echo $factura['anio']; ?></td>
                <td>8</td>
                <td><?php echo $factura['factura_numero']; ?></td>
                <td><?php echo $pucReteFte; ?></td>
                <td><?php echo $i; ?></td>
                <td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
                <td><?php echo "'".$factura['centroCosto']; ?></td>
                <td><?php echo $nit; ?></td>
                <td><?php echo $dv; ?></td>
                <td><?php echo $apellido1; ?></td>
                <td><?php echo $apellido2; ?></td>
                <td><?php echo $nombre1; ?></td>
                <td><?php echo $nombre2; ?></td>
                <td><?php echo $empresa; ?></td>
                <td><?php echo $codDepto; ?></td>
                <td><?php echo $codCiudad; ?></td>
                <td><?php echo $direccion; ?></td>
                <td><?php echo $telefono; ?></td>
                <td><?php echo $sexo; ?></td>
                <td><?php echo ''; ?></td>
                <td><?php echo $desReteFte; ?></td>
                <td style="text-align:right;"><?php echo 0; ?></td>
                <td style="text-align:right;"><?php echo $factura['reteica']; ?></td>
                <td><?php echo $vacio; ?></td>
                <td><?php echo $vacio; ?></td>
                <td><?php echo $vacio; ?></td>
                <td style="text-align:right;"><?php echo $factura['reteica']; ?></td>
            </tr>
            <?php
        }
?>
	  </tbody>
	<?php
  }
  ?>



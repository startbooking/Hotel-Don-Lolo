<?php
  require_once '../../../res/php/titles.php';
  require_once '../../../res/php/app_topHotel.php';

  $fecha = $_POST['fecha'];

  $query = "SELECT DISTINCT historico_cargos_pms.id_cargo, codigos_vta.descripcion_cargo, codigos_vta.cuenta_puc, codigos_vta.descripcion_contable, codigos_vta.centroCosto, codigos_vta.idRetencion, SUM(historico_cargos_pms.monto_cargo) AS monto, SUM(historico_cargos_pms.pagos_cargos) AS pagos, SUM(historico_cargos_pms.impuesto) AS impto, SUM(historico_cargos_pms.valor_cargo) AS total, SUM(historico_cargos_pms.cantidad_cargo) AS cantidad, historico_cargos_pms.valorUnitario AS unitario, historico_cargos_pms.valorUnitario, historico_cargos_pms.codigo_impto, historico_cargos_pms.habitacion_cargo, historico_cargos_pms.id_codigo_cargo, historico_cargos_pms.tipo_factura, historico_cargos_pms.id_perfil_factura, historico_cargos_pms.factura_numero, historico_cargos_pms.numero_reserva, historico_cargos_pms.referencia_cargo, historico_cargos_pms.factura_anulada, historico_cargos_pms.id_usuario_factura, historico_cargos_pms.total_consumos, historico_cargos_pms.total_impuesto, historico_cargos_pms.total_pagos, historico_cargos_pms.fecha_factura, year(historico_cargos_pms.fecha_factura) as anio, historico_cargos_pms.fecha_sistema_cargo, SUM(historico_cargos_pms.reteiva) AS reteiva, SUM(historico_cargos_pms.reteica) AS reteica, SUM(historico_cargos_pms.retefuente) AS retefuente, SUM(historico_cargos_pms.basereteiva) AS baseiva, SUM(historico_cargos_pms.basereteica) AS baseica, SUM(historico_cargos_pms.baseretefuente) AS basefuent FROM historico_cargos_pms, codigos_vta WHERE codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo AND historico_cargos_pms.fecha_factura = '$fecha' GROUP BY historico_cargos_pms.factura_numero, historico_cargos_pms.id_codigo_cargo ORDER BY historico_cargos_pms.factura_numero";

  $facturas = $hotel->getFacturasPorRango($query);

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
          if ($factura['tipo_factura'] == 1) {
              $idC = $factura['id_perfil_factura'];
              $cliente = $hotel->getbuscaDatosHuesped($idC);
              $apellido1 = $cliente[0]['apellido1'];
              $apellido2 = $cliente[0]['apellido2'];
              $nombre1 = $cliente[0]['nombre1'];
              $nombre2 = $cliente[0]['nombre2'];
              $nit = $cliente[0]['identificacion'];
              $sexo = $cliente[0]['sexo'];
          } else {
              $idC = $factura['id_perfil_factura'];
              $cliente = $hotel->getSeleccionaCompania($idC);
              $empresa = $cliente[0]['empresa'];
              $nit = $cliente[0]['nit'];
              $dv = $cliente[0]['dv'];
          }
          $codigoMun = $hotel->traeCodigoCiudad($cliente[0]['ciudad']);
          $codCiudad = substr($codigoMun, 2, 3);
          $codDepto = substr($codigoMun, 0, 2);
          $direccion = $cliente[0]['direccion'];
          $telefono = $cliente[0]['telefono'];

          if ($factura['total_pagos'] == 0) {
              $totales = $factura['monto'];
          } else {
              $totales = $factura['total_pagos'];
          }

          ?>
				<tr>
					<td>1</td>
					<td><?php echo $factura['anio']; ?></td>
					<td>3</td>
					<td><?php echo $factura['factura_numero']; ?></td>
					<td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
					<td><?php echo $factura['descripcion_cargo']; ?></td>
					<td><?php echo $anulada; ?></td>
					<td>CONTABILIDAD</td>
					<td>1</td>
					<td><?php echo $factura['anio']; ?></td>
					<td>3</td>
					<td><?php echo $factura['factura_numero']; ?></td>
					<td><?php echo $factura['cuenta_puc']; ?></td>
					<td><?php echo $i; ?></td>
					<td><?php echo substr($factura['fecha_factura'], 8, 2).'/'.substr($factura['fecha_factura'], 5, 2).'/'.substr($factura['fecha_factura'], 0, 4); ?></td>
					<td><?php echo $factura['centroCosto']; ?></td>
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
					<td style="text-align:right;"><?php echo $factura['monto']; ?></td>
					<td style="text-align:right;"><?php echo $factura['total_pagos']; ?></td>
					<td><?php echo $vacio; ?></td>
					<td><?php echo $vacio; ?></td>
					<td><?php echo $vacio; ?></td>
					<td style="text-align:right;"><?php echo $totales; ?></td>
				</tr>
			<?php
      }
      ?>
		</tbody>
		<?php
  }
  ?>



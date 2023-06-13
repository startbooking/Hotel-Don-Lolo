<?php

  require_once '../../../../res/php/app_topPos.php';

  $fecha = $_POST['fecha'];
  $idamb = $_POST['id'];
  $nomamb = $_POST['amb'];
  $amb = $nomamb;
  $user = $_POST['user'];
  $iduser = $_POST['iduser'];
  $impto = $_POST['impto'];
  $prop = $_POST['prop'];
  $pref = $_POST['prefijo'];
  $logo = $_POST['logo'];
  $connection = [
    'host' => $server,
    'database' => $dbname,
    'user' => $dbuser,
    'password' => $dbpass,
    'charset' => 'utf8',
    'collation' => 'utf8_spanish_ci',
  ];

  $bckname = 'POS_'.$pref.'-'.$dbname.'_'.$fecha;
  define('DB_HOST', $server);
  define('DB_NAME', $dbname);
  define('DB_USER', $dbuser);
  define('DB_PASSWORD', $dbpass);
  define('BACKUP_DIR', '../../../backups'); // Comment this line to use same script's directory ('.')
  define('TABLES', '*'); // Full backup
  define('CHARSET', 'utf8');
  define('GZIP_BACKUP_FILE', true); // Set to false if you want plain SQL backup files (not gzipped)
  define('DISABLE_FOREIGN_KEY_CHECKS', true); // Set to true if you are having foreign key constraint fails
  define('BATCH_SIZE', 1000); // Batch size when selecting rows from database in order to not exhaust system
  define('BCK_NAME', $bckname); // Nombre Backup Archivo de Salida

  $backupDatabase = new Backup_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, CHARSET, BCK_NAME);
  $result = $backupDatabase->backupTables(TABLES, BACKUP_DIR) ? 'OK' : 'KO';

  $facturas = $pos->getFacturasDiaAmbiente('A', $idamb);
  $anuladas = $pos->getFacturasDiaAmbiente('X', $idamb);
  $detalles = $pos->getDetalleFacturaAnuladaDiaAmbiente('A', $idamb);
  $detalleAnuladas = $pos->getDetalleFacturaAnuladaDiaAmbiente('X', $idamb);
  $pagos = $pos->getDetalleFormasdePagoAmbiente('A', $idamb);
  $pagosAnulados = $pos->getDetalleFormasdePagoAmbiente('X', $idamb);
  $populares = $pos->getPopularidadProductosAmbiente('A', $idamb);
  $popularAnulados = $pos->getPopularidadProductosAmbiente('X', $idamb);
  $comandaAnuladas = $pos->getComandasActivas($idamb, 'X');
  $devoluciones = $pos->getDevolucionesDia($idamb, $fecha);

  $abonos = $pos->traeAbonosTotal($idamb);

  $pagos = $pos->getDetalleFormasdePagoBalanceCaja('A', $idamb);

  $cajeros = $pos->getCajerosActivos($idamb);

  $creditos = $pos->getVentasCreditodelDia($idamb);

  // *** CIERRE CAJEROS  ***//
  $oldUser = $user;
  $oldidUser = $iduser;

  foreach ($cajeros as $key => $cajero) {
      $user = $cajero['usuario'];
      $iduser = $cajero['usuario_id'];

      if ($cajero['estado_usuario_pos'] == 1) {
          include '../../../imprimir/imprimeCierreCajeroAuditoria.php';
      }
      $estado = $pos->cambiaEstadoCajero($iduser, 2);
  }

  $user = $oldUser;
  $iduser = $oldidUser;

  // ** BALANCE DIARIO **//
  require_once '../../../imprimir/imprimeBalanceDiarioAuditoria.php';

  $anio = substr($fecha, 0, 4);
  $mes = substr($fecha, 5, 2);
  $dia = substr($fecha, 8, 2);
  $mesasDis = $pos->getMesasDisponibles($idamb);
  $mesasVen = count($facturas);
  $mesasAnu = count($anuladas);
  $comanAnu = count($comandaAnuladas);
  $ingDia = $pos->ingresaDatosAuditoria($fecha, $mesasDis, $mesasVen, $mesasAnu, $comanAnu, $factAnu, $netoAnu, $imptAnu, $propAnu, $totaAnu, $descAnu, $factVen, $netoVen, $imptVen, $propVen, $descVen, $totaVen, $clieVen, $clieAnu, $comaAnu, $idamb, $user, $iduser);

  $ventasDia = $pos->getVentasDiaPos($idamb, $fecha);

  $ventasMes = $pos->getVentasMesPos($idamb, $mes, $anio);

  $ventasAnio = $pos->getVentasAnioPos($idamb, $anio);

  require_once '../../../imprimir/imprimeGerenciaDiariaAuditoria.php';

  $ventas = $pos->getTotalProductosVendidos($idamb);
  $cantidad = $pos->getCantidadProductosVendidos($idamb);

  require_once '../../../imprimir/imprimeVentasPorProductoAuditoria.php';

  $ventas = $pos->getTotalGruposVendidos($idamb);

  $cantidad = $pos->getCantidadProductosVendidos($idamb);

  require_once '../../../imprimir/imprimeVentasPorGrupoAuditoria.php';

  require_once '../../../imprimir/imprimeCarteraDiarioAuditoria.php';

  $coma = $pos->enviaHistoricoComandas($idamb);
  $deta = $pos->enviaHistoricoDetalleComandas($idamb);
  $fact = $pos->enviaHistoricoFacturas($idamb);
  $deta = $pos->enviaHistoricoDetalleFacturas($idamb);
  $caja = $pos->enviaHistoricoCaja($idamb);
  $hisAbon = $pos->enviaHistoricoAbonos($idamb);
  $elicoma = $pos->eliminaComandas($idamb);
  $elicaja = $pos->eliminaCaja($idamb);
  $elicaja = $pos->eliminaAbonos($idamb);
  $elidetacoma = $pos->eliminaDetelleComandas($idamb);
  $elifact = $pos->eliminaFacturas($idamb);
  $elidetafact = $pos->eliminaDetelleFacturas($idamb);

  require_once '../../../imprimir/imprimeDiarioAcumulado.php';

  require_once '../../../imprimir/imprimeDiarioGruposAcumulado.php';

  require_once '../../../imprimir/imprimeDiarioFormasdePago.php';

  $fechanueva = strtotime('+1 day', strtotime($fecha));
  $fechanueva = date('Y-m-d', $fechanueva);
  $cambiaFecha = $pos->cambiaFechaAuditoria($idamb, $fechanueva);
  $cierra = $pos->cambiaEstadoTodosCajero(0);
  echo $cambiaFecha;

  ?>







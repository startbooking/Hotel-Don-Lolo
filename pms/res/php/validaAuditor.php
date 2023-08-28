<?php
  require_once '../../../res/php/titles.php';
  require_once '../../../res/php/app_topHotel.php';
  require_once '../../../res/php/configdb.php';

  $usu = strtoupper(addslashes($_POST['login']));
  $pass = strtoupper(addslashes($_POST['pass']));
  $pass3 = sha1(md5($usu.$pass));

  $user = $hotel->getLogin($usu, $pass3);

  $fecha = FECHA_PMS;

  if (!empty($user)) {
    $usuario = $user[0]['usuario'];
    $idusuario = $user[0]['usuario_id'];

    $llegan = $hotel->getTotalHuespedeseLlegando();
    $salen = $hotel->getSalidasDelDia($fecha);

    // echo $salen;

    $registro = count($hotel->registrosHotelerosSinImprimir($fecha));

    if ($salen != 0 || $registro != 0) {
        if ($salen != 0) {
            require_once 'habitacionesSinSalir.php';
        }
        if ($registro != 0) {
            require_once 'registrosSinImprimir.php';
        }
    } else { ?>     
    <?php
        $activaAud = $hotel->EstadoAuditoriaPMS(1);
        $procesos = $hotel->getProcesoAuditoria();
        foreach ($procesos as $proceso) {
            require_once '../../imprimir/plantillaAuditoria.php';
            if ($proceso['estado_proceso'] == 0) {
                if (!is_null($proceso['nombre_proceso'])) {
                    $proce = '../../auditoria/'.$proceso['nombre_proceso'];
                    require_once $proce;
                } ?>
        <?php
                $ejecutado = $hotel->updateProcesoAuditoria($proceso['id_proceso'], 1);
            } else { ?>
        <?php
            }
            time_sleep_until(microtime(true) + 1);
        }
        $limpaEstado = $hotel->limpiaProcesosAuditoria();
        echo 1;
    }
  } else {
      echo 0;
  }
  ?>
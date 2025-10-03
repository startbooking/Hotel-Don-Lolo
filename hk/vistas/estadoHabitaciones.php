<?php
if (!isset($rooms)) {
  die('Error: Datos de habitaciones no disponibles.');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>House Keeping | SACTel PMS Cloud</title>
    <?php include_once("../res/shared/archivo_head.php") ?>
    <link rel="stylesheet" type="text/css" href="../../../../res/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../res/css/pms.css">
    <link rel="stylesheet" type="text/css" href="res/css/pms.css">
</head>

<body class="skin-red sidebar-mini">
    <div class="container-fluid moduloCentrar">
        <div class="panel panel-success">
            <div class="panel-heading">
                <input type="hidden" id="rutaweb" value="<?= htmlspecialchars(BASE_PMS) ?>">
                <input type="hidden" id="ubicacion" value="estadoHabitaciones">
                <h1 class="text-center sombraBlanca fw-700" style="font-size:34px;text-center;">Estado Habitaciones</h1>
                <div class="container-fluid pd0" style="margin:0px;">
                    <?php
                    $leyenda = [
                        'Limpia Vacante' => 'bg-limpiaVac',
                        'Limpia Ocupada' => 'bg-limpiaOcu',
                        'Sucia Vacante' => 'bg-suciaVac',
                        'Sucia Ocupada' => 'bg-suciaOcu',
                        'Fuera de Orden' => 'bg-maroon',
                        'Fuera de Servicio' => 'bg-red'
                    ];
                    foreach ($leyenda as $texto => $clase):
                    ?>
                        <div class="col-xs-6 col-md-2 <?= htmlspecialchars($clase) ?>" style="padding:8px;font-weight: 600;">
                            <span class="info-box-text text-center sombraBlanca" style="color:#000"><?= htmlspecialchars($texto) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="panel-body" style="color:#FFF;gap:unset;">
                <?php foreach ($rooms as $room): ?>
                    <div class="col-xs-6 col-sm-2 small-box <?= htmlspecialchars(getRoomColorClass($room['estado_hk'])) ?>" style="padding:2px;margin:2px;color:#FFF;">
                        <div class="inner" style="height: 108px">
                            <h5 style="text-align: center;margin:2px 0;font-weight: bold;color:#000">HABITACION</h5>
                            <h3 style="font-size:30px;margin:0"><?= htmlspecialchars($room['numero_hab']) ?></h3>
                            <h5 style="text-align: center;margin:2px 0;font-weight: bold;color:#000"><?= htmlspecialchars($room['descripcion_habitacion']) ?></h5>
                        </div>
                        <nav class="navbar navbar-default" style="margin-bottom: 0px;min-height:0px;">
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding:1px">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown submenu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="font-size:14px ">Estado Habitacion<span class="caret" style="margin-left:10px"></span></a>
                                        <ul class="dropdown-menu" style="padding:5px;">
                                            <?php
                                            $estados = [
                                                'LO' => 'Limpia Ocupada',
                                                'SO' => 'Sucia Ocupada',
                                                'LV' => 'Limpia Vacante',
                                                'SV' => 'Sucia Vacante'
                                            ];
                                            foreach ($estados as $codigo => $descripcion):
                                            ?>
                                                <li>
                                                    <a href="#"
                                                        data-numero="<?= htmlspecialchars($room['numero_hab']) ?>"
                                                        data-estado-actual="<?= htmlspecialchars($room['estado_hk']) ?>"
                                                        data-estado-nuevo="<?= htmlspecialchars($codigo) ?>"
                                                        class="cambiaEstado-js">
                                                        <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                                        Habitacion <?= htmlspecialchars($descripcion) ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <footer>
        <?php include_once '../res/shared/archivo_pie.php'; ?>
    </footer>
    <?php
    include_once '../res/shared/archivo_script.php';
    ?>
    <script src="res/js/pms.js"></script>
    <script src="../res/js/inicio.js"></script>

    <script>
        // Lógica para guardar en localStorage movida a la vista
        const user = {
            usuario_id: 99,
            usuario: 'CAMARERA',
            nombres: 'CAMARERA',
            apellidos: '<?= htmlspecialchars(NAME_HOTEL) ?>',
        };
        localStorage.setItem("sesion", JSON.stringify({
            user
        }));
    </script>
</body>

</html>
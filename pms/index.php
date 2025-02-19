<?php
require_once '../res/php/app_topHotel.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title> Sistema Administrativo Hotelero | SACTel Cloud</title>
    <?php include_once '../res/shared/archivo_head.php'; ?>
    <link rel="stylesheet" type="text/css" href="res/css/pms.css">
</head>

<body class="skin-green sidebar-mini">
    <?php
    if (!isset($_GET['section'])) {
        $_GET['section'] = 'home';
    }
    include_once 'menus/menu_hotel.php';
    include_once 'menus/menu_titulo.php';
    ?>
    <div class="content-fluid" id="plantilla">
        <?php
        if (!isset($_GET['section'])) {
            require 'views/home.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'index') {
            require 'views/home.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'cajeroCerrado') {
            require 'views/cajeroCerrado.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'home') {
            require 'views/home.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'huespedesPerfil') {
            require 'views/huespedes.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'companias') {
            require 'views/companias.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'agencias') {
            require 'views/agencias.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasActivas') {
            require 'views/reservasActivas.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'forecast') {
            require 'views/forecast.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'Oldforecast') {
            require 'views/forecastOld.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'grupos') {
            require 'views/grupos.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'preregistros') {
            require 'views/preregistros.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'encasa') {
            require 'views/encasa.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'llegadasDelDia') {
            require 'views/llegadasDelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'llegadaSinReserva') {
            require 'views/llegadaSinReserva.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'salidasDelDia') {
            require 'views/salidasDelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'salidasRealizadas') {
            require 'views/salidasRealizadas.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'ventasDirectas') {
            require 'views/ventasDirectas.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'facturacionEstadia') {
            require 'views/facturacionEstadia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'facturacionHuesped') {
            require 'views/facturacionHuesped.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'ingresoConsumos') {
            require 'views/ingresoConsumos.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'facturasDelDia') {
            require 'views/facturasDelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'carteraClientes') {
            require 'views/carteraClientes.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'recaudosCartera') {
            require 'views/recaudosCartera.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'recibosCajaDelDia') {
            require 'views/recibosCajaDelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'notasCredito') {
            require 'views/notasCredito.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'facturasDiaNew') {
            require 'views/facturasDelDiaNew.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosDelDia') {
            require 'views/cargosDelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosAnuladosDia') {
            require 'views/cargosAnulados.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosDelDia') {
            require 'views/pagosDelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'depositosRecibidos') {
            require 'views/depositosRecibidos.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosAnuladosDelDia') {
            require 'views/pagosAnuladosDelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'cierreCajero') {
            require 'views/cierreCajero.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'cuentasCongeladas') {
            require 'views/cuentasCongeladas.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'facturacionCongelada') {
            require 'views/facturacionCongelada.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'exportaFacturas') {
            require 'views/exportaFacturas.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'exportaDocs') {
            require 'views/exportaDocs.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'propinas') {
            require 'views/informePropinas.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'historicoNC') {
            require 'views/historicoNC.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'historicoReservas') {
            require 'views/informes/reservasPorRango.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'historicoCajeros') {
            require 'views/historicoCajeros.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'cargarHabitaciones') {
            require 'views/cargarHabitaciones.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'cierreDiario') {
            require 'views/cierreDiario.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'tarjetaRegistro') {
            require 'views/tarjetaRegistro.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'historicoAuditoria') {
            require 'views/historicoAuditoria.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasEsperadasHoy') {
            require 'views/informes/reservasEsperadasHoy.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasCreadasHoy') {
            require 'views/informes/reservasCreadasHoy.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasPorApellido') {
            require 'views/informes/reservasPorApellido.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasPorHabitacion') {
            require 'views/informes/reservasPorHabitacion.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasPorFecha') {
            require 'views/informes/reservasPorFecha.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasCanceladas') {
            require 'views/informes/reservasCanceladas.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasDepositos') {
            require 'views/informes/reservasDiaDepositos.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasDiaDepositos') {
            require 'views/informes/reservasDiaDepositos.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'huespedesPorHabitacion') {
            require 'views/informes/huespedesPorHabitacion.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'huespedesPorApellido') {
            require 'views/informes/huespedesPorApellido.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'llegadasdelDia') {
            require 'views/informes/llegadasdelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'llegadasSinReserva') {
            require 'views/informes/llegadasSinReserva.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'huespedesConAcompanantes') {
            require 'views/informes/huespedesConAcompanantes.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'salidasdelDia') {
            require 'views/informes/salidasdelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'salidasPendientes') {
            require 'views/informes/salidasPendientes.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'balanceHuesped') {
            require 'views/informes/balanceHuesped.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosdelDiaCronologico') {
            require 'views/informes/cargosdelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosdelDiaporConcepto') {
            require 'views/informes/cargosdelDiaporConcepto.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosdelDiaporCajero') {
            require 'views/informes/cargosdelDiaporCajero.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosdelDiaporHabitacion') {
            require 'views/informes/cargosdelDiaporHabitacion.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosAnuladosdelDia') {
            require 'views/informes/cargosAnuladosdelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosdelDiaCronologico') {
            require 'views/informes/pagosdelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosdelDiaporConcepto') {
            require 'views/informes/pagosdelDiaporConcepto.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosdelDiaporCajero') {
            require 'views/informes/pagosdelDiaporCajero.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosdelDiaporHabitacion') {
            require 'views/informes/pagosdelDiaporHabitacion.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosAnuladosdelDia') {
            require 'views/informes/pagosAnuladosdelDia.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'balanceDiario') {
            require 'views/informes/balanceDiario.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'balancecuentasCongeladas') {
            require 'views/informes/cuentasCongeladas.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'informeFacturasdelDia') {
            require 'views/auditoria/facturasDelDiaAuditoria.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'historicoFacturas') {
            require 'views/informes/facturasPorRango.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'informeRecibosCajaRango') {
            require 'views/informes/recibosCajaPorRango.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'informeCargosPorRango') {
            require 'views/informes/consumoCargosPorRango.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'estadoCartera') {
            require 'views/informes/estadoCartera.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'balanceCajeros') {
            require 'views/balanceCajeros.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'balanceGeneral') {
            require 'views/balanceGeneral.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'diarioAcumulado') {
            require 'views/diarioAcumulado.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'procesaReservaFecha') {
            require 'views/procesaReservaFecha.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'estadoHotel') {
            require 'views/estadoHotel.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'estadoHabitaciones') {
            require 'views/estadoHabitaciones.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'objetosOlvidados') {
            require 'views/objetosOlvidados.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'mantenimiento') {
            require 'views/mantenimiento.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'listadoHuespedes') {
            require 'views/listadoHuespedes.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'listadoCumpleanios') {
            require 'views/listadoCumpleanios.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'listadoCompanias') {
            require 'views/listadoCompanias.php';
        } elseif (isset($_GET['section'])) {
            require 'views/404.php';
        }
        ?>
    </div>
    <footer>
        <?php
        include_once '../res/shared/archivo_pie.php';
        ?>
    </footer>
    <?php
    include_once '../res/shared/archivo_script.php';
    include_once '../views/modal/modalUsuario.php';
    ?>
    <script src="<?php echo BASE_WEB; ?>res/js/inicio.js"></script>
    <?php
    if (isset($_GET['section']) && $_GET['section'] == 'home') {
        include_once 'views/modal/modalHuespedes.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'companias') {
        include_once 'views/modal/modalCompania.php';
        include_once 'views/modal/modalFacturas.php';
        // include_once 'views/modal/modalCentrosCia.php';
        include_once 'views/modal/modalAcompanantes.php';
        include_once 'views/modal/modalDocumentosCia.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'huespedesPerfil') {
        include_once 'views/modal/modalHuespedes.php';
        include_once 'views/modal/modalFacturas.php';
        include_once 'views/modal/modalDocumentos.php';
        include_once 'views/modal/modalAcompanantes.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'agencias') {
        include_once 'views/modal/modalAgencia.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'grupos') {
        include_once 'views/modal/modalGrupos.php';
        include_once 'views/modal/modalCompania.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasActivas') {
        include_once 'views/modal/modalReservas.php';
        include_once 'views/modal/modalAcompanantes.php';
        include_once 'views/modal/modalHuespedes.php';
        include_once 'views/modal/modalCompania.php';
        include_once 'views/modal/modalObservaciones.php';
        include_once 'views/modal/modalFacturas.php';
        /* } elseif (isset($_GET['section']) && $_GET['section'] == 'preregistros') {
        include_once 'views/modal/modalReservas.php';
        include_once 'views/modal/modalAcompanantes.php';
        include_once 'views/modal/modalHuespedes.php';
        include_once 'views/modal/modalObservaciones.php'; */
    } elseif (isset($_GET['section']) && $_GET['section'] == 'encasa') {
        include_once 'views/modal/modalRecepcion.php';
        include_once 'views/modal/modalAcompanantes.php';
        include_once 'views/modal/modalObservaciones.php';
        include_once 'views/modal/modalHuespedes.php';
        include_once 'views/modal/modalCompania.php';
        include_once 'views/modal/modalFacturas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'llegadasDelDia') {
        include_once 'views/modal/modalLlegadasDelDia.php';
        include_once 'views/modal/modalReservas.php';
        include_once 'views/modal/modalAcompanantes.php';
        include_once 'views/modal/modalObservaciones.php';
        include_once 'views/modal/modalHuespedes.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'llegadaSinReserva') {
        include_once 'views/modal/modalNuevaReserva.php';
        include_once 'views/modal/modalHuespedes.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'salidasDelDia') {
        include_once 'views/modal/modalRecepcion.php';
        include_once 'views/modal/modalAcompanantes.php';
        include_once 'views/modal/modalObservaciones.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'salidasRealizadas') {
        include_once 'views/modal/modalSalidasRealizadas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'facturacionEstadia') {
        include_once 'views/modal/modalHuespedes.php';
        include_once 'views/modal/modalFacturacion.php';
        include_once 'views/modal/modalReservas.php';
        include_once 'views/modal/modalObservaciones.php';
        include_once 'views/modal/modalCompania.php';
        include_once 'views/modal/modalFacturas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'ventasDirectas') {
        include_once 'views/modal/modalVentasDirectas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'facturacionHuesped') {
        include_once 'views/modal/modalFacturacion.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'cuentasCongeladas') {
        include_once 'views/modal/modalObservaciones.php';
        include_once 'views/modal/modalRecepcion.php';
        include_once 'views/modal/modalCongeladas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'facturacionCongelada') {
        include_once 'views/modal/modalCongeladas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'informeFacturasRango') {
        include_once 'views/modal/modalFacturas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'historicoFacturas') {
        include_once 'views/modal/modalFacturas.php';
    } elseif (isset($_GET['section']) && ($_GET['section'] == 'facturasDelDia' || $_GET['section'] == 'recibosCajaDelDia')) {
        include_once 'views/modal/modalFacturas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'notasCredito') {
        include_once 'views/modal/modalImprimeNC.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'historicoNC') {
        include_once 'views/modal/modalFacturas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'habitaciones') {
        require 'views/modal/modalHabitaciones.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'paquetes') {
        require 'views/modal/modalPaquetes.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'gruposTarifa') {
        require 'views/modal/modalGruposTarifa.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'objetosOlvidados') {
        require 'views/modal/modalObjetos.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'mantenimiento') {
        require 'views/modal/modalMantenimiento.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'estadoHabitaciones') {
        require 'views/modal/modalEstadoHabitaciones.php';
    }
    ?>

    <script src="<?php echo BASE_PMS; ?>res/js/pms.js"></script>
    <script>
        accesoUsuarios();
    </script>
</body>

</html>
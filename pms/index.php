<?php
require_once '../res/php/titles.php';
require_once '../res/php/app_topHotel.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo TITLE_ADM; ?> | Administracion Hotelera</title>
    <?php include_once '../res/shared/archivo_head.php'; ?>
    <link rel="stylesheet" type="text/css" href="res/css/pms.css">
    <!-- <script src="<?php echo BASE_WEB; ?>res/js/inicio.js"></script> -->
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
        include_once 'views/modal/modalCentrosCia.php';
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
    } elseif (isset($_GET['section']) && $_GET['section'] == 'preregistros') {
        include_once 'views/modal/modalReservas.php';
        include_once 'views/modal/modalAcompanantes.php';
        include_once 'views/modal/modalHuespedes.php';
        include_once 'views/modal/modalObservaciones.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'encasa') {
        include_once 'views/modal/modalRecepcion.php';
        include_once 'views/modal/modalAcompanantes.php';
        include_once 'views/modal/modalObservaciones.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'llegadasDelDia') {
        include_once 'views/modal/modalLlegadasDelDia.php';
        include_once 'views/modal/modalReservas.php';
        include_once 'views/modal/modalAcompanantes.php';
        include_once 'views/modal/modalObservaciones.php';
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
        include_once 'views/modal/modalFacturacion.php';
        include_once 'views/modal/modalReservas.php';
        include_once 'views/modal/modalObservaciones.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'ventasDirectas') {
        include_once 'views/modal/modalVentasDirectas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'facturacionHuesped') {
        include_once 'views/modal/modalFacturacion.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'cuentasCongeladas') {
        //   include_once 'views/modal/modalFacturacion.php';
        include_once 'views/modal/modalObservaciones.php';
        include_once 'views/modal/modalRecepcion.php';
        include_once 'views/modal/modalCongeladas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'facturacionCongelada') {
        // / include_once 'views/modal/modalFacturacion.php' ;
        include_once 'views/modal/modalCongeladas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'informeFacturasRango') {
        // / include_once 'views/modal/modalTipoHabitaciones.php' ;
        include_once 'views/modal/modalFacturas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'historicoFacturas') {
        // / include_once 'views/modal/modalTipoHabitaciones.php' ;
        include_once 'views/modal/modalFacturas.php';
    } elseif (isset($_GET['section']) && $_GET['section'] == 'facturasDelDia') {
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
    }
    ?>

    <script src="<?php echo BASE_PMS; ?>res/js/pms.js"></script>

    <script>
        sesion = JSON.parse(localStorage.getItem('sesion'))
        $('#usuarioActivo').val(usuario)
        $('#nombreUsuario').html(`${apellidos} ${nombres} <span class="caret"></span>`)
        if (tipo <= 2) {
            $('#menuAuditoria').css('display', 'block')
        }
        $('#menuClave').html(`
          <a class="altoMenu" id="cambiaPass" 
            data-toggle    = 'modal'
            data-id        = '${usuario_id}' 
            data-user      = '${usuario}' 
            data-apellidos = '${apellidos}' 
            data-nombres   = '${nombres}' 
            href="#myModalCambiarClave" style="padding:10px 15px">Cambiar Contraseña
          </a>
        `)
    </script>
    <?php
    if (isset($_GET['section']) && $_GET['section'] == 'facturacionHuesped') { ?>
        <script>
            var nrores = document.getElementById("reservaActual").value;
            activaFolio(nrores, 1)
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'cierreCajero') { ?>
        <script>
            $('.tituloPagina').html(`<i class="fa fa-tachometer" style="font-size:36px;color:black" ></i> Cierre Cajero [${usuario}]`)
        </script>
    <?php
    } elseif ($_GET['section'] == 'reservasActivas' || $_GET['section'] == 'encasa' || $_GET['section'] == 'facturacionEstadia' || $_GET['section'] == 'salidasDelDia' || $_GET['section'] == 'salidasRealizadas' || $_GET['section'] == 'grupos' || $_GET['section'] == 'mantenimiento' || $_GET['section'] == 'facturasDelDia' || $_GET['section'] == 'carteraClientes' || $_GET['section'] == 'cuentasCongeladas' || $_GET['section'] == 'notasCredito' || $_GET['section'] == 'companias') { ?>
        <script>
            if (tipo == 1) {
                $('#cambiaHuesped').css('display', 'block')
            }
            $(function() {
                $('#example1').DataTable({
                
                    "iDisplayLength": 50,
                    "language": { 
                        "decimal": "",
                        "emptyTable": "No hay registros",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                    }
                });
            });
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'huespedesPerfil') { ?>
        <script>
            new DataTable('#tablaHuespedes', {
              lengthMenu: [50, 100, 200, 500],
              ajax: 'res/php/datasetHuespedes.php',
              processing: true,
              serverSide: true,
              iDisplayLength: 50,
              language: {
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_ registros",
                sZeroRecords: "No se encontraron resultados",
                sEmptyTable: "Ningún dato disponible en esta tabla",
                sInfo: "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
                sInfoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
                sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                sInfoPostFix: "",
                sSearch: "Buscar:",
                sUrl: "",
                sInfoThousands: ",",
                sLoadingRecords: "Cargando...",
                oPaginate: {
                  sFirst: "Primero",
                  sLast: "Último",
                  sNext: "Siguiente",
                  sPrevious: "Anterior",
                },
                oAria: {
                  sSortAscending:
                    ": Activar para ordenar la columna de manera ascendente",
                  sSortDescending:
                    ": Activar para ordenar la columna de manera descendente",
                },
              },
              columnDefs: [{
                targets: "_all",
                orderable: true
              }],
            });      
        </script>


    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosAnulados') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/Informes_cajeros_' + usuario + '.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosDelDia') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/Informes_cajeros_' + usuario + '.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'depositosRecibidos') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/Informes_cajeros_' + usuario + '.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosAnuladosDelDia') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/Informes_cajeros_' + usuario + '.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'facturacionCongelada') { ?>
        <script>
            var nrores = document.getElementById("reservaActual").value;
            activaCongelado(nrores, 1)
        </script>
    <?php
    }elseif(isset($_GET['section']) && $_GET['section'] == 'reservasEsperadasHoy') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasCreadasHoy') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasPorApellido') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasPorHabitacion') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasPorFecha') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasCanceladas') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasDepositos') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'reservasDiaDepositos') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'huespedesPorHabitacion') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'huespedesPorApellido') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'llegadasdelDia') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'llegadasSinReserva') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'huespedesConAcompanantes') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'salidasdelDia') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'salidasPendientes') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_reservas.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'balanceHuesped') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Balance_huesped.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosdelDiaCronologico') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_financieros.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosdelDiaporConcepto') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_financieros.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosdelDiaporCajero') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_financieros.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosdelDiaporHabitacion') { ?>
        <script>
            $('#verInforme').attr('data', 'imprimir/informes/Informes_financieros.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'cargosAnuladosdelDia') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/Informes_financieros.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosdelDiaCronologico') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/Informes_financieros_' + usuario + '.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosdelDiaporConcepto') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/Informes_financieros_' + usuario + '.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosdelDiaporCajero') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/Informes_financieros_' + usuario + '.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosdelDiaporHabitacion') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/Informes_financieros_' + usuario + '.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'pagosAnuladosdelDia') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/Informes_financieros_' + usuario + '.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'balanceDiario') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/Balance_diario_' + usuario + '.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'balancecuentasCongeladas') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/cuentas_Congeladas_' + usuario + '.pdf')
        </script>
    <?php
    } elseif (isset($_GET['section']) && $_GET['section'] == 'informeFacturasdelDia') { ?>
        <script>
            var usuario = $('#usuarioActivo').val();
            $('#verInforme').attr('data', 'imprimir/informes/Informes_Facturas_' + usuario + '.pdf')
        </script>
    <?php
    }
    ?>
</body>

</html>
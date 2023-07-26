<?php
if ($_GET['section'] != 'cajeroCerrado') {
    ?>
  <input type="hidden" name="webPage" id="webPage" value="<?php echo BASE_PMS; ?>">
  <input type="hidden" name="fechaProceso" id="fechaProceso" value="<?php echo FECHA_PMS; ?>">
  <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="">
  <aside class="main-sidebar" style="margin-top:50px;padding:0">
    <section class="sidebar">
      <ul class="sidebar-menu"> 
        <li style="text-align: center">
          <a href="home" style="font-weight: 700">
            <img class="img-thumbnail" src="<?php echo BASE_IMG.LOGO; ?>" alt="" style="border-radius: 5px;margin-left: -10px;margin-top: 0px;height:80px;"> 
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Datos</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="huespedesPerfil"><i class="fa fa-id-badge"></i> Huespedes</a></li>
            <li><a href="companias"><i class="fa fa-industry"></i> Compañias</a></li>
            <!-- <li><a href="agencias"><i class="fa fa-plane "></i> Agencias</a></li> -->
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar-plus-o"></i>
            <span>Reservas</span>
            <span class="fa fa-angle-left pull-right"></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="reservasActivas"><i class="fa fa-calendar"></i> Reservas</a></li>
            <li><a href="forecast"><i class="fa fa-area-chart"></i> Forecast</a></li>
            <?php
              if(DEV==1){ ?>
                <li><a href="grupos"><i class="fa-solid fa-users-between-lines"></i> Grupos</a></li>
                <?php
              }
            ?>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-home"></i>
            <span>Recepcion</span>
            <span class="fa fa-angle-left pull-right"></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="encasa"><i class="fa fa-home"></i> Huespedes en Casa</a></li>
            <li><a href="llegadasDelDia"><i class="fa fa-sign-in" aria-hidden="true"></i> Llegadas del Dia</a></li>
            <li><a href="llegadaSinReserva"><i class="fa fa-briefcase" aria-hidden="true"></i> Llegadas Sin Reservas</a></li>
            <li></li>
            <li><a href="salidasDelDia"><i class="fa fa-clock-o" aria-hidden="true"></i> Salidas Pendientes</a></li>
            <li><a href="salidasRealizadas"><i class="fa fa-sign-out"></i> Salidas Realizadas</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-edit"></i> 
            <span>Facturacion</span> 
            <span class="fa fa-angle-left pull-right"></span>
          </a>
          <ul class="treeview-menu"> 
            <li><a href="facturacionEstadia"><i class="fa fa-money"></i> Facturacion Huespedes</a></li>
            <li><a href="ingresoConsumos"><i class="glyphicon glyphicon-download-alt"></i> Ingreso Consumos</a></li>
            <!-- <li><a href="ventasDirectas"><i class="fa fa-archive"></i>Ventas Directas</a></li>  -->
            <li><a href="facturasDelDia"><i class="fa fa-archive"></i>Facturas Del Dia</a></li> 
            <li><a href="recibosCajaDelDia"><i class="fa fa-archive"></i>Recibos de Caja Del Dia</a></li> 
            <li><a href="exportaFacturas"><i class="fa fa-archive"></i>Exportar Facturas</a></li> 
            <li>
              <a href="#"><i class="fa fa-balance-scale"></i>Balance Cajero<i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="javascript:imprimeInformeAuditoria('imprimeCargosDiaCajero','Balance del Dia Cajero - Cargos del Dia')"><i class="glyphicon glyphicon-copy"></i>Cargos del Dia</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeCargosAnuladosDiaCajero','Balance del Dia Cajero - Cargos Anulados del Dia')"><i class="glyphicon glyphicon-paste"></i>Cargos Anulados</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimePagosDiaCajero','Balance del Dia Cajero - Pagos Recibidos')"><i class="glyphicon glyphicon-usd"></i>Pagos Recibidos</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimePagosAnuladosDiaCajero','Balance del Dia Cajero - Pagos Anulados ')"><i class="glyphicon glyphicon-save-file"></i>Pagos Anulados</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeDepositosDiaCajero','Balance del Dia Cajero - Depositos Recibidos ')"><i class="glyphicon glyphicon-save-file"></i> Depositos Recibidos</a></li> 
                <li><a href="cierreCajero"><i class="glyphicon glyphicon-download-alt"></i>Cierre Cajero</a></li>
              </ul>
            </li>
            <li><a href="informeFacturasRango"><i class="glyphicon glyphicon-paste"></i>Historico Facturas</a></li>
            <li><a href="cuentasCongeladas"><i class="fa fa-snowflake-o"></i>Cuentas Congeladas</a></li> 
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-edit"></i> 
            <span>Cartera</span> 
            <span class="fa fa-angle-left pull-right"></span>
          </a>
          <ul class="treeview-menu"> 
            <li><a href="carteraClientes"><i class="fa-solid fa-money-bill-1-wave"></i></i> Cartera Compañias</a></li>
            <li><a href="recaudosCartera"><i class='glyphicon glyphicon-briefcase'></i> Recaudos Cartera</a>
          </li> 
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> 
            <span>Ama de Llaves</span> 
            <span class="fa fa-angle-left pull-right"></span>
          </a>
          <ul class="treeview-menu">
            <li><a href="estadoHotel"><i class="fa fa-circle-o"></i> Estado Hotel</a></li>
            <li><a href="estadoHabitaciones"><i class="fa fa-language"></i> Estado Habitaciones</a></li>
            <li><a href="objetosOlvidados"><i class="fa fa-puzzle-piece"></i> Objetos Olvidos </a></li>
            <li><a href="mantenimiento"><i class="fa fa-wrench" aria-hidden="true"></i> Mantenimiento Habitaciones </a></li>
          </ul>              
        </li> 
        <li class="treeview" id="menuAuditoria" style="display:none"> 
          <a href="#">
            <i class="fa fa-laptop"></i> 
            <span>Auditoria</span>
            <span class="fa fa-angle-left pull-right"></span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="#"><i class="fa fa-clone"></i>Informes de Cierre<i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li>
                  <a href="javascript:imprimeInformeAuditoria('imprimeHuespedesPorHabitacion','Huespedes en Casa Por Habitacion')"><i class="fa fa-bed" aria-hidden="true"></i> Huespedes Por Habitacion</a>
                </li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeCargosdelDia','Cargos del Dia')"><i class="glyphicon glyphicon-paste"></i>Cargos del Dia</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeCargosAnuladosdelDia','Cargos Anulados del Dia')"><i class="glyphicon glyphicon-copy"></i>Cargos Anulados en el Dia </a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeFacturasdelDiaAuditoria','Facturas del Dia')"><i class="glyphicon glyphicon-paste"></i>Facturas del Dia</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimePagosAnuladosdelDia','Pagos Anulados en el Dia')"><i class="glyphicon glyphicon-usd"></i>Pagos Anulados en el Dia</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeBalanceTotalHuesped','Saldo Huespedes')"><i class="fa fa-money"></i>Saldo Huespedes</a></li> 
                <li><a href="javascript:imprimeInformeAuditoria('imprimeBalanceDiario','Saldo Huespedes')"><i class="fa fa-bar-chart"></i>Balance Diario</a></li> 
                <li><a href="javascript:imprimeInformeAuditoria('imprimeReservasDiaDepositos','Depositos a Reserva del Dia')"><i class="glyphicon glyphicon-download-alt"></i>Abonos - Depositos del Dia </a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeBalanceCongeladas','Depositos a Reserva del Dia')"><i class="fa fa-snowflake-o"></i>Cuentas Congeladas </a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimePagosdelDiaConcepto','Flujo de Caja del Dia')"><i class="glyphicon glyphicon-save-file"></i>Flujo de Caja</a></li>
              </ul>
            </li>
            <li><a href="cargarHabitaciones"><i class="fa glyphicon glyphicon-sort-by-attributes"></i> Cargar Habitaciones</a></li>
            <li><a href="cierreDiario"><i class="glyphicon glyphicon-off"></i>Cierre Diario</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Informes</span>
            <span class="fa fa-angle-left pull-right"></span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="#"><i class="fa fa-calendar"></i>Datos<i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="listadoHuespedes"><i class="glyphicon glyphicon-copy"></i>Datos Huespedes </a></li>
                <li><a href="listadoCumpleanios"><i class="glyphicon glyphicon-paste"></i>Cumpleaños Huespedes </a></li>
                <li><a href="listadoCompanias"><i class="fa fa-address-card-o"></i>Datos Compañias</a></li>
                <!--
                <li><a href="listadoContactos"><i class="fa fa-id-badge"></i>Contactos Por Compañia</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeReservasPorFecha','Reservas por Habitacion')"><i class="fa fa-calendar-check-o"></i>Reservas por Fecha Llegada</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeReservasCanceladas','Reservas Canceladas')"><i class="glyphicon glyphicon-save-file"></i>Reservas Canceladas</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeReservasDepositos','Depositos a Reservas')"><i class="glyphicon glyphicon-download-alt"></i>Depositos a Reserva</a></li>
                -->
              </ul>
            </li>
            <li>
              <a href="#"><i class="fa fa-calendar"></i>Reservas<i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="javascript:imprimeInformeAuditoria('imprimeReservasHoy','Reservas Esperadas en el Dia')"><i class="glyphicon glyphicon-copy"></i>Reservas Esperadas Hoy </a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeReservasCreadasHoy','Reservas Creadas en el Dia')"><i class="glyphicon glyphicon-paste"></i>Reservas Creadas Hoy </a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeReservasPorApellido','Reservas por Apellido')"><i class="fa fa-address-card-o"></i>Reservas por Apellido</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeReservasPorHabitacion','Reservas por Habitacion')"><i class="fa fa-id-badge"></i>Reservas por Habitacion</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeReservasPorFecha','Reservas por Habitacion')"><i class="fa fa-calendar-check-o"></i>Reservas por Fecha Llegada</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeReservasCanceladas','Reservas Canceladas')"><i class="glyphicon glyphicon-save-file"></i>Reservas Canceladas</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeReservasDepositos','Depositos a Reservas')"><i class="glyphicon glyphicon-download-alt"></i>Depositos a Reserva</a></li>
              </ul>
            </li>
            <li>
              <a href="#"><i class="fa fa-home"></i> Recepcion<i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="javascript:imprimeInformeAuditoria('imprimeHuespedesPorHabitacion','Huespedes Por Habitacion')"><i class="fa fa-circle-o"></i>Huespedes Por Habitacion</a></li> 
                <li><a href="javascript:imprimeInformeAuditoria('imprimeHuespedesPorApellido','Huespedes Por Apellido')"><i class="fa fa-circle-o"></i>Huespedes Por Apellido</a></li> 
                <li><a href="javascript:imprimeInformeAuditoria('imprimeHuespedesLlegadasHoy','Llegadas del Dia')"><i class="fa fa-taxi"></i>Llegadas del Dia</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeHuespedesSinReserva','Llegadas Sin Reserva')"><i class="fa fa-bus"></i>Llegadas Sin Reserva</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeHuespedesAcompanantes','Huespedes con Acompañantes')"><i class="fa fa-users"></i>Huespedes con Acompañantes</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeHuespedesSalidasHoy','Salidas del Dia')"><i class="fa fa-sign-out"></i>Salidas del Dia</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeHuespedesPorSalir','Salidas Pendientes')"><i class="glyphicon glyphicon-download-alt"></i>Salidas Pendientes</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeBalanceTotalHuesped','Balance Huespedes')"><i class="fa fa-balance-scale"></i>Balance Huespedes</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeExtranjerosenCasa','Extranjeros en Casa')"><i class="fa fa-circle-o"></i>Extranjeros en Casa</a></li> 
                <li><a href="javascript:imprimeInformeAuditoria('imprimeRegistrosHoteleros','Registros Hoteleros')"><i class="fa fa-circle-o"></i>Registros Hoteleros</a></li> 
              </ul>
            </li> 
            <li>
              <a href="#"><i class="fa fa-usd"></i>Financieros<i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="javascript:imprimeInformeAuditoria('imprimeCargosdelDia','Cargos del Dia')"><i class="glyphicon glyphicon-paste"></i>Cargos del Dia</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeCargosdelDiaConcepto','Cargos del Dia por Concepto')"><i class="glyphicon glyphicon-paste"></i>Cargos del Dia por Concepto</a></li>
                <li><a href=" javascript:imprimeInformeAuditoria('imprimeCargosdelDiaCajero','Cargos del Dia Por Cajeros')"><i class="glyphicon glyphicon-paste"></i>Cargos del Dia Por Cajeros</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeCargosdelDiaHabitacion','Cargos del Dia Por Habitacion')"><i class="glyphicon glyphicon-paste"></i>Cargos del Dia Por Habitacion</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeCargosAnuladosdelDia','Cargos Anulados en el Dia ')"><i class="glyphicon glyphicon-copy"></i>Cargos Anulados en el Dia </a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimePagosdelDia','Pagos del Dia')"><i class="glyphicon glyphicon-save-file"></i>Pagos del Dia</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimePagosdelDiaConcepto','Flujo de Caja del Dia')"><i class="glyphicon glyphicon-save-file"></i>Flujo de Caja</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimePagosdelDiaCajero','Pagos del Dia por Cajero')"><i class="glyphicon glyphicon-save-file"></i>Pagos del Dia por Cajero</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimePagosdelDiaHabitacion','Pagos del Dia Por Habitacion')"><i class="glyphicon glyphicon-paste"></i>Pagos del Dia Por Habitacion</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimePagosAnuladosdelDia','Pagos Anulados en el Dia')"><i class="glyphicon glyphicon-usd"></i>Pagos Anulados en el Dia</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeFacturasdelDiaAuditoria','Facturas del Dia')"><i class="glyphicon glyphicon-paste"></i>Facturas del Dia</a></li>
                <li><a href="informeFacturasRango"><i class="glyphicon glyphicon-paste"></i>Facturas por Rango de Fechas</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeBalanceTotalHuesped','Saldo Huespedes')"><i class="fa fa-circle-o"></i>Saldo Huespedes</a></li> 
                <li><a href="javascript:imprimeInformeAuditoria('imprimeBalanceDiario','Balance Diario')"><i class="fa fa-circle-o"></i>Balance Diario</a></li> 
                <li><a href="javascript:imprimeInformeAuditoria('imprimeBalanceCongeladas','Cuentas Congeladas')"><i class="fa fa-snowflake-o"></i>Cuentas Congeladas</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeReservasDiaDepositos','Depositos a Reserva del Dia ')"><i class="glyphicon glyphicon-download-alt"></i>Abonos - Depositos del Dia </a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeEstadoCartera','Estado Cartera ')"><i class="fa fa-snowflake-o"></i>Estado Cartera</a></li>
              </ul>
            </li>
            <li>
              <a href="#"><i class="fa fa-bed"></i>Ama de LLaves<i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="javascript:imprimeInformeAuditoria('imprimeEstadoHabitaciones','Estado Habitaciones')"><i class="glyphicon glyphicon-paste"></i>Estado Habitaciones</a></li>
                <li><a href="javascript:imprimeInformeAuditoria('imprimeHabitacionesMmto','Habitaciones en Mantenimiento')"><i class="glyphicon glyphicon-paste"></i>Habitaciones en Mantenimiento</a></li>
                
              </ul>  
            </li>
            <li>
              <a href="#"><i class="fa fa-clone"></i>Historico Movimientos<i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="historicoReservas"><i class="fa fa-files-o"></i>Historico Reservas</a></li>
                <li><a href="historicoCajeros"><i class="fa fa-files-o"></i>Historico Cajeros</a></li>
                <li><a href="informeFacturasRango"><i class="fa fa-files-o"></i>Historico Facturas</a></li>
                <li><a href="informeRecibosCajaRango"><i class="fa fa-files-o"></i>Historico Recibos de Caja</a></li>
                <li><a href="historicoAuditoria"><i class="fa fa-circle-o"></i>Historico Auditorias</a></li> 
              </ul>
            </li> 
          </ul>
        </li>
        <li><a href="javascript:cierraSesion()"><i class="glyphicon glyphicon-off" aria-hidden="true"></i><span>Cerrar Sesion </span></a></li>
      </ul>
    </section>
  </aside>
  <?php
}
?>

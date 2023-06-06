<?php

    require '../../../../res/php/titles.php';
    require '../../../../res/php/app_topPos.php';

    $fpago = $_POST['formapago'];

    if (isset($_POST['comandaPag'])) {
        $comanda = $_POST['comandaPag'];
        $_SESSION['NUMERO_COMANDA'] = $comanda;
    } else {
        $comanda = $_SESSION['NUMERO_COMANDA'];
    }

    $pms = $pos->getPagoPMS($fpago);

    $_SESSION['PMS'] = $pms;

    $total = str_replace(',', '', $_POST['totalini']);
    $impuesto = str_replace(',', '', $_POST['totalImp']);
    // $totaldesc = str_replace(',', '', $_POST['descuento']);
    $propina = str_replace(',', '', $_POST['propinaPag']);
    $monto = str_replace(',', '', $_POST['montopago']);
    // $abonos = str_replace(',', '', $_POST['abono']);
    $cambio = $_POST['cambio'];
    // $servicio = 0;
    $servicio = $_POST['servicio'];

    $pagado = $monto + $cambio;

    // $totaldesc = str_replace('.00', '', $totaldesc);
    $totaldesc = 0;

    $ambiente = $_POST['ambientePag'];
    $nombreambiente = $_POST['nombreAmbiente'];

    $usuario = $_POST['usuarioPag'];
    $idusuario = $_POST['idusuario'];
    $cliente = $_POST['clientes'];
    $prefijo = $_POST['prefijo'];
    $fecha = $_POST['fecha'];

    $pax = 1;
    $mesa = '00';
    $numrows = 0;
    $fechapos = $fecha;

    $datosmesa = $pos->getDatosComanda($comanda, $ambiente);

    $pax = $datosmesa[0]['pax'];
    $mesa = $datosmesa[0]['mesa'];
    $motivoDes = $datosmesa[0]['motivo_descuento'];

    $ventasdia = $pos->getProductosVentaComanda($comanda, $ambiente);

    $numerofactura = $pos->getNumeroFactura($ambiente);
    $numFactura = $numerofactura[0]['conc_factura'];
    $numOrden = $numerofactura[0]['conc_orden'];
    $codigoVen = 0;
    $codigoPro = 0;
    $codigoSer = 0;

    if ($pms == 0) {
        $nFactura = $numFactura;
        $numero = $pos->updateNumeroFactura($ambiente, $nFactura + 1);
    } else {
        $nFactura = $numOrden;
        $numero = $pos->updateNumeroOrden($ambiente, $nFactura + 1);
        $infoCargo = $pos->traeInfoCodigosPMS($ambiente);
        $codigoVen = $infoCargo[0]['codigo_venta'];
        $codigoPro = $infoCargo[0]['codigo_propina'];
        $codigoSer = $infoCargo[0]['codigo_servicio'];
    }

    $_SESSION['NUMERO_COMANDA'] = $comanda;
    $_SESSION['NUMERO_FACTURA'] = $nFactura;
    $_SESSION['AMBIENTE_ID'] = $ambiente;
    $_SESSION['NOMBRE_AMBIENTE'] = $nombreambiente;
    $_SESSION['usuario'] = $usuario;

    $subtotal = 0;
    $impuesto = 0;
    foreach ($ventasdia as $ventadia) {
        $idpr = $ventadia['producto_id'];
        $inom = $ventadia['nom'];
        $iven = $ventadia['venta'];
        $ican = $ventadia['cant'];
        $iimp = $ventadia['importe'];
        $iamb = $ventadia['ambiente'];
        $vdes = $ventadia['descuento'];
        $vpor = $ventadia['por_desc'];
        $vimp = $ventadia['impto'];
        $valimp = $ventadia['valorimpto'];
        $subtotal = $subtotal + $iven;
        $impuesto = $impuesto + $valimp;

        $factura = $pos->insertProductoVentas($iamb, $inom, $iven, $ican, $iimp, $idpr, $vimp, $valimp, $nFactura, $usuario, $comanda, $vdes, $vpor, $pms);
    }

    $insFact = $pos->insertFacturaVentaPOS($nFactura, $comanda, $ambiente, $mesa, $pax, $usuario, $total, $subtotal, $impuesto, $propina, $totaldesc, $pagado, $cambio, $fecha, $pms, 'A', $fpago, $cliente, $motivoDes, $servicio);

    $actComanda = $pos->updateFacturaComanda($nFactura, 'P', $usuario, $fecha, $comanda, $ambiente);

    $actMesa = $pos->updateMesaPos($ambiente, $mesa);

    if ($pms == 1) {
        $descri = $pos->getDescripcionCargo($codigoVen);
        $descargo = $descri[0]['descripcion_cargo'];
        $impcargo = $descri[0]['id_impto'];
        $datosCliente = $pos->getDatosHuespedesenCasa($cliente);
        $nrohabi = $datosCliente[0]['num_habitacion'];
        $idhues = $datosCliente[0]['id_huesped'];
        $nrores = $datosCliente[0]['num_reserva'];
        $cargoPMS = $pos->cargosInterfasePOS($fechapos, $subtotal, $impuesto, $codigoVen, $nrohabi, $descargo, $impcargo, $idhues, $prefijo.'_'.$nFactura, $nrores, $comanda, $usuario, $idusuario);

        if ($propina != 0) {
            $descri = $pos->getDescripcionCargo($codigoPro);
            $descargo = $descri[0]['descripcion_cargo'];
            $impcargo = $descri[0]['id_impto'];
            $cargoPro = $pos->cargosInterfasePOS($fechapos, $propina, 0, $codigoPro, $nrohabi, $descargo, 0, $idhues, $prefijo.'_'.$nFactura, $nrores, $comanda, $usuario, $idusuario);
            echo $cargoPro;
        }

        if ($servicio != 0) {
            $descri = $pos->getDescripcionCargo($codigoSer);
            $descargo = $descri[0]['descripcion_cargo'];
            $impcargo = $descri[0]['id_impto'];
            $cargoPro = $pos->cargosInterfasePOS($fechapos, $servicio, 0, $codigoSer, $nrohabi, $descargo, 0, $idhues, $prefijo.'_'.$nFactura, $nrores, $comanda, $usuario, $idusuario);
            echo $cargoPro;
        }
    }

    echo $nFactura;

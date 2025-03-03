<?php
    require '../../../res/php/app_topHotel.php'; 
        
    $nroFactura = '19899';
    
    $diasCre = 0;
     
    $resFac = $hotel->getResolucion(1);

    $resolucion = $resFac[0]['resolucion'];
    $prefijo = $resFac[0]['prefijo'];
    $fechaRes = $resFac[0]['fecha'];
    $desde = $resFac[0]['desde'];
    $hasta = $resFac[0]['hasta'];
    
    $infoFE = $hotel->traeInfoFE($nroFactura);

    $cufe = $infoFE[0]['cufe'];
    $timeCrea = $infoFE[0]['timeCreated'];
    $QRStr = $infoFE[0]['QRStr'];
    
    $dataFac = $hotel->traeDatosFactura($nroFactura);

    $reserva  = $dataFac[0]['numero_reserva'];
    $tipofac  = $dataFac[0]['tipo_factura'];
    $nroFolio = $dataFac[0]['folio_cargo'] ;
    $idhues   = $dataFac[0]['id_huesped'];
    $idcia    = $dataFac[0]['id_perfil_factura'];
    $usuario  = $dataFac[0]['usuario_factura'];
    $codigo   = $dataFac[0]['id_codigo_cargo'];
    $detallePag = $dataFac[0]['informacion_cargo'];
    $refer = $dataFac[0]['referencia_cargo'];

    $idhuesped = $idhues;

    if ($tipofac == 1) {
        $id = $idhues;
    } else {
        $id = $idcia;
        $dataCompany = $hotel->getSeleccionaCompania($id);
        $diasCre = $dataCompany[0]['dias_credito'];
        if ($codigo == 2) {
            $diasCre = $dataCompany[0]['dias_credito'];
            $fechaVen = strtotime('+ '.$diasCre.' day', strtotime($fechaFac));
            $fechaVen = date('Y-m-d', $fechaVen);
        }
    }
    
    $idperfil = $id;

    include_once '../../imprimir/imprimeFacturaCopia.php';


    


 
/* echo json_encode($estadofactura); */
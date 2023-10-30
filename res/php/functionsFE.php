<?php

require 'init.php';
date_default_timezone_set('America/Bogota');

class User_Actions{

  public function ingresaDSNC($infoJSON, $IsValid, $StatusCode, $StatusDescription, $StatusMessage, $string, $message, $send_email_success, $send_email_date_time, $urlinvoicexml, $urlinvoicepdf, $cuds, $uuid_dian, $QRStr, $Created, $number, $prefix){
    global $database;

    $data = $database->insert('datosDS',[
      'message' => $message, 
      'send_email_success' => $send_email_success, 
      'send_email_date_time' => $send_email_date_time, 
      /* 'responseDian' => , 
      'invoicexml' => , 
      'zipinvoicexml' => , 
      'unsignedinvoicexml' => , 
      'reqfe' => , 
      'attacheddocument' => ,  
      'urlinvoiceattached' => , 
      'recibeCurl' => , 
      'pdfEnviado' => , 
      */     
      'rptafe' => $uuid_dian, 
      'urlinvoicexml' => $urlinvoicexml, 
      'urlinvoicepdf' => $urlinvoicepdf, 
      'cude' => $cuds, 
      'QRStr' => $QRStr, 
      'estadoEnvio' => $IsValid, 
      'jsonEnviado' => json_encode($infoJSON), 
      'errorMessage' => $string, 
      'statusCode' => $StatusCode, 
      'statusDesc' => $StatusDescription, 
      'statusMess' => $StatusMessage, 
      'timeCreated' => $Created, 
      'DSNumero' => $number, 
      'prefijo' => $prefix

    ]);
    return $database->id();

  }


  public function motivoRechazoNC(){
    global $database;

    $data = $database->select('motivoRechazoNC',[
      'id',
      'descripcionRechazo',
      'code',
    ]);
    return $data;
  }

  public function anulaDS($id, $numDocu, $motivo, $rechazo, $usuario_id, $idNC){
    global $database;

    $data = $database->update('productosDSCabeza',[
      'estado' => 1,
      'idUsuarioAnula' => $usuario_id,
      'motivoAnulacion' => $motivo,
      'idMotivoRechazo' => $rechazo,
      'idDatosDS' => $idNC,
    ],[
      'documentoSoporte' => $numDocu
    ]);
    return $data->rowCount();
  }

  public function getInfoDSAnular($numDocu){
    global $database;

    $data = $database->select('datosDS',[
      'DSNumero',
      'cude',
    ],[
      'DSNumero' => $numDocu,
    ]);
    return $data;
  }

  public function actualizaEstadoDS($idDoc, $conse){
    global $database;

    $data = $database->update('productosDSCabeza',[
      'estadoDian' => 1,
      'documentoSoporte' => $conse,
    ],[
      'idDocumento' => $idDoc,
    ]);
    return $data->rowCount();
  }

  public function incrementaDS($numDoc){
    global $database;

    $data = $database->update('parametrosFE',[
      'consecutivoDS' => $numDoc,
    ]);
    return $data->rowCount();
  }

  public function ingresaDS($dataDS, $prefijoDS, $consecutivoDS, $status, $StatusCode, $statusText, $StatusDescription, $StatusMessage, $ErrorMessage, $IsValid, $message, $send_email_success, $send_email_date_time, $urlinvoicexml, $urlinvoicepdf, $cude, $QRStr, $Created){
    global $database;

    $data = $database->insert('datosDS',[
      'DSNumero' => $consecutivoDS,
      'prefijo' => $prefijoDS,
      'timeCreated' => $Created,
      'message' => $message,
      'send_email_success' => $send_email_success,
      'send_email_date_time' => $send_email_date_time,
      'urlinvoicexml' => $urlinvoicexml,
      'urlinvoicepdf' => $urlinvoicepdf,
      'cude' => $cude,
      'QRStr' => $QRStr,
      'estadoEnvio' => $IsValid,
      'jsonEnviado' => $dataDS,
      'errorMessage' => $ErrorMessage,
      'statusCode' => $StatusCode,
      'statusDesc' => $StatusDescription,
      'statusMess' => $StatusMessage,
    ]);
    $result = [
      'id' => $database->id(),
      'error' => $database->errorInfo,
    ];

    return $result;    
  }

  public function getProductosDS($id){
    global $database;

    $data = $database->query("SELECT
    codigos_vta.descripcion_cargo,
    codigos_vta.identificador_dian,
    unidades.descripcion_unidad,
    unidades.unidadDian,
    productosDSDetalle.valorUnitario,
    productosDSDetalle.cantidad,
    productosDSDetalle.valorTotal,
    productosDSDetalle.idDocumento
    FROM
    codigos_vta ,
    productosDSDetalle ,
    unidades
    WHERE
    productosDSDetalle.idCargo = codigos_vta.id_cargo AND
    productosDSDetalle.idUnidad = unidades.id_unidad AND
    productosDSDetalle.idDocumento = '$id'
    ORDER BY 
    codigos_vta.descripcion_cargo")->fetchAll();
    return $data;
  }

  public function getInfoDocu($id){
    global $database;

    $data = $database->query("
    SELECT
    companias.empresa,
    companias.nit,
    companias.dv,
    companias.tipoAdquiriente,
    companias.celular,
    companias.direccion,
    companias.email,
    companias.tipo_documento,
    companias.tipoAdquiriente,
    companias.ciudad,
    companias.responsabilidadTributaria
    productosDSCabeza.idDocumento,
    productosDSCabeza.documentoSoporte,
    productosDSCabeza.numeroDocumento,
    productosDSCabeza.tipoOperacion,
    productosDSCabeza.idProveedor,
    productosDSCabeza.fechaDocumento,
    productosDSCabeza.vencimiento,
    productosDSCabeza.fechaVencimiento,
    productosDSCabeza.idFormaPago,
    productosDSCabeza.observaciones,
    productosDSCabeza.estadoDian,
    productosDSCabeza.estado,
    SUM(productosDSDetalle.valorTotal) AS total,
    codigos_vta.descripcion_cargo
    FROM
    companias ,
    codigos_vta ,
    productosDSCabeza,
    productosDSDetalle
    WHERE
    productosDSCabeza.idProveedor = companias.id_compania AND
    productosDSCabeza.idFormaPago = codigos_vta.id_cargo AND
    productosDSCabeza.idDocumento = productosDSDetalle.idDocumento and
    productosDSCabeza.idDocumento = '$id'
    GROUP BY 
    productosDSDetalle.idDocumento   
    ")->fetchAll();
    return $data;
  } 

  public function getInfoDS($id){
    global $database;

    $data = $database->query("SELECT
    companias.empresa,
    companias.nit,
    companias.dv,
    companias.tipoAdquiriente,
    companias.celular,
    companias.direccion,
    companias.email,
    companias.tipo_documento,
    companias.tipoAdquiriente,
    companias.ciudad,
    companias.responsabilidadTributaria,
    productosDSCabeza.idDocumento,
    productosDSCabeza.documentoSoporte,
    productosDSCabeza.numeroDocumento,
    productosDSCabeza.tipoOperacion,
    productosDSCabeza.idProveedor,
    productosDSCabeza.fechaDocumento,
    productosDSCabeza.vencimiento,
    productosDSCabeza.fechaVencimiento,
    productosDSCabeza.idFormaPago,
    productosDSCabeza.observaciones,
    productosDSCabeza.estadoDian,
    productosDSCabeza.motivoAnulacion,
    productosDSCabeza.idMotivoRechazo,
    productosDSCabeza.estado,
    SUM(productosDSDetalle.valorTotal) AS total,
    codigos_vta.descripcion_cargo,
    codigos_vta.formaPagoDian,
    codigos_vta.identificador_dian
    FROM
    companias ,
    codigos_vta ,
    productosDSCabeza,
    productosDSDetalle
    WHERE
    productosDSCabeza.idProveedor = companias.id_compania AND
    productosDSCabeza.idFormaPago = codigos_vta.id_cargo AND
    productosDSCabeza.idDocumento = productosDSDetalle.idDocumento and
    productosDSCabeza.idDocumento = '$id'
    GROUP BY 
    productosDSDetalle.idDocumento ")->fetchAll();
    return $data;
  }

  public function getDocumentoSoporte(){
    global $database;

    $data = $database->query("SELECT
    companias.empresa,
    companias.nit,
    companias.dv,
    productosDSCabeza.idDocumento,
    productosDSCabeza.documentoSoporte,
    productosDSCabeza.numeroDocumento,
    productosDSCabeza.tipoOperacion,
    productosDSCabeza.idProveedor,
    productosDSCabeza.fechaDocumento,
    productosDSCabeza.vencimiento,
    productosDSCabeza.fechaVencimiento,
    productosDSCabeza.idFormaPago,
    productosDSCabeza.observaciones,
    productosDSCabeza.estadoDian,
    productosDSCabeza.estado,
    Sum(productosDSDetalle.valorTotal) AS total,
    codigos_vta.descripcion_cargo
    FROM
    companias ,
    codigos_vta ,
    productosDSCabeza ,
    productosDSDetalle
    WHERE
    productosDSCabeza.idProveedor = companias.id_compania AND
    productosDSCabeza.idFormaPago = codigos_vta.id_cargo AND
    productosDSCabeza.idDocumento = productosDSDetalle.idDocumento
    GROUP BY
    productosDSDetalle.idDocumento
    ORDER BY
    productosDSCabeza.idDocumento
    
    ")->fetchAll();
    return $data;
  }
  
  public function getDocumentoSoporteOld(){
    global $database;

    $data = $database->select('productosDSCabeza',[
      '[>]companias' => ['idProveedor' => 'id_compania'],
      '[>]codigos_vta' => ['idFormaPago' => 'id_cargo'],
    ],[
      'companias.empresa',
      'companias.nit',
      'companias.dv',
      'productosDSCabeza.documentoSoporte',
      'productosDSCabeza.numeroDocumento',
      'productosDSCabeza.tipoOperacion',
      'productosDSCabeza.idProveedor',
      'productosDSCabeza.fechaDocumento',
      'productosDSCabeza.vencimiento',
      'productosDSCabeza.fechaVencimiento',
      'productosDSCabeza.idFormaPago',
      'productosDSCabeza.observaciones',
      'productosDSCabeza.estadoDian',
      'productosDSCabeza.estado',
    ]);
    return $data;
  }

  public function ingresaDetalleDocumento($itemcompra, $unidad, $precio, $cantidad, $total, $imptos, $retencion, $idDoc){
    global $database;

    $data = $database->insert('productosDSDetalle',[
      'idCargo' => $itemcompra, 
      'idUnidad' => $unidad, 
      'valorUnitario' => $precio, 
      'cantidad' => $cantidad, 
      'valorTotal' => $total, 
      'idImpuesto' => $imptos, 
      'idRetencion' => $retencion, 
      'idDocumento' => $idDoc,
    ]);
    
  }

  public function ingresaEncabezadoDocumento($docu ,$tipo ,$prov ,$fech ,$plaz ,$venc ,$form ,$usuario_id ,$come){
    global $database;

    $data = $database->insert('productosDSCabeza',[      
      'numeroDocumento' => $docu,
      'tipoOperacion' => $tipo,
      'idProveedor' => $prov,
      'fechaDocumento' => $fech,
      'vencimiento' => $plaz,
      'fechaVencimiento' => $venc,
      'idFormaPago' => $form,
      'idUsuario' => $usuario_id,
      'observaciones' => $come,
      'createdAt' => date('Y-m-d H:i:s'),
    ]);
    $result = [
      'id' => $database->id(),
      'error' => $database->errorInfo,
    ];

    return $result;
  }

  public function getDetalleProducto($id){
    global $database;

    $data = $database->query("SELECT
      codigos_vta.id_cargo,
      codigos_vta.descripcion_cargo,
      codigos_vta.unidad,
      codigos_vta.id_impto,
      unidades.descripcion_unidad,
      unidades.unidadDian,
      codigos_vta.precio,
      codigos_vta.identificador_dian,
      impuestos.descripcion_cargo AS descripcionImpto,
      codigos_vta.tipo_codigo
    FROM
      codigos_vta ,
      unidades ,
      codigos_vta AS impuestos
    WHERE
      codigos_vta.unidad = unidades.id_unidad AND
      codigos_vta.id_impto = impuestos.id_cargo AND
      codigos_vta.tipo_codigo = 4 AND
      codigos_vta.id_cargo = $id
    ORDER BY
      codigos_vta.descripcion_cargo ASC")->fetchAll();
    return $data;
  }
  
  public function getTipoImpuestos($tipo){
    global $database;
    
    $data = $database->select('codigos_vta',[
      'id_cargo',
      'descripcion_cargo',
      'cuenta_puc',
      'porcentaje_impto',
      'precio'
    ],[
      'tipo_codigo' => 2,
      'tipo_impto' => $tipo,
      'restringido' => 0,
      'ORDER' => ['descripcion_cargo' => 'ASC']      
    ]);
    return $data;

  }

  public function ingresaPago($nombre, $codigo, $tipo, $puc, $centro, $descripcion, $usuario){
    global $database;

    $data = $database->insert('codigos_vta',[
      'descripcion_cargo' => $nombre, 
      'identificador_dian' => $codigo,
      'cuenta_puc' => $puc, 
      'centroCosto' => $centro, 
      'descripcion_contable' => $descripcion, 
      'usuario' => $usuario,
      'formaPagoDian' => $tipo,
      'tipo_codigo' => 5,
      'createdAt' => date('Y-m-d H:i:s'),

    ]);

    $result = [
      'id' => $database->id(),
      'error' => $database->errorInfo,
    ];

    return $result;
  }

  public function getFormasPago(){
    global $database;

    $data = $database->select('codigos_vta', [
      'id_cargo',
      'descripcion_cargo',
      'cuenta_puc',
      'formaPagoDian',
      'identificador_dian',
    ], [
        'ORDER' => 'descripcion_cargo',
        'tipo_codigo' => 5,
    ]);

    return $data;
  }

  public function ingresaProducto($nombreAdi, $codigoAdi, $ImptosAdi, $unidad, $precioAdi, $pucAdi, $centroAdi, $descripcionAdi, $usuario, $codigoDian){
    global $database;

    $data = $database->insert('codigos_vta',[
      'descripcion_cargo' => $nombreAdi, 
      'identificador_dian' => $codigoAdi, 
      'id_impto' => $ImptosAdi, 
      'unidad' => $unidad, 
      'precio' => $precioAdi, 
      'cuenta_puc' => $pucAdi, 
      'centroCosto' => $centroAdi, 
      'descripcion_contable' => $descripcionAdi, 
      'usuario' => $usuario,
      'tipo_codigo' => 4,
      'unidadDian' => $codigoDian,
      'createdAt' => date('Y-m-d H:i:s'),
    ]);
    $result = [
      'id' => $database->id(),
      'error' => $database->errorInfo,
    ];

    return $result;
    
  }
  
  public function ingresaProveedor($empresa, $apellido1, $apellido2, $nombre1, $nombre2, $nit, $dv, $direccion, $ciudad, $telefono, $celular, $correo, $web, $tipo_emp, $tipo_doc, $ciiu, $tipoAdquiriente, $tipoResponsabilidad, $responsabilidadTribu, $usuario){
    global $database;

    $data = $database->insert('companias',[      
      'empresa' => $empresa, 
      'apellido1' => $apellido1, 
      'apellido2' => $apellido2, 
      'nombre1' => $nombre1, 
      'nombre2' => $nombre2, 
      'nit' => $nit, 
      'dv' => $dv, 
      'direccion' => $direccion, 
      'ciudad' => $ciudad, 
      'telefono' => $telefono, 
      'celular' => $celular, 
      'email' => $correo, 
      'web' => $web, 
      'tipo_empresa' => $tipo_emp, 
      'tipo_documento' => $tipo_doc, 
      'id_codigo_ciiu' => $ciiu, 
      'tipoAdquiriente' => $tipoAdquiriente, 
      'tipoResponsabilidad' => $tipoResponsabilidad, 
      'responsabilidadTributaria' => $responsabilidadTribu,
      'activo' => 1,
      'created_at' => date('Y-m-d H:i:s'),
      'tipo_compania' => 1,
      'usuario' => $usuario,
    ]);
    $result = [
      'id' => $database->id(),
      'error' => $database->errorInfo,
    ];

    return $result;
  }

  public function traeEstadoFacturacion(){
    global $database;

    $data = $database->select('empresas',[
      'facturacionElectronica'
    ]);
    return $data;
  }

  public function getCompanias(){
    global $database;

    $data = $database->select('companias', [
        'id_compania',
        'empresa',
        'nombre1',
        'nombre2',
        'apellido1',
        'apellido2',
        'direccion',
        'nit',
        'dv',
        'tipo_documento',
        'telefono',
        'celular',
        'fax',
        'email',
        'id_tarifa',
        'estado_credito',
        'activo',
        'tipo_compania',
    ], [
        'ORDER' => 'empresa',
    ]);

    return $data;
  }

  public function getTipoResponsabilidad(){
    global $database;

    $data = $database->select('dianRegimenFiscal', [
      'descripcion',
      'id',
    ], [
        'ORDER' => ['descripcion' => 'ASC'],
    ]);

    return $data;
  }

  public function getTipoAdquiriente(){
    global $database;

    $data = $database->select('dianTipoAdquiriente', [
        'descripcionAdquiriente',
        'id',
    ], [
        'ORDER' => ['descripcionAdquiriente' => 'ASC'],
    ]);

    return $data;
  }

  public function getResponsabilidadTributaria(){
      global $database;

      $data = $database->select('dianTipoResponsabilidad', [
          'descripcionResponsabilidad',
          'id',
      ], [
          'ORDER' => ['descripcionResponsabilidad' => 'ASC'],
      ]);

      return $data;
  }

  public function datosTokenFE(){
    global $database;

    $data = $database->select('parametrosFE', [
      'token',
      'password',
      'facturador',
      'documentoSoporte',
      'nominaElectronica',
      'radian',
      'prefijoFE',
      'prefijoDS',
      'prefijoNE',
      'prefijoFENC',
      'prefijoFEND',
      'prefijoDSNC',
      'prefijoDSND',
      'prefijoNENC',
      'prefijoNEND',
      'consecutivoFE',
      'consecutivoDS',
      'consecutivoNE',
      'consecutivoNCFE',
      'consecutivoNDFE',
      'consecutivoNCDS',
      'consecutivoNDDS',
      'rutaFE',
    ]);

    return $data;
  }

  public function traeProveedor($id){
    global $database;

    $data = $database->select('companias', [
      'empresa',
      'direccion',
      'nit',
      'dv',
      'tipo_documento',
      'telefono',
      'celular',
      'email',
      'web',
      'ciudad',
      'credito',
      'monto_credito',
      'tipo_empresa',
      'id_codigo_ciiu',
      'tipoAdquiriente',
      'tipoResponsabilidad',
      'responsabilidadTributaria',
    ], [
      'id_compania' => $id,
    ]);

    return $data;
  }

  public function getResolucion($tipoDoc){
    global $database;

    $data = $database->select('resoluciones', [
      'resolucion',
      'fecha',
      'prefijo', 
      'desde',
      'hasta',
      'estado',
      'tipo',
    ], [
      'estado' => 1,
      'tipoDocumento' => $tipoDoc,
    ]);

    return $data;
  }

  public function traeNumeroDocumento($tipo){
    global $database;
    switch ($tipo) {
      case '1':
        $campo1 = 'consecutivoFE';
        $campo2 = 'prefijoFE';
        break;
      case '2':
        $campo1 = 'consecutivoDS';
        $campo2 = 'prefijoDS';
        break;
      case '3':
        $campo1 = 'consecutivoNE';
        $campo2 = 'prefijoNE';
        break;
      case '4':
        $campo1 = 'consecutivoNCFE';
        $campo2 = 'prefijoNCFE';
        break;
      case '5':
        $campo1 = 'consecutivoNDFE';
        $campo2 = 'prefijoNDFE';
        break;
      case '6':
        $campo1 = 'consecutivoNCDS';
        $campo2 = 'prefijoNCDS';
        break;
      case '7':
        $campo1 = 'consecutivoNDDS';
        $campo2 = 'prefijoNDFDS';
        break;                
      default:
        # code...
        break;
    }

    $data = $database->select('parametrosFE',[
      $campo1,
      $campo2,
    ]);
    return $data; 
  }

  public function getCodigosVentas($tipo){
    global $database;

    $data = $database->query("SELECT
    codigos_vta.id_cargo,
    codigos_vta.descripcion_cargo,
    unidades.descripcion_unidad,
    unidades.unidadDian,
    codigos_vta.precio,
    codigos_vta.identificador_dian,
    impuestos.descripcion_cargo AS descripcionImpto,
    codigos_vta.tipo_codigo
    FROM
    codigos_vta ,
    unidades ,
    codigos_vta AS impuestos
    WHERE
    codigos_vta.unidad = unidades.id_unidad AND
    codigos_vta.id_impto = impuestos.id_cargo AND
    codigos_vta.tipo_codigo = $tipo
    ORDER BY
    codigos_vta.descripcion_cargo ASC")->fetchAll();
    return $data;
  }
  
}


?>
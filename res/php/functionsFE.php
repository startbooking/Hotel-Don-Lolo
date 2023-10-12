<?php

require 'init.php';
date_default_timezone_set('America/Bogota');

class User_Actions{

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
      'createdAt' => date('Y-m-d H:m:i'),
    ]);

    $result = [
      'id' => $database->id(),
      'error' => $database->error,
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

  public function ingresaProducto($nombreAdi, $codigoAdi, $ImptosAdi, $unidad, $precioAdi, $pucAdi, $centroAdi, $descripcionAdi, $usuario){
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
      'createdAt' => date('Y-m-d H:m:i'),
    ]);
    $result = [
      'id' => $database->id(),
      'error' => $database->error,
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
      'created_at' => date('Y-m-d H:m:i'),
      'tipo_compania' => 1,
      'usuario' => $usuario,
    ]);
    $result = [
      'id' => $database->id(),
      'error' => $database->error,
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

  public function datosTokenCia(){
      global $database;

      $data = $database->select('parametros_pms', [
          'token',
          'password',
          'facturador',
          'documentoSoporte',
          'nominaElectronica',
          'radian',
      ]);

      return $data;
  }

  public function traeProveedor($idProv){
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

  public function getResolucion($tipoDoc)
  {
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
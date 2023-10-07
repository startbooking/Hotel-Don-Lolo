<?php

require 'init.php';
date_default_timezone_set('America/Bogota');

class User_Actions
{

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

  public function getCodigosVentas(){
    global $database;

    $data = $database->select('codigosDS', [
      'id_cargo',
      'codigo_depto',
      'descripcionCargo',
      'codigoDian',
      'id_impto',
      'tipoUnidad',
      'valor',
    ], [
      'ORDER' => 'descripcionCargo',
    ]);

    return $data;
  }


  public function getFormasPago(){
    global $database;

    $data = $database->select('formas_pago', [
        'id_pago',
        'descripcion',
        'cuenta_puc',
        'descripcion_contable',
        'pms',
    ], [
        'ORDER' => 'descripcion',
    ]);

    return $data;
}






}


?>
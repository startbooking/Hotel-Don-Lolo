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

  public function getCompanias()
    {
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


}


?>
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

}


?>
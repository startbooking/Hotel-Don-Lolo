<?php

try {
    $client = new SoapClient("http://190.242.96.246/wspandora/WSINVENTARIOS_SOFTWARE.asmx?WSDL",
      array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => TRUE));
    $param = array(
                    'campo' => 'razonsoc',
                    'textobuscar' => 'as'
                    );

    $ready = $client->buscards($param)->buscardsResult;

    var_dump($ready); //Verificar si hay resultado
} catch (Exception $e) {
    trigger_error($e->getMessage(), E_USER_WARNING);
}

?>
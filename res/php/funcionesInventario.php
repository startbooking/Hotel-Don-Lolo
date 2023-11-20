<?php 

  function estadoPedido($tipo){
    switch ($tipo) {
      case 0:
        return 'Anulado';  
        break;
      case 1:
        return 'Ingresado';
        break;
      case 2:
        return 'Generado';  
        break;
      case 3:
        return 'Recibido';  
        break;
    }
  }


  function estadoRequisicion($tipo){
    switch ($tipo) {
      case 0:
        return 'Anulado';  
        break;
      case 1:
        return 'Ingresado';
        break;
      case 2:
        return 'Entregado';  
        break;
      case 3:
        return 'Entrega Parcial';  
        break;
    }
  }

  function estadoMovimiento($tipo){
    switch ($tipo) {
      case 0:
        return 'Anulado';  
        break;
      case 1:
        return 'Activo';
        break;
      case 2:
        return 'Motor Home';  
        break;
      case 3:
        return 'Camping';  
        break;
    }
  }

  function array_sort_by(&$arrIni, $col, $order = SORT_ASC){
    $arrAux = array();
    foreach ($arrIni as $key=> $row){
        $arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
        $arrAux[$key] = strtolower($arrAux[$key]);
    }
    array_multisort($arrAux, $order, $arrIni);
  }

  function buscaCodigoCargo($codigo){
    $hotel       = new Hotel_Actions();
    $CodigoVenta = $hotel->buscaCodigoTipoHabitacion($codigo);
    return $CodigoVenta;
  }

  function buscaTextoCargo($codigo){
    $hotel       = new Hotel_Actions();
    $CodigoVenta = $hotel->buscaTextoCargoTipoHabitacion($codigo);
    return $CodigoVenta;
  }

 ?>


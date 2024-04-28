<?php 

  function tipoOcupacion($tipo){
    switch ($tipo) {
      case 1: 
        return 'Habitacion';
        break;
      case 2:
        return 'Dormitorio';  
        break; 
      case 3:
        return 'Motor Home';  
        break;
      case 4:
        return 'Camping';  
        break;
      case 5:
        return 'Cuenta Maestra';  
        break;
    }
  }

  function tipoMmto($tipo){
    switch ($tipo) {
      case 1:
        return '<span class="label label-success" style="font-size:12px">Correctivo</span>';
        break;
      case 2:
        return '<span class="label label-info" style="font-size:12px">Preventivo</span>';  
        break;
    }
  }

  function estadoInventario($tipo){
    switch ($tipo) {
      case 1:
        return '<span class="alert alert-warning alert-function" style="font-size:12px">SI</span>';
        break;
      case 2:
        return '<span class="alert alert-info alert-function" style="font-size:12px">NO</span>';  
        break;
    }
  }

  function estadoMmto($tipo){
    switch ($tipo) {
      case 1:
        return '<span class="alert alert-success alert-function" style="font-size:12px">En Mantenimiento</span>';
        break;
      case 2:
        return '<span class="alert alert-info alert-function" style="font-size:12px">Estadia</span>';  
        break;
    }
  }

  function tipoBloqueo($tipo){
    switch ($tipo) {
      case 1:
        return '<span class="label label-success" style="font-size:12px">Diaria</span>';
        break;
      case 2:
        return '<span class="label label-info" style="font-size:12px">Estadia</span>';  
        break;
    }
  }

  function estadoObjeto($tipo){
    switch ($tipo) {
      case 0:
        return '<span class="label label-success" style="font-size:12px">Almacenado</span>';
        break;
      case 1:
        return '<span class="label label-info" style="font-size:12px">Entregado</span>';  
        break;
      case 2:
        return '<span class="label label-danger" style="font-size:12px">Baja</span>';  
        break;
    }
  }

  function frecuenciaPaquete($tipo){
    switch ($tipo) {
      case 1:
        return '<span class="label label-success" style="font-size:12px">Diaria</span>';
        break;
      case 2:
        return '<span class="label label-info" style="font-size:12px">Estadia</span>';  
        break;
    }
  }
 
  function tipoCargoPaquete($tipo){
    switch ($tipo) {
      case 1:
        return '<span class="label label-success" style="font-size:12px">Por Persona</span>';
        break;
      case 2:
        return '<span class="label label-info" style="font-size:12px">Por Habitacion</span>'; 
        break;
    }
  }

  function estadoTipoHabi($tipo){
    switch ($tipo) {
      case 0:
        return '<span style="font-size:12px" class="label label-danger">Bloqueada</span>';
        break;
      case 1:
        return '<span style="font-size:12px" class="label label-info">Activa</span>';
        break;
      case 1:
        return '<span style="font-size:12px" class="label label-warning">Mantenimiento</span>';
        break;
    }    
  }

  function tipoHabitacion($tipo){
    switch ($tipo) {
      case 0:
        return '<span style="font-size:12px" class="label label-default">Sin Definir</span>';
        break;
      case 1:
        return '<span style="font-size:12px" class="label label-warning">Habitacion</span>';
        break;
      case 2:
        return '<span style="font-size:12px" class="label label-success">Dormitorio</span>';
        break;
      case 3:
        return '<span style="font-size:12px" class="label label-success">Motor Home</span>';
        break;
      case 4:
        return '<span style="font-size:12px" class="label label-success">Camping</span>';
        break;
      case 5:
        return '<span style="font-size:12px" class="label label-default">Cuenta Maestra</span>';
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

  function sexo($tipo){
    if($tipo==0){
      return '<span style="font-size:12px;" class="label label-success">Sin Asignar</span>';
    }
    if($tipo==1){
      return '<span style="font-size:12px;" class="label label-success">Hombre</span>';
    }
    if($tipo==2){
      return '<span style="font-size:12px;" class="label label-warning">Mujer</span>';
    }
  }

  function estadoAuditoria($tipo){
    if($tipo==1){
      return '<input style="margin-top:1px" class="form-check-input" type="checkbox" name="habitacionOption" id="inlineRadio1" value="1" checked="" disabled>';
    }else{
      return '<input style="margin-top:1px" class="form-check-input" type="checkbox" name="habitacionOption" id="inlineRadio1" value="2" disabled>';        
    }
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

  function buscaHuesped($hues,$tipo){
    if($hues==0){
    }else{ 
      $hotel   = new Hotel_Actions();
      $huesped = $hotel->getNombreHuesped($hues);
      if($tipo==1){
        return '<span class="label label-success labelGuest">'.$huesped[0]['nombre_completo'].'</span>';
      }else{
        return '<span class="label label-warning labelGuest">'.$huesped[0]['nombre_completo'].'</span>';        
      }
    }
  }

  function descripcionTarifa($tipo){
    $hotel  = new Hotel_Actions();
    $tarifa = $hotel->getNombreTarifa($tipo);
    return $tarifa;
  }

  function descripcionTipoHabitacion($tipo){
    $hotel   = new Hotel_Actions();
    $tipohab = $hotel->getNombreTipoHabitacion($tipo);
    $regis   = count($tipohab);
    if($regis==0){
      $nombre = '';
    }else{
      $nombre = $tipohab[0]['descripcion_habitacion'];
    }
    return $nombre;
  }

  function estadoHuesped($estado){
    if($estado==1){
      return '<span style="font-size:12px;" class="label label-success">Activo</span>';
    }else{
      return '<span style="font-size:12px;" class="label label-danger">Bloqueado</span>';
    }
  }

  function estadoCredito($estado){
    switch ($estado) {
      case 1:
        return '<span class="label label-success" style="font-size:12px">Abierto</span>';
        break;
      case 2:
        return '<span class="label label-info" style="font-size:12px">Pago Directo</span>';  
        break;
      case 3:
        return '<span class="label label-info" style="font-size:12px">Sin Credito</span>';  
        break;
    }
    /*
    if($estado==1){
      return '<span style="font-size:12px;" class="label label-success">Activo</span>';
    }else{
      return '<span style="font-size:12px;" class="label label-danger">Bloqueado</span>';
    }
    */
  }

  function asignaCompania($id){
    $hotel     = new Hotel_Actions();
    $nombreCia = $hotel->getNombreEmpresa($id);
    $regis = count($nombreCia);
    if($regis==0){
      $nombre = '';
    }else{
      $nombre = $nombreCia[0]['empresa'];
    }
    return '<label>'.$nombre.'</label>';
  }

  function estadoReserva($code){
    if ($code =='LE'){
      return '<span style="font-size:12px" class="label label-warning">Lista de Espera</span>';
    }elseif ($code =='ES'){
      return '<span style="font-size:12px" class="label label-success">En Espera</span>';
    }elseif($code=='CO'){
      return '<span style="font-size:12px;background-color:#00b7ff" class="label label-defaul">Cuenta Congelada</span>';
    }elseif($code=='CA'){
      return '<span style="font-size:12px" class="label label-info">En Casa</span>';
    }elseif($code=='CX'){
      return '<span style="font-size:12px" class="label label-danger">Cancelada</span>';
    }elseif($code=='SA'){
      return '<span style="font-size:12px" class="label label-info">Salida</span>';
    }elseif($code=='NS'){
      return '<span style="font-size:12px" class="label label-warning">No Show</span>';
    }    
  }

?>


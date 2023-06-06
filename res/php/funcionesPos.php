<?php 

  function estadoFacturaInf($estado){
    if($estado=='X'){
      return 'Anulada';  
    }else{
      return 'Activa';  
    }
  }

  function estadoFacturaAlert($estado){
    if($estado=='X'){
      return '<span class="badge alert-danger">Anulada</span>';
    }else{
      return '<span class="badge alert-success">Activa</span>';
    }
  }


?>


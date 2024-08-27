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
      return '<span class="badge alert alert-danger" style="margin-bottom:0px;">Anulada</span>';
    }else{
      return '<span class="badge alert alert-success" style="margin-bottom:0px;">Activa</span>';
    }
  }


?>


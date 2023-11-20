<?php 
  require '../res/php/app_top.php';

?>

<!DOCTYPE html>
<html lang="es">
  <head>
  	<meta charset="utf-8">
  	<title>SACTel Cloud - Modulos del Sistema</title>
    <?php 
    include_once("../res/shared/archivo_head.php") ;
    ?>
  </head>
  
  <body class="skin-green sidebar-mini">
    <?php  include("../res/menus/menu_salir.php"); ?>

    <section class="container " style="margin-top:1%">      
      <div class="container"> 
        <div class="col-md-5 col-sm-5 col-xs-12">          
          <h1 class="fontModule">
          Control Panel <br>
          <small class="">Modulos del Sistema </small>
          </h1>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12 centro">
            <div class="container-fluid centro" >
              <img class="img-thumbnail logoGen" style="margin-top:0;" src="<?=BASE_WEB?>img/<?=LOGO_EMPRESA?>"> 
            </div>
        </div>          
        <div class="col-sm-5 col-sm-5 col-xs-12">          
          <h1 class="derecha fontModule" >
            <?=NAME_EMPRESA?>
            <br>
            <small>
              Nit <?=NIT_EMPRESA?>
          </small>
          </h1>
        </div>  
      </div>
      <div id="modulos" class="container moduloCentrar mt20 modulos">
        <div id="inv" class="col-lg-4 col-md-4 col-sm-6 col-xs-12 apagado">
          <a onclick="ingresoInv()" class="small-box-footer">
            <div class="small-box bg-yellow-gradient">	
              <div class="inner">	
                <h3>Inventarios</h3>
                <p>Control de Stock</p>
              </div>
              <div class="icon">
                <i class="ion ion-archive"></i>
              </div>
              <small class="small-box-footer" style="font-size:12px">Ingresar
                <i class="fa fa-arrow-circle-right"></i>
              </small>
            </div>
          </a>
        </div>
        <div id="pos" class="col-lg-4 col-md-4 col-sm-6 col-xs-12 apagado">
          <a href="../pos/inicio.php" class="small-box-footer">
            <div class="small-box bg-green-gradient">
              <div class="inner"> 
                <h3>Puntos de Venta</h3> 
                <p>Ventas Restaurantes </p>
              </div>
              <div class="icon">
                <i class="ion ion-coffee"></i>
              </div>
              <small class="small-box-footer" style="font-size:12px">Ingresar
                <i class="fa fa-arrow-circle-right"></i>
              </small>
            </div>
          </a>
        </div>
        <div id="pms" class="col-lg-4 col-md-4 col-sm-6 col-xs-12 apagado">	
          <a onclick="ingresoPms()" >
            <div class="small-box bg-blue-gradient">			
              <div class="inner">				
                <h3>PMS Software </h3> 				
                <p style="color:#FFF" id="fechaPms"></p>
              </div>              			
              <div class="icon">                				
                <i class="ion ion-ios-home-outline"></i>              			
              </div>			
              <span class="small-box-footer">Ingresar 
                <i class="fa fa-arrow-circle-right"></i>
              </span>		
            </div>	
          </a>              
        </div>
        <div id="res" class="col-lg-4 col-md-4 col-sm-6 col-xs-12 apagado">	
          <a>
            <div class="small-box bg-aqua">			
              <div class="inner">				
                <h3>Recetas Estandar </h3> 				
                <p style="color:#FFF" id="">Materia Prima & Productos</p>
              </div>              			
              <div class="icon">                				
                <i class="ion ion-ios-home-outline"></i>              			
              </div>			
              <span class="small-box-footer">Ingresar 
                <i class="fa fa-arrow-circle-right"></i>
              </span>		
            </div>	
          </a>              
        </div>
        <div id="fe" class="col-lg-4 col-md-4 col-sm-6 col-xs-12 apagado">	
          <a href="../fe/inicio.php"> 
            <div class="small-box bg-light-blue-gradient">			
              <div class="inner">				
                <h3>Facturacion Electronica </h3> 				
                <p style="color:#FFF" >Facturacion Electronica</p>
              </div>              			
              <div class="icon">
                <i class="fa-solid fa-laptop-file"></i>
              </div>			
              <span class="small-box-footer">Ingresar 
                <i class="fa fa-arrow-circle-right"></i>
              </span>		
            </div>	
          </a>              
        </div>
        <div id="con" class="col-lg-4 col-md-4 col-sm-6 col-xs-12 apagado">	
          <a>
            <div class="small-box bg-light-blue-gradient">			
              <div class="inner">				
                <h3>Contabilidad </h3> 				
                <p style="color:#FFF" >Contabilidad Hotelera</p>
              </div>              			
              <div class="icon">                				
                <i class="ion ion-ios-home-outline"></i>              			
              </div>			
              <span class="small-box-footer">Ingresar 
                <i class="fa fa-arrow-circle-right"></i>
              </span>		
            </div>	
          </a>              
        </div>
      </div>  
      <div class="container moduloCentrar mt20 modulos">
        <div id="par" class="col-lg-4 col-md-4 col-sm-6 col-xs-12 apagado">
          <a onclick="ingresoAdmin()" class="small-box-footer">                  
            <div class="small-box bg-red-gradient">                    
              <div class="inner">                      
                <h3 style="overflow-x: hidden;">Configuracion General <br></h3> 
                <p style="color:#FFF">Parametros del Sistema</p>
              </div>                    
              <div class="icon">
                <i class="fa fa-cogs"></i>
              </div>
              <small class="small-box-footer" style="font-size:12px">Ingresar <i class="fa fa-arrow-circle-right"></i></small>
            </div>
          </a>
        </div>        
      </div>
    </section>
  </body>
  <?php  
    include("../res/shared/archivo_pie.php") ;
    include("../res/shared/archivo_script.php");
    include_once '../views/modal/modalUsuario.php';    
  ?>
    <script src="../res/js/inicio.js"></script>  
    <script src="../res/js/modulos.js"></script>  
</html>

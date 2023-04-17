<?php
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 
  
  $idamb   = $_POST['id'];
  $amb     = $_POST['amb'];
  $user    = $_POST['user'];
  $impto   = $_POST['impto']; 
  $prop    = $_POST['prop'];
  $prefijo = $_POST['pref'];
  $fecha   = $_POST['fecha'];
  
  $mesas         = $pos->getMesasAmbi($idamb);
  $descuentos    = $pos->getDescuentosPos($idamb);
  $formasdepagos = $pos->getFormasdePago();
  $datosClientes = $pos->getClientes();

?>

<div class="row-fluid" style="background-color: #F5FBFC;margin:1px">
  <div class="row-fluid">
    <input type="hidden" name="prefijoAmb" id="prefijoAmb" value="<?=$prefijo?>">
    <input type="hidden" name="idAmbiente" id="idAmbiente" value="<?=$idamb?>">
    <input type="hidden" name="numeroComanda" id="numeroComanda" value='0'>
    <input type="hidden" name="recuperarComanda" id="recuperarComanda" value="0">
    <div class="row">
      <div class="container-fluid" style="margin:0;padding:0">
        <div class="col-md-12" style="background-color: antiquewhite;padding:5px 10px">
          <div class="col-md-7">
            <label class="col-md-2" for="">Mesa</label>           
            <div class="col-md-2">
              <select class="form-control" name='nromesas' id='nromesas'>"
                <?php
                foreach ($mesas as $mesa) : ?>
                  <option value="<?php echo $mesa['numero_mesa'];?>"><?php echo $mesa['numero_mesa'];?></option>
                  <?php 
                endforeach
                ?>
              </select>
            </div>
            <label class="col-md-1" for="">Pers</label>
            <div class="col-md-1" style="padding:0px">
              <input class="form-control" type="number" min='1' id="numPax" name='numPax' value="1">  
            </div>           
            <form accept-charset="utf-8" method="POST" class="form-horizontal" style="padding:0 20px">
              <label class="control-label col-md-2 " for="">Buscar </label>
              <div class="col-md-4" style="padding:0;margin:0">
                <input class="form-control" type="text" name="busqueda" id="busqueda" value="" onKeyUp="buscar();">
              </div>
            </form>
          </div>
          <div class="col-md-5" style="" id="muestraNumero">
            <h3 id="tituloNumero" class="alert alert-info" style="padding:2px;text-align: center;font-weight: bold;margin:0">Nueva Comanda</h3>
          </div>
        </div>            
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-xs-6" style="padding:0">
        <h4 align="center" style="font-family:ubuntu;padding:0 3px;">Selecciona Tipo de Plato</h4>
      </div>
      <div class="col-lg-4 col-md-4 col-xs-6" style="padding:0">
        <h4 align="center" style="font-family:ubuntu;padding:0 3px;">Seleccione el Producto</h4>
      </div>
      <div class="col-lg-5 col-md-5 col-xs-6" style="padding:0">
        <h4 align="center" style="font-family:ubuntu;padding:0 3px;">Informacion Comanda</h4>
      </div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="col-lg-3 col-md-3 moduloCentrar" id="seccionList" style="padding:0;display:block;">
    </div>
    <div class="col-lg-4 col-md-4 col-xs-6 moduloCentrar" id="productoList" style="padding:0px;margin-bottom: 50px;overflow: auto;display:block;">
    </div>
    <div class="col-lg-5 col-md-5 col-xs-12" id="ventasList" style="padding:0px">
      <div class="col-md-9" style="padding:0">
        <div id='productosComanda' class="row-fluid" style="background-color:#FCF7AB;margin-top: 0;overflow: auto">
          <table class="table table-hover comanda" id="comanda">
            <thead>
              <tr class="info" style="font-weight: bold">
                <td>Productos</td>
                <td>Cant.</td>
                <td>Valor</td>
                <td width="20%">Accion</td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div class="row-fluid" id="valores" style='margin-top:5px;background-color: #B9E3E4B3'>
          <table class="table table-responsive estadoComanda" style="margin-bottom: 0px;font-size:14px">
              <tbody> 
              <tr align="right">
                <input type="hidden" name="cantProd" id="cantProd" value='0'>
                <td style="font-size:14px;padding:5px" align="right">Valor Cuenta</td>
                <td style="font-size:14px;padding:5px" id="totalVta" align="right"><?php echo '$ '.number_format(0+0-0,2,",",".");?>
                <td style="font-size:14px;padding:5px">Impuesto</td>
                <td style="font-size:14px;padding:5px" id="valorImpto"><?php echo '$ '.number_format(0,2) ?></td>
                </td>
              </tr>
              <tr align="right">
                <td style="font-size:14px;padding:5px" align="right">Descuento</td>
                <td style="font-size:14px;padding:5px" id="totalDesc" align="right"><?php echo '$ '.number_format(0+0-0,2,",",".");?>
                </td>
                <td style="font-size:14px;padding:5px" align="right">Total a Pagar</td>
                <td style="font-size:14px;padding:5px" id="totalCuenta" align="right"><?php echo '$ '.number_format(0+0-0,2,",",".");?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row-fluid" id="valores" style='margin-top:10px;background-color: #B9E3E4B3'>
        </div>
      </div>
      <div class="col-md-3 menuComanda" style="padding: 0 0px 0 15px;margin-top:0px">
        
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
          <div class="btn-group-vertical mr-2" role="group" aria-label="First group" style="display: block">
            <button 
              id      ="btnGuardarComanda"
              type    ="button" 
              class   ="btn btn-primary" 
              style   ="height: 64px;font-weight: 600;font-size:14px;" 
              title   ="Guardar Presente Cuenta"
              onclick ="guardarCuenta()" 
              >
              <i class    ="fa fa-save"></i> Guardar
            </button>
            <button 
              type           ="button" 
              class          ="btn btn-success"
              title          ="Pagar Presente Cuenta" 
              style          ="height: 64px;font-weight: 600;font-size:14px;display: none;" 
              onclick        ="botonPagar()"

              >
              <i class="fa fa-money"></i> Pagar Cuenta
            </button>
            <button 
              onclick  ="getBorraCuenta(this.name,<?=$idamb?>)" 
              type     ="button" 
              class    ="btn btn-secondary btn-warning" 
              name     ="<?php echo $user;?>" 
              style    ="height: 64px;font-weight: 600;font-size:14px;margin-top:364px;"title    ="Anula Ingreso Presente Cuenta">
              <i class ="fa fa-reply"></i> Regresar
            </button>

          </div>
        </div>
        <div class="row-fluid" id='menu' style="margin-top:-15px">
          <div class="btn-group" role="group">     
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php 
include_once('../views/modal/modalComandas.php') ;
?>

<?php
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  $idamb     = $_POST['id']; 
  $amb       = $_POST['amb'];  
  $nivel     = $_POST['nivel'];  
  $user      = $_POST['user']; 
  $prefijo   = $_POST['pref']; 
  $fecha     = $_POST['fecha']; 
  $comanda   = $_POST['comanda']; 
  $nromesa   = $_POST['nromesa']; 
  $impuesto  = $_POST['impto']; 
  $propina   = $_POST['propina']; 
  $descuento = $_POST['descuento']; 
  $subtotal  = $_POST['subtotal']; 
  $total     = $_POST['total']; 
  
  $datosClientes = $pos->getClientes();
  $descuentos    = $pos->getDescuentosPos($idamb);
  $formasdepagos = $pos->getFormasPago();

?>
<div class="row-fluid" style="background-color: #F5FBFC;margin:1px">
  <div class="row-fluid">
    <div class="container-fluid" style="margin:0;padding:0">
      <div class="col-md-3 alert alert-success" id="titulo1" style="padding: 5px;display:none;margin-bottom:5px;">
        <h4 style="text-align:center">  Tipos de Producto </h4>
      </div>    
      <div class="col-md-4 alert" id="titulo2" style="padding: 5px;display:none;margin-bottom:5px;border:1px solid #000D;">
        <label class="control-label col-md-2 " for="">Buscar </label>
        <div class="col-md-10" style="padding:0;margin:0">
          <input class="form-control" type="text" name="busqueda" id="busqueda" value=""> 
        </div>
      </div>    
      <div class="col-md-8 alert alert-info" id="titulo3" style="padding: 5px;margin-bottom:5px;"></div>    
    </div>
  </div>
  <div class="row-fluid">
    <input type="hidden" name="comandaActiva" id="comandaActiva" value="<?=$comanda?>">
    <div class="col-lg-3 col-md-3 moduloCentrar" id="seccionList" style="padding:0;display:none;">
    </div>
    <div class="col-lg-4 col-md-4 col-xs-6 moduloCentrar" id="productoList" style="padding:0px;margin-bottom: 50px;overflow: auto;display:none;">
    </div>
    <div class="col-lg-8 col-md-8 col-xs-12" id="ventasList" style="padding:5px 0px 0px 10px;">
      <input type="hidden" name="numeroComanda" id="numeroComanda" value="">
      <input type="hidden" name="recuperarComanda" id="recuperarComanda" value="0">
      <input type="hidden" name="prefijoAmb" id="prefijoAmb" value="<?=$prefijo?>">
      <input type="hidden" name="idAmbiente" id="idAmbiente" value="<?=$idamb?>">
      <div class="col-lg-9 col-md-9" style="padding:0 5px;">
        <div id='productosComanda' class="row-fluid" style="padding:0;background-color:#FCF7AB;margin-top: 0;overflow: auto">
          <table class="table table-hover comanda">
            <thead>
              <tr class="info" style="font-weight: bold">
                <td>Productos</td>
                <td>Cant.</td>
                <td>Valor</td>
                <td align="center" width="20%">Accion</td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div class="row-fluid" id="valores" style='margin-top:0px;background-color: #B9E3E4B3'>
          <table class="table table-responsive estadoComanda" style="margin-bottom: 0px;font-size:14px">
            <tbody>
              <tr align="right">
                <td style="font-size:14px;padding:5px" align="right">Valor Cuenta</td>
                <td style="font-size:14px;padding:5px" id="totalVta" align="right"><?php echo '$ '.number_format($subtotal,2,",",".");?>
                <td style="font-size:14px;padding:5px">Impuesto</td>
                <td style="font-size:14px;padding:5px" id="valorImpto"><?php echo '$ '.number_format($impuesto,2) ?></td>
                </td>
              </tr>
              <tr align="right">
                <td style="font-size:14px;padding:5px" align="right">Descuento</td>
                <td style="font-size:14px;padding:5px" id="totalDesc" align="right"><?php echo '$ '.number_format($descuento,2,",",".");?>
                </td>
                <td style="font-size:14px;padding:5px" align="right">Total a Pagar</td>
                <td style="font-size:14px;padding:5px" id="totalCuenta" align="right"><?php echo '$ '.number_format($total,2,",",".");?>
                </td>
              </tr>
            </tbody>
          </table> 
        </div>
      </div>
      <div class="col-lg-3 col-md-3 menuComanda" style="padding:0;text-align: center">
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
          <div class="btn-group-vertical mr-2" role="group" aria-label="First group">
            <button 
              type    ="button" 
              id      ="guardaCuenta"
              class   ="btn btn-primary" 
              style   ="height: 64px;display:none;font-weight: 600;font-size:14px;" 
              title   ="Guardar Presente Cuenta"
              id      ="guardarCuenta"
              onclick ="guardarCuentaRecuperadaPlano()"
              >
              <i class="fa fa-save"></i> Guardar
            </button>
            <button 
              style   ="height: 64px;font-weight: 600;font-size:14px;"
              type    ="button" 
              id      ="recuperaCuenta"
              class   ="btn btn-success prende"  
              onclick ="recuperarCuenta()"  
              title   ="Recuperar Presente Cuenta"
              disabled
              >
              <i class="fa fa-save"></i> Recuperar Comanda
            </button>
            <button 
              style       ="height: 64px;font-weight: 600;font-size:14px;background-color: yellow;border-color:yellow;color:black;"
              data-toggle ="modal" 
              type        ="button" 
              class       ="btn btn-warning prende btnActivo" 
              onclick     ="botonDescuento()"  
              id          ="descuentoCuenta"
              disabled 
              name        ="<?php echo $user;?>" 
              title       ="Descuentos A la Presente Cuenta">
              <i class="fa fa-calculator"></i> Descuento
            </button>
            <button 
              style       ="height: 64px;overflow: hidden;font-weight: 600;font-size:14px;"
              type        ="button" 
              class       ="btn btn-default prende btnActivo" 
              data-toggle ="modal" 
              data-target ="#myImprimirCuenta" 
              onclick     ="imprimeEstadoCuenta()"
              disabled    = 'disabled'
              title       ="Imprimir Estado de Cuenta">
              <i class="fa fa-print"></i> Estado de Cuenta
            </button>
            <?php 
            if($nivel=='A'){ ?>
              <button 
                type        ="button" 
                class       ="btn btn-danger prende btnActivo"
                style       ="height: 64px;font-weight: 600;font-size:14px;"
                title       ="Anular Presente Cuenta"
                data-toggle ="modal"
                name        ="<?php echo $user;?>" 
                id          ="anularComanda"
                disabled
                data-target ="#myModalAnulaComanda" 
                ><i class="fa fa-trash-o"></i> Anular Comanda
              </button> 
              <?php  
            }
            ?>
            <button 
              type     ="button" 
              class    ="btn btn-info prende btnActivo"
              style    ="height: 64px;font-weight: 600;font-size:14px;"
              title    ="Pagar Cuenta" 
              onclick  ="botonPagar()"  
              disabled = 'disabled'
              id       ="pagarComanda"
              ><i class="fa fa-money"></i> Pagar
            </button>
            <button 
              style="height: 64px;overflow: hidden;margin-top:38px;font-weight: 600;font-size:14px;"
              type="button" 
              class="btn btn-default prende btnActivo" 
              data-toggle="modal" 
              data-target="#myImprimirCuenta" 
              onclick="imprimeComandaGen()"
              disabled=""
              id="imprimeComanda"
              title="Imprimir Presente Cuenta">
              <i class="fa fa-print"></i> Imprimir Comanda
            </button>
            <button 
              style   ="height: 64px;padding:20px 0;font-weight: 600;font-size:14px;"
              type    ="button" 
              class   ="btn btn-warning" 
              onclick ="enviaInicio()"            
              id      ="regresarComanda"
              title   ="Recuperar Presente Cuenta">
              <i class="fa fa-home"></i> Regresar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
include_once('../views/modal/modalComandas.php') ;
?>


<script src="<?=BASE_POS?>res/js/facturas.js" type="text/javascript" charset="utf-8"></script>

<script>
  getComandas($('#comandaActiva').val())
</script>

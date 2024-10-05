<?php
  // require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  $idamb     = $_POST['idamb']; 
  $amb       = $_POST['amb'];  
  $nivel     = $_POST['nivel'];  
  $user      = $_POST['user']; 
  $prefijo   = $_POST['pref']; 
  $fecha     = $_POST['fecha']; 
  $comanda   = $_POST['comanda']; 
  $nromesa   = $_POST['nromesa']; 
  $impuesto  = $_POST['impuesto']; 
  $propina   = $_POST['propina']; 
  $descuento = $_POST['descuento']; 
  $subtotal  = $_POST['subtotal']; 
  $total     = $_POST['total']; 
  $cliente   = $_POST['cliente']; 
  
  $datosClientes = $pos->getClientes();
  $descuentos    = $pos->getDescuentosPos($idamb);
  $formasdepagos = $pos->getFormasPago();

?>
<div class="row" style="background-color: #F5FBFC;margin:0px;padding:5px;">
  <div class="row-fluid">
    <div class="container-fluid" style="margin:0;padding:0">
      <div class="col-md-6" style="padding: 0px" id="muestraNumero2">
        <h3 id="tituloNumero2" class="alert alert-info" style="padding:2px;text-align: center;font-weight: bold;margin:0">Informacion Comanda</h3>
      </div>
    </div>
  </div>
  <div class="row-fluid">
    <input type="hidden" name="comandaActiva" id="comandaActiva" value="<?=$comanda?>">
    <div class="col-lg-3 col-md-3 moduloCentrar" id="seccionList" style="padding:0;display:none;">
    </div>
    <div class="col-lg-4 col-md-4 col-xs-6 moduloCentrar" id="productoList" style="padding:0px;margin-bottom: 50px;overflow: auto;display:none;margin-top:5px;">
    </div>
    <div class="col-lg-6 col-md-6 col-xs-12" id="ventasList" style="padding:5px 0px 0px 0px;">
      <input type="hidden" name="numeroComanda" id="numeroComanda" value="">
      <input type="hidden" name="recuperarComanda" id="recuperarComanda" value="0">
      <input type="hidden" name="prefijoAmb" id="prefijoAmb" value="<?=$prefijo?>">
      <input type="hidden" name="idAmbiente" id="idAmbiente" value="<?=$idamb?>">
      <div class="col-lg-9 col-md-9" style="padding:0 5px 0 0;">
        <div id='productosComanda' class="row-fluid" style="padding:0;background-color:#FCF7AB;margin-top: 0;overflow: auto">
          <table class="table table-hover comanda">
            <thead>
              <tr class="info" style="font-weight: bold">
                <td>Productos</td>
                <td>Cant.</td>
                <td>Valor</td>
                <td style="text-align:center;width:20%">Accion</td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div class="row-fluid" id="valores" style='margin-top:0px;background-color: #B9E3E4B3'>
          <table class="table table-responsive estadoComanda" style="margin-bottom: 0px;font-size:14px">
            <tbody>
              <tr style="text-align:right">
                <td>Valor Cuenta</td>
                <td id="totalVta" ><?php echo '$ '.number_format($subtotal,2,",",".");?>
                <td>Impuesto</td>
                <td id="valorImpto"><?php echo '$ '.number_format($impuesto,2) ?></td>
                </td>
              </tr>
              <tr style="text-align:right">
                <td></td>
                <td id="totalDesc" ></td>
                <td>Total a Pagar</td>
                <td id="totalCuenta" ><?php echo '$ '.number_format($total,2,",",".");?>
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
              >
              <i class="fa fa-save"></i> Recuperar
            </button>
            <!-- <button
              style       ="height: 64px;font-weight: 600;font-size:14px;background-color: yellow;border-color:yellow;color:black;"
              data-toggle ="modal"
              type        ="button"
              class       ="btn btn-warning prende btnActivo"
              onclick     ="botonDescuento()"
              id          ="descuentoCuenta"
              name        ="<?php echo $user;?>"
              title       ="Descuentos A la Presente Cuenta">
              <i class="fa fa-calculator"></i> Descuento
            </button> -->
            <button
              style       ="height: 64px;overflow: hidden;font-weight: 600;font-size:14px;"
              type        ="button"
              class       ="btn btn-default prende btnActivo"
              data-toggle ="modal"
              data-target ="#myImprimirCuenta"
              onclick     ="imprimeEstadoCuenta()"
              title       ="Imprimir Estado de Cuenta">
              <i class="fa fa-print"></i> Pre-Cuenta
            </button>
            <?php
            if($nivel=='2'){ ?>
              <button
                type        ="button"
                class       ="btn btn-danger prende btnActivo"
                style       ="height: 64px;font-weight: 600;font-size:14px;"
                title       ="Anular Presente Cuenta"
                data-toggle ="modal"
                name        ="<?php echo $user;?>"
                id          ="anularComanda"
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
              id       ="pagarComanda"
              ><i class="fa fa-money"></i> Pagar
            </button>
            <button
              style="height: 64px;overflow: hidden;margin-top:86px;font-weight: 600;font-size:14px;"
              type="button"
              class="btn btn-default prende btnActivo"
              data-toggle="modal"
              data-target="#myImprimirCuenta"
              onclick="imprimeComandaGen()"
              id="imprimeComanda"
              title="Imprimir Presente Cuenta">
              <i class="fa fa-print"></i> Imprimir
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
  NroComanda = $('#comandaActiva').val()
  getComandas('comanda'+NroComanda,NroComanda)
</script>

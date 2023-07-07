<?php
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php';

  $idamb = $_POST['id'];

  $amb = $_POST['amb'];
  $nivel = $_POST['nivel'];
  $user = $_POST['user'];
  $prefijo = $_POST['prefijo'];
  $fecha = $_POST['fecha'];

  $mesas = $pos->getMesasAmbi($idamb);
  $datosClientes = $pos->getClientes();
  $descuentos = $pos->getDescuentosPos($idamb);
  $formasdepagos = $pos->getFormasPago();

  ?>
<div class="row" style="background-color: #F5FBFC;margin:1px">
  <div class="row-fluid">
    <div class="container-fluid" style="margin:0;padding:0">
      <div class="col-md-12" style="background-color: antiquewhite;padding:5px">
        <div class="col-md-6" style="padding:0 5px" id="muestraComanda">
          <div class="col-lg-12 btn-info" style="padding:0;margin:0;" id="tituloComanda">
            <h4 style="padding:2px;text-align: center;font-weight: bold;margin:0">Comandas Activas</h4>
          </div>
          <div id="tituloBusca" class="col-lg-6" style="padding:0;margin:0;display:none">
            <label class="control-label col-md-3 " for="">Buscar </label>
            <div class="col-md-9" style="padding:0;margin:0">
              <input class="form-control" type="text" name="busqueda" id="busqueda" value=""> 
            </div>
          </div>
        </div>
        <div class="col-md-6 btn-success" style="padding:0 5px" id="muestraNumero">
          <h4 id="tituloNumero" style="padding:2px;text-align: center;font-weight: bold;margin:0">Informacion Comanda</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="row-fluid">
    <div class="col-lg-6 col-md-6 col-xs-12 tablas" id="divideComanda" style="display:none">
      <div id='productosDivide' class="row-fluid">
        <input type="hidden" id="nroComandaDiv">
        <table class="table table-hover comandaDiv">
          <thead>
            <tr class="info" style="font-weight: bold">
              <td>Productos</td>
              <td>Cant.</td>
              <td>Valor</td>
              <td style="text-align:center" width="20%">Accion</td>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="row-fluid" id="valoresDiv" style='margin-top:0px;background-color: #B9E3E4B3'>
        <table class="table table-responsive estadoComandaDiv" style="margin-bottom: 0px;font-size:14px;font-weight:bold;">
          <tbody>
            <!-- <tr style="text-align:right">
              <td>Valor Cuenta</td>
              <td id="totalVtaDiv"><?php echo '$ '.number_format(0 + 0 - 0, 2, ',', '.'); ?>
              <td>Impuesto</td>
              <td id="valorImptoDiv"><?php echo '$ '.number_format(0, 2); ?></td>
              </td>
            </tr> -->
            <tr style="text-align:right">
              <!-- <td>Descuento</td>
              <td id="totalDescDiv"><?php echo '$ '.number_format(0 + 0 - 0, 2, ',', '.'); ?>
              </td> -->
              <!-- <td>Abonos</td>
              <td id="totalAbonosDiv"><?php echo '$ '.number_format(0 + 0 - 0, 2, ',', '.'); ?>
              </td>
            </tr> 
            <tr style="text-align:right">
              <td></td>
              <td></td> -->
              <td>Valor Comanda</td>
              <td id="totalCuentaDiv"><?php echo '$ '.number_format(0 + 0 - 0, 2, ',', '.'); ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-xs-12" id="listaComandas" style="padding:0px 0px 0px 5px;overflow: auto; text-align:center">
    </div>
    <div class="col-lg-3 col-md-3 moduloCentrar" id="seccionList" style="padding:0;display:none;">
    </div>
    <div class="col-lg-4 col-md-4 col-xs-6 moduloCentrar" id="productoList" style="padding:0px;overflow: auto;display:none;">
    </div>
    <div class="col-lg-6 col-md-6 col-xs-12" id="ventasList" style="padding:0px 0px 0px 5px;">
      <input type="hidden" name="descuentosComanda" id="descuentosComanda" value="0">
      <input type="hidden" name="abonosComanda"     id="abonosComanda"     value="0">
      <input type="hidden" name="totalComanda"      id="totalComanda"      value="0">
      <input type="hidden" name="totalImpto"        id="totalImpto"        value="0">
      <input type="hidden" name="numeroComanda"     id="numeroComanda"     value="0">
      <input type="hidden" name="recuperarComanda"  id="recuperarComanda"  value="0">
      <input type="hidden" name="prefijoAmb"        id="prefijoAmb"        value="<?php echo $prefijo; ?>">
      <input type="hidden" name="idAmbiente"        id="idAmbiente"        value="<?php echo $idamb; ?>">
      <input type="hidden" name="nromesa"           id="nromesa"           value="0">
      <input type="hidden" name="canpax"            id="canpax"            value="0">
      <div class="col-lg-9 col-md-9" style="padding:0;">
        <div id='productosComanda' class="row-fluid">
          <table class="table table-hover comanda" id="comanda">
            <thead>
              <tr class="info" style="font-weight: bold">
                <td>Productos</td>
                <td>Cant.</td>
                <td>Valor</td>
                <td style="text-align:center" width="20%">Accion</td>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <div class="row-fluid" id="valores" style='margin-top:0px;background-color: #B9E3E4B3'>
          <table class="table table-responsive estadoComanda" style="margin-bottom: 0px;font-size:14px">
            <tbody>
              <!-- <tr style="text-align:right">
                <td>Valor Cuenta</td>
                <td id="totalVta"><?php echo '$ '.number_format(0 + 0 - 0, 2, ',', '.'); ?>
                <td>Impuesto</td>
                <td id="valorImpto"><?php echo '$ '.number_format(0, 2); ?></td>
                </td>
              </tr> -->
              <tr style="text-align:right">
                <!-- <td>Descuento</td>
                <td id="totalDesc"><?php echo '$ '.number_format(0 + 0 - 0, 2, ',', '.'); ?>
                </td> -->
                <!-- <td>Abonos</td>
                <td id="totalAbonos"><?php echo '$ '.number_format(0 + 0 - 0, 2, ',', '.'); ?>
                </td>
              </tr>
              <tr style="text-align:right">
                <td></td>
                <td></td> -->
                <td>Total Cuenta</td>
                <td id="totalCuenta"><?php echo '$ '.number_format(0 + 0 - 0, 2, ',', '.'); ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 menuComanda" style="padding:0;text-align: center">
        <div class="btn-toolbar" style="padding:0 5px;" role="toolbar" aria-label="Toolbar with button groups">
          <div class="btn-group-vertical mr-2" role="group" aria-label="First group" style="padding:0 10px;width:100%">
            <?php if ($nivel <= 4) { ?>
              <button
                type    ="button"
                id      ="guardaCuenta"
                class   ="btn btn-primary btnRecu"
                style   ="display:none;"
                title   ="Guardar Presente Cuenta"
                id      ="guardarCuenta"
                onclick ="guardarCuentaRecuperada()"
                >
                <i class="fa fa-save"></i> Guardar
              </button>
              <button
                type    ="button"
                id      ="recuperaCuenta"
                class   ="btn btn-success prende btnRecu"
                onclick ="recuperarCuenta()"
                title   ="Recuperar Presente Cuenta"
                >
                <i class="fa fa-save"></i> Recuperar
              </button>
              <?php
            }
              if ($nivel <= 0) { ?>
              <button 
                style       ="background-color: yellow;border-color:yellow;color:black;"
                data-toggle ="modal"
                type        ="button"
                class       ="btn btn-warning prende btnActivo btnRecu"
                onclick     ="botonDescuento()"
                id          ="descuentoCuenta"
                name        ="<?php echo $user; ?>" 
                title       ="Descuentos A la Presente Cuenta">
                <i class="fa fa-calculator"></i> Descuento
              </button>
              <?php
              }
              if ($nivel <= 4) { ?>
              <button
                type        ="button" 
                class       ="btn btn-default prende btnActivo btnRecu" 
                data-toggle ="modal" 
                data-target ="#myImprimirCuenta" 
                onclick     ="imprimeEstadoCuenta()"
                title       ="Imprimir Estado de Cuenta">
                <i class="fa fa-print"></i> Pre-Cuenta
              </button>
              <?php
              }
              if ($nivel <= 2) { ?>
              <button
                type        ="button" 
                class       ="btn btn-danger prende btnActivo btnRecu"
                title       ="Anular Presente Cuenta"
                data-toggle ="modal"
                name        ="<?php echo $user; ?>" 
                id          ="anularComanda"
                data-target ="#myModalAnulaComanda" 
                ><i class="fa fa-trash-o"></i> Anular
              </button>
              <?php
              }
  ?>
              <!-- <button
              style="background:cyan;"
              type="button"
              class="btn btn-default prende btnActivo btnRecu" 
              onclick="dividirCuenta()"
              id="dividirComanda"
              title="Dividir Presente Cuenta">
              <i class="fa fa-clone" aria-hidden="true"></i>
              Dividir
            </button>  -->
            <?php
  if ($nivel <= 3) { ?>
              <!-- 
                <button
                  type        ="button"
                  style       ="margin-top:28px;background:chartreuse;color:#000; "
                  class       ="btn btn-warning prende btnActivo btnRecu"
                  data-toggle ="modal"
                  data-target ="#myModalAbonos"
                  title       ="Abonos a la Presente Cuenta">
                  <i class="fa fa-usd"></i> Abonos

                </button> 
                <button
                  style    ="margin-top:20px"
                  type     ="button"
                  class    ="btn btn-default prende btnActivo btnRecu"
                  title    ="Cargar Room Service"
                  onclick  ="calculaRoomService()"
                  id       ="pagarComanda"
                  ><i class="fa fa-money"></i> Room Service
                </button>
              -->
              <button
                style    ="margin-top:20px"
                type     ="button"
                class    ="btn btn-info prende btnActivo btnRecu"
                title    ="Pagar Cuenta"
                onclick  ="botonPagar()"
                id       ="pagarComanda"
                ><i class="fa fa-money"></i> Pagar
              </button>
              <?php
  }
  if ($nivel <= 4) { ?>
              <button
              style="margin-top:43px"
              type="button"
              class="btn btn-default prende btnActivo btnRecu" 
              data-toggle="modal" 
              data-target="#myImprimirCuenta" 
              onclick="imprimeComandaGen()"
              id="imprimeComanda"
              title="Imprimir Comanda Actual">
              <i class="fa fa-print"></i> Comanda
            </button>
            <?php
  }
  if ($nivel <= 4) { ?>
              <button
              style="display:none !important"
              type="button"
              class="btn btn-info btnActivo btnRecu" 
              data-toggle="modal"  
              data-target="#myImprimirCuenta" 
              onclick="guardarCuentaDividida()"
              id="guardaComandaDividida"
              title="Guarda Nueva Comanda">
              <i class="fa fa-save"></i> Procesar - 
            </button> 
            <?php } ?>
            <button
              type    ="button"
              class   ="btn btn-warning btnRecu"
              onclick ="regresaDividir()"
              id      ="regresarComanda"
              title   ="Regresar ">
              <i class="fa fa-home"></i> Regresar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include_once '../views/modal/modalComandas.php';
  ?>

<script src="<?php echo BASE_POS; ?>res/js/facturas.js" type="text/javascript" charset="utf-8"></script>
<script>
  getCuentasActivas('<?php echo $idamb; ?>')
  $("#busqueda").keypress(function(event) {
    if (event.keyCode === 13) {
      buscarProducto();
    }
  });
</script>



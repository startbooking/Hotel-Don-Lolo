<?php
  require '../../res/php/app_topPos.php';

  $idamb = $_POST['id'];
  $amb = $_POST['amb'];
  $user = $_POST['user'];
  $impto = $_POST['impto'];
  $prop = $_POST['prop'];
  $prefijo = $_POST['prefijo'];
  $fecha = $_POST['fecha'];

  $mesas = $pos->getMesasAmbi($idamb);
  $descuentos = $pos->getDescuentosPos($idamb);
  $formasdepagos = $pos->getFormasdePago();
  $datosClientes = $pos->getClientes();

  ?>

<div class="container-fluid" style="background-color: #F5FBFC;margin:1px;padding:0px;">
  <div class="container-fluid pd0">
    <input type="hidden" name="abonosComanda" id="abonosComanda" value="0">
    <input type="hidden" name="prefijoAmb" id="prefijoAmb" value="<?php echo $prefijo; ?>">
    <input type="hidden" name="idAmbiente" id="idAmbiente" value="<?php echo $idamb; ?>">
    <input type="hidden" name="numeroComanda" id="numeroComanda" value='0'>
    <input type="hidden" name="recuperarComanda" id="recuperarComanda" value="0">
    <div class="container-fluid pd0">
      <div class="container-fluid" style="margin: 0 0 3px 0;padding:0">
        <div class="row" style="background-color: antiquewhite;padding:5px">
          <div class="col-md-7 col-sm-7 col-xs-12 pd0">
            <label class="col-md-1 col-sm-1 col-xs-4" for="">Mesa</label>
            <div class="col-md-2 col-sm-2 col-xs-8 pd0">
              <select class="form-control" name='nromesas' id='nromesas'>"
                <?php
                  foreach ($mesas as $mesa) { ?>
                  <option value="<?php echo $mesa['numero_mesa']; ?>"><?php echo $mesa['numero_mesa']; ?></option>
                  <?php
                  }
                ?>
              </select>
            </div>
            <label class="col-md-1 col-sm-1 col-xs-4" for="">Pers</label>
            <div class="col-md-1 col-sm-1 col-xs-8 pd0">
              <input class="form-control" type="number" min='1' id="numPax" name='numPax' value="1">
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-4" for="">Buscar </label>
            <div class="col-md-5 col-sm-5 col-xs-8">
              <input class="form-control" type="text" name="busqueda" id="busqueda" value="">
            </div>
            <form accept-charset="utf-8" method="POST" class="form-horizontal" style="padding:0 20px" placeholder="Producto">
            </form>
          </div>
          <div class="col-md-5 col-sm-5 col-xs-12 pd0" id="muestraNumero">
            <h3 id="tituloNumero" class="alert alert-info">Nueva Comanda</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid pd0">
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 moduloCentrar" id="seccionList">
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 moduloCentrar" id="productoList">
    </div>
    <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12 " id="ventasList">
      <input type="hidden" name="totalImpto" id="totalImpto" value="0">
      <div class="col-md-9 col-xs-12" style="padding:0 2px">
        <div id='productosComanda' class="row-fluid">
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
              <tr style="text-align:right">
                <input type="hidden" name="cantProd" id="cantProd" value='0'>
                <td>Valor Cuenta</td>
                <td id="totalVta" ><?php echo '$ '.number_format(0 + 0 - 0, 2, ',', '.'); ?>
                <td>Impuesto</td>
                <td id="valorImpto"><?php echo '$ '.number_format(0, 2); ?></td>
                </td>
              </tr>
              <tr style="text-align:right">
                <td ></td>
                <td id="totalDesc" ></td>
                <td >Total Cuenta</td>
                <td id="totalCuenta" ><?php echo '$ '.number_format(0 + 0 - 0, 2, ',', '.'); ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- <div class="row-fluid" id="valores" style='margin-top:10px;background-color: #B9E3E4B3'>
        </div> -->
      </div>
      <div class="col-md-3 col-xs-12 menuComanda">
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
            <!-- <button
              id          ="btnPagarComanda"
              type        ="button"
              class       ="btn btn-success"
              title       ="Pagar Presente Cuenta"
              onclick     ="botonPagarDirecto()"
              style       ="height: 64px;font-weight: 600;font-size:14px;"
              >
              <i class="fa fa-money"></i> Pagar </button> -->
            <button
              onclick  ="getBorraCuenta(this.name,<?php echo $idamb; ?>)"
              type     ="button"
              class    ="btn btn-secondary btn-warning"
              name     ="<?php echo $user; ?>"
              style    ="height: 64px;font-weight: 600;font-size:14px;margin-top:383px;" title="Anula Ingreso Presente Cuenta">
              <i class ="fa fa-reply"></i> Regresar
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

<script>
  $("#busqueda").keypress(function(event) {
    if (event.keyCode === 13) {
      buscarProducto();
    }
  });
</script>

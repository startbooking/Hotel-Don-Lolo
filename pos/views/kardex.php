<?php

require '../../res/php/titles.php';
require '../../res/php/app_topPos.php';

$idamb = $_POST['id'];
$nomamb = $_POST['amb'];
$user = $_POST['user'];
$iduser = $_POST['iduser'];
$impto = $_POST['impto'];
$prop = $_POST['prop'];
$bodega = $_POST['bodega'];

define('FECHA_POS', $_POST['fecha']);

$fecha = $_POST['fecha'];
$_SESSION['NOMBRE_AMBIENTE'] = $nomamb;
$_SESSION['AMBIENTE_ID'] = $idamb;
$_SESSION['usuario'] = $user;
$_SESSION['usuario_id'] = $iduser;

$nombreAlm = $pos->buscaAlmacen($bodega);

$kardexs = $pos->getTraeKardex($bodega);

// echo print_r($kardexs);

?>

<section class="content">
  <div class="panel panel-success">
    <div class="panel-heading">
      <div class="row" style="display: flex">
        <div class="col-lg-6">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?php echo BASE_ADM; ?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="clientes.php">
          <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-address-book-o"></i> Kardex Almacen </h3>
        </div>
        <div class="col-lg-6">
          <button style="float:right;margin-top:10px;" class="btn btn-success" onclick="exportTableToExcel('tablaKardexPrn')"><i class="glyphicon glyphicon-th" aria-hidden="true"></i> Exportar</button>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div class="datos_ajax_delete"></div>
      <div class="container-fluid" style="padding:0">
        <table id="tablaKardex" class="table table-hover table-bordered table-condensed">
          <h3 class="alert alert-success" style="margin:0 0 20px 0 ;font-weight: 700;text-align:center">Kardex <?php echo $nombreAlm; ?></h3>
          <thead>
            <tr class="warning">
              <th>Producto</th>
              <th>Unidad</th>
              <th>Entradas</th>
              <th>Salidas</th>
              <th>Saldo</th>
              <th>Promedio</th>
              <th>Valor Total</th>
              <th>Accion</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($kardexs as $kardex) { ?>
              <tr>
                <td><?php echo $kardex['nombre_producto']; ?></td>
                <td><?php echo $kardex['descripcion_unidad']; ?></td>
                <td style="text-align: right"><?php echo number_format($kardex['entradas'], 2); ?></td>
                <td style="text-align: right"><?php echo number_format($kardex['salidas'], 2); ?></td>
                <td style="text-align: right"><?php echo number_format($kardex['saldo'], 2); ?></td>
                <td style="text-align: right"><?php 
                if($kardex['promedio']==''){
                  echo number_format(0, 2);
                }else{
                  echo number_format($kardex['promedio'], 2); 
                }
                ?>
              </td>
                <td style="text-align: right"><?php echo number_format($kardex['promedio'] * $kardex['saldo'], 2); ?></td>
                <td style="text-align:center;">
                  <button type="button" class="btn btn-info btn-xs" data-toggle="modal" 
                  data-target="#modalConsultaKardex" 
                  data-id="<?php echo $kardex['id_producto']; ?>" data-bodega="<?php echo $bodega; ?>" 
                  data-nombre="<?php echo $kardex['nombre_producto']; ?>" title="Muestra Movimientos de Inventario">
                    <i class='glyphicon glyphicon-edit'></i>
                  </button>
                  <!-- <div class="btn-group">
                  </div> -->
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div>
        <table style="display:none" id="tablaKardexPrn" class="table table-hover table-bordered table-condensed">
          <thead>
            <tr class="warning">
              <th>Producto</th>
              <th>Unidad</th>
              <th>Entradas</th>
              <th>Salidas</th>
              <th>Saldo</th>
              <th>Promedio</th>
              <th>Valor Total</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($kardexs as $kardex) { ?>
              <tr>
                <td><?php echo $kardex['nombre_producto']; ?></td>
                <td><?php echo $kardex['descripcion_unidad']; ?></td>
                <td style="text-align: right"><?php echo $kardex['entradas']; ?></td>
                <td style="text-align: right"><?php echo $kardex['salidas']; ?></td>
                <td style="text-align: right"><?php echo $kardex['saldo']; ?></td>
                <td style="text-align: right"><?php echo $kardex['promedio']; ?></td>
                <td style="text-align: right"><?php echo $kardex['promedio'] * $kardex['saldo']; ?></td>

              </tr>
            <?php } ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</section>
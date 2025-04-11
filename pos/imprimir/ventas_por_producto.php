<?php
	session_start();
  include_once('../../Conn/seciones.php');
	require_once("../dompdf/dompdf_config.inc.php");
  require_once("../conf/funciones.php");
	include_once('../../Conn/Conn.php'); 

  $fecha = date("d-m-Y");
  $amb = $_SESSION['AMBIENTE'];

  $sql = "SELECT facturas_pos.factura, detalle_facturas_pos.nom,
    Sum(detalle_facturas_pos.venta) AS ventas, Sum(detalle_facturas_pos.cant) AS cant, ambientes.nombre
    FROM facturas_pos, detalle_facturas_pos, ambientes
    WHERE facturas_pos.factura = detalle_facturas_pos.factura AND
    facturas_pos.ambiente = ambientes.codigo AND
    detalle_facturas_pos.ambiente = ambientes.codigo AND facturas_pos.estado = 'A' and facturas_pos.ambiente = '$amb' and ambientes.codigo = '$amb' GROUP BY facturas_pos.ambiente, detalle_facturas_pos.nom
    ORDER BY facturas_pos.ambiente ASC, detalle_facturas_pos.cod ASC";

    $can=mysqli_query($conn,$sql);
    $totalcan = 0;
    $totalvta = 0;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $titulo?> Cuentas Anuladas</title>
    <?php include_once("../../bases/archivo_head.php") ?>

  </head>

  <body class="skin-yellow sidebar-mini">
    <?php 
    include_once("../menus/menu_titulo.php");
    include_once("../menus/menu_pos.php");
    ?>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="row-fluid">
        <h3 align="center" style="font-weight:bold">
          Informes de Ventas Puntos de Venta
        </h3>
        <h4 align="center">Ventas Por Producto</h4>
        </div>
        <div class="row-fluid">
        <h3 align="center">Ambiente: <?=$_SESSION['NOMBRE_AMBIENTE']?></h3>
        </div>
      </section>
      <section class="content-fluid">
        <div class="box-header">
          <!-- /.box-header -->
          <div class="container-fluid">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Valor</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  while($row = mysqli_fetch_assoc($can)) {
                    ?>
                    <tr>
                    <td><?php echo $row["nom"];?></td>
                    <td align="right"><?php echo number_format($row["cant"],2);?></td>
                    <td align="right"><?php echo number_format($row["ventas"],2);?></td>
                    <td align="center">
                      <a href="" title="Detalle Cuenta"><span class="btn btn-xs btn-success" ><i class="fa fa-bars" aria-hidden="true"></i></span></a>
                    </td>
                  </tr>
                  <?php         
                }
                ?> 
              </tbody>
              <tfoot>
                <tr>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Valor</th>
                  <th>Accion</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>  
        <div class="container-fluid" style="margin-top:50px">
          <div class="row-fluid">
            <?php 
              $sql_con = "SELECT facturas_pos.factura, detalle_facturas_pos.nom,
                  Sum(detalle_facturas_pos.importe) AS ventas, Sum(detalle_facturas_pos.cant) AS cant, ambientes.nombre
                  FROM facturas_pos, detalle_facturas_pos, ambientes
                  WHERE facturas_pos.factura = detalle_facturas_pos.factura AND
                  facturas_pos.ambiente = ambientes.codigo AND
                  detalle_facturas_pos.ambiente = ambientes.codigo AND facturas_pos.estado = 'A' and ambientes.codigo = '$amb' GROUP BY facturas_pos.ambiente ORDER BY facturas_pos.ambiente ASC";
                $res_con = mysqli_query($conn,$sql_con);

             ?>

            <div class="col-lg-8">
              <h3>Total Ventas <?=$_SESSION['NOMBRE_AMBIENTE']?> </h3>
            </div>
            <?php 
              while($row_con=mysqli_fetch_assoc($res_con)){
            ?>
            <div class="col-lg-4">
              <h3><?=number_format($row_con['ventas'],2);?></h3>
            </div>
            <?php 
              }
            ?>
          </div>
        </div>          
      </section>
    </div>
  </body>
  <?php include("../../bases/archivo_script.php") ?>
  <script src="../js/ajax.js"></script>

    <script>
    $(document).ready(function(){
      load(1);
    });
  </script>

</html>

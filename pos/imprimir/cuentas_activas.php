<?php
	session_start();
  include_once('../../Conn/seciones.php');
	require_once("../dompdf/dompdf_config.inc.php");
	include_once('../../Conn/Conn.php'); 

  $fecha = date("d-m-Y");
  $amb = $_SESSION['AMBIENTE'];

  $sql = "SELECT comandas.comanda, comandas.mesa, comandas.pax, comandas.usuario, ambientes.nombre, SUM( ventas_dia_pos.venta) as ventas FROM comandas , ambientes , ventas_dia_pos WHERE comandas.ambiente = ambientes.codigo AND comandas.comanda = ventas_dia_pos.comanda AND comandas.estado = 'A' and ambientes.codigo = '$amb' GROUP BY comandas.ambiente, comandas.comanda ORDER BY comandas.ambiente ASC, comandas.comanda ASC";

	$can=mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $titulo?> Cuentas Anuladas</title>
    <?php include_once("../../res/shared/archivo_head.php") ?>

  </head>

  <body class="skin-yellow sidebar-mini">
    <?php
    include_once("../menus/menu_titulo_venta2.php");
    include_once("../menus/menu_pos.php");
    ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h3 style="text-align:center;font-weight:bold">
          Informes de Ventas Puntos de Venta
        </h3>
        <h4 style="text-align:center;">Cuentas Activas</h4>
        <h3 style="text-align:center;">Ambiente: <?= strtoupper($_SESSION['NOMBRE_AMBIENTE']);?></h3>

      </section>
      <section class="content-fluid">
        <div class="box-body">
          <!-- /.box-header -->
          <div class="container-fluid">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <th>Comanda</th>
                  <th>Puestos</th>
                  <th>Nro Mesa</th>
                  <th>Valor Cuenta</th>
                  <th>Usuario</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  while($row = mysqli_fetch_assoc($can)) {
                    ?>
                    <tr>
                    <td><?php echo $row["comanda"];?></td>
                    <td><?php echo $row["pax"];?></td>
                    <td><?php echo $row["mesa"];?></td>
                    <td align="right"><?php echo number_format($row["ventas"],2);?></td>
                    <td><?php echo $row["usuario"];?></td>
                    <td align="center">
                      <a href="" title="Detalle Cuenta"><span class="btn btn-xs btn-success"><i class="fa fa-bars" aria-hidden="true"></i></span></a>
                      <a href="" title="Anular Cuenta"><span class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></span></a>
                    </td>
                  </tr>
                  <?php         
                }
                ?> 
              </tbody>
            </table>
          </div>
        </div>          
        <div class="container-fluid" style="margin-top:50px">
          <div class="row-fluid">
            <?php 

              $sql_con = "SELECT comandas.comanda, comandas.mesa, comandas.pax, comandas.usuario, ambientes.nombre, SUM( ventas_dia_pos.venta) as ventas FROM comandas , ambientes , ventas_dia_pos WHERE comandas.ambiente = ambientes.codigo AND comandas.comanda = ventas_dia_pos.comanda AND comandas.estado = 'A' and ambientes.codigo = '$amb' GROUP BY comandas.ambiente ORDER BY comandas.ambiente ASC";
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
  <?php include("../../res/shared/archivo_script.php") ?>
</html>

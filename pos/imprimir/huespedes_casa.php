<?php
	session_start();
  include_once('../../Conn/seciones.php');
	require_once("../dompdf/dompdf_config.inc.php");
  require_once("../conf/funciones.php");
	include_once('../../Conn/Conn.php'); 

  $fecha = date("d-m-Y");

  $sql = "SELECT reservas_pms.llegada, reservas_pms.salida, reservas_pms.num_habitacion, reservas_pms.can_hombres, reservas_pms.can_mujeres, reservas_pms.can_ninos, huespedes.apellidos, huespedes.nombres FROM huespedes , reservas_pms WHERE huespedes.id_huesped = reservas_pms.id_huesped and estado = 'CA' order by num_habitacion ASC ";

	$can=mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $titulo?> Huespdes en Casa PMS</title>
    <?php include_once("../../bases/archivo_head.php") ?>

  </head>

  <body class="skin-yellow sidebar-mini">
    <?php 
    include_once("../menus/menu_titulo.php");
    include_once("../menus/menu_pos.php");
    ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1 align="center" style="font-size:2em;font-weight:bold">
          Huespedes en Casa 
        </h1>
        <h4 align="center">PMS</h4>
      </section>
      <section class="content" style="margin-left:30px">
        <div class="box-header">
          <div class="row">
            <div class="container col-lg-11">
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nro Hab.</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>LLegada</th>
                    <th>Salida</th>
                    <th>Hom.</th>
                    <th>Muj.</th>
                    <th>Nin</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    while($row = mysqli_fetch_assoc($can)) {
                      ?>
                      <tr>
                      <td><?php echo $row["num_habitacion"];?></td>
                      <td><?php echo $row["apellidos"];?></td>
                      <td><?php echo $row["nombres"];?></td>
                      <td><?php echo $row["llegada"];?></td>
                      <td><?php echo $row["salida"];?></td>
                      <td align="right"><?php echo $row["can_hombres"];?></td>
                      <td align="right"><?php echo $row["can_mujeres"];?></td>
                      <td align="right"><?php echo $row["can_ninos"];?></td>
                    </tr>
                    <?php         
                  }
                  ?> 
                </tbody>
                <tfoot>
                  <tr>
                    <th>Punto de Venta</th>
                    <th>Comanda</th>
                    <th>Puestos</th>
                    <th>Nro Mesa</th>
                    <th>Valor Cuenta</th>
                    <th>Usuario</th>
                    <th>Accion</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>          
      </section>
    </div>
  </body>
  <?php include("../../bases/archivo_script.php") ?>
</html>

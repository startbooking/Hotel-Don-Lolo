<?php
	session_start();
  include_once('../../Conn/seciones.php');
	require_once("../dompdf/dompdf_config.inc.php");
	include_once('../../Conn/Conn.php'); 
  require_once("../../Conn/funciones.php");

  $fecha = date("d-m-Y");

  $sql = "SELECT date(historico_facturas_pos.fecha) as fecha, historico_facturas_pos.id, historico_facturas_pos.factura, historico_facturas_pos.comanda, historico_facturas_pos.mesa, historico_facturas_pos.pax, historico_facturas_pos.usuario_factura, historico_facturas_pos.valor_total, historico_facturas_pos.valor_neto, historico_facturas_pos.impuesto, historico_facturas_pos.propina, historico_facturas_pos.descuento, historico_facturas_pos.estado, historico_facturas_pos.pms, ambientes.nombre FROM historico_facturas_pos, ambientes WHERE historico_facturas_pos.ambiente = ambientes.codigo ORDER BY historico_facturas_pos.fecha, historico_facturas_pos.ambiente, historico_facturas_pos.pms, historico_facturas_pos.factura";

	$can=mysqli_query($conn,$sql);

  $totalnet = 0 ;
  $totalimp = 0 ;
  $totalpro = 0 ;
  $totaltot = 0 ;


?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $titulo?> historico de Facturas</title>
    <?php include_once("../../bases/archivo_head.php") ?>
  </head>

  <body class="skin-yellow sidebar-mini">
    <?php 
    include_once("../menus/menu_titulo.php");
    include_once("../menus/menu_pos.php");
    ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h3 align="center" style="font-size:1.5em;font-weight:bold">
          Informes de Ventas Puntos de Venta
        </h3>
        <h4 align="center">Historico de Facturas</h4>
      </section>
      <section class="content" style="margin-left:50px">
        <div class="box-body"> 
          <div class="container col-lg-11">
            <table id="example1" class="table table-bordered" style="font-size: 11px">
              <thead>
                <tr>
                  <th>Punto de Venta</th>
                  <th>Fecha</th>
                  <th>Factura</th>
                  <th>Com</th>
                  <th>PAX</th>
                  <th>Mesa</th>
                  <th>Neto</th>
                  <th>Impuesto</th>
                  <th>Propina</th>
                  <th>Total</th>
                  <th>Usuario</th>
                  <th>Estado</th>
                  <th>Tipo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  while($row = mysqli_fetch_assoc($can)) {
                    $totalnet = $totalnet + $row["valor_neto"];
                    $totalimp = $totalimp + $row["impuesto"];
                    $totalpro = $totalpro + $row["propina"];
                    $totaltot = $totaltot + $row["valor_total"];
                    ?>
                    <tr>
                      <td><?php echo $row["nombre"];?></td>
                      <td align='right'><?php echo $row["fecha"];?></td>
                      <td align='right'><?php echo $row["factura"];?></td>
                      <td align='right'><?php echo $row["comanda"];?></td>
                      <td align='right'><?php echo $row["pax"];?></td>
                      <td align='right'><?php echo $row["mesa"];?></td>
                      <td align='right'><?php echo number_format($row["valor_neto"],2);?></td>
                      <td align='right'><?php echo number_format($row["impuesto"],2);?></td>
                      <td align='right'><?php echo number_format($row["propina"],2);?></td>
                      <td align='right'><?php echo number_format($row["valor_total"],2);?></td>
                      <td><?php echo $row["usuario_factura"];?></td>
                      <td><?php echo estado_fac($row["estado"]);?></td>
                      <td><?php echo estado_pms($row["pms"]);?></td>
                      <td>
                        <a href="" title="Detalle Factura" class="btn btn-info btn-xs btn-warning" data-toggle="modal" data-target="#myModal" data-id="<?=$row['id']?>">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        </a>
                      </td>
                    </tr>
                  <?php         
                }
                ?> 
              </tbody>
              <tfoot>
                <tr>
                  <th>Punto de Venta</th>
                  <th>Fecha</th>
                  <th>Factura</th>
                  <th>Com</th>
                  <th>PAX</th>
                  <th>Mesa</th>
                  <th>Neto</th>
                  <th>Impuesto</th>
                  <th>Propina</th>
                  <th>Total</th>
                  <th>Usuario</th>
                  <th>Estado</th>
                  <th>Tipo</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
            <div class="container col-lg-11">
              <table id="totales" class="table table-bordered">
                    <tr>
                    <td>TOTAL VENTAS</td>
                    <td align='right'><?php echo number_format($totalnet,2);?></td>
                    <td align='right'><?php echo number_format($totalimp,2);?></td>
                    <td align='right'><?php echo number_format($totalpro,2);?></td>
                    <td align='right'><?php echo number_format($totaltot,2);?></td>
                  </tr>
                
              </table>
            </div>
          </div>
        </div>          
      </section>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detalle Factura</h4>
                </div>

                <div class="modal-body">

                    <input type="text" name="lista" id="lista"/>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>

            </div><!-- modal content -->
        </div><!-- modal dialog -->
    </div><!-- modal fade -->

    <div id="myModalDetalleFactura" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <p>Some text in the modal.</p>
            <input type="text" name="DNI" id="DNI" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
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

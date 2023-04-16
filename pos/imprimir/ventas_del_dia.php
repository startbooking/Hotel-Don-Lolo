<?php
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 
  
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_POS?></title>
    <meta charset="UTF-8">
    <?php include_once('../../bases/archivo_head.php') ?>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <script language="JavaScript" type="text/javascript" src="<?= BASE_POS?>js/ajax.js"></script>
    <script type="text/javascript">
      function calcular_total() {
        total = 0
        $(".suma_propina").each(
          function(index, value) {
            total = total + eval($(this).val());
          }
        );
        $("#total").val(total);
      }
    </script>
  </head>
  <body class="skin-yellow sidebar-mini" id="ppal" onload="getSecciones();">
    <div class="containt-fluid">
      <?php 
        include_once('../menus/menu_titulo_venta2.php') ;
      ?>
    </div>

    <div class="content-wrapper">
      <section class="content-header">
        <h1 align="center" style="font-size:3em;font-weight:bold">
          Informes de Ventas Puntos de Venta
        </h1>
        <h2 align="center">Ventas del Dia</h2>
      </section>
      <section class="content" style="margin-left:50px">
        <div class="box-header">
          <div class="row">
            <!-- /.box-header -->
            <div class="container col-lg-11">
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr>
                    <th>Punto de Venta</th>
                    <th>Factura</th>
                    <th>Comanda</th>
                    <th>Puestos</th>
                    <th>Nro Mesa</th>
                    <th>Neto</th>
                    <th>Impuesto</th>
                    <th>Propina</th>
                    <th>Total</th>
                    <th>Usuario</th>
                    <th>Accion</th>
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
                        <td align='right'><?php echo $row["factura"];?></td>
                        <td align='right'><?php echo $row["comanda"];?></td>
                        <td align='right'><?php echo $row["pax"];?></td>
                        <td align='right'><?php echo $row["mesa"];?></td>
                        <td align='right'><?php echo number_format($row["valor_neto"],2);?></td>
                        <td align='right'><?php echo number_format($row["impuesto"],2);?></td>
                        <td align='right'><?php echo number_format($row["propina"],2);?></td>
                        <td align='right'><?php echo number_format($row["valor_total"],2);?></td>
                        <td><?php echo $row["usuario_factura"];?></td>
                        <td>
                          <a href="#" data-id="1" data-toggle="modal" data-target="#myModal">ver</a>
                          <a href="" title="Detalle Factura" class="btn btn-info btn-xs btn-warning" data-toggle="modal" data-target="#myModal" data-id="<?=$row['id']?>">
                          <i class="fa fa-bars" aria-hidden="true"></i>
                          </a>
                          <a href="" title="Anular Factura"><span class="badge"  style="background-color:#AB1212"><span class="glyphicon glyphicon-remove-circle"></span></span></a>
                        </td>
                      </tr>
                    <?php         
                  }
                  ?> 
                </tbody>
                <tfoot>
                  <tr>
                    <th>Punto de Venta</th>
                    <th>Factura</th>
                    <th>Comanda</th>
                    <th>Puestos</th>
                    <th>Nro Mesa</th>
                    <th>Neto</th>
                    <th>Impuesto</th>
                    <th>Propina</th>
                    <th>Total</th>
                    <th>Accion</th>
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
  <script src="../js/facturas.js" type="text/javascript" charset="utf-8"></script>
  <?php include("../../bases/archivo_script.php") ?>

</html>
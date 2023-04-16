<?php
  include_once('../../Conn/Conn.php');
  include_once('../config/funciones.php');
  include_once('../../Conn/seciones.php');
  include_once('../../Conn/funciones.php');
  $almacen = $_POST['almacen'];

  $query = "SELECT m.numero, m.fecha_movimiento, sum(m.valor_total) as valor, m.usuario, t.descripcion, m.estado, m.tipo_movi FROM movimientos_inventario m, tipo_movimiento_inv t where m.tipo = 1 and t.ajuste = 0 and m.tipo_movi = t.codigo and m.bodega = '$almacen' group by numero, t.codigo order by numero";
  
  $result = mysqli_query($conn,$query);
  $numrows = mysqli_num_rows($result);

  if ($numrows>0){
    ?>
      <div class='row-fluid'>
        <div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
        <table id="example1" class="table table-bordered">
          <thead>
            <tr class="warning">
              <td>Numero</td>
              <td>Fecha</td>
              <td>Valor</td>
              <td>Usuario</td>
              <td>Movimiento</td>
              <td>Estado</td>
              <td>Accion</td>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_array($result)){
            ?>
              <tr style='font-size:12px'>
                <td><?php echo $row['numero']; ?></td>
                <td><?php echo $row['fecha_movimiento']; ?></td>
                <td align="right"><?php echo number_format($row['valor'],2); ?></td>
                <td><?php echo $row['usuario']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td align="center"><?php echo estado_mov($row['estado']); ?></td>
               <td align='center'>
                <button type="button" class="btn btn-info btn-xs" 
                  data-toggle  ="modal" 
                  data-target  ="#ModalDetalleMovimiento" 
                  data-numero  ="<?php echo $row['numero']?>" 
                  data-almacen ="<?php echo $almacen?>" 
                  data-tipmov ="<?php echo $row['tipo_movi']?>" 
                  data-tipo   = "1"
                  title        ="Ver Detalle del Movimiento" >
                  <i class='glyphicon glyphicon-edit'></i>
                </button>
                <button type="button" class="btn btn-danger btn-xs" 
                  data-toggle="modal" 
                  data-target="#ModalAnulaMovimiento" 
                  title="Anula Movimiento" 
                  data-numero="<?php echo $row['numero']?>"  
                  data-almacen="<?php echo $almacen?>"  
                  data-tipmov ="<?php echo $row['tipo_movi']?>"
                  data-tipo   = "1"
                  title        ="Anular Movimiento Actual" >
                  <i class='glyphicon glyphicon-trash '></i> 
                </button>
               </td>
             </tr>
             <?php
            }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <td>Numero</td>
              <td>Fecha</td>
              <td>Valor</td>
              <td>Usuario</td>
              <td>Movimiento</td>
              <td>Estado</td>
              <td>Accion</td>
            </tr>
          </tfoot>
        </table>
      </div>
    <?php
  } else {
    ?>
    <div class="alert alert-warning alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4>Atencion !!!</h4> Sin Movimientos de Entradas
    </div>
    <?php 
  }
?>
  <script>
    $(function () {
      $('#example1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "language": {
          "next": "Siguiente",
          "search": "Buscar:",
          "entries": "registros"
        },
      });
    });
  </script>

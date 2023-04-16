<?php
/*-----------------------
Autor: Obed Alvarado
http://www.obedalvarado.pw
Fecha: 12-06-2015
Version de PHP: 5.6.3
----------------------------*/

	# conectare la base de datos
	# error_reporting(0);
	//include_once('../../Conn/Conn.php');
	include_once('../../Conn/seciones.php');
	include_once('../../Conn/funciones.php');

  $query = 'SELECT p.id_prod, p.cod_prod, p.nom_prod, f.des_falm, g.des_grup, s.des_subg, u.des_unid FROM productos_inve as p, familia_inve as f, grupos_inve as g, subgrupos_inve as s, unidades as u WHERE p.cod_familia = f.cod_falm AND p.cod_grupo = g.cod_grup AND p.cod_subgrupo = s.cod_subg AND p.uco_prod = u.cod_unid ORDER BY p.nom_prod ASC';
    $result = mysqli_query($conn,$query);
                    // Imprimir los resultados en HTML'
		
	$count_query  = mysqli_query($conn,$query);
	if($row= mysqli_fetch_array($count_query)){
		$numrows = mysqli_num_rows($count_query);
	}

	if ($numrows>0){
		?>
    <div class="row-fluid">
      <div class='container col-lg-11'>
        <div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
        <table id="example1" class="table table-bordered">
          <thead>
            <tr class="warning">
              <td>Codigo</td>
              <td>Producto</td>
              <td>Familia</td>
              <td>Grupo</td>
              <td>SubGrupo</td>
              <td>Unidad</td>
              <td>Accion</td>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_array($result)){
            ?>
              <tr style='font-size:12px'>
                <td><?php echo $row['cod_prod']; ?></td>
                <td width="180px"><?php echo $row['nom_prod']; ?></td>
                <td><?php echo $row['des_falm']; ?></td>
                <td><?php echo $row['des_grup']; ?></td>
                <td><?php echo $row['des_subg']; ?></td>
                <td width="30px"><?php echo $row['des_unid']; ?></td>
               <td align='center'>
                <button type="button" class="btn btn-info btn-xs" 
                  data-toggle="modal" 
                  data-target="#dataUpdateProducto" 
                  data-id        ="<?php echo $row['id_prod']?>" 
                  data-codigo    ="<?php echo $row['cod_prod']?>" 
                  data-producto  ="<?php echo $row['nom_prod']?>" 
                  data-familia   ="<?php echo $row['cod_familia']?>" 
                  data-grupo     ="<?php echo $row['cod_grupo']?>" 
                  data-subgrupo  ="<?php echo $row['cod_subgrupo']?>" 
                  data-compra    ="<?php echo $row['ucp_prod']?>" 
                  data-almacena  ="<?php echo $row['uco_prod']?>" 
                  data-procesa   ="<?php echo $row['upr_prod']?>" 
                  data-costo     ="<?php echo $row['pco_prod']?>" 
                  data-promedio  ="<?php echo $row['ppo_prod']?>" 
                  data-minimo    ="<?php echo $row['stock_min']?>" 
                  data-maximo    ="<?php echo $row['stock_max']?>" 
                  data-porciona  ="<?php echo $row['pri_prod']?>" 
                  data-equivale  ="<?php echo $row['por_prod']?>" 
                  data-cantidad  ="<?php echo $row['vpo_prod']?>" 
                  data-ubicacion ="<?php echo $row['ubicacion']?>" 
                  title="Modifica Datos del Producto" >
                  <i class='glyphicon glyphicon-edit'></i>
                </button>
                <button type="button" class="btn btn-danger btn-xs" 
                  data-toggle="modal" 
                  data-target="#dataDeleteProducto" 
                  title="Eliminar Producto" 
                  data-id="<?php echo $row['id_prod']?>"  
                  data-codigo="<?php echo $row['cod_prod']?>"  >
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
              <td>Codigo</td>
              <td>Producto</td>
              <td>Familia</td>
              <td>Grupo</td>
              <td>SubGrupo</td>
              <td>Unidad</td>
              <td>Accion</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
		<?php
	} else {
		?>
		<div class="alert alert-warning alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4>Atencion !!!</h4> Sin Informacion de Productos
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

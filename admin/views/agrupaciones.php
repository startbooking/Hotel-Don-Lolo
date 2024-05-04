
<div class="content-wrapper" style="margin-bottom: 50px"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row">
          <div class="col-lg-6">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_ADM?>">                  
            <input type="hidden" name="ubicacion" id="ubicacion" value="agrupaciones">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-cube"></i> Agrupaciones Ventas </h3>
          </div>
          <div class="col-lg-6" align="right">
            <a 
              data-toggle="modal" 
              style="margin:20px 0" type="button" class="btn btn-success" href="#myModalAdicionarAgrupacion">
              <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
               Adicionar Agrupacion</a>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="datos_ajax_delete"></div>
        <div class="col-lg-6 col-lg-offset-3">              
          <div class="container-fluid"> 
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <!-- <th>Codigo</th> -->
                  <th>Descripcion</th>
                  <th>Accion</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach ($agrupaciones as $agrupacion) { ?> 
                  <tr>
                    <!-- <td><?php echo $agrupacion["id"]?></td> -->
                    <td><?php echo $agrupacion["descripcion"]?></td>
                    <td align="center">
                      <button type="button" class="btn btn-info btn-xs" 
                        data-toggle ="modal" 
                        data-target ="#myModalModificaAgrupacion" 
                        data-id     ="<?= $agrupacion['id']?>" 
                        data-desc   ="<?= $agrupacion['descripcion']?>" 
                        title       ="Modificar la Agrupacion Actual" >
                        <i class='fa fa-pencil-square'></i>
                      </button>
                      <button type="button" class="btn btn-danger btn-xs" 
                        data-toggle ="modal" 
                        data-target ="#myModalEliminaAgrupacion" 
                        data-id     ="<?= $agrupacion['id']?>" 
                        data-desc   ="<?= $agrupacion['descripcion']?>" 
                        title       ="Elimina la Agrupacion Actual" >
                        <i class='fa fa-trash'></i>
                      </button>
                    </td>
                  </tr>
                  <?php 
                }
                ?>
              </tbody>
              <!--
              <tfoot>
                <tr>
                  <th>Descripcion</th>
                  <th>Accion</th>
                </tr>
              </tfoot>
              -->
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<form id="dataRegistrarProducto" class="form-horizontal">
<div class="modal fade" id="dataRegisterProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
        <h4 class="modal-title" id="exampleModalLabel">Modificar Producto</h4>
      </div>
      <div class="modal-body">
        <div id="datos_ajax"></div>
        <div class="form-group">
          <label for="codigo" class="control-label col-lg-2 col-md-2">Codigo</label>
          <div class="col-lg-2 col-md-2">
            <input type="text" class="form-control" id="codigo" name="codigo" required maxlength="6">
          </div>
          <label for="producto" class="control-label col-lg-4 col-md-4">Producto</label>
          <div class="col-lg-4 col-md-4">
            <input type="text" class="form-control" id="producto" name="producto" required >
          </div>
        </div>
        <div class="form-group">
          <label for="familia" class="control-label col-lg-2 col-md-2">Familia</label>
          <div class="col-lg-4 col-md-4">
            <select name="familia" id="familia" required >
              <option>Seleccione la Familia del Producto</option>
              <?php 
              $sql_fam = "SELECT * FROM familia_inve ORDER BY des_falm" ;
              $res_fam = mysqli_query($conn,$sql_fam);
              while($row_fam=mysqli_fetch_assoc($res_fam)){
                ?>
                  <option onclick="getGrupo(this.value)" value="<?=$row_fam['cod_falm']?>"><?=$row_fam['des_falm']?></option>
                <?php 
              }
              ?>
            </select>
          </div>
            <label for="seccion" class="control-label col-lg-2 col-md-2">Grupo</label>
            <div class="col-lg-4 col-md-4">
              <select name="grupos" id="grupos" required>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="seccion" class="control-label col-lg-2 col-md-2">Subgrupo</label>
            <div class="col-lg-4 col-md-4">
              <select name="subgrupo" id="subgrupo" requierd>
              </select>
            </div>
            <label for="seccion" class="control-label col-lg-2 col-md-2">Unidad de Compra</label>
            <div class="col-lg-4 col-md-4">
              <select name="compra" id="compra" required>
                <option>Seleccione la unidad de Compra</option>
                <?php 
                $sec = "SELECT * FROM unidades order by des_unid" ;
                $fil = mysqli_query($conn,$sec);
                while($tfil = mysqli_fetch_array($fil)){
                  ?>
                  <option value="<?= $tfil['cod_unid']?>"><?php echo $tfil['des_unid']?></option>
                  <?php
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group" id="compra">
            <label for="seccion" class="control-label col-lg-2 col-md-2">Unidad de Almacenamiento</label>
            <div class="col-lg-4 col-md-4">
              <select name="almacena" id="almacena" required>
                <option>Seleccione la unidad de Almacenamiento</option>
                <?php 
                $sec = "SELECT * FROM unidades order by des_unid" ;
                $fil = mysqli_query($conn,$sec);
                while($tfil = mysqli_fetch_array($fil)){
                  ?>
                  <option value="<?= $tfil['cod_unid']?>"><?php echo $tfil['des_unid']?></option>
                  <?php
                  }
                ?>
              </select>
            </div>
            <label for="seccion" class="control-label col-lg-2 col-md-2">Unidad de Procesamiento</label>
            <div class="col-lg-4 col-md-4">
              <select name="procesa" id="procesa" required>
                <option>Seleccione la unidad de Procesamiento</option>
                <?php 
                $sec = "SELECT * FROM unidades order by des_unid" ;
                $fil = mysqli_query($conn,$sec);
                while($tfil = mysqli_fetch_array($fil)){
                  ?>
                  <option value="<?= $tfil['cod_unid']?>"><?php echo $tfil['des_unid']?></option>
                  <?php
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="costo" class="control-label col-lg-2  col-md-2">Precio Costo</label>
            <div class="col-lg-4 col-md-4">
              <input type="number" class="form-control" id="costo" name="costo" min='0' value='0'> 
            </div>
            <label for="promedio" class="control-label col-lg-2  col-md-2">Precio Promedio</label>
            <div class="col-lg-4 col-md-4">
              <input type="number" class="form-control" id="promedio" name="promedio" min='0' value='0'> 
            </div>
          </div>

          <div class="form-group">
            <label for="costo" class="control-label col-lg-2  col-md-2">Stock Minimo</label>
            <div class="col-lg-4 col-md-4">
              <input type="number" class="form-control" id="minimo" name="minimo" required min='0' > 
            </div>
            <label for="promedio" class="control-label col-lg-2  col-md-2">Stock maximo</label>
            <div class="col-lg-4 col-md-4">
              <input type="number" class="form-control" id="maximo" name="maximo" required min='0' > 
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-lg-2  col-md-2" for="">Porcionar</label>
            <div class="col-lg-2 col-md-2">
              <input type="checkbox" name="porciona" id="porciona" title="Producto Para Porcionar ?">
            </div>
            <label for="costo" class="control-label col-lg-2  col-md-2">% Equivalente</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" class="form-control" id="equivale" name="equivale" min='0' value='0'> 
            </div>
            <label for="promedio" class="control-label col-lg-2  col-md-2">Peso Porcion</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" class="form-control" id='cantidad' name="cantidad" min='0' value='0'> 
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-2  col-md-2" for="exampleTextarea">Ubicacion</label>
            <div class="col-lg-10 col-md-10">
            <input type="text" id="ubicacion" name="ubicacion">
              <!--<textarea class="form-control" id="ubicacion" name="ubicacion"></textarea> -->
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar datos</button>
      </div>
    </div>
  </div>
</div>
</form>
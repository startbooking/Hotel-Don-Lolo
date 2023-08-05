<form id="dataRegistrarProveedor" class="form-horizontal">
  <div class="modal fade" id="dataRegisterProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></button>
          <h4 class="modal-title" id="exampleModalLabel">Adiciona Proveedor</h4>
        </div>
        <div class="modal-body">
          <div id="datos_ajax"></div>
          <div class="form-group">
            <label for="empresa" class="control-label col-lg-2 col-md-2">Empresa</label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="empresa" name="empresa" required >
            </div>
            <label for="nit" class="control-label col-lg-1 col-md-1">Nit</label>
            <div class="col-lg-2 col-md-2">
              <input type="number" class="form-control" id="nit" name="nit" min="1000000" required >
            </div>
            <div class="col-lg-1 col-md-1" id="dv">
            </div>
          </div>
          <div class="form-group">
            <label for="direccion" class="control-label col-lg-2 col-md-2">Direccion</label>
            <div class="col-lg-6 col-md-6">
              <input type="text" class="form-control" id="direccion" name="direccion" required >
            </div>
              <label for="seccion" class="control-label col-lg-2 col-md-2">Telefono</label>
              <div class="col-lg-2 col-md-2">
                <input type="number" class="form-control" id="telefono" name="telefono" required >
              </div>
            </div>

            <div class="form-group" id="subgrupo">
              <label for="seccion" class="control-label col-lg-2 col-md-2">Telefono 2</label>
              <div class="col-lg-2 col-md-2">
                <input type="number" class="form-control" id="telefono2" name="telefono2" >
              </div>
              <label for="seccion" class="control-label col-lg-2 col-md-2">Celular</label>
              <div class="col-lg-2 col-md-2">
                <input type="number" class="form-control" id="celular" name="celular" required >
              </div>
              <label for="seccion" class="control-label col-lg-2 col-md-2">Fax</label>
              <div class="col-lg-2 col-md-2">
                <input type="number" class="form-control" id="fax" name="fax" >
              </div>
            </div>

            <div class="form-group">
              <label for="seccion" class="control-label col-lg-2 col-md-2">email</label>
              <div class="col-lg-4 col-md-4">
                <input type="email" class="form-control" id="correo" name="correo" required >
              </div>
              <label for="seccion" class="control-label col-lg-2 col-md-2">Tipo Empresa</label>
              <div class="col-lg-4 col-md-4">
                <select name="tipo_emp" id="tipo_emp" required>
                  <option value="">Seleccione El Tipo de Empresa</option>
                  <?php 
                  $sec = "SELECT * FROM tipo_cia order by descripcion" ;
                  $fil = mysqli_query($conn,$sec);
                  while($tfil = mysqli_fetch_array($fil)){
                    ?>
                    <option value="<?= $tfil['codigo']?>"><?php echo $tfil['descripcion']?></option>
                    <?php
                    }
                  ?>
                </select>
              </div>
            </div>
            <div id='nombre_personas'></div>

            <div class="form-group">
              <label for="costo" class="control-label col-lg-2  col-md-2">Tipo Documento</label>
              <div class="col-lg-4 col-md-4">
                <select name="tipo_doc" id="tipo_doc" required>
                  <option value="">Seleccione El Tipo de Documento</option>
                  <?php 
                  $sec = "SELECT * FROM tipo_doc order by descripcion" ;
                  $fil = mysqli_query($conn,$sec);
                  while($tfil = mysqli_fetch_array($fil)){
                    ?>
                    <option value="<?= $tfil['codigo']?>"><?php echo $tfil['descripcion']?></option>
                    <?php
                    }
                  ?>
                </select>
              </div>
              <label for="promedio" class="control-label col-lg-2  col-md-2">Codigo CIIU</label>
              <div class="col-lg-4 col-md-4">
                <select name="ciiu" id="ciiu" required>
                  <option value="">Seleccione El Codigo CIIU</option>
                  <?php 
                  $sec = "SELECT * FROM ciiu order by codigo" ;
                  $fil = mysqli_query($conn,$sec);
                  while($tfil = mysqli_fetch_array($fil)){
                    ?>
                    <option value="<?= $tfil['codigo']?>"><?php echo $tfil['codigo'].' '.substr($tfil['descripcion'],0,50)?></option>
                    <?php
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="paices" class="control-label col-lg-2  col-md-2">Pais</label>
              <div class="col-lg-4 col-md-4">
                <select name="paices" id="paices" required>
                  <option value="">Seleccione El Pais</option>
                  <?php 
                  $sec = "SELECT * FROM paices order by codigo" ;
                  $fil = mysqli_query($conn,$sec);
                  while($tfil = mysqli_fetch_array($fil)){
                    ?>
                    <option value="<?= $tfil['codigo']?>"><?php echo $tfil['descripcion']?></option>
                    <?php
                    }
                  ?>
                </select>
              </div>
              <label for="ciudad" class="control-label col-lg-2  col-md-2">Ciudad</label>
              <div class="col-lg-4 col-md-4">
                <select name="ciudad" id="ciudad" required>
                </select> 
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-lg-2  col-md-2" for="">web</label>
              <div class="col-lg-4 col-md-4">
                <input type="text" name="web" id="web" title="Pagina Web">
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</form>
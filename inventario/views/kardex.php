    <div class="content-wrapper">
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="container-fluid" style="padding:0">
              <div class="col-lg-3" style="padding:0">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?= BASE_INV ?>">
                <input type="hidden" name="ubicacion" id="ubicacion" value="proveedores">
                <h3 class="w3ls_head tituloPagina">
                  <i style="color:black;" class="fa-solid fa-magnifying-glass-chart fa-2x"></i>
                  Kardex
                </h3>
              </div>
              <div class="col-lg-6">
                <div class="form-horizontal">
                  <label class="col-lg-4 col-md-4 col-sm-4 control-label">Bodega de Inventario</label>
                  <div class="col-lg-8 col-md-8 col-sm-8">
                    <select class="form-control" name="bodega" id="bodega" onblur='muestraKardex(this.value)'>
                      <option value="">Seleccione la Bodega </option>
                      <?php
                      $bodegas = $admin->getBodegas();
                      foreach ($bodegas as $bodega) { ?>
                        <option value="<?= $bodega['id_bodega'] ?>"><?= $bodega['descripcion_bodega'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="container-fluid">
            </div>
          </div>
          <div class="panel-body">
            <div id="datosMovimientos"></div>
          </div>
        </div>
      </section>
    </div>
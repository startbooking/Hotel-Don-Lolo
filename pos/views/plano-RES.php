<div class="container-fluid">
  <div class="col-lg-9">
    <div class="container-fluid ">
        <div class="container-fluid sombraNegra borde pd20">
          <div class="container-fluid">
            <button onclick="abreCuenta('03')" class="btn btn-success doble " id="boton03" name="boton12">M 03</button>
            <div class="cuadro t40 l250 sombraBlanca"></div>
            <button onclick="abreCuenta('09')" class="btn btn-success sencilla ml150" id="boton09" name="boton13">M 09</button>
            <button onclick="abreCuenta('10')" class="btn btn-success doble ml150" id="boton10" name="boton14">M 10</button>
            <div class="cuadro t40 r130 sombraBlanca"></div>
          </div>
          <div class="container-fluid mt40">
            <button onclick="abreCuenta('02')" class="btn btn-success sencilla" id="boton02" name="boton15">M 02</button>
            <button onclick="abreCuenta('05')" class="btn btn-success sencilla ml110" id="boton05" name="boton16">M 05</button>
            <button onclick="abreCuenta('08')" class="btn btn-success sencilla ml110" id="boton08" name="boton17">M 08</button>
            <button onclick="abreCuenta('11')" class="btn btn-success sencilla ml110" id="boton11" name="boton12">M 11</button>
            <button onclick="abreCuenta('14')" class="btn btn-success sencilla ml110" id="boton14" name="boton13">T 14</button>
          </div>
          <div class="container-fluid mt40">
            <button onclick="abreCuenta('01')" class="btn btn-success sencilla" id="boton01" name="boton14">M 01</button>
            <button onclick="abreCuenta('06')" class="btn btn-success sencilla ml120" id="boton06" name="boton15">M 06</button>
            <div class="cuadro l250 sombraBlanca"></div>
            <button onclick="abreCuenta('07')" class="btn btn-success doble ml110" id="boton07" name="boton16">M 07</button>
            <div class="cuadro r130 sombraBlanca"></div>
            <button onclick="abreCuenta('13')" class="btn btn-success sencilla ml180" id="boton13" name="boton17">M 13</button>
            <div class="row-flui">
              <div class="bordelinea"></div>
              <div class="barra"></div>
              <div class="puerta"></div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="containe r-fluid">
      <div class="container-fluid" style="padding:10px">
      <div class="container-fluid">
        <!-- <h3 style="text-align:center" class="tituloEscritorio">Informes y Estadisticas</h3> -->
        <div class="row moduloCentrar">
          <div class="col-md-12 col-xs-12">
            <a onclick="cuentasActivas()" class="small-box-footer">
              <div class="small-box bg-yellow" style="cursor:pointer;">
                <div class="inner">
                  <?php
                  echo '<h3> ' . number_format($comandaPos, 0, ',', '.') . '</h3>';
                  ?>
                  <p>Cuentas Activas</p>
                </div>
                <div class="icon">
                  <i class="ion ion-archive"></i>
                </div>
                <small class="small-box-footer" style="font-size:12px">Detalles<i class="fa fa-arrow-circle-right"></i></small>

              </div>
            </a>
          </div>
          <div class="col-md-12 col-xs-12">
            <a onclick="facturasDia()" class="small-box-footer">
              <div class="small-box bg-aqua" style="cursor:pointer;">
                <div class="inner">
                  <?php
                  echo '<h3> ' . number_format($facturasPos, 0, ',', '.') . '</h3>';
                  ?>
                  <p>Facturas Generadas </p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-cart-outline"></i>
                </div>
                <small class="small-box-footer" style="font-size:12px">Detalles<i class="fa fa-arrow-circle-right"></i></small>
              </div>
            </a>
          </div>
          <div class="col-md-12 col-xs-12">
            <a onclick="verComandasAnuladas()" class="small-box-footer">
              <div class="small-box bg-red" style="cursor: pointer;">
                <div class="inner">
                  <?php
                  echo '<h3> ' . number_format($comandaAnuladaPos, 0, ',', '.') . '</h3>';
                  ?>
                  <p>Cuentas Anuladas</p>
                </div>
                <div class="icon">
                  <i class="ion ion-archive"></i>
                </div>
                <small class="small-box-footer">
                  Ingresar <i class="fa fa-arrow-circle-right"></i>
                </small>
              </div>
            </a>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
    <div class="row" style="height: 360px;">      
      <div class="col-md-9" style="border:1px solid #000;">
        <div class="row" style="display:flex;height: 20%">
          <div style="border:1px solid #000;width: 200px;height: 50px;margin:0px 150px;background: whitesmoke"></div>
          <div style="border:1px solid #000;width: 200px;height: 50px;margin:0px 0px;background: whitesmoke"></div>
        </div>
        <div class="row" style="height: 30%">
          <button onclick="abreCuenta('06')" class="btn btn-success" id="boton06" name="boton06" style="border:1px solid #000; width: 60px;height: 60px;border-radius:50%;margin-left: 10px;margin-top: -100px;">M 6</button>
          <button onclick="abreCuenta('05')" class="btn btn-success" id="boton05" name="boton05" style="border:1px solid #000; width: 50px;height: 50px;border-radius:50%;margin-left:85px;margin-top: -35px;">M 5</button>
          <button onclick="abreCuenta('04')" class="btn btn-success" id="boton04" name="boton04" style="border:1px solid #000; width: 50px;height: 50px;border-radius:50%;margin-left:85px;margin-top: -35px;">M 4</button>
          <button onclick="abreCuenta('03')" class="btn btn-success" id="boton03" name="boton03" style="border:1px solid #000; width: 50px;height: 50px;border-radius:50%;margin-left:50px;margin-top: 50px;">M 3</button>
          <button onclick="abreCuenta('02')" class="btn btn-success" id="boton02" name="boton02" style="border:1px solid #000; width: 50px;height: 50px;border-radius:50%;margin-left:55px;margin-top:-35px;">M 2</button>
          <button onclick="abreCuenta('01')" class="btn btn-success" id="boton01" name="boton01" style="border:1px solid #000; width: 50px;height: 50px;border-radius:50%;margin-left:85px;margin-top:-35px;">M 1</button>
        </div>
        <div class="row" style="height: 14%">
          <button onclick="abreCuenta('07')" class="btn btn-success" id="boton07" name="boton07" style="border:1px solid #000; width: 60px;height: 60px;border-radius:50%;margin-left: 10px;margin-top:0px">M 7</button>
        </div>
        <div class="row" style="margin-top:-30px;">
          <button onclick="abreCuenta('B1')" class="btn btn-success" id="botonB1" name="botonB1" style="border:1px solid #000; width: 50px;height: 30px;border-radius:10%;margin-left: 180px;">B 1</button>
          <button onclick="abreCuenta('B2')" class="btn btn-success" id="botonB2" name="botonB2" style="border:1px solid #000; width: 50px;height: 30px;border-radius:10%;margin-left: 20px;">B 2</button>
          <button onclick="abreCuenta('B3')" class="btn btn-success" id="botonB3" name="botonB3" style="border:1px solid #000; width: 50px;height: 30px;border-radius:10%;margin-left: 20px;">B 3</button>
          <button onclick="abreCuenta('B4')" class="btn btn-success" id="botonB4" name="botonB4" style="border:1px solid #000; width: 50px;height: 30px;border-radius:10%;margin-left: 20px;">B 4</button>          
          <button onclick="abreCuenta('B5')" class="btn btn-success" id="botonB5" name="botonB5" style="border:1px solid #000; width: 50px;height: 30px;border-radius:10%;margin-left: 20px;">B 5</button>          
        </div>
        <div class="row" style="display:flex;height: 20%">
          <div style="border:1px solid #000;width: 100px;height: 144px;margin:0px 0px;background: whitesmoke"></div>
          <div style="border:1px solid #000;width: 200px;height: 50px;margin-left:50px;width: 535px;background: whitesmoke"></div>
        </div>
      </div>
      <div class="col-md-3" style="border:1px solid #000;">
        <div class="row" style="height: 20%">
          <button onclick="abreCuenta('T1')" class="btn btn-success pull-right" id="botonT1" style="border:1px solid #000; width: 50px;height: 50px;margin-right: 20px;margin-top: 20px;">T 1</button>

        </div>
        <div class="row" style="height: 30%">
          <button onclick="abreCuenta('T2')" class="btn btn-success" id="botonT2" style="border:1px solid #000; width: 50px;height: 50px;border-radius:50%;margin-left:40%;margin-top: 60px;">T 2</button>
        </div>
        <div class="row" style="height: 14%">
          <button onclick="abreCuenta('T3')" class="btn btn-success" id="botonT3" style="border:1px solid #000; width: 60px;height: 90px;margin-left: 0px;margin-top: 0px">T 3</button>
          <button onclick="abreCuenta('T4')" class="btn btn-success" id="botonT4" style="border:1px solid #000; width: 60px;height: 60px;margin-left: 90px;margin-top: 114px">T 4</button>
        </div>
      </div>
    </div>
    <div class="row" style="margin:0">
      <div class="container-fluid" style="padding:10px">
        <div class="col-md-6 col-xs-6">
          <a onclick="facturasDia()" class="small-box-footer">
            <div class="small-box bg-aqua" style="cursor:pointer;">
              <div class="inner">
                <?php 
                echo '<h3> '.number_format($facturasPos,0,",",".").'</h3>';
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
        <div class="col-md-6 col-xs-6">
          <a onclick="verComandasAnuladas()" class="small-box-footer">
          <div class="small-box bg-red" style="cursor: pointer;">
            <div class="inner">
              <?php 
              echo '<h3> '.number_format($comandaAnuladaPos,0,",",".").'</h3>';
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
        <div class="container pull-right" role="group" aria-label="Toolbar Group">
        </div>
      </div>
    </div>

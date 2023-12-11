    <div class="row bordeSeccion" style="height:430px;margin-bottom:20px;">
      <div class="col-md-4 " style="padding:0px;">
        <div class="container-fluid borderCajas" style="position:absolute;width:100px;height: 152px;margin-left:72%;">
          <label class="control-label" style="margin-top: 88%;"> JACUZZI</label>
        </div>
        <div class="row">
          <button onclick="abreCuenta('12')" class="btn btn-success btn635" id="boton12" name="boton12" style="margin-left:87%;;margin-top:81%;">M 12</button>
          <button onclick="abreCuenta('13')" class="btn btn-success btn635" id="boton13" name="boton13" style="margin-left: 55%;margin-top: 77%;border-radius: 50%;height: 60px;">T 13</button>
          <button onclick="abreCuenta('14')" class="btn btn-success btn635" id="boton14" name="boton14" style="margin-left:15%;;margin-top:84%;">M 14</button>
          <button onclick="abreCuenta('15')" class="btn btn-success btn635" id="boton15" name="boton15" style="margin-left:28%;;margin-top:38%;">M 15</button>
          <button onclick="abreCuenta('16')" class="btn btn-success btn635" id="boton16" name="boton16" style="margin-left:28%;;margin-top:20%;">M 16</button>
          <button onclick="abreCuenta('17')" class="btn btn-success btn635" id="boton17" name="boton17" style="margin-left:28%;;margin-top:2%;">M 17</button>
        </div>
      </div>
      <div class="col-md-3" style="padding:0">
        <div class="container-fluid borderCajas tCaja18">
          <label class="control-label" style="margin-top:33%;"> COCINA</label>
        </div>
        <div class="container-fluid borderCajas tCaja13" style="margin-top:25%">
          <label class="control-label" style="margin-top:26%;"> ASCENSOR</label>
        </div>
      </div>
      <div class="col-md-5" style="padding:0px;">
        <div class="container-fluid borderCajas" style="position:absolute;width:64px;height: 82px;margin-left:-2px;">
          <label class="control-label" style="margin-top: 85%;margin-left: -60%;"> BARRA</label>
        </div>
        <div class="row">
          <button onclick="abreCuenta('01')" class="btn btn-success btn635" id="boton01" name="boton01" style="margin-left:30%">M 01</button>
          <button onclick="abreCuenta('02')" class="btn btn-success btn635" id="boton02" name="boton02" style="margin-left:59%">M 02</button>
          <button onclick="abreCuenta('03')" class="btn btn-success btn635" id="boton03" name="boton03" style="margin-left:89%;margin-top:12%">M 03</button>
          <button onclick="abreCuenta('04')" class="btn btn-success btn635" id="boton04" name="boton04" style="margin-left:89%;margin-top:26%">M 04</button>
          <button onclick="abreCuenta('05')" class="btn btn-success btn635" id="boton05" name="boton05" style="margin-left:89%;margin-top:40%">M 05</button>
          <button onclick="abreCuenta('06')" class="btn btn-success btn635" id="boton06" name="boton06" style="margin-left:63%;;margin-top:16%">M 06</button>
          <button onclick="abreCuenta('07')" class="btn btn-success btn635" id="boton07" name="boton07" style="margin-left:34%;;margin-top:24%">M 07</button>
          <button onclick="abreCuenta('08')" class="btn btn-success btn635" id="boton08" name="boton08" style="margin-left:63%;;margin-top:33%">M 08</button>
          <button onclick="abreCuenta('09')" class="btn btn-success btn635" id="boton09" name="boton09" style="margin-left:35%;;margin-top:44%">M 09</button>
          <button onclick="abreCuenta('10')" class="btn btn-success btn635" id="boton10" name="boton10" style="margin-left:63%;;margin-top:48%">M 10</button>
          <button onclick="abreCuenta('11')" class="btn btn-success btn635" id="boton11" name="boton11" style="margin-left:35%;;margin-top:60%;width: 120px;height: 78px;">M 11</button>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top:50px">
      <div class="container-fluid" style="padding:10px">
        <div class="col-md-6 col-xs-6">
          <a onclick="facturasDia()" class="small-box-footer">
            <div class="small-box bg-aqua" style="cursor:pointer;">
              <div class="inner">
                <?php
                echo '<h3> ' . number_format($facturasPos, 0, ",", ".") . '</h3>';
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
                echo '<h3> ' . number_format($comandaAnuladaPos, 0, ",", ".") . '</h3>';
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
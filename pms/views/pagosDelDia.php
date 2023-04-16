    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading">  
            <div class="row">
              <div class="col-lg-9">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="balanceCajero.php">
                <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="<?=$_SESSION['usuario']?>">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Balance Cajero <?=$_SESSION['usuario']?> [Pagos Recibidos en el Dia]</h3>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="imprimeInforme">
               <object id="verInforme" width="100%" height="500" data=""></object> 
            </div>
            <?php 
              include 'imprimir/imprimePagosDiaCajero.php';
            ?>
          </div>
        </div>
      </section>
    </div>

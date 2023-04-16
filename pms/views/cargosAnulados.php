    <div class="content-wrapper"> 
      <section class="content">
        <div class="panel panel-success">
          <div class="panel-heading"> 
            <div class="row">
              <div class="col-lg-9">
                <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">                  
                <input type="hidden" name="ubicacion" id="ubicacion" value="cargosAnulados">
                <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="<?=$_SESSION['usuario']?>">
                <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Balance Cajero <?=$_SESSION['usuario']?> [Cargos Anulados del Dia]</h3>
              </div>
              <div class="col-lg-3" align="right">
                <a style="margin:20px 0" type="button" class="btn btn-success" href=""><i class="fa fa-print" aria-hidden="true"></i>Imprimir</a>
              </div>
            </div>
          </div>
          <div class="panel-body"> 
            <div class="imprimeInforme">
               <object id="verInforme" width="100%" height="500" data=""></object> 
            </div>
            <?php 
              include 'imprimir/imprimeCargosAnuladosDiaCajero.php';
            ?>          
          </div>
        </div>
      </section>
    </div>

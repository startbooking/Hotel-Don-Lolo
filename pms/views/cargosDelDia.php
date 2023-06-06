<script>
  sesion      = JSON.parse(localStorage.getItem('sesion'))
  usuario     = sesion['usuario'][0]['usuario']
  $('.tituloPagina').html(`<i style="color:black;font-size:36px;" class="fa fa-industry"></i> Balance Cajero ${usuario} [Cargos del Dia]`)
</script>

<div class="content-wrapper" id="cargosdeldia"> 
  <section class="content">
    <div class="panel panel-success">
      <div class="panel-heading"> 
        <div class="row">  
          <div class="col-lg-9">
            <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_PMS?>">                  
            <input type="hidden" name="ubicacion" id="ubicacion" value="balanceCargosDelDia">
            <input type="hidden" name="usuarioActivo" id="usuarioActivo" value="">
            <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Balance Cajero [Cargos del Dia]</h3>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="imprimeInforme">
           <object id="verInforme" width="100%" height="500" data=""></object> 
        </div>
        <?php 
          include 'imprimir/imprimeCargosDiaCajero.php';
        ?>
      </div>
    </div>
  </section>
</div>

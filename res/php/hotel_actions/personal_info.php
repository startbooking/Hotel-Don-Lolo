<?php 
  require '../config.php' ;
  require '../app_top.php'; 
  $idhotel  = $_POST['hotel'];
  $textos   = $user->getTextHotel($idhotel);
  $hotel    = $textos[0]['hotel_name']
?>

<div class="personal_info_area">
  <div class="hotel_booking_area">
    <div class="hotel_booking margin-top-25">
      <div class="row-fluid">
        <form role="form" action="javascript:confirma_reserva()" method="POST" accept-charset="utf-8">
          <div class="row m15">
            <div class="panel panel-info">
              <div class="panel-heading">
                <h2 style="text-align: center;font-size: 22px;font-weight: 600;padding: 0;margin: 0;">Datos del Huesped</h2>
              </div>
              <div class="panel-body">
                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                  <input type="hidden" name="idhotel" id='idhotel' value='<?php echo $idhotel ?>'> 
                  <input type="hidden" name="namehotel" id='namehotel' value='<?php echo $hotel ?>'> 
                  <input type="text" name="firs_name" id="firs_name" class="form-control" placeholder="Nombres" required="">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                  <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Apellidos" required="">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                  <input type="text" name="identify" id="identify" class="form-control" placeholder="Identificacion" max="15" required="">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                  <input type="email" name="mail" id="mail" class="form-control" placeholder="Email" required="">               
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="Telefono" required="">               
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                  <input type="text" name="adress" id="adress" class="form-control" placeholder="Direccion" required="">               
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                  <input type="text" name="city" id="city" class="form-control" placeholder="Ciudad" required="">               
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-4">
                  <select class="form-control" name="nacionality" id='nacionality' required="">
                    <option value="">Nacionalidad</option>
                    <?php 
                      $lands = $user->getLands();
                      foreach($lands as $land): ?>
                        <option value="<?php echo $land['id_land']?>"><?php echo $land['name_land']?></option>
                        <?php 

                      endforeach; 
                     ?>

                  </select>               
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                  <textarea class="form-control" name="comments" id="comments" rows="5" placeholder="Ingresa Alguna Solicitud Especifica"></textarea>
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12" style="margin-top:10px">
                  <article style="text-align: justify;font-size:0.7em">
                  <header id="header" class=""><?php echo $textos[0]['privacy_policy'] ?> 
                    <a href="" data-toggle="modal" data-target="#myModalPoliticas"><?php echo $textos[0]['title_privacy'] ?></a>
                  </header>
                  <p>
                    <h5>
                      <?php echo $textos[0]['title_terms_use'] ?>
                    </h5>
                    <input type="checkbox" name="abeas" id="abeas" value="1" checked>
                    <?php  echo $textos[0]['terms_use'] ?>
                  </p>
                  </article>                
                </div>
                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                  <label for=""> He leído y acepto las </label>
                  <a href="" data-toggle="modal" data-target="#myModal">Condiciones de la Reserva</a>
                  <input type="checkbox" name="abeas" id="abeas" value="1" required="">
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12">
                  <div class="booking_next_btn padding-top-5 margin-top-5 clearfix border-top-whitesmoke">
                    <div class="col-sm-6 col-xs-12">
                      <a href="home" class="btn btn-warning btn-block">Cancelar Reserva</a>  
                    </div>

                    <div class="col-sm-6 col-xs-12 btnReserva">                  
                      <button class="btn btn-info btn-block" type="submit">Completa la Reserva</button>
                    </div> 
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



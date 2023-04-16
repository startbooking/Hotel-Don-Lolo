<?php 
  $llega = date('Y-m-d');
  $sale = strtotime ( '+1 day' , strtotime ( $llega ) ) ;
  $sale = date ('Y-m-d' , $sale );
 ?>

  <form id=form1 role=form action='booking' class='form-group form-booking' method="POST">
      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
        <div class="room_book border-right-dark-1">
          <h6>Reserva Ahora</h6>
        </div>
      </div> 
      <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-12">
          <input class="form-control" type="date" id="indate" name="indate" min="<?php echo $llega ?>" value="<?php echo $llega ?>" onblur='validafecha(this.value)'  required>
      </div>
      <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-12">
        <input class="form-control" type="date" id="outdate" name="outdate" required min="<?php echo $sale?>" value="<?php echo $sale?>" step="1">
      </div>
      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 icon_arrow">
        <div class="input-group border-bottom-dark-2">
          <select class='form-control' name='adult' id='adult' required="">
            <?php 
            for ($i=1; $i <=ADULTS ; $i++) {
            ?>
            <option value="<?=$i?>"><?=$i?> Adulto</option>
            <?php 
            }
             ?>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 icon_arrow">
        <div class="input-group border-bottom-dark-2">
          <select class=form-control name='child' id='child' required="">
            <option value="0">Sin Niños</option>
            <?php 
            for ($i=1; $i <= KIDS ; $i++) { 
             ?>
              <option value="<?=$i?>"><?=$i?> Niños</option>
            <?php 
            }
            ?>
          </select>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
        <button class="btn btn-primary btn-block" type="submit" style="margin-top:0 !important ">Disponibilidad</button>
      </div>
  </form>


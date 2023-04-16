<?php 
  $llega = date('Y-m-d');
  $sale  = strtotime ( '+1 day' , strtotime ( $llega ) ) ;
  $sale  = date ('Y-m-d' , $sale );
?>

<div class='hotel_booking'>
  <form id=form1 role=form action='<?=BASE_WEB?>booking' class='form-group' method="POST">
    <div class="row">
      <div class="form-group col-lg-12">
        <div class="room_book border-right-dark-1">
          <h6 style="padding:15px 0; text-align:center">Reserva Ahora</h6>
        </div>
      </div> 
      <div class="form-group col-lg-12">
          <input class="form-control" type="date" id="indate" name="indate" min="<?php echo $llega ?>" value="<?php echo $llega ?>" onblur='validafecha(this.value)'  required>
      </div>
      <div class="form-group col-lg-12">
        <input class="form-control" type="date" id="outdate" name="outdate" required min="<?php echo $sale?>" min="<?php echo $sale?>" value="<?php echo $sale?>" step="1">
      </div>
      <div class="form-group col-lg-12 col-md-12 col-sm-12 icon_arrow">
        <label style="color:#FFF;font-weight: 500;margin-bottom: 5px">Adultos</label>
        <select class=form-control name='adult' id='adult' required="">
            <?php 
            for ($i=1; $i <= ADULTS ; $i++) { 
             ?>
              <option value="<?=$i?>"><?=$i?> Adultos</option>
            <?php 
            }
            ?>
          </select>
      </div>
      <div class="form-group col-lg-12 col-md-12 col-sm-12 icon_arrow">
        <label style="color:#FFF;font-weight: 500;margin-bottom: 5px">Niños</label>
          <select class=form-control name='child' id='child'>
            <option value="0">Sin Niños</option>}
            <?php 
            for ($i=1; $i <= KIDS ; $i++) { 
             ?>
              <option value="<?=$i?>"><?=$i?> Niños</option>
            <?php 
            }
            ?>
          </select>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:20px 10px;">
        <center>  <button class="btn btn-primary btn-block" type="submit">Disponibilidad</button></center>
      </div>
    </div>
  </form>
</div>

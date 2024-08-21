

	<div class="row imgCover">
		<img src="<?php echo BASE_IMG.'cover/'.$hotel[0]['img_portada']?>" alt="" style="">
	</div>
	<div class="row">
		<div class="row">
			<div class="w3_agile_banner_info" style="z-index:50">
				<!--<section class="slider" style="background-color:#0005;">
				</section>
				<section class="banner_hotel_booking">						
				</section> -->
					<div class="flexslider">
						<ul class="slides">
							<?php 
		            foreach($sliders as $slider): ?>
									<li>
										<div class="agileits_w3layouts_banner_info">
											<p><?php echo $slider['title'];?></p>
											<h3><?php echo $slider['subtitle'];?></h3>
										</div>
									</li>
			            <?php 
			          endforeach; 
			        ?>
						</ul>
					</div>
					<div class="banner_hotel_booking" style="background-color: <?php echo COLOR_MENU?>">
						<?php 
						include_once 'res/php/hotel_actions/form_booking.php'
						 ?>
					</div>	
				<!--
				<script defer src="<?php BASE_WEB?>res/js/jquery.flexslider.js"></script>
				<script type="text/javascript">
					$(window).load(function(){
					  $('.flexslider').flexslider({
						animation: "slide",
						start: function(slider){
						  $('body').removeClass('loading');
						}
					  });
					});
				</script>
			-->
			</div>			
		</div>
	</div>
	<!-- banner -->
	<!--<div class="banner jarallax sectionHome">
	</div> -->
	<!-- //banner -->	
	<!-- special -->
	<div class="special jarallax">
		<div class="container">
			<h3 class="w3ls_head">
				<?=TITLES_ROOMS?> 
				<span class="thr"></span>
			</h3>
			<p class="w3agile">
				<?=SUBTITLE_ROOMS?> 
			</p>
			<div class="special-grids rooms" style="display: flex;flex-wrap: wrap;justify-content: center;">
	      <?php
					$regis = count($rooms);
	        foreach($rooms as $room): ?>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 w3l-special-grid contenedor">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;margin:0">
								<div class="carta">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 w3ls-special-img lado frente" style="background-color: <?=COLOR_CARD?>">
										<img class="img-thumbnail" style="width: 100%" src="<?php echo BASE_IMAGES ?>rooms/md-<?=$room['image']?>" alt="">
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 w3ls-special-img lado atras" style="background-color: <?=COLOR_CARD?>;color:<?php echo FONT_CARD?>">
										<div class="row">
		                  <h2  style="color:<?php echo FONT_CARD?>" for=""><?=$room['room_name']?></h2>
		                  <h3  style="color:<?php echo FONT_CARD?>" for=""><?=$room['sub_text']?></h3>
		                  <h2 style="color:<?php echo FONT_CARD?>" >Precio desde <?=number_format($room['price'],0).'</br>';
		                  	if($hotelabout[0]['currency']==1){ ?>
					          			<small style="color:<?php echo FONT_CARD?>;">Impuestos Incluidos</small>
					          			<?php 
					          		}else{
					          			?>
					          			<small style="color:<?php echo FONT_CARD?>;">Impuestos no Incluidos</small>
					          			<?php 
					          		}
		                  ?> </h2>
		                  <h3  style="color:<?php echo FONT_CARD?>" for="">Camas <?php echo $room['beds']?>
		                  	<small style="color:<?php echo FONT_CARD?>">
				                  <?php 
				                    for ($i = 1; $i <= $room['beds']; $i++) {
				                      ?>
				                      <i class="fa fa-hotel" aria-hidden="true"></i>
				                      <?php 
				                    }
				                  ?>
		                  	</small>
		                  </h3>
		                  <h3  style="color:<?php echo FONT_CARD?>" for="" title='Capacidad Maxima <?php echo $room['pax_max'] ?> Personas'>Capacidad 
			                  <small style="color:<?php echo FONT_CARD?>">
				                  <?php 
				                    for ($i = 1; $i <= $room['pax_max']; $i++) { ?>
				                      <i class="fa fa-male" aria-hidden="true"></i>
				                      <?php 
				                    }
				                  ?>
			                  </small>
		                  </h3>
			              </div>
			              <div class="row-fluid row-facility">
			                <?php 
			                  $facilidades = $user->getFacilityRoom($room['id_room']);
			                  foreach($facilidades as $facilidad): ?>
			                    <div class="col-lg-1 col-md-1 col-xs-2" style="padding:1px;margin:1px">
			                      <img class="img-thumbnail" src="<?php echo BASE_IMAGES ?>facility/<?=$facilidad['image']?>" alt="<?=$facilidad['description']?>" title="<?=$facilidad['description']?>">  
			                    </div>
			                  <?php endforeach; 
			                ?>
			              </div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 0;margin:0">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 agileits-special-info lado frente" style="background-color: <?=COLOR_CARD?>"> 
									<a href="<?php echo BASE_WEB ?>room/<?=$room['url']?>">
										<h4 style="color:<?php echo FONT_CARD ?>"><?=$room['room_name']?></h4>
										<p style="color:<?php echo FONT_CARD ?>"><?=$room['sub_text']?></p>
									</a>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>

						<?php 
					endforeach; 
				?>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //special -->
	<!-- testimonials -->
	<!--<div class="testimonials jarallax">
		<div class="container">
			<h3 class="w3ls_head">
				<?=TITLES_CLIENTS_OPINION?>
				<span class="thr"></span>
			</h3>
			<p class="w3agile">
				<?=SUBTITLES_CLIENTS_OPINION?>
			</p>
				
			<div class="w3ls_testimonials_grids">
				<section class="center slider"> -->
					<!--<div class="col-md-6 col-sm-12 col-xs-12">
						<div id="TA_selfserveprop883" class="TA_selfserveprop">
							<ul id="d97wDHYR" class="TA_links RBdPpk">
								<li id="UbdMfS4tDPl" class="RTPp0NMf1">
									<a target="_blank" href="https://www.tripadvisor.co/">
										<img src="https://www.tripadvisor.co/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/>
									</a>
								</li>
							</ul>
						</div>
						<script async src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=883&amp;locationId=7384763&amp;lang=es_CO&amp;rating=true&amp;nreviews=4&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=true&amp;border=true&amp;display_version=2"></script>

					</div>
					<div class="col-md-6 col-sm-12 col-xs-12 ">
						<div id="TA_cdswritereviewlg847" class="TA_cdswritereviewlg">
							<ul id="R93oZbmX" class="TA_links GqH2Fddr5B">
								<li id="vzGlS8" class="XWPgvVhVMuz">
									<a target="_blank" href="https://www.tripadvisor.co/">
										<img src="https://www.tripadvisor.co/img/cdsi/img2/branding/medium-logo-12097-2.png" alt="TripAdvisor"/>
									</a>
								</li>
							</ul>
						</div> -->
						<!--<script async src="https://www.jscache.com/wejs?wtype=cdswritereviewlg&amp;uniq=847&amp;locationId=7384763&amp;lang=es_CO&amp;lang=es_CO&amp;display_version=2"></script> -->
					<!-- </div> -->
				<!--</section>
			</div>
		</div>
	</div>
-->
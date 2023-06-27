<header class="main-header">
  <div id="top-header" style="z-index:20;position: relative">
    <div class="row">
      <div class="col-xs-6">
        <div class="th-text pull-left">
          <div class="th-item" > <a href="mailto:<?php echo MAIL_CONTACT?>"><i class="fa fa-envelope"></i> <?php echo MAIL_CONTACT?> </a></div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="th-text pull-right">
          <label style='text-align: right;'>RNT <?php echo $hotelabout[0]['rnt'] ?></label>             
        </div>
      </div>
    </div>
  </div>

  <a href="<?=BASE_WEB?>index.php" class="logo" style="color:<?php echo FONT_MENU?>">
    <img src="<?=BASE_IMG.LOGO_HOTEL?>" style="margin-left:10px;width: 35px">
    <span style="font-size:14px;font-weight: 600"><?=NAME_HOTEL?></span>
  </a>
  <button type="button" class="navbar-toggle collapsed logo-peq" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
    <span class="sr-only">Toggle navigation</span>
    <img src="<?php echo BASE_IMG.LOGO_HOTEL?>" alt="">
  </button> 
  <nav class="navbar">
    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
      <nav class="link-effect-8" id="link-effect-8">
        <ul class="nav navbar-nav">
          <?php 
            $menus = $user->menuPrincipal();
            foreach($menus as $menu): 
              $submenus = $user->subMenuPrincipal($menu['id_menu']);
              $product = $menu['products'];
              $regis = count($submenus);
              if($regis==0){?>             
                <li><a style="color:<?php echo FONT_MENU?>" href="<?php echo BASE_WEB?><?php echo $menu['link'] ?>"><?php echo $menu['description'] ?> <i class="<?php echo $menu['icon']?>"></i> </a></li>             
                <?php 
              }else{
                ?>
                <li class="dropdown">
                  <a style="color:<?php echo FONT_MENU?>" href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $menu['description']?> <b style="color:<?php echo FONT_MENU?>" class="caret"></b>
                  </a>
                  <ul class="dropdown-menu agile_short_dropdown">
                    <?php foreach($submenus as $submenu):  ?>
                      <li>
                        <?php 
                        if($submenu['new_window']==1){
                         ?>
                        <a style="color:<?php echo FONT_MENU?>" href="<?php echo $submenu['link'] ?>" target ='_blank' style="text-align:left;padding: 10px 20px;"><?php echo $submenu['description'] ?></a>
                         <?php    
                        }else{ ?>
                          <a href="<?php echo BASE_WEB?><?php echo $submenu['link'] ?>" style="text-align:left;padding: 10px 20px;color:<?php echo FONT_MENU?>"><?php echo $submenu['description'] ?></a>
                          <?php 
                      }
                      ?>
                      </li>
                    <?php endforeach;   ?>
                  </ul>
                </li>

              <?php 
            }
            endforeach;  
          ?> 
          <li>
            <a href="#" data-toggle="modal" data-target="#myModalLogin" style="font-family: 'Source Sans Pro';color:<?php echo FONT_MENU?>"> Intranet <i class="fa fa-sign-in" aria-hidden="true"></i> </a>
          </li>
        </ul>
      </nav>
    </div>
  </nav>
  <nav class="navbar" style="background: transparent;">
    <div class="row">
      <div class="agile_banner_social">
        <ul class="agileits_social_list socialMenu">
          <?php 
            $socials = $user->socialMenu();
            foreach($socials as $social): ?>
              <li><a style="color:<?php echo FONT_MENU?>;border:1px solid <?php echo FONT_MENU?>; " href="<?php echo $social['web']?>" class="<?php echo $social['clase']?>" target="_blank"><i class="<?php echo $social['icon'] ?>"></i></a>
              </li>
              <?php 
            endforeach;  
          ?>
          <li class='btnPhone'>
            <a class="textoResponsive" data-desktoptext="<?php echo PHONE_HOTEL ?> " data-tablettext="" data-phonetext='' href='tel:+<?php echo PHONE_HOTEL?>'><i class="fa fa-phone "></i> 
            </a>
          </li> 
        </ul>
      </div>
    </div>
  </nav>
</header>










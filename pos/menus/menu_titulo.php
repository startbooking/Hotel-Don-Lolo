
<header class="main-header">

  <a href="<?=$_SESSION['BASE_URL']?>index.php" class="logo" style="height: 51px">
    <img class="img_thumbnail" src="<?=BASE_WEB?>img/logoBarahona.png" style="margin-top:-3px;">
    <span style="font-size:16px;font-weight: 600">Menu Principal</span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav navbar-right" style="background-color: #00a65a">
        <?php 
        if(isset($_SESSION['NOMBRE_AMBIENTE'])){
          ?>
          <li>
            <?php 
              if(isset($_SESSION['NOMBRE_AMBIENTE'])){
                ?>
                <li><a href="../index.php"><?php echo $_SESSION['NOMBRE_AMBIENTE']?></a></li>
                <?php
              }
            ?>
          </li> 
          <?php
        }
         ?>
        <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="hidden-xs"><?php echo $_SESSION["apellidos"]." ".$_SESSION["nombres"] ?></span>
          </a>
        </li>
        <li>
          <a href="<?=$_SESSION['BASE_URL']?>modulos/modulos.php">Regresar <i class="glyphicon glyphicon-log-out"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>
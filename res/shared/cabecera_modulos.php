<header>
  <div>
  <a href="index.php" img="../img/sactel.png">
    Barahona Software SAS
  </a>
  </div>
  <div>
    <nav>
      <div>
        <ul>
          <li><a href="../bases/salir.php">Regresar</a></li>
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?php echo $_SESSION["apellidos"]." ".$_SESSION["nombres"] ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="../modulos/modulos.php" class="btn btn-default btn-flat">Regresar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</header>

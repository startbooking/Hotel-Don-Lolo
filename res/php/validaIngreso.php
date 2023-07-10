<?php
  date_default_timezone_set("America/Bogota");
  if(!isset($_SESSION["entro"]) || $_SESSION["entro"]==null ){ ?>
		<meta charset="utf-8" />
		<meta http-equiv="refresh" content="0;URL=../index.php" />
		<?php 
		return 0;
  }
	if($_SESSION["entro"] != "SI") {
    ?>
		<meta charset="utf-8" />
		<meta http-equiv="refresh" content="0;URL=../index.php" />
		<?php 
		return 0;
	}

	if ($_SESSION['activo'] == "N") {
    ?>
		<meta charset="utf-8" />
		<meta http-equiv="refresh" content="0;URL=../index.php" />
		<?php 
		return 0;
	}
?>

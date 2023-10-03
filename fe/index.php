<?php
include_once '../res/php/app_topFE.php';
include_once 'layout/top.php';
?>
<section class="content">
<?php
if (!isset($_GET['section'])) {
  require 'views/home.php';
}elseif (isset($_GET['section']) && $_GET['section'] == 'index') {
  require 'views/home.php';
}elseif (isset($_GET['section']) && $_GET['section'] == 'proveedores') {
  require 'views/proveedores.php';
}elseif (isset($_GET['section']) && $_GET['section'] == 'productos') {
  require 'views/codigosVentas.php';
}elseif (isset($_GET['section']) && $_GET['section'] == 'docSopoŕte') {
  require 'views/docSopoŕte.php';
}
?>

</section>

<?php include ('layout/bottom.php'); ?> 
<script src="<?php echo BASE_FE;?>res/js/fe.js"></script>



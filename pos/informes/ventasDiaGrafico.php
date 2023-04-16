    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        function drawChart() {
            // call ajax function to get sports data
            var jsonData = $.ajax({
                url: "../res/php/user_actions/dataProductos.php",
                dataType: "json",
                async: false
            }).responseText;
            //The DataTable object is used to hold the data passed into a visualization.
            alert(jsonData);
            var data = new google.visualization.DataTable(jsonData);
            /// console.log(data)

            // To render the pie chart.
            var chart = new google.visualization.PieChart(document.getElementById('chart_container'));
            chart.draw(data, {width: 800, height: 650});
        }
        // load the visualization api
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);
    </script>



<?php 
  require '../../res/php/app_topPos.php'; 

  $idamb  = $_POST['id'];
  $nomamb = $_POST['amb'];
  $user   = $_POST['user'];
  $iduser = $_POST['iduser'];
  $impto  = $_POST['impto'];
  $prop   = $_POST['prop'];
  $file   = $_POST['file'];
  $logo   = $_POST['logo'];
  $fecha  = $_POST['fecha'];
  
  $_SESSION['NOMBRE_AMBIENTE'] = $nomamb;
  $_SESSION['AMBIENTE_ID']     = $idamb;
  $_SESSION['usuario']         = $user;
  $_SESSION['usuario_id']      = $iduser;

  $cantidad = $pos->getCantidadProductosVendidos($idamb);


?>

<section class="content">
  <div class="panel panel-success">
    <div class="panel-heading"> 
      <div class="row">
        <div class="col-lg-9">
          <input type="hidden" name="user" id="user" value="<?=$user?>">
          <input type="hidden" name="rutaweb" id="rutaweb" value="<?=BASE_POS?>">
          <input type="hidden" name="ubicacion" id="ubicacion" value="balanceDiario.php">
          <h3 class="w3ls_head tituloPagina"><i style="color:black;font-size:36px;" class="fa fa-industry"></i> Ventas Del Dia <?=$fecha?></h3>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <!--
      <div class="imprimeInforme">
        <object id="verInforme" width="100%" height="500" data=""></object> 
      </div>
      -->
      <?php 
        /// include '../imprimir/imprimeVentasDia.php';
      ?>
    </div>
  </div> 
</section>

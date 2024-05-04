<?php
  
  session_start();
  include_once("../../Conn/Conn.php");
  $codigo = $_POST['codigo'];

  $query = "SELECT * FROM ciudades WHERE pais = '$codigo' ORDER BY municipio";
  $result = mysqli_query($conn,$query);
  if(mysqli_num_rows($result)==0){
  }else{ 
  ?>
    <option value="">Seleccione La Ciudad</option>
  <?php 
  while($row = mysqli_fetch_assoc($result)){
    ?>
      <option value="<?=$row['codigo'];?>"><?= $row['municipio'].'-'.$row['depto'];?> </option>
    <?php 
    }
  }
?>
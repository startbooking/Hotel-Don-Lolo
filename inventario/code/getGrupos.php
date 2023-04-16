<?php
  
  session_start();
  include_once("../../Conn/Conn.php");
  $codigo = $_POST['codigo'];

  $query = "SELECT * FROM grupos_inve WHERE cod_falm = '$codigo' ORDER BY des_grup";
  $result = mysqli_query($conn,$query);
  if(mysqli_num_rows($result)==0){
  }else{ 
  ?>
    <option value="">Seleccione el grupo de Inventarios</option>
  <?php 
  while($row = mysqli_fetch_assoc($result)){
    ?>
      <option value="<?=$row['cod_grup'];?>"><?= $row['des_grup'];?> </option>
    <?php 
    }
  }
?>
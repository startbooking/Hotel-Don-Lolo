<?php
  
  session_start();
  include_once("../../Conn/Conn.php");
  $codigo = $_POST['codigo'];

  $query = "SELECT * FROM subgrupos_inve WHERE cod_grup = '$codigo' ORDER BY des_subg";
  $result = mysqli_query($conn,$query);
  if(mysqli_num_rows($result)==0){
  }else{ 
  ?>
    <option value="">Seleccione el SubGrupo de Inventarios</option>
  <?php 
  while($row = mysqli_fetch_assoc($result)){
    ?>
      <option value="<?=$row['cod_subg'];?>"><?= $row['des_subg'];?> </option>
    <?php 
    }
  }
?>
<?php 
	include_once('../../Conn/Conn.php');

	$tipo = $_POST['tipo'];

	$nums    = array();
	if($tipo=='1'){
		$sqlnum = "SELECT c_entradas, prefijo_ent FROM parametros_inv WHERE id=1 ";
	}else{
		$sqlnum = "SELECT c_salidas, prefijo_sal FROM parametros_inv WHERE id=1 ";
	}

	$resnum = mysqli_query($conn,$sqlnum); 
	if($rownum=mysqli_num_rows($resnum)>0){
		while($resp= mysqli_fetch_assoc($resnum)){
			$nums=$resp;
		}
		echo json_encode($nums);
	}else{
		echo "0";
	}



 ?>

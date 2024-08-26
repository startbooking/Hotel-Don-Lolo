<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

	$empresa  = strtoupper($_POST['nameOwerUpd']);
	$nit      = $_POST['nitUpd'];
	$dv       = $_POST['dvNitUpd'];
	$direcc   = strtoupper($_POST['adressUpd']);
	$ciudad   = $_POST['cityUpd'];
	$web      = $_POST['webPageUpd'];
	$email    = $_POST['emailUpd'];
	$tele     = $_POST['phoneUpd'];
	$celu     = $_POST['movilUpd'];
	$rnt      = $_POST['RNTUpd'];
	$impto    = $_POST['imptoOption'];
	/* // $cms      = $_POST['cmsOption'];
	// $access   = $_POST['accessOption'];
	$cms      = 0;
	$access   = 0; */
	$ciiu     = $_POST['ciiu'];
	$tipoEmp  = $_POST['tipo_emp'];
	$logoAnt  = $_POST['imgLogo'];	
	$name     = $_FILES['logoUpd']['name']; 
	$name_img = $_FILES['logoUpd']; 

	if($name==''){
		$logo = $logoAnt;
	}else{
		$logo = $name;
	  $directorio = '../../../img/';
		$file_name = $_FILES['logoUpd']['name'];
		$source    = $_FILES["logoUpd"]["tmp_name"];      
    $target_path = $directorio.$file_name;

    $aFile = crearThumbJPEG($source,$target_path,90,90,90); 	

  }

	$upd = $admin->updateCia($empresa, $nit, $dv, $direcc, $ciudad, $web, $email, $tele, $celu, $rnt, $impto, $logo, $ciiu, $tipoEmp);

	echo json_encode($upd);


 ?>

<?php
	$targetPath = '../../uploads/'.$_FILES['file']['name']; // Target path where file is to be stored

	foreach($_FILES["file"]['tmp_name'] as $key => $tmp_name){
		//Validamos que el archivo exista
		if($_FILES["file"]["name"][$key]) {
			//Obtenemos el nombre original del archivo
			$filename   =  '../../uploads/'.$_FILES["file"]["name"][$key]; 
			//Obtenemos un nombre temporal del archivo
			$source     = $_FILES["file"]["tmp_name"][$key]; 
			//Declaramos un  variable con la ruta donde guardaremos los archivos
			$rtOriginal =$_FILES['file']['tmp_name'][$key];			
			// $directorio = 'image'.$max_ancho.'x'.$max_alto; 
			$typefile   = $_FILES['file']['type'][$key];
			
			$up = move_uploaded_file($rtOriginal,$filename) ; // Moving Uploaded file

			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			/*		
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
			$dir         = opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
				
			list($ancho,$alto)=getimagesize($source);

			$x_ratio = $max_ancho / $ancho;
			$y_ratio = $max_alto / $alto;

			if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
			    $ancho_final = $ancho;
			    $alto_final = $alto;
			}else if(($x_ratio * $alto) < $max_alto){
			  $alto_final = ceil($x_ratio * $alto);
			  $ancho_final = $max_ancho;
			}else {
			  $ancho_final = ceil($y_ratio * $ancho);
			  $alto_final = $max_alto;
			}

			/* if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
			    $ancho_final = $ancho;
			    $alto_final = $alto;
			}
			else if(($x_ratio * $alto) < $max_alto){
			    $alto_final = ceil($x_ratio * $alto);
			    $ancho_final = $max_ancho;
			}
			else {
			    $ancho_final = ceil($x_ratio * $ancho);
			    $alto_final = ceil($y_ratio * $alto);
			}
			*/


			//Copiar original en lienzo
			// imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
			 
			//Destruir la original

			//Crear la imagen y guardar en directorio upload/
			/*
			switch ($typefile) {
				case 'image/jpeg':
					$lienzo   = imagecreatetruecolor($ancho_final,$alto_final); 
					$original = imagecreatefromjpeg($source);
					imagejpeg($lienzo,$directorio."/".strtolower($_FILES['archivo']['name'][$key]),90);
					// echo 'ok jpeg';
					break;
				case 'image/png':
					$lienzo   = imagecolortransparent($ancho_final,$alto_final); 
					$original = imagecreatefrompng($source);
					imagepng($lienzo,$directorio."/".strtolower($_FILES['archivo']['name'][$key]),9);
					break;
				case 'image/gif':
					imagegif($lienzo,$directorio."/".strtolower($_FILES['archivo']['name'][$key]));
					break;
				case 'image/bmp':
					imagebmp($lienzo,$directorio."/".strtolower($_FILES['archivo']['name'][$key]));
					break;
				default:
					echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
					break;
			}
			imagedestroy($original);

			closedir($dir);
			*/
			//Cerramos el directorio de destino
		}
	}


	echo $up;

?>
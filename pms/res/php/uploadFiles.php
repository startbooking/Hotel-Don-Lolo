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

		}
	}


	echo $up;

?>
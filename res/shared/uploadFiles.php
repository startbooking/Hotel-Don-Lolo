<?php
	/// echo __DIR__;
	
	// $sourcePath = ; // Storing source path of the file in a variable

	// $targetPath = "pms/upload/".$_FILES['file']['name']; // Target path where file is to be stored
	$targetPath = '../../pms/uploads/'.$_FILES['file']['name']; // Target path where file is to be stored

	$up = move_uploaded_file($_FILES['file']['tmp_name'],$targetPath) ; // Moving Uploaded file

	echo $up;

	/*
	$validextensions = array("jpeg", "jpg", "png", "gif");
	$temporary       = explode(".", $_files["file"]["name"]);
	$file_extension  = end($temporary);
	if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg" || ($_FILES["file"]["type"] == "image/gif")
	) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
	&& in_array($file_extension, $validextensions)) {
		if ($_FILES["file"]["error"] > 0) {
			echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
		}else{
			if (file_exists("upload/" . $_FILES["file"]["name"])) {
				echo $_FILES["file"]["name"] . " <span id='invalid'><b>Archivo ya existe.</b></span> ";
			}else{
				echo "<span id='success'>Imagen subida satisfactoriamente...!!</span><br/>";
				echo "<br/><b>Arhivo:</b> " . $_FILES["file"]["name"] . "<br>";
				echo "<b>Tipo:</b> " . $_FILES["file"]["type"] . "<br>";
				echo "<b>Tamaño:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				echo "<b>Archivo temporal:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
			}
		}
	}else{
		echo "<span id='invalid'>***Invalid file Size or Type***<span>";
	}
}
	*/
?>
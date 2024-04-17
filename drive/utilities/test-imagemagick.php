<?php

$file = $_GET['file'];

	if (file_exists($file)) {

	try {
	    $img = new Imagick($file.'[0]');
	}
	catch(ImagickException $e) {
		echo "<pre>";
	    echo 'Caught exception: ',  $e->getMessage(), "\n";
	    unset($e);
	    echo "</pre>";
	    // $image = imagecreatefromjpeg('vfm-admin/images/placeholder-pdf.jpg');
	    // return $image;
	}

	if ($img) {
		$img->setImageFormat('png');

		try {
		    $str = $img->getImageBlob();
		    $image = imagecreatefromstring($str);
		}
		catch(ImagickException $e) {
			echo "<pre>";
		    echo 'Caught exception: ',  $e->getMessage(), "\n";
		    echo "</pre>";
		    // unset($e);
		    // $image = imagecreatefromjpeg('vfm-admin/images/placeholder-pdf.jpg');
		}
	}
} else {
	echo "file not found";
}
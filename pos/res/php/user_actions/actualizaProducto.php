<?php
require_once '../../../../res/php/app_topPos.php';
$recomienda = 0;
$receta = 0;
$tipo = 0;
$fileName = '';

extract($_POST);

$uploadBaseDir = '../../../../public/pos/productos/'; // Ruta que se guardará en la base de datos

if (!isset($recomendado)) {
	$recomienda = 0;
	$recomendado = 'off';
}

if ($recomendado == 'on') {
	$recomienda = 1;
};

if ($tipo !== 0) {
	$receta   = $idrecetaUpd;
}

if (isset($_FILES['imgSelect']) && $_FILES['imgSelect']['error'] === UPLOAD_ERR_OK) {
	try {
		$fileTmpPath = $_FILES['imgSelect']['tmp_name'];
		$fileName = $_FILES['imgSelect']['name'];

		$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

		$allowedFileTypes = ['jpg', 'jpeg', 'png', 'webp'];
		if (!in_array($fileExtension, $allowedFileTypes)) {
			throw new Exception("Tipo de archivo no permitido. Solo se aceptan imágenes.");
		}
		$destPath = $uploadBaseDir . $fileName;
		if (move_uploaded_file($fileTmpPath, $destPath)) {
			$imagePath = $uploadBaseDir . $fileName;
		} else {
			throw new Exception("Error al mover el archivo a la carpeta de destino.");
		}
	} catch (Exception $e) {
		error_log("Error de subida de imagen para producto: " . $e->getMessage());
	}
}

$upda = $pos->actualizaProducto($idProd, strtoupper($producto), strtoupper($codigo), $seccion, $venta, $impto, $tipo, $receta, $unidadMedUpd, $descripcion, $recomienda, $fileName);

echo $upda;

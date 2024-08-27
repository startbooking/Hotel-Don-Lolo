<?php

$imagenCodificada = file_get_contents("php://input"); 
//Obtener la imagen
// echo $imagenCodificada;
if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
	//La imagen traerá al inicio data:image/png;base64, cosa que debemos remover
	$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
	/// echo $imagenCodificadaLimpia;
	//Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
	//todo el contenido lo guardamos en un archivo
	$imagenDecodificada = base64_decode($imagenCodificadaLimpia);
	//Calcular un nombre único
	$nombreImagenGuardada = "foto_" . uniqid() . ".png";
	// echo $nombreImagenGuardada;
	//Escribir el archivo
	file_put_contents($nombreImagenGuardada, $imagenDecodificada);

	//Terminar y regresar el nombre de la foto
	exit($nombreImagenGuardada);
?>
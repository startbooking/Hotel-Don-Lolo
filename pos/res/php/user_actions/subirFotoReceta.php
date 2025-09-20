<?php

// Requerir el archivo de configuración y la clase de conexión a la base de datos
require '../../../../res/php/app_topPos.php';

// Definir el directorio de destino para las imágenes
$directorio = '../../../images/';

// Función para obtener la extensión del archivo
function getFileExtension($filename) {
    return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

// Función para obtener un nombre de archivo único
function generateUniqueFileName($directory, $extension) {
    do {
        $fileName = md5(uniqid(rand(), true)) . '.' . $extension;
    } while (file_exists($directory . $fileName));
    return $fileName;
}

// Función para redimensionar la imagen y guardar con el formato correcto
function processImage($source, $target, $maxWidth, $maxHeight, $quality, $imageType) {
    // Cargar la imagen según su tipo
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $img = imagecreatefromjpeg($source);
            break;
        case IMAGETYPE_PNG:
            $img = imagecreatefrompng($source);
            break;
        case IMAGETYPE_GIF:
            $img = imagecreatefromgif($source);
            break;
        case IMAGETYPE_WEBP:
            $img = imagecreatefromwebp($source);
            break;
        default:
            return false;
    }

    if (!$img) {
        return false;
    }

    $originalWidth = imagesx($img);
    $originalHeight = imagesy($img);

    // Calcular las nuevas dimensiones manteniendo el ratio
    $ratio = $originalWidth / $originalHeight;
    $newWidth = $maxWidth;
    $newHeight = $maxHeight;

    if ($maxWidth / $maxHeight > $ratio) {
        // Redondea el resultado a un número entero para evitar el error de precisión
        $newWidth = intval($maxHeight * $ratio);
    } else {
        // Redondea el resultado a un número entero para evitar el error de precisión
        $newHeight = intval($maxWidth / $ratio);
    }

    // Crear la nueva imagen redimensionada
    $newImg = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

    // Guardar la imagen redimensionada
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            imagejpeg($newImg, $target, $quality);
            break;
        case IMAGETYPE_PNG:
            imagepng($newImg, $target, 9); // Calidad de PNG va de 0 a 9
            break;
        case IMAGETYPE_GIF:
            imagegif($newImg, $target);
            break;
        case IMAGETYPE_WEBP:
            imagewebp($newImg, $target, $quality);
            break;
    }

    imagedestroy($img);
    imagedestroy($newImg);

    return true;
}

// Asegurarse de que el directorio de imágenes existe
if (!is_dir($directorio)) {
    mkdir($directorio, 0755, true);
}

// Obtener el ID de la receta del POST
$idrec = isset($_POST['idRecetaFoto']) ? $_POST['idRecetaFoto'] : null;

// Validar que se recibió un ID de receta
if (!$idrec) {
    echo "Error: ID de receta no proporcionado.";
    exit;
}

// Recorrer los archivos subidos
if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
    foreach ($_FILES['images']['name'] as $name => $value) {
        $file_name = $_FILES['images']['name'][$name];
        $source = $_FILES['images']['tmp_name'][$name];
        $file_error = $_FILES['images']['error'][$name];
        
        // Verificar si hay errores en la subida del archivo
        if ($file_error !== UPLOAD_ERR_OK) {
            echo "Error al subir el archivo: " . $file_name . " (código: " . $file_error . ")";
            continue;
        }

        // Obtener la extensión y el tipo MIME de la imagen
        $extension = getFileExtension($file_name);
        $imageType = exif_imagetype($source);

        // Validar que el formato de imagen es soportado
        $supportedFormats = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP];
        if (!in_array($imageType, $supportedFormats)) {
            echo "Error: El formato de imagen de " . $file_name . " no es soportado.";
            continue;
        }

        // Generar un nombre de archivo único
        $uniqueFileName = generateUniqueFileName($directorio, $extension);
        $target_path = $directorio . $uniqueFileName;
        
        // Procesar la imagen (redimensionar y guardar)
        if (processImage($source, $target_path, 600, 400, 90, $imageType)) {
            // Si el procesamiento es exitoso, actualizar el registro en la base de datos
            $img = $pos->updateFotoReceta($uniqueFileName, $idrec);
            if ($img) {
                echo "Imagen subida y actualizada con éxito para la receta ID: " . $idrec;
            } else {
                echo "Error: Imagen subida, pero no se pudo actualizar el registro en la base de datos.";
            }
        } else {
            echo "Error al procesar la imagen: " . $file_name;
        }
    }
} else {
    echo "No se ha subido ningún archivo.";
}

?>

<?php
$uploadDirectory = 'mis_fotos/'; // Ruta de la carpeta de destino

if (isset($_FILES['capturedImage']) && !empty($_FILES['capturedImage']['tmp_name'])) {
    $uploadedFile = $_FILES['capturedImage']['tmp_name'];

    // Generar un nombre aleatorio para la imagen
    $extension = pathinfo($_FILES['capturedImage']['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid() . '.' . $extension;
    $destination = $uploadDirectory . $newFileName;

    if (move_uploaded_file($uploadedFile, $destination)) {
        echo 'Imagen subida exitosamente a: ' . $destination;
    } else {
        echo 'Error al subir la imagen.';
    }
} else {
    echo 'No se recibió ninguna imagen.';
}

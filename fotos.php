<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Imágenes con Miniaturas</title>
    <style>
        ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
        }

        li {
            margin: 10px;
            text-align: center;
        }

        img {
            max-width: 150px;
            max-height: 150px;
        }
    </style>
</head>

<body>
    <h1>Lista de Imágenes con Miniaturas</h1>
    <ul>
        <?php
        $imageDir = 'mis_fotos'; // Cambia esto al directorio de tus imágenes

        // Obtener nombres de archivo en el directorio
        $files = glob("$imageDir/*.{jpg,jpeg,png,gif}", GLOB_BRACE);

        foreach ($files as $file) {
            $fileName = basename($file);
            echo "<li><img src='$file' alt='$fileName'><br>$fileName</li>";
        }
        ?>
    </ul>
</body>

</html>
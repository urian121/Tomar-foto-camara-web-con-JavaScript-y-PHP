<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Imágenes con Miniaturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/home.css" />
</head>

<body>
    <div class="container">
        <div class="row justify-content-md-center">
            <h1 class="text-center">Lista de Imágenes con Miniaturas
                <hr>
            </h1>
            <?php
            $imageDir = 'mis_fotos'; // Cambia esto al directorio de tus imágenes
            $files = glob("$imageDir/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
            foreach ($files as $file) {
                $fileName = basename($file);
                echo '<div class="col-md-3 mb-3">';
                echo "<img src='$file' alt='$fileName'><br>$fileName";
                echo '</div>';
            }

            ?>

        </div>
    </div>

</body>

</html>
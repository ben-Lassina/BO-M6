<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kunstspeeltuin Foto's</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1 class="fotostitle">Kunstspeeltuin Foto's</h1>
    <h2 class="fotosdesc">Ga naar https://35667.hosts2.ma-cloud.nl/public/ om je fotos te bekijken</h2>
    <article class="fotosarticle">
        <section class="fotossection">
            <figure class="fotosfigure">
                <img src="img/test-img.webp" alt="" class="fotosimg">
            </figure>
            <figure class="fotosfigure">
                <img src="img/test-img.webp" alt="" class="fotosimg">
            </figure>
            <figure class="fotosfigure">
                <img src="img/test-img.webp" alt="" class="fotosimg">
            </figure>
        </section>
    </article>
</body>
</html>

<?php
// Open the serial port for communication with Arduino
$serial = fopen($serialPort, "r");

// Check if serial port opened successfully
if (!$serial) {
    die("Failed to open serial port");
}

// Read the incoming image data from the serial port
$imageData = fread($serial, 5000);

// Close the serial port
fclose($serial);

$file = fopen("image.jpg", "wb"); // Open the file for writing in binary mode
if ($file) {
    fwrite($file, $imageData); // Write the image data to the file
    fclose($file); // Close the file
    echo "Image received and saved successfully";
} else {
    echo "Failed to save image";
}
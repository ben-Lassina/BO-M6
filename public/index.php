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
            <figure class="fotosfigure">
                <img src="img/test-img.webp" alt="" class="fotosimg">
            </figure>
        </section>
    </article>
</body>
</html>

<?php
include_once "../source/config.php";
include_once "../source/database.php";

// Establish database connection using defined constants
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT image_url FROM images";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<img src='" . $row['image_url'] . "' alt=''>";
    }
} else {
    echo "No images found";
}

mysqli_close($conn);

// Define $serialPort before using it
$serialPort = "/dev/ttyS0"; // Example, replace with your actual serial port

$serial = fopen($serialPort, "r");

if (!$serial) {
    die("Failed to open serial port");
}

$imageData = fread($serial, 5000);

fclose($serial);

$file = fopen("image.jpg", "wb");
if ($file) {
    fwrite($file, $imageData);
    fclose($file);
    echo "Image received and saved successfully";
} else {
    echo "Failed to save image";
}
?>

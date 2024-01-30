<?php

include "../source/database.php";

// Check if image data is received
if (isset($_POST['image'])) {
    // Decode base64 image data
    $imageData = base64_decode($_POST['image']);
    
    // Generate a unique filename for the image
    $imageName = uniqid() . '.jpg';

    // Specify the directory where you want to save the images
    $imagePath = 'uploads/' . $imageName;

    // Save the image to the server
    file_put_contents($imagePath, $imageData);

    // Insert image path into database
    $conn = database_connect();
    $stmt = $conn->prepare("INSERT INTO images (path) VALUES (?)");
    $stmt->bind_param("s", $imagePath);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo "Image uploaded successfully!";
} else {
    echo "No image data received!";
}
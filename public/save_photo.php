<?php
include_once '../source/database.php';

header('Content-Type: application/json'); // Set content type header to JSON

$imageData = $_POST['imageData'];
$filename = 'photo_' . time() . '.png';
$timestamp = date('Y-m-d H:i:s');

if (file_put_contents($filename, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)))) {

    $filesize = filesize($filename);

    $sql = "INSERT INTO Foto (photoname, tijd, grootte) VALUES ('$filename', '$timestamp', $filesize)";
    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true, 'photoURL' => $filename);
    } else {
        $response = array('success' => false);
    }
} else {
    $response = array('success' => false);
}

echo json_encode($response); // Encode the response array as JSON and echo it

$conn->close();
?>

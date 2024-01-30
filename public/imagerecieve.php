<?php
include '../source/database.php';
include_once '../source/config.php';

if (!isset($_POST['imageData'])) {
    $response = ["succeeded" => false, "message" => "No image data received.", "downloadlink" => null];
    echo json_encode($response);
    exit;
}

$imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['imageData']));

$filename = '../uploads/photo.png';
if (!file_put_contents($filename, $imageData)) {
    $response = ["succeeded" => false, "message" => "Failed to save image.", "downloadlink" => null];
    echo json_encode($response);
    exit;
}

function insertImageInDb($conn, $FotoID, $photoname, $tijd, $grootte)
{
    $q = "INSERT INTO BOfoto (FotoID, photoname, tijd, grootte) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($q);

    if ($stmt) {
        $stmt->bind_param("isiss",
            $FotoID->FotoID,
            $photoname->photoname,
            $tijd->tijd,
            $grootte->grootte,
        );

        $result = $stmt->execute();
        
        if ($result) {
            $response = ["succeeded" => true, "message" => "Image inserted into database successfully.", "downloadlink" => null];
        } else {
            $response = ["succeeded" => false, "message" => "Failed to insert image into database.", "downloadlink" => null];
        }

        $stmt->close();
    } else {
        $response = ["succeeded" => false, "message" => "Error in the prepared statement for data insertion.", "downloadlink" => null];
    }

    return $response;
}

$FotoID = "example_ID";
$photoname = "example_photoname";
$tijd = "example_timestamp";
$grootte = "example_size";

$insertResult = insertImageInDb($conn, $FotoID, $photoname, $tijd, $grootte);

$conn->close();

header('Content-Type: application/json');
echo json_encode($insertResult); 
?>

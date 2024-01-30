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

function insertImageInDb($conn, $photoname, $tijd, $grootte)
{
    $q = "INSERT INTO BOfoto (photoname, tijd, grootte) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($q);

    if ($stmt) {
        $stmt->bind_param("sss", $photoname, $tijd, $grootte);
        $result = $stmt->execute();
        
        if ($result) {
            $FotoID = $stmt->insert_id;
            $response = ["succeeded" => true, "message" => "Image inserted into database successfully.", "downloadlink" => createLink($FotoID)];
        } else {
            $response = ["succeeded" => false, "message" => "Failed to insert image into database.", "downloadlink" => null];
        }

        $stmt->close();
    } else {
        $response = ["succeeded" => false, "message" => " ", "downloadlink" => null];
    }

    return $response;
}

function createLink($FotoID)
{
    $link = "http://" . $_SERVER['HTTP_HOST'] . "/imagedownload.php?link=$FotoID"; // Assuming HTTP, change to HTTPS if necessary
    return $link;
}

$photoname = "example_photoname";
$tijd = "example_timestamp";
$grootte = "example_size";

$insertResult = insertImageInDb($conn, $photoname, $tijd, $grootte);

$conn->close();

header('Content-Type: application/json');
echo json_encode($insertResult); 
?>

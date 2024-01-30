<?php
include '../source/database.php';

function handleFile($file, $link)
{
    $link = uniqid();
    $location = $file["tmp_name"];
    $ext = ".png";
    $filename = "../uploads/$link$ext";
    
    move_uploaded_file($location, $filename);

    return $filename;
}

$response = [
    "succeeded" => false,
    "message" => "",
    "downloadlink" => null
];
function insertImageInDb($conn, $id, $photoname, $size, $uploaddatetime)
{
    $q = "INSERT INTO Foto (FotoID, photoname, tijd, grootte) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($q);

    if ($stmt) {
        $stmt->bind_param("isds",
            $id,
            $photoname,
            $uploaddatetime,
            $size
        );

        $result = $stmt->execute();
        $response = ["succeeded" => $result];

        $stmt->close();
    } else {
        // Echoing error messages here will cause issues with JSON response
        // echo "Error in the prepared statement for data insertion.";
        // exit;
        return ["succeeded" => false];
    }

    return $response;
}

$conn->close();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
?>

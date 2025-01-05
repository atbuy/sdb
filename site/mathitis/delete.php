<?php
include "../connect.php";

// Only allow DELETE requests
if ($_SERVER["REQUEST_METHOD"] != "DELETE") {
    http_response_code(405);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

$row_id = $data["id"];

$query = $conn->prepare("DELETE FROM MATHITIS WHERE id = ?");
$query->bind_param("i", $row_id);

if ($query->execute()) {
    $query->close();
    header("Location: index.php");
    exit();
} else {
    $query->close();
    echo "Error deleting record: " . $conn->error;
}
?>
<?php
include "../connect.php";

$query = "SELECT * FROM MATHITIS";
$result = $conn->query($query);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

$mathitisData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mathitisData[] = $row;
    }
}
$conn->close();
?>
<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] != "GET") {
    http_response_code(405);
    exit();
}


$query = "SELECT id, full_name, age, class_year, school, absences, missed_year FROM MATHITIS ORDER BY id ASC;";
$result = mysqli_query($conn, $query) or die("Could not connect to database.");

$response = array();

while ($row = mysqli_fetch_array($result)) {
    $row_data = new stdClass();
    $row_data->id = $row["id"];
    $row_data->full_name = $row["full_name"];
    $row_data->age = $row["age"];
    $row_data->class_year = $row["class_year"];
    $row_data->school = $row["school"];
    $row_data->absences = $row["absences"];
    $row_data->missed_year = $row["missed_year"];

    array_push($response, $row_data);
}

$MATHITIS_DATA = json_encode($response);

$conn->close();
?>

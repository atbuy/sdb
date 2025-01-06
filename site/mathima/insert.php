<?php

  // Only allow POST requests
  if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    header("Content-Type: application/json");
    echo json_decode(array("message"=>"405 Method not allowed"));
    exit();
  }

  include "../connect.php";

  // Read JSON data from JS request
  $data = json_decode(file_get_contents("php://input"), true);

  // Unpack data from JSON body
  $name = $data["name"];
  $active_year = $data["active_year"];
  $school_category = $data["school_category"];

  // Insert row to MATHIMA table
  $query = $conn->prepare("INSERT INTO MATHIMA (name, active_year, school_category) VALUES (?, ?, ?)");
  $query->bind_param("sis", $name, $active_year, $school_category);

  if($query->execute()) {
    http_response_code(200);
    header("Content-Type: application/json");
    echo json_decode(array("message"=>"success"));
    $query->close();
    exit();
  }

  http_response_code(500);
  header("Content-Type: application/json");
  echo json_decode(array("message"=>"There was an error: " . $conn->error));
  $query->close();
?>





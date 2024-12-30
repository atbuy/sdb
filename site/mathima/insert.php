<?php

  // Only allow POST requests
  if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    exit();
  }

  include "connect.php";

  // Read JSON data from JS request
  $data = json_decode(file_get_contents("php://input"), true);

  // Unpack data from JSON body
  $row_name = $data["name"];
  $row_active_year = $data["active_year"];
  $row_school_category = $data["school_category"];

  // Insert row to MATHIMA table
  $query = $conn->prepare("INSERT INTO MATHIMA (name, active_year, school_category) VALUES (?, ?, ?)");
  $query->bind_param(
    "sis",
    $row_name,
    $row_active_year,
    $row_school_category,
  );
  $query->execute();
  $query->close();
?>





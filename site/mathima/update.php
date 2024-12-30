<?php

  // Only allow PATCH requests
  if ($_SERVER["REQUEST_METHOD"] != "PATCH") {
    http_response_code(405);
    exit();
  }

  include "../connect.php";

  // Read JSON data from JS request
  $data = json_decode(file_get_contents("php://input"), true);

  // Unpack data from JSON body
  $row_id = $data["id"];
  $row_name = $data["name"];
  $row_active_year = $data["active_year"];

  // Update the given MATHIMA row with the new values
  $query = $conn->prepare("UPDATE MATHIMA SET name=?, active_year=? WHERE id=?");
  $query->bind_param(
    "sii",
    $row_name,
    $row_active_year,
    $row_id
  );
  $query->execute();
  $query->close();
?>

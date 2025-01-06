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
  $id = $data["id"];
  $name = $data["name"];
  $active_year = $data["active_year"];

  // Update the given MATHIMA row with the new values
  $query = $conn->prepare("UPDATE MATHIMA SET name=?, active_year=? WHERE id=?");
  $query->bind_param("sii", $name, $active_year, $id);
  $query->execute();
  $query->close();
?>

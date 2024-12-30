<?php

  // Only allow DELETE requests
  if ($_SERVER["REQUEST_METHOD"] != "DELETE") {
    http_response_code(405);
    exit();
  }

  include "../connect.php";

  // Read JSON data from JS request
  $data = json_decode(file_get_contents("php://input"), true);

  $row_id = $data["id"];

  // Delete the row from the table
  $query = $conn->prepare("DELETE FROM MATHIMA WHERE id=?");
  $query->bind_param("i", $row_id);
  $query->execute();
  $query->close();
?>


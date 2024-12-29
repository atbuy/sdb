<?php

  if ($_SERVER["REQUEST_METHOD"] != "PATCH") {
    http_response_code(405);
    exit();
  }


  $data = json_decode(file_get_contents("php://input"), true);

  $row_id = $data["id"];
  $row_name = $data["name"];
  $row_active_year = $data["active_year"];


  include "../connect.php";

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

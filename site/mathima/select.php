<?php

  // Only allow GET requests
  if ($_SERVER["REQUEST_METHOD"] != "GET") {
    http_response_code(405);
    exit();
  }

  include '../connect.php';

  // Get all rows from the MATHIMA table
  $query = "SELECT id, name, active_year, school_category FROM MATHIMA ma ORDER BY ma.id ASC;";
  $result = mysqli_query($conn, $query) or die("Could not connect to database.");

  // Iterate over each row and push the data to a hashmap,
  // so that it can be returned to JS
  $response = array();
  while($row = mysqli_fetch_array($result)) {
    $row_data = new stdClass();
    $row_data->id = $row["id"];
    $row_data->name = $row["name"];
    $row_data->active_year = $row["active_year"];
    $row_data->school_category = $row["school_category"];

    array_push($response, $row_data);
  }

  $MATHIMA_DATA = json_encode($response);
?>

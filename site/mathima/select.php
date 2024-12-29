<?php

  include 'connect.php';

  $query = "SELECT id, name, active_year, school_category FROM MATHIMA;";
  $result = mysqli_query($conn, $query) or die("Could not connect to database.");

  $all_properties = array();
  while ($property = mysqli_fetch_field($result)) {
    array_push($all_properties, $property->name);
  }

  $item_styles = array();
  $item_styles["id"] = "text-rose-600 font-semibold";
  $item_styles["name"] = "text-green-400";
  $item_styles["active_year"] = "text-rose-600 font-semibold";
  $item_styles["school_category"] = "text-blue-400";


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

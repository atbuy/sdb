<?php
  include 'connect.php';
  include 'components/icons/edit.php';
  include 'components/icons/delete.php';

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


  while($row = mysqli_fetch_array($result)) {
    echo "<tr>";

    // Display all elements from the MATHIMA table
    foreach ($all_properties as $item) {
      echo '<td class="px-3 py-4 ' . $item_styles[$item] . '">' . $row[$item] . '</td>';
    }

    // Add action buttons
    echo '<td class="px-3 py-4 flex justify-around items-center">';

    // Action edit icon
    echo "<div>";
    echo '<button class="action-button update" onclick="editMathima(' . $row["id"] . ')">';
    echo $edit_icon;
    echo "</button>";
    echo "</div>";

    // Delete icon
    echo "<div>";
    echo '<button class="action-button delete" onclick="deleteMathima(' . $row["id"] . ')">';
    echo $delete_icon;
    echo '</button>';
    echo "</div>";
    echo "</td>";

    echo "</tr>";
  }

?>

<?php

include "../connect.php";
include "../components/icons/home.php";
include "../components/icons/edit_action.php";
include "../components/icons/cancel.php";
include "../components/icons/cancel_action.php";
include "../components/icons/save_action.php";
include "../components/icons/delete_action.php";

// Check if there's an error message passed in the query string
$errorMessage = isset($_GET['error']) ? $_GET['error'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Team 19 - DB</title>
  <link rel="icon" href="../static/images/rounded_icon.png" />
  <link rel="stylesheet" href="../static/css/main.css" />
  <link rel="stylesheet" href="../static/css/exetash.css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

  <header class="table-name">
    <h1 class="logo">EXETASH</h1>
  </header>

  <main class="main-content">
    <table class="data-table">
      <thead>
        <tr>
            <th class="px-3 py-4 text-white bg-black">ID</th>
            <th class="px-3 py-4 text-white bg-black">Student</th>
            <th class="px-3 py-4 text-white bg-black">Lesson</th>
            <th class="px-3 py-4 text-white bg-black">Grade</th>
            <th class="px-3 py-4 text-white bg-black">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "
          SELECT
            id,
            (SELECT mis.full_name FROM MATHITIS mis WHERE mis.id=ex.lesson) as student,
            (SELECT ma.name FROM MATHIMA ma WHERE ma.id=ex.lesson) lesson,
            grade 
          FROM EXETASH ex
          ORDER BY ex.id ASC;";

        $result = mysqli_query($conn, $query) or die("Could not connect to database.");

        while ($row = mysqli_fetch_array($result)) {
          $isEditing = isset($_GET['edit']) && $_GET['edit'] == $row['id'];
          echo "<tr>";
          echo "<td class='px-3 py-4'>{$row['id']}</td>";

          if ($isEditing) {
            echo "<td class='px-3 py-4'><input type='text' class='w-1/2 border-b-2 border-white bg-transparent' name='student' value='{$row['student']}' form='edit-form-{$row['id']}' /></td>";
            echo "<td class='px-3 py-4'><input type='text' class='w-1/2 border-b-2 border-white bg-transparent' name='lesson' value='{$row['lesson']}' form='edit-form-{$row['id']}' /></td>";
            echo "<td class='px-3 py-4'><input type='text' class='w-1/2 border-b-2 border-white bg-transparent' name='grade' value='{$row['grade']}' form='edit-form-{$row['id']}' /></td>";
          } else {
            echo "<td class='px-3 py-4'>{$row['student']}</td>";
            echo "<td class='px-3 py-4'>{$row['lesson']}</td>";
            echo "<td class='px-3 py-4'>{$row['grade']}</td>";
          }
          echo "<td class='action-buttons'>";

          if ($isEditing) {
            echo "<form method='POST' action='action.php' id='edit-form-{$row['id']}' style='display:inline-block;'>
                    <input type='hidden' name='save' value='1' />
                    <input type='hidden' name='id' value='{$row['id']}' />
                    <button type='submit' class='save-button hover:scale-125'>$SAVE_ACTION_ICON</button>
                  </form>";
            echo "<form method='GET' action='index.php' style='display:inline-block;'>
                    <button type='submit' class='cancel-button mr-2 hover:scale-125'>$CANCEL_ACTION_ICON</button>
                  </form>";
          } else {
            echo "<form method='GET' action='index.php' style='display:inline-block;'>
                    <input type='hidden' name='edit' value='{$row['id']}' />
                    <button type='submit' class='edit-button hover:scale-125'>$EDIT_ACTION_ICON</button>
                  </form>";
            echo "<form method='POST' action='action.php' style='display:inline-block;'>
                    <input type='hidden' name='delete' value='1' />
                    <input type='hidden' name='id' value='{$row['id']}' />
                    <button type='submit' class='delete-button mr-2 hover:scale-125'>$DELETE_ACTION_ICON</button>
                  </form>";
          }
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>

    <!-- Error message displayed below the table -->
    <?php if (!empty($errorMessage)): ?>
      <div style="margin-top: 20px; color: red; font-weight: bold;">
        Error: <?php echo htmlspecialchars($errorMessage); ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="action.php" class="text-black" style="margin-top: 5px;">
      <input type="text" name="student" placeholder="Student" required class='placeholder-gray-600' />
      <input type="text" name="lesson" placeholder="Lesson" required class='placeholder-gray-600'  />
      <input type="text" name="grade" placeholder="Grade" required class='placeholder-gray-600'  />
      <button type="submit" class="insert-button">Insert Row</button>
    </form>
  </main>

  <button class="bg-zinc-900 shadow-lg p-4 fixed left-4 bottom-4 rounded-full" onclick="goto('')">
    <span class="fill-white"><?php echo $HOME_ICON ?></span>
  </button>

  <script src="../static/js/main.js"></script>

</body>

</html>
<?php 
  include "./mathima/select.php";
  include "./components/icons/edit.php";
  include "./components/icons/delete.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="static/images/icon.png" />

    <link rel="stylesheet" href="static/css/main.css" />

    <!-- Add tailwind CDN for styles -->
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Team 19 - DB</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
  </head>

  <body>
    <div class="flex flex-col p-6 justify-center items-center">

      <!-- Table title -->
      <div class="rounded-t-lg flex justify-center items-center">
        <span class="text-2xl py-4 px-2 font-semibold">
          MATHIMA
        </span>
      </div>

      <!-- "MATHIMA" table -->
      <table class="bg-zinc-900 rounded-lg table-auto text-left">
        <thead>
          <tr class="bg-zinc-950">
            <th class="px-3 py-4 rounded-tl-lg">ID</th>
            <th class="px-3 py-4">Name</th>
            <th class="px-3 py-4">Active Year</th>
            <th class="px-3 py-4">School Category</th>
            <th class="px-3 py-4 rounded-tr-lg">Action</th>
          </tr>
        </thead>
        <tbody x-data='{ rows: <?php echo $MATHIMA_DATA ?> }'>
          <template x-for="row in rows" :key="row.id">
            <tr>
              <td class="px-3 py-4 text-rose-600 font-semibold" x-text="row.id"></td>
              <td class="px-3 py-4 text-green-400" x-text="row.name"></td>
              <td class="px-3 py-4 text-rose-600 font-semibold" x-text="row.active_year"></td>
              <td class="px-3 py-4 text-blue-400" x-text="row.school_category"></td>
              <td class="px-3 py-4 flex justify-around items-center">
                <div>
                  <button class="action-button update" onclick="editMathima(this)" :data-rowID="row.id">
                    <?php echo $EDIT_ICON ?>
                  </button>
                </div>
                <div>
                  <button class="action-button delete" onclick="deleteMathima(this)" :data-rowID="row.id">
                    <?php echo $DELETE_ICON ?>
                  </button>
                </div>
              </td>
            </tr>
          </template>
          
          <!-- Load all rows from the "Mathima" table -->
        </tbody>
      </table>
    </div>
    
    <script src="static/js/main.js"></script>

  </body>
</html>

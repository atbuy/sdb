<?php 
  include "./mathima/select.php";
  include "./components/icons/edit.php";
  include "./components/icons/delete.php";
  include "./components/icons/save.php";
  include "./components/icons/cancel.php";
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

    <!-- Add Toastify styles for toast type notifications -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

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
      <table class="bg-zinc-900 rounded-lg table-auto text-left shadow-lg">
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
            <tr :data-mathima-row="row.id" x-data="{ editing: false, toggleEdit() { this.editing = !this.editing } }">
              <td class="px-3 py-4 text-rose-600 font-semibold" x-text="row.id"></td>
              <td class="px-3 py-4 text-green-400">
                <input
                  class="border-b-2 border-white bg-transparent"
                  :value="row.name"
                  x-show="editing"
                  :data-mathima-input="row.id"
                  data-mathima-input-key="name"
                />
                <span x-show="!editing" x-text="row.name"></span>
              </td>
              <td class="px-3 py-4 text-rose-600 font-semibold">
                <input
                  class="border-b-2 border-white bg-transparent"
                  type="number"
                  :value="row.active_year"
                  x-show="editing"
                  min="0"
                  max="99"
                  :data-mathima-input="row.id"
                  data-mathima-input-key="active_year"
                />
                <span x-show="!editing" x-text="row.active_year"></span>
              </td>
              <td class="px-3 py-4 text-blue-400" x-text="row.school_category"></td>
              <td class="px-3 py-4 flex justify-around items-center" x-show="!editing">
                <div>
                  <button class="action-button update" x-on:click="toggleEdit()">
                    <?php echo $EDIT_ICON ?>
                  </button>
                </div>
                <div>
                  <button class="action-button delete" onclick="deleteMathima(this)" :data-rowID="row.id">
                    <?php echo $DELETE_ICON ?>
                  </button>
                </div>
              </td>
              <td class="px-3 py-4 flex justify-around items-center" x-show="editing">
                <div>
                  <button
                    class="action-button save"
                    onclick="editMathimaSave(this)"
                    :data-rowID="row.id"
                  >
                    <?php echo $SAVE_ICON ?>
                  </button>
                </div>
                <div>
                  <button class="action-button cancel" x-on:click="toggleEdit()">
                    <?php echo $CANCEL_ICON ?>
                  </button>
                </div>
              </td>

            </tr>
          </template>
        </tbody>
      </table>
    </div>
    
    <script src="static/js/main.js"></script>
    <script src="static/js/toasts.js"></script>

    <!-- Toastify notifications -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  </body>
</html>

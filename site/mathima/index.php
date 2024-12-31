<?php 
  include "./select.php";
  include "../components/icons/edit_action.php";
  include "../components/icons/delete_action.php";
  include "../components/icons/save_action.php";
  include "../components/icons/cancel_action.php";
  include "../components/icons/add.php";
  include "../components/icons/cancel.php";
  include "../components/icons/question.php";
  include "../components/icons/home.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Team 19 - DB</title>

    <link rel="icon" href="../static/images/rounded_icon.png" />

    <link rel="stylesheet" href="../static/css/main.css" />

    <!-- Add tailwind CDN for styles -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Add Toastify styles for toast type notifications -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

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
                <span x-show="!editing" x-text="row.name" data-mathima-value-key="name"></span>
              </td>
              <td class="px-3 py-4 text-rose-600 font-semibold">
                <input
                  class="border-b-2 border-white bg-transparent"
                  type="number"
                  :value="row.active_year"
                  x-show="editing"
                  :data-mathima-input="row.id"
                  data-mathima-input-key="active_year"
                />
                <span x-show="!editing" x-text="row.active_year" data-mathima-value-key="active_year"></span>
              </td>
              <td class="px-3 py-4 text-blue-400" x-text="row.school_category"></td>
              <td class="px-3 py-4 flex justify-around items-center" x-show="!editing">
                <div>
                  <button class="action-button update" x-on:click="toggleEdit()">
                    <?php echo $EDIT_ACTION_ICON ?>
                  </button>
                </div>
                <div>
                  <button class="action-button delete" onclick="deleteMathima(this)" :data-rowID="row.id">
                    <?php echo $DELETE_ACTION_ICON ?>
                  </button>
                </div>
              </td>
              <td class="px-3 py-4 flex justify-around items-center" x-show="editing">
                <div>
                  <button
                    class="action-button save"
                    onclick="editMathima(this)"
                    x-on:click="toggleEdit()"
                    :data-rowID="row.id"
                  >
                    <?php echo $SAVE_ACTION_ICON ?>
                  </button>
                </div>
                <div>
                  <button class="action-button cancel" x-on:click="toggleEdit()">
                    <?php echo $CANCEL_ACTION_ICON ?>
                  </button>
                </div>
              </td>

            </tr>
          </template>
        </tbody>
      </table>

      <div class="my-4 flex flex-col items-center" x-data="{ inserting: false, toggleInsert() { this.inserting = !this.inserting } }">
        <table x-transition class="bg-zinc-900 rounded-lg table-auto text-left shadow-lg" x-show="inserting">
          <thead>
            <tr class="bg-zinc-950">
              <th class="px-3 py-4 rounded-tl-lg">ID</th>
              <th class="px-3 py-4">Name</th>
              <th class="px-3 py-4">Active Year</th>
              <th class="px-3 py-4">School Category</th>
              <th class="px-3 py-4 rounded-tr-lg">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr id="insertMathimaRow">
              <td class="px-3 py-4 text-rose-600 font-semibold">
                <span class="cursor-help font-semibold fill-rose-600" id="mathimaIDInfo">
                  <?php echo $QUESTION_ICON ?>
                </span>
              </td>
              <td class="px-3 py-4 text-green-400">
                <input class="border-b-2 border-white bg-transparent" type="text" data-insert-key="name" />
              </td>
              <td class="px-3 py-4 text-rose-600 font-semibold">
                <input class="border-b-2 border-white bg-transparent" type="number" data-insert-key="active_year" />
              </td>
              <td class="px-3 py-4 text-blue-400">
                <input class="border-b-2 border-white bg-transparent" type="text" oninput="this.value = this.value.toUpperCase()" data-insert-key="school_category" />
              </td>
              <td class="px-3 py-4 flex justify-center items-center">
                <button id="insertMathimaButtonInfo" class="p-1 bg-green-500 rounded-md fill-white" onclick="insertMathima('insertMathimaRow')">
                  <?php echo $ADD_ICON ?>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        <button class="p-3 m-4 bg-green-500 rounded-lg" x-show="!inserting" x-on:click="toggleInsert()">
          <div class="flex justify-between items-center">
            <span class="mx-4">Insert row</span>
            <span class="mr-3 w-4 fill-white"><?php echo $ADD_ICON ?></span>
          </div>
        </button>
        <button class="p-3 m-4 bg-red-500 rounded-lg" x-show="inserting" x-on:click="toggleInsert()">
          <div class="flex justify-between items-center">
            <span class="mx-4">Cancel</span>
            <span class="mr-3 w-4 fill-white"><?php echo $CANCEL_ICON ?></span>
          </div>
        </button>
      </div>
    </div>


    <button class="bg-zinc-900 shadow-lg p-4 fixed left-4 bottom-4 rounded-full" onclick="goto('')">
      <span class="fill-white"><?php echo $HOME_ICON ?></span>
    </button>


    <!-- Tippy for tooltips  -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    <!-- Custom scripts -->
    <script src="../static/js/main.js"></script>
    <script src="../static/js/mathima.js"></script>
    <script src="../static/js/toasts.js"></script>

    <!-- Toastify notifications -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  </body>
</html>


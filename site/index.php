<?php
global $TABLE_ICON, $RESET_ICON;
include './components/icons/table.php';
  include './components/icons/reset.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="./static/images/icon.png" />

    <link rel="stylesheet" href="./static/css/main.css" />

    <!-- Add Toastify styles for toast type notifications -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Add tailwind CDN for styles -->
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Team 19 - DB2</title>
  </head>

  <body id="body">

    <div class="flex py-5 justify-center items-center text-2xl">
      <b>Manage Tables</b>
    </div>

    <div class="py-5 flex justify-center items-center">
        <!-- Button for MATHIMA -->
        <button class="flex justify-center items-center px-6 py-4 mx-6 shadow-lg rounded-lg bg-zinc-900 hover:scale-110 transition-transform" onclick="goto('mathima')">
          <span class="mr-3 fill-white"><?php echo $TABLE_ICON ?></span>
          <span class="mx-2 font-bold">MATHIMA</span>
        </button>
        <!-- Button for MATHITIS -->
        <button class="flex justify-center items-center px-6 py-4 mx-6 shadow-lg rounded-lg bg-zinc-900 hover:scale-110 transition-transform" onclick="goto('mathitis')">
            <span class="mr-3 fill-white"><?php echo $TABLE_ICON ?></span>
            <span class="mx-2 font-bold">MATHITIS</span>
        </button>
    </div>

    <button id="resetInfo" class="fixed p-4 left-4 bottom-4 fill-red-600" onclick="resetToast()">
      <?php echo $RESET_ICON ?>
    </button>

    <!-- Tippy for tooltips  -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    <!-- Custom scripts -->
    <script src="./static/js/main.js"></script>
    <script src="./static/js/toasts.js"></script>
    <script src="./static/js/reset.js"></script>

    <!-- Toastify notifications -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
    tippy("#resetInfo", {
      content: "Reset database",
      placement: "right",
      animation: "fade",
      delay: [250, 0],
    })
    </script>

  </body>
</html>

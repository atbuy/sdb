<?php
  include './components/icons/table.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="/static/images/icon.png" />

    <link rel="stylesheet" href="/static/css/main.css" />

    <!-- Add tailwind CDN for styles -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Add Toastify styles for toast type notifications -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <title>Team 19 - DB2</title>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
  </head>

  <body>

    <div class="flex py-5 justify-center items-center">
      <b>Manage Tables</b>
    </div>

    <div class="py-5 flex justify-center items-center">
        <a href="/mathima" class="flex justify-center items-center px-6 py-4 mx-6 shadow-lg rounded-lg bg-zinc-900 hover:scale-110 transition-transform">
          <span class="mr-3 fill-white"><?php echo $TABLE_ICON ?></span>
          <span class="mx-2 font-bold">MATHIMA</span>
        </a>
    </div>

  </body>
</html>

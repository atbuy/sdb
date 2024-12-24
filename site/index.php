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
        <tbody>
          <!-- Load all rows from the "Mathima" table -->
          <?php include 'mathima/mathima_rows.php' ?>
        </tbody>
      </table>
    </div>

    <script src="static/js/main.js"></script>
  </body>
</html>

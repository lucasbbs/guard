<?php ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lock Box</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="/styles.css">

</head>

<body>
  <?php $validations_create = flash()->get('validations_create') ?? []; ?>
  <div class="mx-auto max-w-screen-lg h-screen">
    <?php require base_path('views/partials/_navbar.view.php') ?>

    <div class="w-full flex gap-4">
      <div class="w-48 h-full my-auto flex items-center">
        <?php require base_path('views/partials/_sidebar_menu.view.php'); ?>
      </div>
      <div class="flex w-full flex-col space-y-6">

        <?php require base_path('views/partials/_searchbar.view.php') ?>
        <?php require base_path('views/partials/_message.view.php'); ?>

        <div class="flex flex-grow py-6">
          <div class="rounded-l-box w-fit flex flex-col overflow-hidden">
            <div class="flex divide-y divide-gray-700 justify-evenly">
              <?php require base_path('views/partials/_alphabet.view.php'); ?>
            </div>
            <!-- <div class="text-muted font-small font-semibold mt-8">
          Logged in as
        </div>
        <span class="text-body font-small">
          <?= auth()->email ?>
        </span> -->
          </div>
          <?php require base_path("views/{$view}.view.php"); ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
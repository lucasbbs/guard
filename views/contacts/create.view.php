<?php

$validations = flash()->get('validations_create');
$validations = is_array($validations) ? $validations : [];

?>

<div class="bg-base-200 rounded-r-box w-full p-10">
  <?php partial('partials/_create_form', ['validations' => $validations]); ?>
</div>
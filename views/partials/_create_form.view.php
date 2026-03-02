<?php

$validations = is_array($validations ?? null) ? $validations : [];

?>

<form action="/contacts/create" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-6">
  <?php partial('partials/_picture_field', ['validations' => $validations]); ?>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Name</legend>
    <input type="text" class="input w-full" name="name" placeholder="Contact Name" />
    <?php if (isset($validations['name'])): ?>
      <div class="mt-1 text-xs text-error" data-validation-error><?= $validations['name'][0] ?></div>
    <?php endif; ?>
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Phone number</legend>
    <input class="input w-full" name="phone" type="text" placeholder="Phone number" />
    <?php if (isset($validations['phone'])): ?>
      <div class="mt-1 text-xs text-error" data-validation-error><?= $validations['phone'][0] ?></div>
    <?php endif; ?>
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Email</legend>
    <input class="input w-full" name="email" type="email" placeholder="Email" />
    <?php if (isset($validations['email'])): ?>
      <div class="mt-1 text-xs text-error" data-validation-error><?= $validations['email'][0] ?></div>
    <?php endif; ?>
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Address</legend>
    <input class="input w-full" name="address" type="text" placeholder="Address" />
    <?php if (isset($validations['address'])): ?>
      <div class="mt-1 text-xs text-error" data-validation-error><?= $validations['address'][0] ?></div>
    <?php endif; ?>
  </fieldset>

  <div class="flex justify-end items-center">
    <button class="btn btn-primary">Save</button>
  </div>
</form>

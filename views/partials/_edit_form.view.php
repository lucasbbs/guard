<?php

$selectedContact = $contact;
$validations = is_array($validations ?? null) ? $validations : [];

?>

<form action="/contacts" method="POST" id="<?= 'form-update_' . htmlspecialchars((string) $selectedContact->id, ENT_QUOTES, 'UTF-8') ?>">
  <input type="hidden" name="__method" value="PUT" />

  <input type="hidden" name="id" value="<?= htmlspecialchars((string) $selectedContact->id, ENT_QUOTES, 'UTF-8') ?>" />

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Name</legend>
    <input type="text" class="input w-full" value="<?= htmlspecialchars((string) ($selectedContact->name ?? ''), ENT_QUOTES, 'UTF-8') ?>" name="name" />

    <?php if (isset($validations['name'])): ?>
      <div class="mt-1 text-xs text-error"><?= $validations['name'][0] ?></div>
    <?php endif; ?>
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Phone number</legend>
    <input
      <?php if (! $selectedContact->isVisible()): ?>
      disabled
      <?php endif; ?>
      type="text"
      class="input w-full"
      name="phone"
      placeholder="Phone number"
      value="<?= htmlspecialchars((string) $selectedContact->phone(), ENT_QUOTES, 'UTF-8') ?>" />

    <?php if (isset($validations['phone'])): ?>
      <div class="mt-1 text-xs text-error"><?= $validations['phone'][0] ?></div>
    <?php endif; ?>
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Email</legend>
    <input
      <?php if (! $selectedContact->isVisible()): ?>
      disabled
      <?php endif; ?>
      type="email"
      class="input w-full"
      name="email"
      placeholder="Email"
      value="<?= htmlspecialchars((string) $selectedContact->email(), ENT_QUOTES, 'UTF-8') ?>" />

    <?php if (isset($validations['email'])): ?>
      <div class="mt-1 text-xs text-error"><?= $validations['email'][0] ?></div>
    <?php endif; ?>
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Address</legend>
    <textarea
      <?php if (! $selectedContact->isVisible()): ?>
      disabled
      <?php endif; ?>
      class="textarea h-24 w-full"
      name="address"
      placeholder="Address"><?= htmlspecialchars((string) $selectedContact->address(), ENT_QUOTES, 'UTF-8') ?></textarea>

    <?php if (isset($validations['address'])): ?>
      <div class="mt-1 text-xs text-error"><?= $validations['address'][0] ?></div>
    <?php endif; ?>
  </fieldset>

  <button class="btn btn-primary" type="submit">Update</button>
</form>

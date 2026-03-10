<?php $validations = flash()->get('validations'); ?>

<div class="rounded-box w-full text-3xl font-bold pt-20 overflow-hidden flex flex-col items-center">
  <?php $contact_id = $contact_id ?? null; ?>
  <?php $isSingle = $contact_id !== null && $contact_id !== ''; ?>
  <form action="<?= $isSingle ? '/show-single' : '/show' ?>" method="POST" class="max-w-md flex flex-col gap-4">
    <div class="text-center text-white">
      <?= $isSingle ? 'Type your password to unlock this contact' : 'Type your password to unlock your contacts' ?>
    </div>

    <?php if ($isSingle): ?>
      <input type="hidden" name="contact_id" value="<?= htmlspecialchars((string) $contact_id, ENT_QUOTES, 'UTF-8') ?>" />
    <?php endif; ?>

    <label class="form-control">
      <div class="label">
        <span class="label-text text-sm text-body">Password</span>
      </div>

      <input type="password" placeholder="Enter password" name="password" class="input input-bordered w-full guard-input" />

      <?php if (isset($validations['password'])): ?>
        <div class="mt-1 text-xs text-error"><?= $validations['password'][0] ?></div>
      <?php endif; ?>
    </label>

    <button class="btn bg-brand"><?= $isSingle ? 'Unlock Contact' : 'Open Contacts' ?></button>
  </form>
</div>
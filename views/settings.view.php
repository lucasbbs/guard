<?php $validations = flash()->get('validations'); ?>

<div class="rounded-box w-full text-3xl font-bold pt-20 overflow-hidden flex flex-col items-center">
  <form action="/settings" method="POST" class="max-w-md flex flex-col gap-4">
    <div class="text-center text-white">Update your password</div>

    <label class="form-control">
      <div class="label">
        <span class="label-text text-sm text-body">Password</span>
      </div>

      <input type="password" name="password" class="input input-bordered w-full guard-input" placeholder="Enter password" />

      <div class="label">
        <span class="label-text text-sm text-body">Confirm Password</span>
      </div>
      <input type="password" name="password_confirmation" class="input input-bordered w-full mt-2 guard-input" placeholder="Confirm password" />

      <?php if (isset($validations['password'])): ?>
        <div class="mt-1 text-xs text-error"><?= $validations['password'][0] ?></div>
      <?php endif; ?>
    </label>

    <button class="btn bg-brand">Update password</button>
  </form>
</div>
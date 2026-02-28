<?php $validations = flash()->get('validations'); ?>
<div class="grid grid-cols-2">

  <div class="hero min-h-screen flex ml-40">
    <div class="hero-content -mt-20">
      <div>
        <p class="py-2 text-xl">Welcome to</p>
        <h1 class="text-6xl font-bold">Lock Box</h1>
        <p class="py-2 pb-4 text-xl">where you keep <span class="italic">everything</span> safe</p>
      </div>
    </div>
  </div>

  <div class="bg-white hero mr-40 min-h-screen text-black">
    <div class="hero-content -mt-20">
      <form method="POST" action="/login">
        <div class="card">
          <div class="card-body">
            <div class="card-title text-xl">Sign in to your account</div>
            <?php require base_path('views/partials/_message.view.php'); ?>
            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">Email</span>
              </div>

              <input type="text" name="email" class="input w-full max-w-xs bg-white" value="<?= old('email') ?>" />

              <?php if (isset($validations['email'])): ?>
                <div class="mt-1 text-xs text-error"><?= $validations['email'][0] ?></div>
              <?php endif; ?>
            </label>

            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">Password</span>
              </div>

              <input type="password" name="password" class="input w-full max-w-xs bg-white" />
              <?php if (isset($validations['password'])): ?>
                <div class="mt-1 text-xs text-error"><?= $validations['password'][0] ?></div>
              <?php endif; ?>
            </label>

            <div class="card-actions">
              <button class="btn btn-primary btn-block">Login</button>
              <a href="/register" class="btn btn-link">Don't have an account?</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
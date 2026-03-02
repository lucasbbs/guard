<?php $validations = flash()->get('validations'); ?>
<div class="grid grid-cols-2">

  <div class="hero min-h-[150px] sm:min-h-screen flex pl-0 sm:pl-10 md:pl-20 lg:pl-40 login-background-blur place-items-start pt-20">
    <div class="hero-content -mt-20 text-white">
      <div>
        <p class="py-2 text-xl">Welcome to</p>
        <div class="text-4xl font-bold flex gap-1.5"> <img src="./images/guard_logo.svg" alt="">
          <h1>Guard</h1>
        </div>
        <p class="py-2 pb-4 text-xl">where you keep <span class="italic">everything</span> safe</p>
      </div>
    </div>
  </div>

  <div class="bg-white hero mr-40 min-h-screen text-white background-guest-action ">
    <div class="hero-content -mt-20">
      <form method="POST" action="/register">
        <div class="card">
          <div class="card-body">
            <div class="card-title text-xl">Sign up for an account</div>

            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">Name</span>
              </div>

              <input type="text" name="name" value="<?= old('name') ?>" class="input input-bordered w-full max-w-xs guard-input" placeholder="Enter your name" />
              <?php if (isset($validations['name'])): ?>
                <div class="mt-1 text-xs text-error"><?= $validations['name'][0] ?></div>
              <?php endif; ?>
            </label>

            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">E-mail</span>
              </div>

              <input type="text" name="email" value="<?= old('email') ?>" class="input input-bordered w-full max-w-xs guard-input" placeholder="Enter your email" />
              <?php if (isset($validations['email'])): ?>
                <div class="mt-1 text-xs text-error"><?= $validations['email'][0] ?></div>
              <?php endif; ?>
            </label>

            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">Password</span>
              </div>

              <input type="password" name="password" class="input input-bordered w-full max-w-xs guard-input" placeholder="Enter your password" />
              <?php if (isset($validations['password'])): ?>
                <div class="mt-1 text-xs text-error"><?= $validations['password'][0] ?></div>
              <?php endif; ?>
            </label>


            <label class="form-control">
              <div class="label">
                <span class="label-text text-black">Confirm Password</span>
              </div>

              <input type="password" name="password_confirmation" class="input input-bordered w-full max-w-xs guard-input" placeholder="Confirm your password" />
              <?php if (isset($validations['password_confirmation'])): ?>
                <div class="mt-1 text-xs text-error"><?= $validations['password_confirmation'][0] ?></div>
              <?php endif; ?>
            </label>

            <div class="card-actions flex flex-col">
              <button class="btn btn-login btn-block w-fit self-end">Register</button>
              <div class="flex gap-2"><span class="text-white">Already have an account?</span> <a href="/login" class="brand">Access account</a></div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
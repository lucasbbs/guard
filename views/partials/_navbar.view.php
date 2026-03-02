<div class="navbar bg-black shadow-sm">
  <div class="flex-1">
    <a href="/contacts" class="btn btn-link px-0 text-xl">
      <img src="/images/guard_logo.svg" alt="Guard">
    </a>
  </div>
  <div class="flex-none">
    <ul class="menu menu-horizontal px-1">
      <li class="text-white">
        <?php if (session()->get('show')): ?>
          <a href="/hide">
            <img src="/images/lock_opened.svg" class="w-6 h-6 brightness-0 invert">
          </a>
        <?php else: ?>
          <a href="/confirm">
            <img src="/images/lock_closed.svg" class="w-6 h-6 brightness-0 invert">
          </a>
        <?php endif; ?>
      </li>
      <li>
        <details>
          <summary><?= auth()->name ?></summary>
          <ul class="bg-base-100 rounded-t-none p-2">
            <li><a href="/logout">Logout</a></li>
          </ul>
        </details>
      </li>
    </ul>
  </div>
</div>
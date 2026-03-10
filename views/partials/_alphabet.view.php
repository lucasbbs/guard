<?php

$alphabet = $alphabet ?? range('A', 'Z');
$baseUrl = $baseUrl ?? '/contacts';
$search = $search ?? null;


$buildUrl = function (?string $letter) use ($baseUrl, $search): string {
  $query = [];

  if (is_string($letter) && $letter !== '') {
    $query['letter'] = $letter;
  }

  if (is_string($search) && $search !== '') {
    $query['search'] = $search;
  }

  return $baseUrl . (empty($query) ? '' : ('?' . http_build_query($query)));
};

?>

<nav aria-label="Alphabet" class="flex flex-col items-center px-4">
  <div class="rounded-3xl bg-brand px-2 py-3 flex flex-col items-center gap-1 select-none">
    <a
      href="<?= $buildUrl(null) ?>"
      class="w-7 h-7 flex items-center justify-center rounded-md text-[0.65rem] uppercase tracking-wide <?= $activeLetter === null ? 'bg-base-100/20 font-bold' : 'opacity-80 hover:opacity-100' ?>"
      <?= $activeLetter === null ? 'aria-current="page"' : '' ?>>
      All
    </a>

    <div class="h-px w-6 bg-primary-content/30 my-1"></div>

    <?php foreach ($alphabet as $letter): ?>
      <?php if ($activeLetter === $letter): ?>
        <span
          class="w-7 h-7 flex items-center justify-center rounded-md text-2xl font-semibold bg-base-100/20 font-bold"
          aria-current="page">
          <?= $letter ?>
        </span>
      <?php else: ?>
        <a
          href="<?= $buildUrl($letter) ?>"
          class="w-7 h-7 flex items-center justify-center rounded-md text-sm font-light <?= $activeLetter === $letter ? 'bg-base-100/20 font-bold' : 'opacity-80 hover:opacity-100 hover:bg-base-100/10' ?>"
          <?= $activeLetter === $letter ? 'aria-current="page"' : '' ?>>
          <?= $letter ?>
        </a>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</nav>
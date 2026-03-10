<?php

$id = $id ?? uniqid('modal_', false);
$title = $title ?? null;
$trigger = $trigger ?? null;
$triggerClass = $triggerClass ?? 'btn';
$closeText = $closeText ?? 'Close';
$slot = $slot ?? '';
$actions = $actions ?? null;

if (is_callable($slot)) {
  $slot = capture($slot);
}

if (is_callable($actions)) {
  $actions = capture($actions);
}

?>

<?php if (is_string($trigger) && $trigger !== ''): ?>
  <div
    onclick="document.getElementById('<?= $id ?>').showModal()">
    <?= $trigger ?>
  </div>
<?php endif; ?>

<dialog id="<?= $id ?>" class="modal bg-black/90">
  <div class="modal-box">
    <?php if (is_string($title) && $title !== ''): ?>
      <h3 class="text-lg font-bold"><?= $title ?></h3>
    <?php endif; ?>

    <?= $slot ?>

    <div class="modal-action">
      <?php if ($actions !== null): ?>
        <?= $actions ?>
      <?php else: ?>
        <form method="dialog">
          <button class="btn"><?= $closeText ?></button>
        </form>
      <?php endif; ?>
    </div>
  </div>

  <form method="dialog" class="modal-backdrop">
    <button aria-label="<?= $closeText ?>"></button>
  </form>
</dialog>
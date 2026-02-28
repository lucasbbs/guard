<?php $validations = flash()->get('validations'); ?>

<div class="bg-base-300 rounded-l-box w-56 flex flex-col divide-y divide-gray-700 overflow-hidden">

  <?php foreach ($notes as $note): ?>
    <a href="/notes?id=<?= $note->id ?><?= request()->get('search', '', '&search=') ?>"
      class="
                w-full p-2 cursor-pointer hover:bg-base-200
                <?php if ($note->id == $selectedNote->id): ?> bg-base-200 <?php endif; ?>
            ">
      <?= $note->title ?> <br />

      <span class="text-xs">id: <?= $note->id ?></span>
    </a>
  <?php endforeach; ?>

</div>

<div class="bg-base-200 rounded-r-box w-full p-10 flex flex-col space-y-6">
  <form action="/notes" method="POST" id="form-update">
    <input type="hidden" name="__method" value="PUT" />

    <input type="hidden" name="id" value="<?= $selectedNote->id ?>" />

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Title</legend>
      <input type="text" class="input w-full" value="<?= $selectedNote->title ?>" name="title" />

      <?php if (isset($validations['title'])): ?>
        <div class="mt-1 text-xs text-error"><?= $validations['title'][0] ?></div>
      <?php endif; ?>
    </fieldset>

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Your note</legend>
      <textarea
        <?php if (! session()->get('show')): ?>
        disabled
        <?php endif; ?>
        class="textarea h-24 w-full" name="note" placeholder="Your note here"><?= $selectedNote->note() ?></textarea>

      <?php if (isset($validations['note'])): ?>
        <div class="mt-1 text-xs text-error"><?= $validations['note'][0] ?></div>
      <?php endif; ?>
    </fieldset>
  </form>

  <div class="flex justify-between items-center">
    <form action="/notes" method="POST">
      <input type="hidden" name="__method" value="DELETE" />
      <input type="hidden" name="id" value="<?= $selectedNote->id ?>" />
      <button class="btn btn-error" type="submit">Delete</button>
    </form>
    <button class="btn btn-primary" type="submit" form="form-update">Update</button>
  </div>
</div>
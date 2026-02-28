<?php $validations = flash()->get('validations'); ?>
<div class="bg-base-300 rounded-l-box w-56 overflow-hidden">
  <div class="bg-base-200 p-4 rounded-tl-box">+ New Note</div>
</div>
<div class="bg-base-200 rounded-r-box w-full p-10">
  <form action="/notes/create" method="POST" class="flex flex-col space-y-6">
    <fieldset class="fieldset">
      <legend class="fieldset-legend">Title</legend>
      <input type="text" class="input w-full" name="title" placeholder="Type here" />
      <?php if (isset($validations['title'])): ?>
        <div class="mt-1 text-xs text-error"><?= $validations['title'][0] ?></div>
      <?php endif; ?>
    </fieldset>

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Your note</legend>
      <textarea class="textarea h-24 w-full" name="note"></textarea>
      <?php if (isset($validations['note'])): ?>
        <div class="mt-1 text-xs text-error"><?= $validations['note'][0] ?></div>
      <?php endif; ?>
    </fieldset>

    <div class="flex justify-end items-center">
      <button class="btn btn-primary">Save</button>
    </div>
  </form>
</div>
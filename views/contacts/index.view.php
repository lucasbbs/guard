<?php $validations = flash()->get('validations'); ?>

<div class="rounded-r-box w-full p-10 flex flex-col space-y-6">
  <table class="text-white">
    <thead>
      <tr>
        <th class="text-start">Name</th>
        <th class="text-start">Phone</th>
        <th class="text-start">Email</th>
        <th class="text-start">Address</th>
        <th class="text-end">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($contacts as $contact): ?>
        <tr>
          <td class="align-middle py-3">
            <div class="flex items-center gap-2">
              <div class="h-10 w-10 shrink-0">
                <img
                  src="<?= 'images/' . ($contact->picture ? 'uploads/' . $contact->picture : 'account_circle.svg') ?>"
                  alt="Contact picture"
                  class="h-full w-full rounded-full object-cover <?= $contact->picture ? '' : ' invert' ?>">
              </div>

              <span><?= htmlspecialchars($contact->name ?? '', ENT_QUOTES, 'UTF-8') ?></span>
            </div>
          </td>
          <td class="text-start py-3"><?= htmlspecialchars((string) $contact->phone(), ENT_QUOTES, 'UTF-8') ?></td>
          <td class="text-start py-3"><?= htmlspecialchars((string) $contact->email(), ENT_QUOTES, 'UTF-8') ?></td>
          <td class="text-start py-3"><?= htmlspecialchars((string) $contact->address(), ENT_QUOTES, 'UTF-8') ?></td>
          <td class="text-end flex gap-2 py-3">
            <!-- Edit contact  - opens the modal partial to edit the contact -->
            <?php partial('partials/_modal', [
              'id' => 'edit_contact_modal_' . $contact->id,
              'title' => 'Edit Contact',
              'trigger' => '<button class="btn btn-link px-0"><img src="images/edit.svg" class="brightness-0 invert" alt="edit" /></button>',
            ], function () use ($contact) { ?>
              <?php partial('partials/_edit_form', ['contact' => $contact]); ?>
            <?php }); ?>


            <!-- Delete Contact -->
            <form action="/contacts" method="POST">
              <input type="hidden" name="__method" value="DELETE" />
              <input type="hidden" name="id" value="<?= $contact->id ?>" />
              <button class="btn btn-link px-0" type="submit">
                <img src="images/delete.svg" class="brightness-0 invert" alt="delete">
              </button>
            </form>
            <form action="/show-single" method="POST">
              <input type="hidden" name="contact_id" value="<?= htmlspecialchars((string) $contact->id, ENT_QUOTES, 'UTF-8') ?>" />
              <button class="btn btn-link px-0" type="submit">
                <?php partial('partials/_lock_icon', ['locked' => $contact->isLocked()]); ?>
              </button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="flex justify-between items-center">
    <form action="/contacts" method="POST">
      <!-- <input type="hidden" name="__method" value="DELETE" />
      <input type="hidden" name="id" value="<-?= $selectedContact->id ?>" />
      <button class="btn btn-error" type="submit">Delete</button> -->
    </form>
  </div>
</div>
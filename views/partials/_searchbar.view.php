    <div class="flex gap-4">
      <form action="/contacts" class="flex justify-between w-full">
        <h1 class="text-white text-3xl">List Contacts</h1>
        <label class="input input-bordered flex items-center gap-2 guard-input">
          <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <g
              stroke-linejoin="round"
              stroke-linecap="round"
              stroke-width="2.5"
              fill="none"
              stroke="currentColor">
              <circle cx="11" cy="11" r="8"></circle>
              <path d="m21 21-4.3-4.3"></path>
            </g>
          </svg>
          <input
            type="text"
            name="search"
            placeholder="Search contacts in Guard..."
            value="<?= request()->get('search') ?>" />
        </label>
      </form>

      <?php partial('partials/_modal', [
        'id' => 'create_contact_modal',
        'title' => 'Create Contact',
        'trigger' => '<button class="btn whitespace-nowrap"><img class="filter" src="/images/add.svg" alt="">Add Contact</button>',
      ], function () use ($validations_create) { ?>
        <?php partial('partials/_create_form', ['validations' => $validations_create ?? []]); ?>
      <?php }); ?>

      <script>
        (() => {
          const dialog = document.getElementById('create_contact_modal');
          if (!dialog) return;

          dialog.addEventListener('close', () => {
            dialog.querySelectorAll('[data-validation-error]').forEach((el) => el.remove());

            const form = dialog.querySelector('form');
            if (!(form instanceof HTMLFormElement)) return;

            form.reset();

            const pictureInput = form.querySelector('[data-picture-input]');
            if (!pictureInput) return;

            pictureInput.dispatchEvent(new Event('change', {
              bubbles: true
            }));
          });
        })();
      </script>

      <?php if (($view ?? null) === 'contacts/index' && ! empty($validations_create ?? [])): ?>
        <script>
          document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('create_contact_modal')?.showModal();
          });
        </script>
      <?php endif; ?>
    </div>

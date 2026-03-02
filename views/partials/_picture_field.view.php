<fieldset class="fieldset" data-picture-field>
  <legend class="fieldset-legend">Picture</legend>
  <div class="flex items-center gap-4">
    <img src="/images/account_circle.svg" alt="Contact picture preview" class="w-20 h-20 rounded-full object-cover bg-base-200" data-picture-preview>

    <div class="flex flex-col gap-2">
      <button type="button" class="btn btn-sm w-fit" data-picture-button>+ Add Picture</button>
      <input type="file" class="hidden" name="picture" accept="image/*" data-picture-input />
      <div class="text-xs text-base-content/60" data-picture-filename></div>
    </div>
  </div>
  <?php if (isset($validations['picture'])): ?>
    <div class="mt-1 text-xs text-error" data-validation-error><?= $validations['picture'][0] ?></div>
  <?php endif; ?>
</fieldset>

<script>
  (() => {
    const root = document.currentScript?.previousElementSibling;
    if (!(root instanceof HTMLElement) || !root.matches('[data-picture-field]')) return;

    const button = root.querySelector('[data-picture-button]');
    const input = root.querySelector('[data-picture-input]');
    const preview = root.querySelector('[data-picture-preview]');
    const filename = root.querySelector('[data-picture-filename]');

    if (!button || !input || !preview) return;

    const fallbackSrc = preview.getAttribute('src') || '';

    button.addEventListener('click', () => {
      input.click();
    });

    input.addEventListener('change', () => {
      const file = input.files && input.files[0];

      if (!file) {
        preview.src = fallbackSrc;
        filename.textContent = '';
        button.textContent = '+ Add Picture';
        return;
      }

      const reader = new FileReader();
      reader.addEventListener('load', () => {
        preview.src = String(reader.result || fallbackSrc);
      });
      reader.readAsDataURL(file);

      if (filename) filename.textContent = file.name;
      button.textContent = 'Change Picture';
    });
  })();
</script>

<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      Create New Recipe
    </h2>
  </x-slot>

  <div class="py-12 px-8">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


        <x-forms.form action="/recipes" method="POST">
          <div>
            <x-buk-checkbox name="needs_transcription" /> Needs Transrcription</div>

          <x-forms.input name="name" />

          <x-forms.select name="author" :options="$authors" selected="0">
          </x-forms.select>

          <x-forms.textarea name="description">
            Brief description of your recipe.
          </x-forms.textarea>
          <x-forms.textarea name="ingredients" rows="6">
            List each ingredient on it's own line.
          </x-forms.textarea>
          <x-forms.textarea name="cooking_Directions" rows="10">
            List each step on it's own line.
          </x-forms.textarea>

          <x-forms.multi-file-upload heading="Attachments" name="attachments[]" filetypes="PNG, JPG, PDF up to 20MB"
            accept=".png,.jpg,.jpeg,.pdf">

          </x-forms.multi-file-upload>
      </div>

      <x-forms.button type="submit">Save</x-forms.button>
      </x-forms.form>


    </div>
  </div>
  </div>

</x-app-layout>
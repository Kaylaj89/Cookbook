<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      {{ __('Create New Author') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

        <x-forms.form action="/authors" method="POST">
          <x-forms.input name="name"></x-forms.input>
          <x-forms.trix name="bio" instruction="Please enter a bio for this author."></x-forms.trix>
          <x-forms.button type="submit">
            Create Author
          </x-forms.button>
        </x-forms.form>



      </div>
    </div>
  </div>
</x-app-layout>
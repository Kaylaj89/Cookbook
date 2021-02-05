<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      {{ __('Edit Author') }}
    </h2>
  </x-slot>

  <x-layout.panel width="5">
    <x-forms.form action="/authors/{{$author->id}}" method="PATCH">
      <x-forms.input name="name" :value="$author->name"></x-forms.input>
      <x-forms.trix name="bio" instruction="Please enter a bio for this author.">{{$author->bio ?? ''}}</x-forms.trix>
      <x-forms.button type="submit">
        Update Author
      </x-forms.button>
    </x-forms.form>
  </x-layout.panel>


  <x-layout.panel width="5">
    <x-layout.h3>Careful! You can NOT undo this.</x-layout.h3>
    <x-buk-form-button :action="route('authors.destroy', $author->id)" method="DELETE"
      class="ml-5 bg-red-500 items-center text-white font-bold rounded-lg text-sm px-4 py-2">
      Delete Author
    </x-buk-form-button>
  </x-layout.panel>
</x-app-layout>
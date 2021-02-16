<x-app-layout>
  <x-slot name="header">


    <div class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      {{ __('Recipes') }}

      <x-layout.crud-button href="/recipes/create" color="green">
        Add New Recipe
      </x-layout.crud-button>
    </div>


  </x-slot>

  <x-layout.panel width="5">
    @if (count($recipes) < 1) <x-layout.no-data model="recipes">
      </x-layout.no-data>
      @else
      <x-layout.recipes-table :recipes='$recipes'></x-layout.recipes-table>

      @endif

  </x-layout.panel>

</x-app-layout>
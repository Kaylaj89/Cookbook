<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      {{ __('Your Shopping List') }}
    </h2>
  </x-slot>
  <div class="grid grid-cols-2">


    @if(count($ingredients) <= 0) <x-layout.panel width="2">
      <x-layout.no-data model="ingredients" />
      </x-layout.panel>
      @else
      <x-layout.panel width="3">
        <x-forms.form action="/shoppinglist" method="PATCH">
          <input type="hidden" name="remove" value="true">
          <ul>
            @foreach($ingredients as $ingredient)

            <li>
              <x-buk-checkbox name="ingredients[]" value="{{$ingredient}}" />{{ $ingredient }}</li>
            @endforeach
          </ul>
          <div>
            <x-forms.selectall></x-forms.selectall>
            <button type="submit"
              class="bg-red-500 hover:bg-red-700 text-white text-sm px-5 py-2 rounded-lg float-right my-15"> Remove
              Selected </button>
          </div>
          <div class="py-5"></div>
        </x-forms.form>

      </x-layout.panel>

      @endif

      <livewire:kroger.show-products :ingredients="$ingredients" />
      <livewire:kroger.show-locations />
  </div>
</x-app-layout>
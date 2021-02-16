<div wire:init="loadKrogerProducts">
  <x-layout.panel width="7">
    <x-layout.h3 class="text-center">Suggest Products (Powered by The Kroger API)</x-layout.h3>
    <x-layout.kroger :products="$products"></x-layout.kroger>
  </x-layout.panel>
</div>
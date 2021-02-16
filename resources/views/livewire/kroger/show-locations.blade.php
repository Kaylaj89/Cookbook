<div>
  <x-layout.panel width="7">
    <x-layout.h3 class="text-center">Kroger Stores Near You</x-layout.h3>
    <label for="zip">Zip:</label>
    <input type="text" wire:model="zip" name="zip"></input>
    <x-jet-input-error for="zip" />
    <div class="py-5" wire:init="loadKrogerLocations">
      @if(count($locations) > 0)
      <x-layout.table :headerCols="['name', 'address', 'phone']">
        @foreach($locations as $location)
        <tr>
          <x-layout.table-cell>
            {{$location['name']}}
          </x-layout.table-cell>

          <x-layout.table-cell>
            {{$location['address']['addressLine1']}}<br />
            {{$location['address']['city']}}, {{$location['address']['state']}}, {{$location['address']['zipCode']}}
          </x-layout.table-cell>

          <x-layout.table-cell>
            {{$location['phone'] ?? ''}}
          </x-layout.table-cell>

          
        </tr>
        @endforeach
      </x-layout.table>
    </div>
    @else
    <div class="py-3">Loading ...</div>
    @endif
  </x-layout.panel>
</div>
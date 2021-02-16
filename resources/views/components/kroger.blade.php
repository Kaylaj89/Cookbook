<x-layout.panel width='7'>
  <x-layout.table :headerCols="['photo', 'name', 'category']">
    @foreach($products as $product)
    <tr>
      <x-layout.table-cell>
        <div class="object-center"><img class="object-center" src="{{$product['photo']}}" alt=""></div>
      </x-layout.table-cell>
      <x-layout.table-cell>{{$product['description']}}</x-layout.table-cell>
      <x-layout.table-cell>{{$product['category']}}</x-layout.table-cell>

    </tr>
    @endforeach
  </x-layout.table>

</x-layout.panel>
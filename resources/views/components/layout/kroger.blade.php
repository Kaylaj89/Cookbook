@if($products != null)
<x-layout.table :headerCols="['photo', 'name', 'category']">
    @foreach($products as $product)
    <tr>
        <x-layout.table-cell>
            <div class="object-center"><img src="{{$product['photo']}}" alt=""></div>
        </x-layout.table-cell>
        <x-layout.table-cell>{{$product['description']}}</x-layout.table-cell>
        <x-layout.table-cell>{{$product['category']}}</x-layout.table-cell>

    </tr>
    @endforeach
</x-layout.table>

@else
<div class="py-3">Loading ...</div>
@endif
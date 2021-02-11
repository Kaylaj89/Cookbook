@php
$headerCols = ['name', 'author' , 'created by','','tr'];
$except = isset($except) ? $except : [];
$headerCols = array_diff($headerCols, $except);
@endphp


<x-layout.table :headerCols="$headerCols">

    @foreach($recipes as $recipe)
    <tr>
        @if(!in_array('name', $except))
        <x-layout.table-cell>
            <x-layout.link href="/recipes/{{$recipe->id}}">{{$recipe->name}}</x-layout.link>
        </x-layout.table-cell>
        @endif

        @if(!in_array('author', $except))
        <x-layout.table-cell>
            <x-layout.link href="/authors/{{$recipe->author->id ?? ''}}">{{$recipe->author->name ?? ''}}</x-layout.link>
        </x-layout.table-cell>
        @endif
        @if(!in_array('created by', $except))
        <x-layout.table-cell>{{$recipe->user->name ?? ''}}</x-layout.table-cell>
        @endif

        <x-layout.table-cell>
            <x-layout.link href="/recipes/{{$recipe->id}}">View</x-layout.link> |
            <x-layout.link href="/recipes/{{$recipe->id}}/edit">Edit</x-layout.link>
        </x-layout.table-cell>

        <x-layout.table-cell>
            <livewire:trcheckbox :recipe="$recipe" />
        </x-layout.table-cell>
    </tr>
    @endforeach


</x-layout.table>
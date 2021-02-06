<x-layout.table :headerCols="['name', 'author' , 'created by', 'Team', '']">

    @foreach($recipes as $recipe)
    <tr>
        <x-layout.table-cell>
            <x-layout.link href="/recipes/{{$recipe->id}}">{{$recipe->name}}</x-layout.link>
        </x-layout.table-cell>

        <x-layout.table-cell>
            <x-layout.link href="/authors/{{$recipe->author->id ?? ''}}">{{$recipe->author->name ?? ''}}</x-layout.link>
        </x-layout.table-cell>

        <x-layout.table-cell>{{$recipe->user->name ?? ''}}</x-layout.table-cell>
        <x-layout.table-cell>{{$recipe->team->name ?? ''}}</x-layout.table-cell>
        <x-layout.table-cell>
            <x-layout.link href="/recipes/{{$recipe->id}}">View</x-layout.link> |
            <x-layout.link href="/recipes/{{$recipe->id}}/edit">Edit</x-layout.link>
        </x-layout.table-cell>
    </tr>
    @endforeach


</x-layout.table>
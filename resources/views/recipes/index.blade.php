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
    @if (count($recipes) < 1) <p>no recipes here yet! Why not create one?</p>
      <x-layout.no-data model="recipes"></x-layout.no-data>
      @else
      <x-layout.table :headerCols="['name', 'description', 'author', 'likes', '' ]">
        @foreach($recipes as $recipe)
        <tr>
          <x-layout.table-cell>
            <x-layout.link href="/recipes/{{$recipe->id}}">{{$recipe->name}}</x-layout.link>
          </x-layout.table-cell>
          <x-layout.table-cell>
            <p class="text-left text-gray 900 truncate ...">{{Str::limit($recipe->description,15, '....')}}
              <x-layout.link href='/recipes/{{$recipe->id}}'>Read More</x-layout.link>
            </p>
          </x-layout.table-cell>
          <x-layout.table-cell>
            <x-layout.link href="/authors/{{$recipe->author->id ?? ''}}">{{$recipe->author->name ?? ''}}</x-layout.link>
          </x-layout.table-cell>
          <x-layout.table-cell>
            {{$recipe->likes}}
          </x-layout.table-cell>
          <x-layout.table-cell>
            <x-layout.link href="/recipes/{{$recipe->id}}">View</x-layout.link> |
            <x-layout.link href="/recipes/{{$recipe->id}}/edit">Edit</x-layout.link>
          </x-layout.table-cell>
        </tr>
        @endforeach
      </x-layout.table>

      @endif
  </x-layout.panel>

</x-app-layout>
<x-app-layout>
  <x-slot name="header">
    <x-layout.h2>{{$author->name }}
      <x-layout.crud-button href="/authors/{{$author->id}}/edit" color="green">Edit Author</x-layout.crud-button>
    </x-layout.h2>
  </x-slot>

  <x-layout.panel width="4">
    <x-layout.description-list title="Author Information">
      <x-layout.dl-row title="Name">
        {{$author->name}}
      </x-layout.dl-row>
      <x-layout.dl-row title="Biography" color="white" class="trix-content">
        {!!$author->bio ?? ''!!}
      </x-layout.dl-row>
    </x-layout.description-list>

  </x-layout.panel>
  @if(count($author->recipes))
  <x-layout.panel width='4'>
    <x-layout.h3>Recipes by {{$author->name}}</x-layout.h3>
    <x-layout.table :headerCols="['name', 'description', 'likes' , '']">

      @foreach($author->recipes as $recipe)
      <tr>
        <x-layout.table-cell>
          <x-layout.link href="/recipes/{{$recipe->id}}">{{$recipe->name}}</x-layout.link>
        </x-layout.table-cell>
        <x-layout.table-cell>
          <p class="text-left text-gray 900 truncate ...">{{Str::limit($recipe->description,15, '....')}} <x-layout.link
              href='/recipes/{{$recipe->id}}'>Read More</x-layout.link>
          </p>
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
  </x-layout.panel>
  @endif

</x-app-layout>
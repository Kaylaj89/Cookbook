<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      {{ __('All Authors') }}
      <x-layout.crud-button href="/authors/create" color="green">
        Add New Author
      </x-layout.crud-button>
    </h2>
  </x-slot>
  <x-layout.panel width="3">
    @if(count($authors) > 0)
    <x-layout.table :headerCols="['name', 'recipe count', '']">
      @foreach ($authors as $author)
      <tr>
        <x-layout.table-cell>
          <x-layout.link href="/authors/{{$author->id}}">{{$author->name}}</x-layout.link>
        </x-layout.table-cell>
        <x-layout.table-cell>{{count($author->recipes)}}</x-layout.table-cell>
        <x-layout.table-cell>
          <x-layout.link href="/authors/{{$author->id}}">View</x-layout.link> |
          <x-layout.link href="/authors/{{$author->id}}/edit">Edit</x-layout.link>
        </x-layout.table-cell>
      </tr>
      @endforeach
    </x-layout.table>
    @else
    <x-layout.no-data model="authors"></x-layout.no-data>

    @endif
  </x-layout.panel>

  </ul>
  </div>
  </div>
  </div>
</x-app-layout>
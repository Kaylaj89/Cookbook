<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      {{ __('All Authors') }}
      <x-layout.crud-button href="/authors/create" color="green">
        Add New Author
      </x-layout.crud-button>
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <ul>
          @foreach ($authors as $author)
          <li>{{$author->name}} : {{$author->bio ?? 'requires bio'}} </li>

          @endforeach
        </ul>
      </div>
    </div>
  </div>
</x-app-layout>
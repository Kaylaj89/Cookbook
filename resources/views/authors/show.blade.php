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
      <x-layout.dl-row title="Created By" class="trix-content">
        {{$author->user->name ?? ''}}
      </x-layout.dl-row>
    </x-layout.description-list>

  </x-layout.panel>
  @if(count($author->recipes))
  <x-layout.panel width='4'>
    <x-layout.h3>Recipes by {{$author->name}}</x-layout.h3>
    <x-layout.recipes-table :recipes='$author->recipes'></x-layout.recipes-table>
  </x-layout.panel>
  @endif
</x-app-layout>
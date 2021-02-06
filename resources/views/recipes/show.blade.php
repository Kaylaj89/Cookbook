<x-app-layout>
  <x-slot name="header">
    <x-layout.h2 class="capitalize">
      {{$recipe->name}} by <x-layout.link href="/authors/{{$recipe->author->id ?? ''}}">
        {{$recipe->author->name ?? 'Author'}}</x-layout.link>
      <x-layout.crud-button href="/recipes/{{$recipe->id}}/edit" color="green">
        Edit Recipe
      </x-layout.crud-button>
    </x-layout.h2>
  </x-slot>

  <x-layout.panel width="5">

    @if($recipe->attachments == null)
    <p class="text-center mt-5">This recipe does not have any attachments yet.</p>
    @else
    @php
    $attachments = json_decode($recipe->attachments, true);
    @endphp
    <x-layout.attachments-slider :attachments="$attachments"></x-layout.attachments-slider>
    @endif
    <x-layout.description-list title="Recipe Information">
      <x-layout.dl-row title="Name">
        {{$recipe->name}}
      </x-layout.dl-row>
      <x-layout.dl-row title="Description" color="white">
        {{$recipe->description ?? ''}}
      </x-layout.dl-row>

      <x-layout.dl-row title="Ingredients">
        @if(count($ingredients) > 0)
        <ul>

          @foreach ($ingredients as $ingredient)
          <li>
            <x-buk-checkbox name="ingredient-{{$loop->index+1}}" />{{$ingredient}}</li>
          @endforeach
        </ul>
        <button class="text-white bg-indigo-500 hover:bg-indigo-700 px-5 py-2 rounded-lg mt-5">Add Ingredients to
          Shopping List</button>
        @endif
      </x-layout.dl-row>
      <x-layout.dl-row title="Cooking Directions" color="white">
        @if(count($steps) > 0)
        <ul>
          @foreach ($steps as $step)
          <li>{{$step}}</li>
          @endforeach
        </ul>
        @endif
      </x-layout.dl-row>

      <x-layout.dl-row title="Author">
        <x-layout.link href="/authors/{{$recipe->author->id ?? ''}}">{{$recipe->author->name ?? ''}}</x-layout.link>
      </x-layout.dl-row>

      <x-layout.dl-row title="Created" color="white">
        {{$recipe->created_at->diffForHumans()}} by {{$recipe->user->name}}
      </x-layout.dl-row>

      <x-layout.dl-row title="Team">
        {{$recipe->team->name}}
      </x-layout.dl-row>
      <x-layout.dl-row title="Attachments" color="white">


        @if($recipe->attachments == null)
        <p class="text-center m-5">This recipe does not have any attachments yet.</p>
        @else


        @php
        $attachments = json_decode($recipe->attachments, true);
        @endphp

        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
          @foreach($attachments['fileNames'] as $fileName => $originalFileName)
          <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
            <div class="w-0 flex-1 flex items-center">
              <!-- Heroicon name: paper-clip -->
              <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                  clip-rule="evenodd" />
              </svg>
              <span class="ml-2 flex-1 w-0 truncate">
                {{$originalFileName}}
              </span>
            </div>
            @if(!empty($recipe->attachments))
            <div class="ml-4 flex-shrink-0">
              <a href="{{asset('storage/uploads/images/'.$fileName)}}"
                class="font-medium text-indigo-600 hover:text-indigo-500" download="{{$originalFileName}}">
                Download
              </a>
            </div>
            @endif
          </li>
          @endforeach
        </ul>
        @endif
      </x-layout.dl-row>
    </x-layout.description-list>
    </div>
    </div>
    </div>
  </x-layout.panel>
</x-app-layout>
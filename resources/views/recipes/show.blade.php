<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      {{$recipe->name}} by Author
      <x-layout.crud-button href="/recipes/{{$recipe->id}}/edit" color="green">
        Edit Recipe
      </x-layout.crud-button>
    </h2>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">

    </h2>
  </x-slot>

  <div class="py-12 px-8">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">
        @if($recipe->attachments == null)
        <p class="text-center mt-5">This recipe does not have any attachments yet.</p>
        @else
        @php
        $attachments = json_decode($recipe->attachments, true);
        @endphp
        <x-layout.attachments-slider :attachments="$attachments"></x-layout.attachments-slider>
        @endif


        <div class="px-4 py-5 sm:px-6">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Recipe Information
          </h3>
        </div>
        <div class="border-t border-gray-200">
          <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                Name
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$recipe->name}}
              </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                Description
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$recipe->description}}
              </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                Ingredients:
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">

                <ul>
                  @foreach ($ingredients as $ingredient)
                  <li>{{$ingredient}}</li>
                  @endforeach
                </ul>
              </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                Cooking Directions:
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <ul>
                  @foreach ($steps as $step)
                  <li>{{$step}}</li>
                  @endforeach
                </ul>
              </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                Author:
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$recipe->author->name ?? "No author has been assigned to this recipe yet."}}
              </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                Created:
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{$recipe->created_at->diffForHumans()}}
              </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                Attachments:
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                  @if($recipe->attachments == null)
                  @php
                  $attachments = json_decode($recipe->attachments, true);
                  @endphp

                  <p class="text-center m-5">This recipe does not have any attachments yet.</p>
                  @else
                  @foreach($attachments['fileNames'] as $fileName => $originalFileName)
                  <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                    <div class="w-0 flex-1 flex items-center">
                      <!-- Heroicon name: paper-clip -->
                      <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
                  @endif
                </ul>
              </dd>
            </div>
          </dl>
        </div>
      </div>


    </div>
  </div>
  </div>

</x-app-layout>
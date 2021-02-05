<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      Edit Recipe

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

        <x-forms.form action="/recipes/{{$recipe->id}}" method="PATCH">

          <x-forms.input name="name" value="{{$recipe->name}}">
            </x-form.input>
            <x-forms.textarea name="description">
              Brief description of your recipe.
              <x-slot name="content">{{$recipe->description}}</x-slot>
            </x-forms.textarea>
            <x-forms.textarea name="ingredients">
              List each ingredient on it's own line.
              <x-slot name="content">
                @foreach ($ingredients as $ingredient)
                {{$ingredient}}
                @endforeach
              </x-slot>
            </x-forms.textarea>
            <x-forms.textarea name="cooking_Directions">
              List each step on it's own line.
              <x-slot name="content">
                @foreach ($steps as $step)
                {{$step}}
                @endforeach
              </x-slot>
            </x-forms.textarea>
            <x-forms.multi-file-upload heading="Attachments" name="attachments[]" filetypes="PNG, JPG, PDF up to 20MB"
              accept=".png,.jpg,.jpeg,.pdf">
            </x-forms.multi-file-upload>

      </div>
      <x-forms.button type="submit">Update</x-forms.button>
      </x-forms.form>




      <x-layout.panel>
        <h2 class="p-5 mb-5 rounded-lg">Careful! You can NOT undo this.</h2>
        <x-buk-form-button :action="route('recipes.destroy', $recipe->id)" method="DELETE"
          class="ml-5 bg-red-500 items-center text-white font-bold rounded-lg text-sm px-4 py-2">
          Delete Recipe
        </x-buk-form-button>
        @if($recipe->attachments != null)
        @php
        $attachments = json_decode($recipe->attachments, true);
        @endphp

        <ul>
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
              <x-buk-form-button :action="route('recipes.attachment.delete', [$recipe->id, $fileName])" method="POST"
                class="ml-5 bg-red-500 items-center text-white font-bold rounded-lg text-sm px-4 py-2">
                Delete This Attachment
              </x-buk-form-button>
            </div>
            @endif
          </li>
          @endforeach
        </ul>
        @endif


      </x-layout.panel>
    </div>
  </div>
  </div>
</x-app-layout>
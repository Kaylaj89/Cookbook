<x-app-layout>
  <x-slot name="header">
    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
      Edit Recipe

    </h2>

  </x-slot>

  <div class="py-12 px-8">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


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
      </div>
      <x-forms.button type="submit">Update</x-forms.button>
      </x-forms.form>




      <x-layout.panel>
        <h2 class="p-5 mb-5 rounded-lg">Careful! You can NOT undo this.</h2>
        <x-buk-form-button :action="route('recipes.destroy', $recipe->id)" method="DELETE"
          class="ml-5 bg-red-500 items-center text-white font-bold rounded-lg text-sm px-4 py-2">
          Delete Recipe
        </x-buk-form-button>
      </x-layout.panel>
    </div>
  </div>
  </div>
</x-app-layout>
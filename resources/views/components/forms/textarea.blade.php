<div>
    <x-buk-label for="{{$name}}" class="block text-sm font-medium text-gray-700">
    </x-buk-label>
    <p class="mt-2 text-sm text-gray-500">
        {{$slot}}
    </p>
    <div class="mt-1">
        <x-buk-textarea name="{{$name}}"
            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">
            {{$content ?? ''}}</x-buk-textarea>
    </div>

</div>
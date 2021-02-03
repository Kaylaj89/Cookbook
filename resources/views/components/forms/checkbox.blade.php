<div>
    <label for="{{$name}}" class="block text-sm font-medium text-gray-700">
        <input name="{{$name}}" type="checkbox" class="mr-2">{{$slot}}
    </label>
    <p class="mt-2 text-sm text-gray-500">
        {{$smallText}}
    </p>
</div>
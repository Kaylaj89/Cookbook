<div class="grid grid-cols-3 gap-6">
    <div class="col-span-3 sm:col-span-2">
        <x-buk-label for="{{$name}}" class="block text-sm font-medium text-gray-700">
        </x-buk-label>
        <div class="mt-1 flex rounded-md shadow-sm">
            <x-buk-input type="text" name="{{$name}}" id="{{$name}}" value="{{$value ?? ''}}"
                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" />
        </div>
    </div>
</div>
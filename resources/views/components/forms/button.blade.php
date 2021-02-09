<div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
    <button type="{{$type}}"
        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-{{$color ?? 'indigo'}}-500 hover:bg-{{$color ?? 'indigo'}}-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        {{$slot}}
    </button>
</div>
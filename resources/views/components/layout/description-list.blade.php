<div>
    <x-layout.h3>
    {{$title ?? ''}}
    </x-layout.h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
          {{$subtitle ?? ''}}
        </p>
      </div>
      <div class="border-t border-gray-200">
        <dl>
          {{$slot}}
        </dl>
      </div>
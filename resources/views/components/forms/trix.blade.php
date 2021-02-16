<script>
    // prevents attachments:
    document.addEventListener("trix-file-accept", function(event) {
      event.preventDefault();
    });
</script>
<style>
    /*removes the attach files button*/
    trix-toolbar .trix-button-group--file-tools {
        display: none;
    }
</style>

<div>
    <x-buk-label for="{{$name}}" class="block text-sm font-medium text-gray-700">
    </x-buk-label>
    <p class="mt-2 text-sm text-gray-500">
        {{$instruction ?? ''}}
    </p>

    <div class="mt-1">
        <x-buk-trix name="{{$name}}">{{$slot}}</x-buk-trix>
    </div>
</div>
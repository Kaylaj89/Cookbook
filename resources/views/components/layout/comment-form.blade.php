<div class="mt-2 mb-8">
    <textarea name="comment" rows="5" wire:model.defer="comment"
        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
    <x-jet-input-error for="comment" />
    <button wire:click="saveComment"
        class="bg-indigo-500 hover:bg-indigo-700 text-white text-sm rounded-lg px-5 py-2 mt-2 float-right">Save
        Comment</button>
</div>
<x-layout.panel width="5">
    <p>{{$comment->content}}</p>
    <p class="text-right">{{$comment->created_at->diffForHumans()}} by {{ $comment->user->name }} </p>
    @can('delete', $comment)
    <button class="float-right text-sm text-white text-red-500 hover:text-red-700 hover:underline mt-5"
        wire:click="deleteComment({{$comment->id}})">Delete</button>
    @endcan
</x-layout.panel>
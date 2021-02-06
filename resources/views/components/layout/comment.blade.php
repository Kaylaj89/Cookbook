<x-layout.panel width="5">
    <p>{{$comment->content}}</p>
    <p class="text-right">{{$comment->created_at->diffForHumans()}} by {{ $comment->user->name }} </p>
</x-layout.panel>
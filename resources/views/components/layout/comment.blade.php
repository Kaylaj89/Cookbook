<x-layout.panel width="5">
    <p>{{$comment->content}}</p>
    <p class="float-right ml-2 "><img class="h-8 w-8 rounded-full object-cover"
            src="@if(strpos($comment->user->profile_photo_url, 'googleusercontent') > 0){{$comment->user->profile_photo_path}} @else {{$comment->user->profile_photo_url}} @endif "
            alt="{{ $comment->user->name }}" /></p>
    src="@if(strpos(Auth::user()->profile_photo_url, 'googleusercontent') > 0){{Auth::user()->profile_photo_path}} @else
    {{Auth::user()->profile_photo_url}} @endif "
    alt="{{ Auth::user()->name }}" /></p>
    <p class="text-right text-sm py-2">{{$comment->created_at->diffForHumans()}} by {{ $comment->user->name }}</p>
    @can('delete', $comment)
    <button class="float-right text-sm text-white text-red-500 hover:text-red-700 hover:underline mt-5"
        wire:click="deleteComment({{$comment->id}})">Delete</button>
    @endcan
</x-layout.panel>
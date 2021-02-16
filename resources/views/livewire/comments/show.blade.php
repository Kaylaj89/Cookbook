<div>
  @if(count($comments) == 0)
  <x-layout.no-data model="comments"></x-layout.no-data>
  <x-layout.comment-form></x-layout.comment-form>
  @else
  <x-layout.h3>User Comments: {{count($comments)}}</x-layout.h3>
  <div>
    <x-layout.comment-form></x-layout.comment-form>
    <div class="mt-8">
      @foreach($comments as $currentcomment)
      <x-layout.comment :comment="$currentcomment"></x-layout.comment>
      @endforeach
    </div>
  </div>
  @endif
</div>
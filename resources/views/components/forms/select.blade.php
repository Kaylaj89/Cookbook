@if (count($options) <= 0) <p class="m-5">No {{ucfirst($name)}} exists. Please <a href="/{{$name}}s/create"
        class="hover:underline text-indigo-500 hover:text-indigo-700">create</a> one first.</p>
    @else

    <select name="{{$name}}" id="{{$name}}" class="rounded-lg">
        <option value="0">Select {{ucfirst($name)}}</option>
        @foreach ($options as $option)
        <option value="{{$option->id}}" @if($selected==$option->id) selected @endif>{{$option->name}}</option>
        @endforeach

    </select>
    @endif
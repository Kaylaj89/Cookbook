<x-forms.form action="/comments" method="POST">
    <input type="hidden" name="recipe_id" value="{{$recipe->id}}">
    <x-forms.textarea name="comment"></x-forms.textarea>
    <x-forms.button type="submit"> Submit Comment</x-forms.button>
</x-forms.form>
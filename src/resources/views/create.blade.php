@extends("layouts.layout")

@section("title", "create")

@section("content")
<form action="{{ route('create.dish') }}" method="post">
    @csrf
    <input type="text" id="name" placeholder="Name of dish">
    <br>
    <label for="type">Meal type:</label>
    <select name="type" id="type" >
        <option value="">-</option>
        <option value="breakfast">breakfast</option>
        <option value="soup">soup</option>
        <option value="lunch">lunch</option>
        <option value="supper">supper</option>
        <option value="dessert">dessert</option>
    </select>
    <br>
    <label for="kitchen">Kitchen:</label>
    <select name="kitchen" id="kitchen">
        <option value="">-</option>
        <option value="american">american</option>
        <option value="asian">asian</option>
        <option value="british">british</option>
        <option value="french">french</option>
        <option value="greek">greek</option>
        <option value="indian">indian</option>
        <option value="italian">italian</option>
        <option value="mexican">mexican</option>
    </select>
    <br>
    <input type="checkbox" default="FALSE" name="vegan">
    <label for="vegan">vegan</label>
    <input type="checkbox" default="FALSE" name="vegeterian">
    <label for="vegeterian">vegeterian</label>
    <br>
    <input type="text" id="description" placeholder="describe the dish">
    <br>
    <input type="text" id="url" placeholder="paste the url of recipe">
    <br>
    <label for="PhotoURL">chose the pictuer of your dish:</label>
    <input type="file" id="PhotoURL" accept="image/png, image/jpeg">
    <br>
    <label for="ingredients">ingridients:</label>
    <select name="ingredients[]" id="ingredients" multiple style="width:100%">
        @foreach($ingredients as $ingredient)
            <option value="{{ $ingredient->id }}">
                {{ $ingredient->ingredient }}
            </option>
        @endforeach
    </select>
    <button type="submit">submit</button>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<script>
$(document).ready(function() {
    $('#ingredients').select2({
        placeholder: "Type ingredient name...",
        closeOnSelect: false,
        tags: true,
    });

    $('#ingredients').on('select2:select', function () {
        setTimeout(() => {
            let searchField = $('.select2-search__field');
            searchField.val('');
            searchField.trigger('input');
        }, 0);
    });
});
</script>
@endsection

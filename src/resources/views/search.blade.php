@extends("layouts.layout")

@section("title", "search")

@section("content")
<form action="{{ route('search.results') }}" method="GET">
    <label for="ingredients">ingridients:</label>
    <select name="ingredients[]" id="ingredients" multiple style="width:100%">
        @foreach($ingredients as $ingredient)
            <option value="{{ $ingredient->id }}">
                {{ $ingredient->ingredient }}
            </option>
        @endforeach
    </select>
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
    <select name="kitchen[]" id="kitchen" multiple>
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
    <br>
    <input type="checkbox" default="FALSE" name="vegeterian">
    <label for="vegeterian">vegeterian</label>
    <button type="submit">Submit</button>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#ingredients').select2({
        placeholder: "Type ingredient name...",
        allowClear: false,
        closeOnSelect: false,
    });
});
</script>
</script>
<style>
.select2-container--default .select2-selection--multiple {
    min-height: 45px;
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 5px;
}

.select2-container--default .select2-selection__choice {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 3px 8px;
    border-radius: 4px;
}

.select2-container--default .select2-results__option {
    padding: 8px;
}
</style>
@endsection

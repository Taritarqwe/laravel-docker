@extends("layouts.layout")

@section("title", "create")

@section("content")
<form action="{{ route('create.dish') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    <input type="text" id="name" name="name" placeholder="Name of dish" required>
    <br>
    
    <label for="type">Meal type:</label>
    <select name="type" id="type" required>
        <option value="">-</option>
        <option value="breakfast">breakfast</option>
        <option value="soup">soup</option>
        <option value="lunch">lunch</option>
        <option value="supper">supper</option>
        <option value="dessert">dessert</option>
    </select>
    <br>
    
    <label for="kitchen">Kitchen:</label>
    <select name="kitchen" id="kitchen" required>
        <option value="">-</option>
        <option value="american">american</option>
        <option value="asian">asian</option>
        </select>
    <br>
    
    <input type="checkbox" name="vegan" id="vegan" value="1">
    <label for="vegan">vegan</label>
    <input type="checkbox" name="vegeterian" id="vegeterian" value="1">
    <label for="vegeterian">vegeterian</label>
    <br>
    
    <input type="text" id="description" name="description" placeholder="describe the dish" required>
    <br>
    
    <input type="url" id="url" name="recipeURL" placeholder="paste the url of recipe" required>
    <br>
    
    <label for="PhotoURL">choose the picture of your dish:</label>
    <input type="file" id="PhotoURL" name="photoURL" accept="image/png, image/jpeg" required>
    <br>
    
    <label for="ingredients">ingredients:</label>
    <select name="ingredients[]" id="ingredients" multiple style="width:100%" required>
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

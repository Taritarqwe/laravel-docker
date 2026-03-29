@extends("layouts.layout")

@section("title", "browse")

@section("content") 
@foreach($dishes as $dish)

<div style="max-width: 800px; margin: 40px auto; font-family: monospace, sans-serif; padding: 20px;">

    <div style="display: flex; gap: 20px; margin-bottom: 30px;">
        
        <div style="width: 150px; height: 150px; border: 1px solid black; display: flex; align-items: center; justify-content: center;">
            @if($dish->photoURL)
                <img src="{{ asset($dish->photoURL) }}" 
                     alt="{{ $dish->name }}" 
                     style="max-width: 100%; max-height: 100%; object-fit: cover;">
            @else
                <span>img</span>
            @endif
        </div>

        <div style="flex-grow: 1;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                <span style="font-size: 1.2em;">{{ $dish->name }}</span>
                <span>{{ $dish->kitchen }}</span>
            </div>
            
            <div>
                description: {{ $dish->description }}
            </div>
        </div>
    </div>

    <div style="margin-bottom: 40px;">
        url of recipe: 
        <a href="{{ $dish->recipeURL }}" target="_blank">
            {{ $dish->recipeURL }}
        </a>
    </div>

    <div style="display: flex; justify-content: space-between;">
        
        <div>
            {{ $dish->type }}
        </div>

        <div>
            restrictions: 
            vegeterian <span>{!! $dish->vegeterian ? '&#10003;' : '&#10005;' !!}</span>
            &nbsp;&nbsp;
            vegan <span>{!! $dish->vegan ? '&#10003;' : '&#10005;' !!}</span>
        </div>

        <div style="text-align: right;">
            created by:<br>
            {{ $dish->userName }}
        </div>
    </div>

    <div>
        matches: {{ $dish->match_count ?? 0 }}
    </div>

</div>

@endforeach

@endsection
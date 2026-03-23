@extends("layouts.layout")

@section("title", "search")

@section("content")
<div style="max-width: 800px; margin: 40px auto; font-family: monospace, sans-serif; padding: 20px;">

    <div style="display: flex; gap: 20px; margin-bottom: 30px;">
        
        <div style="width: 150px; height: 150px; border: 1px solid black; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
            @if($dish->photo)
                <img src="{{ asset('storage/' . $dish->photo) }}" alt="{{ $dish->name }}" style="max-width: 100%; max-height: 100%; object-fit: cover;">
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
        url of recipe: <a href="{{ $dish->recipe_url }}" target="_blank" style="color: blue; text-decoration: none;">{{ $dish->recipe_url }}</a>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
        
        <div>
            {{ $dish->type }}
        </div>

        <div>
            restrictions: 
            vegeterian <span>{!! $dish->vegeterian ? '&#10003;' : '&#10005;' !!}</span> &nbsp;&nbsp;
            vegan <span>{!! $dish->vegan ? '&#10003;' : '&#10005;' !!}</span>
        </div>

        <div style="text-align: right;">
            created by:<br>
            {{ $dish->username }}
        </div>
    </div>

</div>

@endsection
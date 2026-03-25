@extends("layouts.layout")

@section("title", "browse")

@section("content") 
<form action="{{ route('search.results') }}" method="GET">
</form>

@endsection
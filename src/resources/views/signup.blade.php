<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('main.css') }}" rel="stylesheet">
    <title>@yield("title")</title>
</head>
<body>
<header>
    <h1>Perfood</h1>
    <a href="{{ url('sign') }}">back</a>
</header>

<form style="height:500px;" method="POST" action="{{ route('signup') }}">
    @csrf

    <input type="text" name="name" placeholder="Username"><br>

    <input type="email" name="email" placeholder="Email"><br>

    <input type="password" name="password" placeholder="Password"><br>

    <input type="password" name="password_confirmation" placeholder="Confirm Password"><br>

    <button type="submit">Submit</button>

    @if ($errors->any())
        <ul class="px-4 py-2 bg-red-100">
            @foreach ($errors->all() as $error)
                <li class="my-2 text-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</form>


@include("layouts.footer")
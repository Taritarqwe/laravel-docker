<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('main.css') }}" rel="stylesheet">
    <title>@yield("title")</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>
<header>
    <h1>Perfood</h1>
    <input type=text placeholder="recipe search">
    @guest
        <a href="{{ url('/sign') }}">sign in</a>
    @endguest

    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button>logout</button>
        </form>
    @endauth
</header>
<nav>
    <ul>
        <li><a href="{{ url('/search') }}">🔎</a></li>
        <li><a href="{{ url('/browse') }}">🌐</a></li>
        <li><a href="{{ url('/create') }}">🛠️</a></li>
        <li><a href="{{ url('/main') }}">🏠</a></li>
    </ul>
</nav>

<body>
<div id="style">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title")</title>
    
    <link href="{{ asset('main.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>
<body>

    <header>
        <h1>Perfood</h1>
        
        <div class="auth-box">
            @guest
                <a href="{{ url('/sign') }}" class="btn">sign in</a>
            @endguest

            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn">logout</button>
                </form>
            @endauth
        </div>
    </header>

    <nav class="sidenav">
        <ul>
            <li><a href="{{ url('/search') }}"><span class="icon">🔎</span><span class="nav-text">Search</span></a></li>
            <li><a href="{{ url('/browse') }}"><span class="icon">🌐</span><span class="nav-text">Browse</span></a></li>
            <li><a href="{{ url('/create') }}"><span class="icon">🛠️</span><span class="nav-text">Create</span></a></li>
            <li><a href="{{ url('/main') }}"><span class="icon">🏠</span><span class="nav-text">Home</span></a></li>
        </ul>
    </nav>

    <main>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('main.css') }}" rel="stylesheet">
    <link href="{{ asset('sign.css') }}" rel="stylesheet">
    <title>@yield("title")</title>
</head>
<body>
<header>
    <h1>Perfood</h1>
    <a href="{{ url('main') }}">back</a>
</header>
<i>
    <a id="redead", href="{{ url('signup') }}">sign up</a>
</i>
@if(request()->query('error') == 'must_login')
    <div style="background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; padding: 15px; border-radius: 4px; margin-bottom: 20px; font-family: sans-serif;">
        <strong>Restricted Access:</strong> 
        You tried to access a page that requires an account. Please sign in or create an account to continue.
    </div>
@endif
<form style="height:200px;" method="POST" action="{{ route('login.submit') }}">
    @csrf

    <input type="text" name="name" placeholder="Username"><br>
    <p>or</p>
    <input type="email" name="email" placeholder="Email"><br>

    <input type="password" name="password" placeholder="Password"><br>
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
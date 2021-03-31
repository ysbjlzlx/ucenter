<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title') | UCenter</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    </head>
    <body class="flex flex-col min-h-screen">
        <header>@include('layout.header')</header>
        <main class="flex-1">@yield('body')</main>
        <footer>@include('layout.footer')</footer>
    </body>
</html>

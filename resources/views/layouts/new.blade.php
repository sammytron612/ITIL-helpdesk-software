<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    @livewireStyles
    <!-- Styles -->
    @vite('resources/js/app.js')
    <style>


[x-cloak] { display: none !important; }


    .arrow-top {
        position: relative;
    }

    .arrow-top:before, .arrow-top:after {
        content: "";
        position: absolute;
        left: 16px;
        top: -20px;
        border-top: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid gray;
        border-left: 10px solid transparent;
    }

    .arrow-top:after {
      border-bottom: 10px solid white;
      top: -19px;
    }



    </style>

</head>

<body class="font-sans antialiased">

        @include('layouts.vertical-navigation')

        @livewireScripts
        <x-alert-component />
</body>
</html>

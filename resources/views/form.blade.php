<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Darkside Form</title>

        <!-- Styles -->
        @vite(['resources/js/app.js', 'resources/css/reset.css', 'resources/css/stylesheet.css'])
        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans" rel="stylesheet">

    </head>
    <body>
        <header>
            <h3>Darkside Test</h3>
        </header>
        <div id="app">
            <customer-form></customer-form>
        </div>
    
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Darkside Form</title>

        <!-- Styles -->
        <link href="css/reset.css" rel="stylesheet">
        <link href="css/stylesheet.css" rel="stylesheet">
        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans" rel="stylesheet">
    </head>
    <body>
        <header>
            <h3>Darkside Test</h3>
        </header>
        <div class="message">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
        <div class="main">
            <form method="POST" action="{{ route('customer.submit') }}">
                @csrf
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address">
                <button type="submit">Submit</button>
            </form>
        </div>
    </body>
</html>

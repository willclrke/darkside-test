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
        <div class="main">
            <p>Hello world!</p>
            <form method="POST" action="{{ route('customer.submit') }}">
                @csrf
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name"><br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email"><br>
                <label for="phone">Phone:</label><br>
                <input type="tel" id="phone" name="phone"><br>
                <label for="address">Address:</label><br>
                <input type="text" id="address" name="address"><br>
                <button type="submit">Submit</button>
            </form>
        </div>
    </body>
</html>

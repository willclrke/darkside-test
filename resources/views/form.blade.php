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
        <div id="content">
            <div class="title">
                <h1 id="title">Customer Details Form</h1>
            </div>
            <div class="row">
                <div id="app" class="column left">

                    <customer-form></customer-form>
                </div>
                <div id="intro" class="column right">
                    <h2>Guide</h2>
                    <br>
                    <p>The objective of this exercise is to develop a straightforward form that can save and update customer information, such as name, email, phone, and address, to a database.</p>
                    <b><p>To add a new customer's details:</p></b> 
                    <ul>
                        <li>Simply fill out the form</li>
                        <li>Hit submit!</li>
                    </ul>
                    <br>
                    <b><p>To update an existing customer:</p></b>
                    <ul>
                        <li>Enter name of the customer</li>
                        <li>Fill out remaining details with those you want to update</li>
                        <li>Hit submit!</li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>
